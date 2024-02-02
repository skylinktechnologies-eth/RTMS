<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;


class LocationController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:location-list|location-create|location-edit|location-delete', ['only' => ['index','store']]);
         $this->middleware('permission:location-create', ['only' => ['index','store']]);
         $this->middleware('permission:location-edit', ['only' => ['index','update']]);
         $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $locations =Location::orderBy('created_at', 'desc')->get();
        return view('Pages.Location.index',compact('locations'));
    }
    
    public function store(Request $request)
    {
          $request->validate([
            'location_name'=>'required'
          ]);
          $location=new Location();
          $location->location_name=$request->location_name;
          $location->save();
          return back()->with('success','location created successfully');
    }
    public function update(  Request $request ,$id)
    {
          $request->validate([
            'location_name'=>'required'
          ]);
          $location= Location::find($id);
          $location->location_name=$request->location_name;
          $location->update();
          return back()->with('success','location updated successfully');
    }
    public function destroy($id){
        $location= Location::find($id);
        $location->delete();
        return back()->with('success','location deleted successfully');
    }


}
