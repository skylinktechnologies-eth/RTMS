<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Waitstaff;
use App\Models\WaitstaffAssignment;
use Illuminate\Http\Request;

class WaitstaffAssignmentController extends Controller
{
    //
    public function index()
    {
        $assignments=WaitstaffAssignment::all();
        return view('Pages.WaitstaffAssignment.index',compact('assignments'));
    }

    
    public function create(){
        $waitstaffs=Waitstaff::all();
       $tables= Table::all();
        return view('Pages.WaitstaffAssignment.create',compact('waitstaffs','tables'));
    }
    public function edit( $id){
        $tables = Table::all();
        $waitstaffs = Waitstaff::all();
        $staffAssigns = WaitstaffAssignment::find($id);
        return view('Pages.WaitstaffAssignment.edit',compact('waitstaffs','staffAssigns','tables'));
    }
   
    public function store(Request $request,$id){
        
        $request->validate([
            'waitstaff_id' => 'required',
            'table_id' => 'required', 
        ]);

        $assignTable=WaitstaffAssignment::where('table_id',$request->table_id)->get();
      
        if($assignTable->isNotEmpty() ){
            return back()->with('danger','Table is already assign!');
        }else{
            $waitstaff= new WaitstaffAssignment();
            $waitstaff->waitstaff_id=$id;
            $waitstaff->table_id=$request->table_id;
            $waitstaff->assignment_date=$request->assignment_date;
            $waitstaff->save(); 
        }
     
       
        return back()->with('success','Waitstaff Assign successfully!');
    }

    public function update(Request $request, $id){
        
     
        $request->validate([
            
           
            'table_id' => 'required',
            'assignment_date' => 'required'
        ]);   
       
       $assignment=  WaitstaffAssignment::find($id);
       $assignment->table_id=$request->table_id;
       $assignment->assignment_date=$request->assignment_date;
       $assignment->update(); 
        return back()->with('success','Waitstaff update successfully!');
    }
    public function destroy(String $id){
        $assignment= WaitstaffAssignment::find($id);
        $assignment->delete();
        return back()->with('success','Waitstaff delete successfully!');

    }
}
