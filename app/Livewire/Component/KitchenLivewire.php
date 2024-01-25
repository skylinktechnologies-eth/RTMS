<?php

namespace App\Livewire\Component;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\OrderItem;
use Livewire\Component;

class KitchenLivewire extends Component
{
    public $orderItems;
    public $categories;
    public $selectedCategoryId;
    public $selectedItemStatus;
    public $selectedDate;


    public function mount()
    {
        $this->categories = Category::all();
        $this->selectedCategoryId = null;
        $this->selectedItemStatus = null;
        $this->selectedDate = now()->format('Y-m-d');
        $this->loadOrderItems();
    }

    public function loadOrderItems()
    {
        $query = OrderItem::query();

        if ($this->selectedCategoryId) {
            $menuItem = MenuItem::where('category_id', $this->selectedCategoryId)->first();
            $menuItemId = $menuItem ? $menuItem->id : null;

            if ($menuItemId) {
                $query->where('menu_item_id', $menuItemId);
            } else {
                // No matching menu item, set an empty collection
                $this->orderItems = collect();
                return;
            }
        }

        if ($this->selectedItemStatus) {
            $query->where('status', $this->selectedItemStatus);
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

    public function updatedSelectedItemStatus()
    {
        $this->loadOrderItems();
    }
    public function updatedSelectedDate()
{
    $this->loadOrderItems();
}

    public function render()
    {
        return view('livewire.component.kitchen-livewire');
    }
}

