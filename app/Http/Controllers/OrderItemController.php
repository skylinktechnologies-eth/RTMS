<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    //

    public function index()
    {
        $orderItems = OrderItem::all();
        $orders=Order::all();

        return view('Pages.OrderItem.index', compact('orderItems','orders'));
    }
    public function create()
    {
        $orderItem = OrderItem::all();
        $orders = Order::all();
        $items = MenuItem::all();
        return view('Pages.OrderItem.create', compact('orderItem', 'orders', 'items'));
    }
    public function edit($id)
    {
        $orderItem = OrderItem::find($id);
        $orders = Order::all();
        $items = MenuItem::all();
        return view('Pages.OrderItem.edit', compact('orderItem', 'orders', 'items'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'order_id'=>'required',
            'menu_item_id'=>'required',
            'quantity'=>'required',
            'sub_total'=>'required',
            'remark'=>'required',
            'status'=>'required'
        ]);

        $orderItem = new OrderItem();
        $orderItem->order_id=$request->order_id;
        $orderItem->menu_item_id=$request->menu_item_id;
        $orderItem->quantity=$request->quantity;
        $orderItem->sub_total=$request->sub_total;
        $orderItem->remark=$request->remark;
        $orderItem->status=$request->status;
        $orderItem->save();

        return back()->with('success', 'Order Item created successfully!');
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'table_id' => 'required',
        ]);

        $orderItem =  OrderItem::find($id);


        $orderItem->update();
        return back()->with('success', 'Menu Item update successfully!');
    }
    public function destroy(String $id)
    {
        $orderItem = OrderItem::find($id);
        $orderItem->delete();
        return back()->with('success', 'Menu Item delete successfully!');
    }
    public function changeStatusToPreparing($id)
    {

        $orderItems = OrderItem::where( 'order_id',$id)->get();
       
        foreach($orderItems as $orderItem){
            $orderItem->status = 'Preparing';
            $orderItem->save();
        }
       
        return back()->with('success', 'Change Status');
    } 
    public function changeStatusToReady($id)
    {

        $orderItems = OrderItem::where( 'order_id',$id)->get();
       
        foreach($orderItems as $orderItem){
            $orderItem->status = 'Ready';
            $orderItem->save();
        }
       
        return back()->with('success', 'Change Status');
    }

}
