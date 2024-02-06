<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\SupplyOrder;
use App\Models\SupplyOrderItem;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:purchase-list|purchase-create|purchase-edit|purchase-delete', ['only' => ['index', 'store', 'changeStatusToReceived', 'changeStatusToPlaced']]);
        $this->middleware('permission:purchase-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:purchase-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:purchase-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $orderItems = SupplyOrderItem::orderBy('created_at', 'desc')->get();
        $supplyOrder = SupplyOrder::all();
        return view('Pages.Purchase.index', compact('orderItems'));
    }
    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::all();
        return view('Pages.Purchase.create', compact('suppliers', 'items'));
    }
    public function edit($id)
    {
        $orderItems = SupplyOrderItem::where('supply_order_id', $id)->get(); // Use get() to fetch the results
        $supplyOrder = SupplyOrder::find($id);
        $suppliers = Supplier::all();
        $items = Item::all();
        // foreach ($orderItems as  $orderItem) {
        //     return  $orderItem;
        // }

        return view('Pages.Purchase.edit', compact('suppliers', 'items', 'orderItems', 'supplyOrder'));
    }
    public function store(Request $request)
    {

        $request->validate([]);

        $supplyOrder = new SupplyOrder();
        $supplyOrder->supplier_id = $request->supplier_id;
        $supplyOrder->order_date = $request->order_date;
        $supplyOrder->status = "Placed";
        $supplyOrder->save();

        // $table->foreignId('item_id')->constrained();
        // $table->integer('quantity');
        // $table->date('last_update');
        // Iterate through each item in the request and create a new SupplyOrderItem
        foreach ($request->item_list as $item) {
            $orderItem = new SupplyOrderItem();
            $orderItem->supply_order_id = $supplyOrder->id;
            $orderItem->item_id = $item['item_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->total = $item['total'];
            $orderItem->save();

            $inventoryItems = Inventory::where('item_id', $item['item_id'])->get();



            if ($inventoryItems->isNotEmpty()) {
                foreach ($inventoryItems as $inventoryItem) {
                    if ($inventoryItem->quantity > 0) {
                        $inventoryItem->quantity += $orderItem->quantity;
                        $inventoryItem->save();
                    } else {

                    }
                }
            } else {


                $inventory = new Inventory();
                $inventory->item_id = $orderItem->item_id;
                $inventory->quantity = $orderItem->quantity;
                $inventory->last_update = now()->format('Y-m-d');
                $inventory->save();
            }
        }

        return redirect()->route('purchase.index');
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'List' => 'required'
            // Add your validation rules here
        ]);
        $supplyOrder = SupplyOrder::find($id);
        $supplyOrder->supplier_id = $request->supplier_id;
        $supplyOrder->order_date = $request->order_date;
        $supplyOrder->save();
        $getItem = SupplyOrderItem::where('supply_order_id', $id)->get();
        SupplyOrderItem::where('supply_order_id', $id)->delete();


        // Iterate through each item in the request and create a new SupplyOrderItem
        foreach ($request->List as $item) {
            $orderItem = new SupplyOrderItem();
            $orderItem->supply_order_id = $supplyOrder->id;
            $orderItem->item_id = $item['item_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->total = $item['total'];
            $orderItem->save();
            $inventoryItems = Inventory::where('item_id', $item['item_id'])->get();



            if ($inventoryItems->isNotEmpty()) {
                foreach ($inventoryItems as $inventoryItem) {
                    foreach ($getItem as $items) {
                    if ($inventoryItem->quantity > 0) {
                       
                            if ($items->item_id == $inventoryItem->item_id) {
                                $inventoryItem->quantity =  $inventoryItem->quantity - $items->quantity + $orderItem->quantity;
                                $inventoryItem->save();
                            }
                        }
                    }
                }
            } else {


                $inventory = new Inventory();
                $inventory->item_id = $orderItem->item_id;
                $inventory->quantity = $orderItem->quantity;
                $inventory->last_update = now()->format('Y-m-d');
                $inventory->save();
            }
        }
        return redirect()->route('purchase.index');
    }
    public function destroy(String $id)
    {
        $orderItems = SupplyOrderItem::where('supply_order_id', $id)->get();

        foreach ($orderItems as $orderItem) {
            $orderItem->delete();
        }

        // Optionally, if you want to delete the SupplyOrder as well, uncomment the following lines:
        $supplyOrder = SupplyOrder::find($id);
        $supplyOrder->delete();

        return back()->with('success', 'Order deleted successfully!');
    }
    public function changeStatusToReceived($id)
    {
        $supplyOrder = SupplyOrder::find($id);
        $supplyOrder->status = 'Recieved';
        $supplyOrder->save();
        return back()->with('success', 'Change Status');
    }
    public function changeStatusToPlaced($id)
    {
        $supplyOrder = SupplyOrder::find($id);
        $supplyOrder->status = 'Placed';
        $supplyOrder->save();
        return back()->with('success', 'Change Status');
    }
}
