<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Issuing;
use App\Models\IssuingItem;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssuingController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:issuing-list|issuing-create|issuing-edit|issuing-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:issuing-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:issuing-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:issuing-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $issuingItems = IssuingItem::orderBy('created_at', 'desc')->get();
        return view('Pages.Issuing.index', compact('issuingItems'));
    }
    public function create()
    {
        $inventories = Inventory::select(
            'item_id',
            DB::raw('SUM(CASE WHEN quantity > 0 THEN quantity ELSE 0 END) as purchased_quantity'),
            DB::raw('SUM(CASE WHEN quantity < 0 THEN ABS(quantity) ELSE 0 END) as issued_quantity')
        )
            ->groupBy('item_id')
            ->with('item') // Load the 'item' relationship
            ->get();

        $locations = Location::all();
        $items = Item::all();
        return view('Pages.Issuing.create', compact('locations', 'items', 'inventories'));
    }
    public function edit($id)
    {
        $inventories = Inventory::select(
            'item_id',
            DB::raw('SUM(CASE WHEN quantity > 0 THEN quantity ELSE 0 END) as purchased_quantity'),
            DB::raw('SUM(CASE WHEN quantity < 0 THEN ABS(quantity) ELSE 0 END) as issued_quantity')
        )
            ->groupBy('item_id')
            ->with('item') // Load the 'item' relationship
            ->get();
        $issuingItems = IssuingItem::where('issuing_id', $id)->get(); // Use get() to fetch the results
        $issuing = Issuing::find($id);
        $locations = Location::all();
        $items = Item::all();


        return view('Pages.Issuing.edit', compact('locations', 'items', 'issuingItems', 'issuing', 'inventories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
            'issued_date' => 'required',
            'issued_to' => 'nullable',
            'item_list' => 'required',

        ]);
        $inventories = Inventory::select(
            'item_id',
            DB::raw('SUM(CASE WHEN quantity > 0 THEN quantity ELSE 0 END) as purchased_quantity'),
            DB::raw('SUM(CASE WHEN quantity < 0 THEN ABS(quantity) ELSE 0 END) as issued_quantity')
        )
            ->groupBy('item_id')
            ->with('item') // Load the 'item' relationship
            ->get();

        foreach ($request->item_list as $item) {
            $available_quantity = 0;

            foreach ($inventories as $inventory) {
                if ($item['item_id'] == $inventory->item_id) {
                    $available_quantity = $inventory->purchased_quantity - $inventory->issued_quantity;
                    break; // Exit the loop once a match is found
                }
            }

            // Check if the issuing quantity is greater than the available quantity
            if ($item['quantity'] > $available_quantity) {
                return back()->with('success', 'Issuing quantity is greater than available quantity.');
            }
        }

        $issuing = new Issuing();
        $issuing->location_id = $request->location_id;
        $issuing->issued_date = $request->issued_date;
        $issuing->issued_to = $request->issued_to;
        $issuing->save();

        foreach ($request->item_list as $item) {
            $issuingItem = new IssuingItem();
            $issuingItem->issuing_id = $issuing->id;
            $issuingItem->item_id = $item['item_id'];
            $issuingItem->quantity = $item['quantity'];
            $issuingItem->total = $item['quantity'];
            $issuingItem->save();

            // Update inventories
            $inventoryIssues = Inventory::where('item_id', $item['item_id'])->where('quantity', '<', 0)->get();

            if ($inventoryIssues->isNotEmpty()) {
                foreach ($inventoryIssues as $inventoryIssue) {
                    $inventoryIssue->quantity -= $item['quantity'];
                    $inventoryIssue->save();
                }
            } else {


                $inventory = new Inventory();
                $inventory->item_id = $issuingItem->item_id;
                $inventory->quantity = -($issuingItem->quantity);
                $inventory->last_update = now()->format('Y-m-d');
                $inventory->save();
            }
            
            
        }

        return redirect()->route('issuing.index')->with('success', 'Issuing record successfully created.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location_id' => 'required',
            'issued_date' => 'required',
            'List' => 'required',

        ]);
        $inventories = Inventory::select(
            'item_id',
            DB::raw('SUM(CASE WHEN quantity > 0 THEN quantity ELSE 0 END) as purchased_quantity'),
            DB::raw('SUM(CASE WHEN quantity < 0 THEN ABS(quantity) ELSE 0 END) as issued_quantity')
        )
            ->groupBy('item_id')
            ->with('item') // Load the 'item' relationship
            ->get();

        foreach ($request->List as $item) {
            $available_quantity = 0;

            foreach ($inventories as $inventory) {
                if ($item['item_id'] == $inventory->item_id) {
                    $available_quantity = $inventory->purchased_quantity - $inventory->issued_quantity;
                    break; // Exit the loop once a match is found
                }
            }

            // Check if the issuing quantity is greater than the available quantity
            if ($item['quantity'] > $available_quantity) {
                return back()->with('success', 'Issuing quantity is greater than available quantity.');
            }
        }
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
        $inventories = Inventory::all();
        foreach ($issuingItems as $issuingItem) {
            foreach ($inventories as $inventory) {

                if ($inventory->item_id == $issuingItem->item_id &&  $inventory->quantity < 0) {

                    $inventory->quantity =  $inventory->quantity + $issuingItem->quantity;
                    $inventory->save();
                }

            }
            foreach ($inventories as $inventory) {
                if($inventory->quantity==0){
                    $inventory->delete();
                }
              
            }
            IssuingItem::where('issuing_id', $id)->delete();
        }

        // Optionally, if you want to delete the SupplyOrder as well, uncomment the following lines:
        $issuing = Issuing::find($id);
        $issuing->delete();

        return back()->with('success', 'Issuing deleted successfully!');
    }
}
