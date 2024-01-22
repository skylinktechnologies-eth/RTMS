<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\SupplyItem;
use Illuminate\Http\Request;

class SupplyItemController extends Controller
{
    //
    public function index()
    {
        $supplyItems = Item::orderBy('created_at', 'desc')->get();

        return view('Pages.SupplyItem.index', compact('supplyItems'));
    }

    public function create()
    {
        $categories = ItemCategory::all();
        return view('Pages.SupplyItem.create', compact('categories'));
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'item_name' => 'required',
            'item_category_id' => 'required',
            'unit_of_measure' => 'required',
            'price' => 'required'
        ]);
        $supplyItem = new Item();
        $supplyItem->item_name = $request->item_name;
        $supplyItem->item_category_id = $request->item_category_id;
        $supplyItem->unit_of_measure = $request->unit_of_measure;
        $supplyItem->price = $request->price;
        $supplyItem->save();
        return back()->with('success', 'Supply Item created successfully');
    }
    public function edit($id)
    {
        $categories = ItemCategory::all();
        $items = Item::find($id);
        return view('Pages.SupplyItem.edit', compact('categories','items'));
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'item_name' => 'required',
            'item_category_id' => 'required',
            'unit_of_measure' => 'required',
            'price' => 'required'

        ]);
        $supplyItem = Item::find($id);
        $supplyItem->item_name = $request->item_name;
        $supplyItem->item_category_id = $request->item_category_id;
        $supplyItem->unit_of_measure = $request->unit_of_measure;
        $supplyItem->price = $request->price;
        $supplyItem->update();
        return back()->with('success', 'Supply Item updated successfully');
    }
    public function destroy($id)
    {
        $location = Item::find($id);
        $location->delete();
        return back()->with('success', 'Supply Item deleted successfully');
    }
}
