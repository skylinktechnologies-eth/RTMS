<?php

namespace App\Livewire\Component;

use App\Models\Category;
use App\Models\KitchenInteraction;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Livewire\Component;

class InteractionLivewire extends Component
{
    public $orderItems; // Declare the public property to hold order items
    public $kitchenInteractions;
    public $categories;
    public $tables;
    public $orders;
    public $selectedCategoryId;
    public $selectedTableId;
    public $selectedDate;
    public function mount()
    {
        // Load the order items when the component is mounted
        $this->orderItems = OrderItem::orderBy('created_at', 'desc')->get();
        $this->orders = Order::orderBy('created_at', 'desc')->get();
        $this->kitchenInteractions = KitchenInteraction::all ();
        $this->categories = Category::all();
        $this->tables = Table::all();
        $this->selectedCategoryId = null;
        $this->selectedTableId = null;
        $this->selectedDate = now()->format('Y-m-d');
        $this->loadOrderItems();
    }
    
    public function loadOrderItems()
    {
        $query = OrderItem::query();
    
        if ($this->selectedCategoryId) {
            $menuItemsInCategory = MenuItem::where('category_id', $this->selectedCategoryId)->pluck('id');
    
            if ($menuItemsInCategory->isNotEmpty()) {
                $query->whereIn('menu_item_id', $menuItemsInCategory);
            } else {
                // No matching menu items in the category, continue with the query without category filter
            }
        }
    
        if ($this->selectedTableId) {
            // Update the relationship in the where clause
            $query->whereHas('order.table', function ($subQuery) {
                $subQuery->where('id', $this->selectedTableId);
            });
        }
    
        if ($this->selectedDate) {
            $query->whereHas('order', function ($subQuery) {
                $subQuery->whereDate('order_date', $this->selectedDate);
            });
        } else {
            // Default to today's orders
            $query->whereHas('order', function ($subQuery) {
                $subQuery->whereDate('order_date', today());
            });
        }
    
        $this->orderItems = $query->orderBy('created_at', 'desc')->get();
    }
    
    

    public function updatedSelectedCategoryId()
    {
        $this->loadOrderItems();
    }

    public function updatedSelectedTableId()
    {
        $this->loadOrderItems();
    }
    public function updatedSelectedDate()
{
    $this->loadOrderItems();
}
    public function render()
    {
        return view('livewire.component.interaction-livewire');
    }
}
