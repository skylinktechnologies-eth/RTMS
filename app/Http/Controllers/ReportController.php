<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\IssuingItem;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\SupplyOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:report-manage', ['only' => ['index', 'purchase', 'inventory']]);
    }
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Fetch order items based on the date range, grouped by menu_item_id and order_date
        $orderItems = OrderItem::with(['menuItem', 'order'])
            ->whereHas('order', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('order_date', [$startDate, $endDate]);
            })
            ->select(
                'menu_item_id',
                DB::raw('orders.order_date AS order_date'), // Alias for clarity
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(sub_total) as sub_total')
            )
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('menu_item_id', 'order_date') // Use the alias for grouping
            ->get();

        return view('Pages.Reports.Sales.index', compact('orderItems'));
    }

    public function purchase(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Fetch order items based on the date range, grouped by item_id and order_date
        $supplyOrderItems = SupplyOrderItem::with(['item', 'supplyOrder'])
            ->whereHas('supplyOrder', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('order_date', [$startDate, $endDate]);
            })
            ->select(
                'item_id',
                DB::raw('supply_orders.order_date AS order_date'), // Alias for clarity
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(total) as total'),
                DB::raw('AVG(price) as average_price') // Include the average price
            )
            ->join('supply_orders', 'supply_orders.id', '=', 'supply_order_items.supply_order_id')
            ->groupBy('item_id', 'order_date')
            ->get();

        return view('Pages.Reports.Purchase.index', compact('supplyOrderItems'));
    }

    public function inventory(Request $request)
    {
        $inventories = Inventory::select(
            'item_id',
            DB::raw('SUM(CASE WHEN quantity > 0 THEN quantity ELSE 0 END) as purchased_quantity'),
            DB::raw('SUM(CASE WHEN quantity < 0 THEN ABS(quantity) ELSE 0 END) as issued_quantity')
        )
            ->groupBy('item_id')
            ->with('item') // Load the 'item' relationship
            ->get();

        return view('Pages.Reports.Inventory.index', compact('inventories'));
    }
}
