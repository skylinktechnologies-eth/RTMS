<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:menuCategory-list|menuCategory-create|menuCategory-edit|menuCategory-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:menuCategory-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:menuCategory-edit', ['only' => ['index', 'update']]);
        $this->middleware('permission:menuCategory-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('Pages.Category.index', compact('categories'));
    }
   

    public function store(Request $request)
    {

        $request->validate([

            'category_name' => 'required',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        return back()->with('success', 'Category created successfully!');
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'category_name' => 'required',
        ]);

        $category =  Category::find($id);
        $category->category_name = $request->category_name;
        $category->update();
        return back()->with('success', 'Category update successfully!');
    }
    public function destroy(String $id)
    {
        try {

            $relatedCount = DB::table('menu_items')->where('category_id', $id)->count();

            if ($relatedCount === 0) {
                $category = Category::find($id);
                $category->delete();
                return redirect()->back();
            } else {

                return back()->with('danger', 'Cannot delete category  with related datas.');
            }
        } catch (QueryException $e) {
        }

        return back()->with('success', 'Category delete successfully!');
    }
}
