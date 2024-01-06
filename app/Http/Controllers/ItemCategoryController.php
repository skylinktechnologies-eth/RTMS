<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    //
    public function index(){
        $itemCategories=ItemCategory::all();
        return view('Pages.ItemCategory.index',compact('itemCategories'));
    }
    public function store(Request $request)
    {
          $request->validate([
            'item_category_name'=>'required'
          ]);
          $category=new ItemCategory();
          $category->item_category_name=$request->item_category_name;
          $category->save();
          return back()->with('success','Category created successfully');
    }
    public function update(  Request $request ,$id)
    {
          $request->validate([
            'item_category_name'=>'required'
          ]);
          $category= ItemCategory::find($id);
          $category->item_category_name=$request->item_category_name;
          $category->update();
          return back()->with('success','Category updated successfully');
    }
    public function destroy($id){
        $category= ItemCategory::find($id);
        $category->delete();
        return back()->with('success','Category deleted successfully');
    }
}
