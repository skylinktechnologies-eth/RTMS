<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderInteraction;
use App\Models\OrderItem;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
        $orderItems = OrderItem::all();

        return view('Pages.Order.index', compact('orderItems'));
    }
    public function create()
    {
        $order = Order::all();
        $tables = Table::all();
        $menuItems = MenuItem::all();;
        return view('Pages.Order.create', compact('order', 'tables', 'menuItems'));
    }
    public function edit($id)
    {
        $order = Order::find($id);
        $tables = Table::all();
        return view('Pages.Order.edit', compact('order', 'tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_date' => 'required',
            'table_id' => 'required',
            
        ]);

        $order = new Order();
        $order->table_id = $request->table_id;
        $order->order_date = $request->order_date;
        $order->status = 'Open';
        $order->save();

        foreach ($request->menu_item_id as $index => $item_id) {
            if ($request->quantity[$index] != null) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->menu_item_id = $item_id;
                $orderItem->quantity = $request->quantity[$index]; // Use $index instead of $quantity
                $orderItem->sub_total = $request->quantity[$index] * $request->price[$index]; // Use $index instead of [$price]
                $orderItem->remark = $request->remark[$index];
                $orderItem->status = 'Pending';
                $orderItem->save();
            }
        }
        $interaction = new OrderInteraction();
        $interaction->order_id = $order->id;
        $interaction->waitstaff_id = Auth::id();
        $interaction->interaction_date = $order->order_date;
        $interaction->interaction_type = 'Order Placed';
        $interaction->save();
        return redirect()->route('orderItem.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'table_id' => 'required',
            'order_date' => 'required',
        ]);

        $order =  Order::find($id);
        $order->table_id = $request->table_id;
        $order->order_date = $request->order_date;
        $order->status = "Open";
        $order->update();
        return back()->with('success', 'Orders update successfully!');
    }
    public function destroy(String $id)
    {
        $order = Order::find($id);
        $order->delete();
        return back()->with('success', 'Orders delete successfully!');
    }
    public function changeStatusClose($id)
    {
        $order = order::find($id);
        $order->status = 'Close';
        $order->save();
        return back()->with('success', 'Change Status');
    }
}
