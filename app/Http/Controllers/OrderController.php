<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    
    public function index(){
        $orders=Order::all();
        return view('Pages.Order.index',compact('orders'));
    }
    public function create(){
        $order=Order::all();
     $tables=Table::all();
;        return view('Pages.Order.create',compact('order','tables'));
    }
    public function edit( $id){
        $order=Order::find($id);
        $tables=Table::all();
        return view('Pages.Order.edit',compact('order','tables'));
    }
   
    public function store(Request $request) {
        return $request->all();
        $request->validate([
            'order_date' => 'required',
            'table_id' => 'required',
            'item_id' => 'array',
            'price' => 'array',
            'quantity' => 'array',
            'remark' => 'array',
        ]);
    
        $order = new Order();
        $order->table_id = $request->table_id;
        $order->order_date = $request->order_date;
        $order->status = 'Open';
        $order->save();
    
        foreach ($request->item_id as $index => $item_id) {
            $orderItem = new OrderItem();
            $orderItem->supply_order_id = $order->id;
            $orderItem->item_id = $item_id;
            $orderItem->quantity = $request->quantity[$index];
            $orderItem->price = $request->price[$index];
            $orderItem->total = $request->quantity[$index] * $request->price[$index];
            $orderItem->remark = $request->remark[$index];
            $orderItem->save();
        }
    
        return redirect()->route('your.success.route');
    }
    

    public function update(Request $request, $id){
        
        $request->validate([
            
            'table_id' => 'required', 
            'order_date'=>'required', 
        ]);   
       
       $order=  Order::find($id);
       $order->table_id=$request->table_id;
       $order->order_date=$request->order_date;
       $order->status="Open";
       $order->update();
        return back()->with('success','Orders update successfully!');
    }
    public function destroy(String $id){
        $order= Order::find($id);
        $order->delete();
        return back()->with('success','Orders delete successfully!');

    }
}
