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
    // Retrieve distinct item_ids from both SupplyOrderItem and IssuingItem
    $itemIds = array_merge(
        SupplyOrderItem::distinct('item_id')->pluck('item_id')->toArray(),
        IssuingItem::distinct('item_id')->pluck('item_id')->toArray()
    );

    // Initialize an empty array to store inventory data
    $inventoryData = [];

    // Iterate through each unique item_id and calculate purchased, issued, and balance quantities
    foreach (array_unique($itemIds) as $itemId) {
        $item = Item::find($itemId); // Retrieve the Item model for the given item_id

        if ($item) {
            $purchasedQuantity = SupplyOrderItem::where('item_id', $itemId)->sum('quantity');
            $issuedQuantity = IssuingItem::where('item_id', $itemId)->sum('quantity');

            // Calculate the balance (purchased - issued)
            $balance = $purchasedQuantity - $issuedQuantity;

            // Create an array with item details and calculated quantities
            $inventoryData[] = [
                'item_name' => $item->item_name, // Use item name instead of ID
                'purchased_quantity' => $purchasedQuantity,
                'issued_quantity' => $issuedQuantity,
                'balance' => $balance,
            ];
        }
    }

    return view('Pages.Reports.Inventory.index', compact('inventoryData'));
}
    

}
