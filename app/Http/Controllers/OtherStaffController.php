<?php

namespace App\Http\Controllers;

use App\Models\Otherstaff;
use Illuminate\Http\Request;

class OtherStaffController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:otherstaff-list|otherstaff-create|otherstaff-edit|otherstaff-delete', ['only' => ['index','store','view']]);
         $this->middleware('permission:otherstaff-create', ['only' => ['create','store']]);
         $this->middleware('permission:otherstaff-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:otherstaff-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $otherstaffs = Otherstaff::orderBy('created_at', 'desc')->get();
        return view('Pages.otherStaff.index', compact('otherstaffs'));
    }

    public function create()
    {
        $otherstaff = Otherstaff::all();

        return view('Pages.otherStaff.create', compact('otherstaff'));
    }
    public function edit($id)
    {
        $otherstaff = Otherstaff::find($id);

        return view('Pages.otherStaff.edit', compact('otherstaff'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'hire_date' => 'required'
        ]);

        $otherstaff = new Otherstaff();
        $statuses = "Active";
        $otherstaff->first_name = $request->first_name;
        $otherstaff->last_name = $request->last_name;
        $otherstaff->contact_number = $request->contact_number;
        $otherstaff->hire_date = $request->hire_date;
        $otherstaff->status = $statuses;
        $otherstaff->save();


        return redirect()->route('otherstaff.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'hire_date' => 'required'
        ]);
        $othertaff =  Otherstaff::find($id);
        $statuses = "Active";
        $othertaff->first_name = $request->first_name;
        $othertaff->last_name = $request->last_name;
        $othertaff->contact_number = $request->contact_number;
        $othertaff->hire_date = $request->hire_date;
        $othertaff->status = $statuses;
        $othertaff->update();
        return back()->with('success', 'otherstaff update successfully!');
    }
    public function destroy(String $id)
    {
        $otherstaff = Otherstaff::find($id);
        $otherstaff->delete();
        return back()->with('success', 'other staff delete successfully!');
    }
}
