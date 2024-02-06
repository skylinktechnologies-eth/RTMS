<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Issuing;
use App\Models\IssuingItem;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Http\Request;

class IssuingController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:issuing-list|issuing-create|issuing-edit|issuing-delete', ['only' => ['index','store']]);
         $this->middleware('permission:issuing-create', ['only' => ['create','store']]);
         $this->middleware('permission:issuing-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:issuing-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $issuingItems = IssuingItem::orderBy('created_at', 'desc')->get();
        return view('Pages.Issuing.index', compact('issuingItems'));
    }
    public function create()
    {
        $inventories = Inventory::all();
        $locations = Location::all();
        $items = Item::all();
        return view('Pages.Issuing.create', compact('locations', 'items', 'inventories'));
    }
    public function edit($id)
    {
        $issuingItems = IssuingItem::where('issuing_id', $id)->get(); // Use get() to fetch the results
        $issuing = Issuing::find($id);
        $locations = Location::all();
        $items = Item::all();


        return view('Pages.Issuing.edit', compact('locations', 'items', 'issuingItems', 'issuing'));
    }
    public function store(Request $request)
    {
        
        $request->validate([]);
        $issuing = new Issuing();
        $issuing->location_id = $request->location_id;
        $issuing->issued_date = $request->issued_date;
        $issuing->issued_to =  $request->issued_to;
        $issuing->save();

        // Iterate through each item in the request and create a new SupplyOrderItem
        foreach ($request->item_list as $item) {
            $issuingItem = new IssuingItem();
            $inventoryItems = Inventory::where('item_id', $item['item_id'])->get();
           
            $issuingItem->issuing_id = $issuing->id;
            $issuingItem->item_id = $item['item_id'];
            $issuingItem->quantity = $item['quantity']; // Set the quantity directly
        
            foreach ($inventoryItems as $inventoryItem) {
            
                if ($inventoryItem->quantity > 0) {
                   
                    // Check if the issuing quantity is less than or equal to the purchased quantity
                    if ($item['quantity'] > abs($inventoryItem->quantity)) {
                        // If any item has a quantity greater than the purchased quantity, delete the issuing record
                        Issuing::where('id', $issuing->id)->delete();
                        return back()->with('success', 'Issuing quantity is greater than available quantity.');
                    }
                    else {
                        foreach ($inventoryItems as $inventoryItem) {
                            if ($inventoryItem->quantity < 0) {
                                $inventoryItem->quantity += -($issuingItem->quantity);
                                $inventoryItem->save();
                            } else {
                                $inventory = new Inventory();
                                $inventory->item_id = $issuingItem->item_id;
                                $inventory->quantity = -($issuingItem->quantity);
                                $inventory->last_update = now()->format('Y-m-d');
                                $inventory->save();
                            }
                        }
                } 
                }
            }
        
            $issuingItem->total = $item['quantity'];
            $issuingItem->save();
        
            foreach ($inventoryItems as $inventoryItem) {
                if ($inventoryItem->quantity < 0) {
                    $inventoryItem->quantity += -($issuingItem->quantity);
                    $inventoryItem->save();
                } else {
                    $inventory = new Inventory();
                    $inventory->item_id = $issuingItem->item_id;
                    $inventory->quantity = -($issuingItem->quantity);
                    $inventory->last_update = now()->format('Y-m-d');
                    $inventory->save();
                }
            }
        }
        
        return redirect()->route('issuing.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'location_id' => 'required',
            'issued_date' => 'required',
            'issued_to' => 'required',
            'List' => 'required',

        ]);
        $issuing =  Issuing::find($id);
        $issuing->location_id = $request->location_id;
        $issuing->issued_date = $request->issued_date;
        $issuing->issued_to =  $request->issued_to;
        $issuing->save();
        $getItem = IssuingItem::where('issuing_id', $id)->get();
        IssuingItem::where('issuing_id', $id)->delete();
        foreach ($request->List as $item) {
            $issuingItem = new IssuingItem();
            $issuingItem->issuing_id = $issuing->id;
            $issuingItem->item_id = $item['item_id'];
            $issuingItem->quantity = $item['quantity'];
            $issuingItem->total = $item['quantity'];
            $issuingItem->save();
            $inventoryItems = Inventory::where('item_id', $item['item_id'])->get();

            if ($inventoryItems->isNotEmpty()) {
                foreach ($inventoryItems as $inventoryItem) {
                    foreach ($getItem as $items) {
                    if ($inventoryItem->quantity < 0) {
                       
                            if ($items->item_id == $inventoryItem->item_id) {
                                $inventoryItem->quantity =  $inventoryItem->quantity + $items->quantity - $issuingItem->quantity;
                                $inventoryItem->save();
                            }
                        }
                    }
                }
            } else {
                $inventory = new Inventory();
                $inventory->item_id = $issuingItem->item_id;
                $inventory->quantity = $issuingItem->quantity;
                $inventory->last_update = now()->format('Y-m-d');
                $inventory->save();
            }
        }
    
        return redirect()->route('issuing.index');
    }
    public function destroy(String $id)
    {
        $issuingItems = IssuingItem::where('issuing_id', $id)->get();

        foreach ($issuingItems as $issuingItem) {
            $issuingItem->delete();
        }

        // Optionally, if you want to delete the SupplyOrder as well, uncomment the following lines:
        $issuing = Issuing::find($id);
        $issuing->delete();

        return back()->with('success', 'Issuing deleted successfully!');
    }
}
