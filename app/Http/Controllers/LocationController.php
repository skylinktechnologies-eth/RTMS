<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:location-list|location-create|location-edit|location-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:location-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:location-edit', ['only' => ['index', 'update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $locations = Location::orderBy('created_at', 'desc')->get();
        return view('Pages.Location.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required'
        ]);
        $location = new Location();
        $location->location_name = $request->location_name;
        $location->save();
        return back()->with('success', 'location created successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'location_name' => 'required'
        ]);
        $location = Location::find($id);
        $location->location_name = $request->location_name;
        $location->update();
        return back()->with('success', 'location updated successfully');
    }
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();
        return redirect()->back()->with('success', 'location Deleted successfully');


        //       $relatedIssuingCount = DB::table('issuing_items')->where('location_id', $id)->count();
        //       $relatedDisposingCount = DB::table('disposing_items')->where('location_id', $id)->count();
        // return $relatedIssuingCount;
        //       if ($relatedIssuingCount === 0 && $relatedDisposingCount === 0) {

        //         $location = Location::find($id);
        //         $location->delete();
        //         return redirect()->back();
        //       } else {

        //         return back()->with('danger', 'Cannot delete Location  with related data');
        //       }

    }
}
