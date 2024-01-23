<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    //
    public function index(Request $request)
    {
       
        return view('Pages.Kitchen.index');
    }
    
}
