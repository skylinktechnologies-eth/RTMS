<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Waitstaff;
use App\Models\WaitstaffAssignment;
use Illuminate\Http\Request;

class WaitstaffController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:waitstaff-list|waitstaff-create|waitstaff-edit|waitstaff-delete', ['only' => ['index','store','view']]);
         $this->middleware('permission:waitstaff-create', ['only' => ['create','store']]);
         $this->middleware('permission:waitstaff-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:waitstaff-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $waitstaffs = Waitstaff::orderBy('created_at', 'desc')->get();
        return view('Pages.Waitstaff.index', compact('waitstaffs'));
    }

    public function create()
    {
        $waitstaff = Waitstaff::all();

        return view('Pages.Waitstaff.create', compact('waitstaff'));
    }
    public function edit($id)
    {
        $waitstaff = Waitstaff::find($id);

        return view('Pages.Waitstaff.edit', compact('waitstaff'));
    }
    public function view($id)
    {
        $tables = Table::all();
        $waitstaff = Waitstaff::find($id);
        $staffAssigns = WaitstaffAssignment::all();

        return view('Pages.WaitstaffAssignment.create', compact('waitstaff', 'tables','staffAssigns'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'hire_date' => 'required'
        ]);

        $waitstaff = new Waitstaff();
        $statuses = "Active";
        $waitstaff->first_name = $request->first_name;
        $waitstaff->last_name = $request->last_name;
        $waitstaff->contact_number = $request->contact_number;
        $waitstaff->hire_date = $request->hire_date;
        $waitstaff->status = $statuses;
        $waitstaff->save();

        return redirect()->route('waitstaff.index');
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'hire_date' => 'required'
        ]);

        $waitstaff =  Waitstaff::find($id);
        $statuses = "Active";
        $waitstaff->first_name = $request->first_name;
        $waitstaff->last_name = $request->last_name;
        $waitstaff->contact_number = $request->contact_number;
        $waitstaff->hire_date = $request->hire_date;
        $waitstaff->status = $statuses;
        $waitstaff->update();
        return back()->with('success', 'Waitstaff update successfully!');
    }
    public function destroy(String $id)
    {
        $waitstaff = Waitstaff::find($id);
        $waitstaff->delete();
        return back()->with('success', 'Waitstaff delete successfully!');
    }
}
