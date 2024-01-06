<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\SupplyOrder;
use App\Models\SupplyOrderItem;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    public function index()
    {
        $orderItems = SupplyOrderItem::all();
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

        // Iterate through each item in the request and create a new SupplyOrderItem
        foreach ($request->item_list as $item) {
            $orderItem = new SupplyOrderItem();
            $orderItem->supply_order_id = $supplyOrder->id;
            $orderItem->item_id = $item['item_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->total = $item['total'];
            $orderItem->save();
        }
        return back()->with('success','Issuing Created successfully');
    }
    public function update(Request $request ,$id)
    {
        $request->validate([]);

        $supplyOrder =  SupplyOrder::find($id);
        $supplyOrder->supplier_id = $request->supplier_id;
        $supplyOrder->order_date = $request->order_date;
        $supplyOrder->status = "Placed";
        $supplyOrder->save();

        // Iterate through each item in the request and create a new SupplyOrderItem
        $orderItem =  SupplyOrderItem::where('supply_order_id',$id)->get();
      
        
         
            $orderItem->supply_order_id = $supplyOrder->id;
            $orderItem->item_id = $request->item_id;
            $orderItem->quantity = $request->quantity;
            $orderItem->price = $request->price;
            $orderItem->total = $request->total;
            $orderItem->save();
       
    }
}
