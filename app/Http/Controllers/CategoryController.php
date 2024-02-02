<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:menuCategory-list|menuCategory-create|menuCategory-edit|menuCategory-delete', ['only' => ['index','store']]);
         $this->middleware('permission:menuCategory-create', ['only' => ['index','store']]);
         $this->middleware('permission:menuCategory-edit', ['only' => ['index','update']]);
         $this->middleware('permission:menuCategory-delete', ['only' => ['destroy']]);
    }
     
    public function index(){
        $categories=Category::orderBy('created_at', 'desc')->get();
      
        return view('Pages.Category.index',compact('categories'));
    }
    // public function create(){
    //     $category=Category::all();
    //     $tables=Table::all();
    //     return view('Pages.Reservation.create',compact('reservations','tables'));
    // }
    // public function edit( $id){
    //     $reservation=Reservation::find($id);
    //     $tables=Table::all();
    //     return view('Pages.Reservation.edit',compact('reservation','tables'));
    // }
   
    public function store(Request $request){
        
        $request->validate([
            
            'category_name' => 'required', 
        ]);   
       
       $category= new Category();
       $category->category_name=$request->category_name;
       $category->save(); 
       
        return back()->with('success','Category created successfully!');
    }

    public function update(Request $request, $id){
        
        $request->validate([
            
            'category_name' => 'required', 
        ]);   
       
       $category=  Category::find($id);
       $category->category_name=$request->category_name;
       $category->update();
        return back()->with('success','Category update successfully!');
    }
    public function destroy(String $id){
        $category= Category::find($id);
        $category->delete();
        return back()->with('success','Category delete successfully!');

    }
}
