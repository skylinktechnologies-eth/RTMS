<?php

namespace App\Http\Controllers;

use App\Models\Issuing;
use App\Models\IssuingItem;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Http\Request;

class IssuingController extends Controller
{
    //
    public function index()
    {
        $issuingItems=IssuingItem::all();
        return view('Pages.Issuing.index',compact('issuingItems'));
    }
    public function create()
    {
        $locations = Location::all();
        $items = Item::all();
        return view('Pages.Issuing.create', compact('locations', 'items'));
    }
    public function edit($id)
    {
        // $orderItems = SupplyOrderItem::where('supply_order_id', $id)->get(); // Use get() to fetch the results
        // $supplyOrder = SupplyOrder::find($id);
        // $suppliers = Supplier::all();
        // $items = Item::all();
        // foreach ($orderItems as  $orderItem) {
        //     return  $orderItem;
        // }

        return view('Pages.Purchase.edit', compact('suppliers', 'items', 'orderItems', 'supplyOrder'));
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
            $issuingItem->issuing_id = $issuing->id;
            $issuingItem->item_id = $item['item_id'];
            $issuingItem->quantity = $item['quantity'];
            $issuingItem->total = $item['quantity'];
            $issuingItem->save();
        }
        return back()->with('success','Issuing Created successfully');
    }
}
