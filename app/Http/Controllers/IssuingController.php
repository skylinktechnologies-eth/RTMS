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
        $issuingItems=IssuingItem::orderBy('created_at', 'desc')->get();
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
        $issuingItems = IssuingItem::where('issuing_id', $id)->get(); // Use get() to fetch the results
        $issuing = Issuing::find($id);
        $locations = Location::all();
        $items = Item::all();
        

        return view('Pages.Issuing.edit', compact('locations', 'items', 'issuingItems', 'issuing'));
    }
    public function store(Request $request)
    {
        $request->validate([

        ]);
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
        return redirect()->route('issuing.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'location_id'=>'required',
            'issued_date'=>'required',
            'issued_to'=>'required',
            'List'=>'required',

        ]);
        $issuing =  Issuing::find($id);
        $issuing->location_id = $request->location_id;
        $issuing->issued_date = $request->issued_date;
        $issuing->issued_to =  $request->issued_to;
        $issuing->save();

        IssuingItem::where('issuing_id',$id)->delete();
        foreach ($request->List as $item) {
            $issuingItem = new IssuingItem();
            $issuingItem->issuing_id = $issuing->id;
            $issuingItem->item_id = $item['item_id'];
            $issuingItem->quantity = $item['quantity'];
            $issuingItem->total = $item['quantity'];
            $issuingItem->save();
        }
        return back()->with('success','Issuing Updated successfully');
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
