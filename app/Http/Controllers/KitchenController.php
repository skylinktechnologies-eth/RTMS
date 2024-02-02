<?php

namespace App\Http\Controllers;

use App\Models\KitchenInteraction;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:kitchen-list', ['only' => ['index', 'changeStatusToPreparing', 'changeStatusToReady']]);
    }
    public function index(Request $request)
    {

        return view('Pages.Kitchen.index');
    }
    public function changeStatusToPreparing($id)
    {
        $orderItem = OrderItem::find($id);

        $orderItem->status = 'Preparing';
        $orderItem->save();
        $interaction = new KitchenInteraction();
        $interaction->order_item_id = $id;
        $interaction->interaction_type = "StartPreparation";
        $interaction->interaction_date = today();
        $interaction->save();

        return back()->with('success', 'Change Status');
    }
    public function changeStatusToReady($id)
    {

        $orderItem = OrderItem::find($id);
        $interaction = KitchenInteraction::where('order_item_id', $id)->first();

        $interaction->interaction_type = 'FinishPreparation';
        $interaction->save();
        $orderItem->status = 'Ready';
        $orderItem->save();


        return back()->with('success', 'Change Status');
    }
}
