<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    //
    public function index()
    {
        return view('Pages.Kitchen.index');
    }
    
}
