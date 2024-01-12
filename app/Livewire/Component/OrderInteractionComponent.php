<?php

// OrderInteraction.php

namespace App\Http\Livewire\Component;

use Livewire\Component;
use App\Models\OrderItem; // Import the OrderItem model

class OrderInteractionComponent extends Component
{
    public $orderItems; // Declare the public property to hold order items

    public function mount()
    {
        // Load the order items when the component is mounted
        $this->orderItems = OrderItem::all();
    }

    public function render()
    {
        return view('livewire.component.order-interaction-component');
    }
}


