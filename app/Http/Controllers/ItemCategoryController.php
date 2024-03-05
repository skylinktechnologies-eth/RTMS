<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemCategoryController extends Controller
{
  //
  function __construct()
  {
    $this->middleware('permission:supplyItemCategory-list|supplyItemCategory-create|supplyItemCategory-edit|supplyItemCategory-delete', ['only' => ['index', 'store']]);
    $this->middleware('permission:supplyItemCategory-create', ['only' => ['index', 'store']]);
    $this->middleware('permission:supplyItemCategory-edit', ['only' => ['index', 'update']]);
    $this->middleware('permission:supplyItemCategory-delete', ['only' => ['destroy']]);
  }
  public function index()
  {
    $itemCategories = ItemCategory::orderBy('created_at', 'desc')->get();
    return view('Pages.ItemCategory.index', compact('itemCategories'));
  }
  public function store(Request $request)
  {
    $request->validate([
      'item_category_name' => 'required'
    ]);
    $category = new ItemCategory();
    $category->item_category_name = $request->item_category_name;
    $category->save();
    return back()->with('success', 'Category created successfully');
  }
  public function update(Request $request, $id)
  {
    $request->validate([
      'item_category_name' => 'required'
    ]);
    $category = ItemCategory::find($id);
    $category->item_category_name = $request->item_category_name;
    $category->update();
    return back()->with('success', 'Category updated successfully');
  }
  public function destroy($id)
  {
    try {
      $relatedCount = DB::table('items')->where('item_category_id', $id)->count();

      if ($relatedCount === 0) {
        $category = ItemCategory::find($id);
        $category->delete();
        return redirect()->back();
      } else {

        return back()->with('danger', 'Cannot delete  Item Category  with related data');
      }
    } catch (QueryException $e) {
    }
  }
}
