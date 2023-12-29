<?php

namespace App\Http\Controllers;

use App\Models\SupplyItem;
use Illuminate\Http\Request;

class SupplyItemController extends Controller
{
    //
    public function index(){
        $supplyItem=SupplyItem::all();
     
        return view('Pages.SupplyItem.index',compact('supplyItem'));
    }
    
}
