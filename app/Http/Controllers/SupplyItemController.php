<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplyItemController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:supplyItem-list|supplyItem-create|supplyItem-edit|supplyItem-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:supplyItem-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:supplyItem-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:supplyItem-delete', ['only' => ['destroy']]);
    }

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
        return redirect()->route('supplyItem.index');
    }
    public function edit($id)
    {
        $categories = ItemCategory::all();
        $items = Item::find($id);
        return view('Pages.SupplyItem.edit', compact('categories', 'items'));
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
        return redirect()->route('supplyItem.index');
    }
    public function destroy($id)
    {
        try {

            $relatedCount = DB::table('supply_order_items')->where('item_id', $id)->count();
            $relatedIssuingCount = DB::table('issuing_items')->where('item_id', $id)->count();
            $relatedDisposingCount = DB::table('disposing_items')->where('item_id', $id)->count();

            if ($relatedCount === 0 && $relatedIssuingCount === 0 && $relatedDisposingCount === 0) {

                $location = Item::find($id);
                $location->delete();
                return redirect()->back();
            } else {

                return back()->with('danger', 'Cannot delete  Supply Item  with related data');
            }
        } catch (QueryException $e) {
        }
    }
}
