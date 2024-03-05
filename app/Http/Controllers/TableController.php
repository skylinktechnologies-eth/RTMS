<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:table-list|table-create|table-edit|table-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:table-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:table-edit', ['only' => ['index', 'update']]);
        $this->middleware('permission:table-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $tables = Table::orderBy('created_at', 'desc')->get();
        return view('Pages.Table.index', compact('tables'));
    }

    public function create()
    {
        return view('Pages.Table.create');
    }
    public function edit(String $id)
    {

        return view('Pages.Table.create');
    }
    public function store(Request $request)
    {

        $request->validate([

            'table_name' => 'required',
            'capacity' => 'required'

        ]);
        $tables = new Table;
        $statuses = "Vacant";
        $tables->table_name = $request->table_name;
        $tables->capacity = $request->capacity;
        $tables->status = $statuses;
        $tables->save();

        return redirect()->route('table.index');
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'table_name' => 'required',
            'capacity' => 'required'

        ]);
        $tables =  Table::find($id);
        $statuses = "Vacant";
        $tables->table_name = $request->table_name;
        $tables->capacity = $request->capacity;
        $tables->status = $statuses;
        $tables->update();
        return back()->with('success', 'Table update successfully!');
    }
    public function destroy(String $id)
    {
        try {
           
            $relatedOrderCount = DB::table('orders')->where('table_id', $id)->count();
            $relatedReservationCount = DB::table('reservation_details')->where('table_id', $id)->count();
            $relatedWaitstaffCount = DB::table('waitstaff_assignments')->where('table_id', $id)->count();

            if ($relatedOrderCount === 0 && $relatedReservationCount === 0 && $relatedWaitstaffCount===0) {
            
                $table = Table::find($id);
                $table->delete();
                return redirect()->back();
            } else {
          
                return back()->with('danger', 'Cannot delete  Table  with related data');
            }
        } catch (QueryException $e) {
            
        }
    }
}
