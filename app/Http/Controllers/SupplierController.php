<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function index(){
        $suppliers=Supplier::all();
     
        return view('Pages.Supplier.index',compact('suppliers'));
    }
    
   
    public function store(Request $request){
        
        $request->validate([
            
            'supplier_name' => 'required',
            'contact_number' => 'required',
            'address' => 'required' 
        ]);   
       
       $supplier= new Supplier();
       $supplier->supplier_name=$request->supplier_name;
       $supplier->contact_number=$request->contact_number;
       $supplier->address=$request->address;
       $supplier->save();  
        return back()->with('success','Supplier created successfully!');
    }

    public function update(Request $request, $id){
        
        $request->validate([
             
            'supplier_name' => 'required',
            'contact_number' => 'required',
            'address' => 'required' 
        ]);   
       
       $supplier=  Supplier::find($id);
       $supplier->supplier_name=$request->supplier_name;
       $supplier->contact_number=$request->contact_number;
       $supplier->address=$request->address;
       $supplier->update();
        return back()->with('success','Supplier update successfully!');
    }
    public function destroy(String $id){
        $supplier= Supplier::find($id);
        $supplier->delete();
        return back()->with('success','Supplier delete successfully!');

    }
}
