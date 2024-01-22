<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    //

    public function index()
    {
        $items = MenuItem::orderBy('created_at', 'desc')->get();

        return view('Pages.MenuItem.index', compact('items'));
    }
    public function create()
    {
        $items = MenuItem::all();
        $categories = Category::all();
        return view('Pages.MenuItem.create', compact('items', 'categories'));
    }
    public function edit($id)
    {
        $item = MenuItem::find($id);
        $categories = Category::all();
        return view('Pages.MenuItem.edit', compact('item', 'categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'item_name' => 'required',
            'image' => 'nullable',
            'price' => 'required'
        ]);


        $menItem = new MenuItem();
        $menItem->category_id = $request->category_id;
        $menItem->item_name = $request->item_name;
        $menItem->price = $request->price;
        if ($request->image) {
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $filepath = $request->image->storeAs('itemImage', $filename, 'public'); // Store in the 'public' disk
            $menItem->image = $filepath;
        }

        $menItem->save();

        return redirect()->route('menuItem.index');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'category_id' => 'required',
            'item_name' => 'required',

            'price' => 'required'
        ]);

        $menItem =  MenuItem::find($id);
        $menItem->category_id = $request->category_id;
        $menItem->item_name = $request->item_name;
        $menItem->price = $request->price;
        if ($request->image) {
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $filepath = $request->image->storeAs('uploads', $filename, 'public'); // Store in the 'public' disk
            $menItem->image = $filepath;
        }

        $menItem->update();
        return back()->with('success', 'Menu Item update successfully!');
    }
    public function destroy(String $id)
    {
        $menItem = MenuItem::find($id);
        $menItem->delete();
        return back()->with('success', 'Menu Item delete successfully!');
    }
}
