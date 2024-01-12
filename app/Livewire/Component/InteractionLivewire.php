<?php

namespace App\Livewire\Component;

use App\Models\OrderItem;
use Livewire\Component;

class InteractionLivewire extends Component
{
    public $orderItems; // Declare the public property to hold order items

    public function mount()
    {
        // Load the order items when the component is mounted
        $this->orderItems = OrderItem::orderBy('created_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.component.interaction-livewire');
    }
}
