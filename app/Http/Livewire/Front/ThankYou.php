<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Keys;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ThankYou extends Component
{
    //  show order details on thank you page

    public $order;

    public function mount($order)
    {
        $this->order = Order::findOrFail($order->id);
        $this->keys = Keys::with('order')->where('order_id', $this->order->id)->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.thank-you');
    }
}
