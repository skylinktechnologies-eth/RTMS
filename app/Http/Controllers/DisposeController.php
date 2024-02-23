<?php

namespace App\Http\Controllers;

use App\Models\Disposing;
use App\Models\DisposingItem;
use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisposeController extends Controller
{
    //
    public function index(){

        $disposings=Disposing::all();
        $disposingItems=DisposingItem::all();
        return view('Pages.Despose.index',compact('disposings','disposingItems'));
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

       
        $items = Item::all();
        return view('Pages.Despose.create', compact('items', 'inventories'));
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
        $disposingItems = DisposingItem::where('disposing_id', $id)->get(); // Use get() to fetch the results
        $disposing = Disposing::find($id);
        $items = Item::all();


        return view('Pages.Despose.edit', compact( 'items', 'disposingItems', 'disposing', 'inventories'));
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'disposed_by' => 'required',
            'disposed_date' => 'required',
            'reason' => 'nullable',
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
                return back()->with('success', 'Disposing quantity is greater than available quantity.');
            }
        }

        $disposing = new Disposing();
        $disposing->disposed_by = $request->disposed_by;
        $disposing->disposed_date = $request->disposed_date;
        $disposing->reason = $request->reason;
        $disposing->save();

        foreach ($request->item_list as $item) {
            $disposingItem = new DisposingItem();
            $disposingItem->disposing_id = $disposing->id;
            $disposingItem->item_id = $item['item_id'];
            $disposingItem->quantity = $item['quantity'];
            $disposingItem->total = $item['quantity'];
            $disposingItem->save();

            // Update inventories
            $inventoryDisposes = Inventory::where('item_id', $item['item_id'])->where('quantity', '<', 0)->get();

            if ($inventoryDisposes->isNotEmpty()) {
                foreach ($inventoryDisposes as $inventoryDispose) {
                    $inventoryDispose->quantity -= $item['quantity'];
                    $inventoryDispose->save();
                }
            } else {


                $inventory = new Inventory();
                $inventory->item_id = $disposingItem->item_id;
                $inventory->quantity = -($disposingItem->quantity);
                $inventory->last_update = now()->format('Y-m-d');
                $inventory->save();
            }
            
            
        }

        return redirect()->route('disposing.index')->with('success', 'Disposing record successfully created.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'disposed_by' => 'required',
            'disposed_date' => 'required',
            'reason' => 'nullable',
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
        $disposing =  Disposing::find($id);
        $disposing->disposed_by = $request->disposed_by;
        $disposing->disposed_date = $request->disposed_date;
        $disposing->reason = $request->reason;
        $disposing->save();
        $getItem = DisposingItem::where('disposing_id', $id)->get();
        DisposingItem::where('disposing_id', $id)->delete();
        foreach ($request->List as $item) {
            $disposingItem = new DisposingItem();
            $disposingItem->disposing_id = $disposing->id;
            $disposingItem->item_id = $item['item_id'];
            $disposingItem->quantity = $item['quantity'];
            $disposingItem->total = $item['quantity'];
            $disposingItem->save();
            $inventoryItems = Inventory::where('item_id', $item['item_id'])->get();

            if ($inventoryItems->isNotEmpty()) {
                foreach ($inventoryItems as $inventoryItem) {
                    foreach ($getItem as $items) {
                        if ($inventoryItem->quantity < 0) {

                            if ($items->item_id == $inventoryItem->item_id) {
                                $inventoryItem->quantity =  $inventoryItem->quantity + $items->quantity - $disposingItem->quantity;
                                $inventoryItem->save();
                            }
                        }
                    }
                }
            } else {
                $inventory = new Inventory();
                $inventory->item_id = $disposingItem->item_id;
                $inventory->quantity = $disposingItem->quantity;
                $inventory->last_update = now()->format('Y-m-d');
                $inventory->save();
            }
        }

        return redirect()->route('disposing.index');
    }
    public function destroy(String $id)
    {
        $disposingItems = DisposingItem::where('disposing_id', $id)->get();
        $inventories = Inventory::all();
        foreach ($disposingItems as $disposingItem) {
            foreach ($inventories as $inventory) {

                if ($inventory->item_id == $disposingItem->item_id &&  $inventory->quantity < 0) {

                    $inventory->quantity =  $inventory->quantity + $disposingItem->quantity;
                    $inventory->save();
                }

            }
            foreach ($inventories as $inventory) {
                if($inventory->quantity==0){
                    $inventory->delete();
                }
              
            }
            DisposingItem::where('disposing_id', $id)->delete();
        }

        // Optionally, if you want to delete the SupplyOrder as well, uncomment the following lines:
        $issuing = Disposing::find($id);
        $issuing->delete();

        return back()->with('success', 'Disposing deleted successfully!');
    }
}
