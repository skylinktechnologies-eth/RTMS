<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
   
    public function store(Request $request){
        
        $request->validate([
          'table_id'=>'required',
          'order_date'=>'required',
         
        ]);   
     
       $order= new Order();
       $statues="Open";
       $order->table_id=$request->table_id;
       $order->order_date=$request->order_date;
       $order->status=$statues;
       $order->save(); 
       
        return back()->with('success','Orders created successfully!');
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
