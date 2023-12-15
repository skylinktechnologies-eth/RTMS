<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class TableController extends Controller
{
    //
    public function index(){
        $tables=Table::all();
        return view('Pages.Table.index',compact('tables'));
    }

    public function create(){
        return view('Pages.Table.create');
    }
    public function edit(String $id){

        return view('Pages.Table.create');
    }
    public function store(Request $request){
        
        $request->validate([
            
            'table_name' => 'required',
            'capacity' => 'required'
           
        ]);
       $tables= new Table;
       $statuses="Vacant";
       $tables->table_name=$request->table_name;
       $tables->capacity=$request->capacity;
       $tables->status=$statuses;
       $tables->save(); 
       
        return back()->with('success','Table created successfully!');
    }

    public function update(Request $request, $id){
        
        $request->validate([
            
            'table_name' => 'required',
            'capacity' => 'required'
           
        ]);
       $tables=  Table::find($id);
       $statuses="Vacant";
       $tables->table_name=$request->table_name;
       $tables->capacity=$request->capacity;
       $tables->status=$statuses;
       $tables->update();
        return back()->with('success','Table update successfully!');
    }
    public function destroy(String $id){
        $table= Table::find($id);
        $table->delete();
        return back()->with('success','Table delete successfully!');

    }
}
