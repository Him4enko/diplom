<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Keys;

use App\Models\Keys;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $editKeys = false;
    public $key;

    public $listeners = ['editKeys'];

    protected $rules = [
        'key.key' => 'required|string|max:255',
        'key.product_id' => 'required|exists:products,id',
        'key.user_id' => 'nullable|exists:users,id',
        'key.order_id' => 'nullable|exists:orders,id',
        'key.is_activated' => 'nullable|boolean',
    ];

    public function mount(Keys $key)
    {
        $this->key = $key;
    }

    public function editKeys()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->editKeys = true;
    }

    public function update()
    {
        $this->validate();

        $this->key->save();

        session()->flash('message', 'Key updated successfully.');

        $this->emit('refreshIndex');

        $this->editKeys = false;
    }

    public function render()
    {
        return view('livewire.admin.keys.edit', [
            'products' => Product::all(),
            'users' => User::all(),
            'orders' => Order::all(),
        ]);
    }
}
