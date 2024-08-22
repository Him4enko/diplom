<?php

namespace App\Http\Livewire\Admin\Keys;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use App\Models\Keys;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $createKeys = false;
    public $key; // Add $key property
    public $order_id;
    public $user_id;
    public $product_id;

    public $listeners = ['createKeys'];

    protected $rules = [
        'key' => 'required|string|unique:keys,key',
        'product_id' => 'required|exists:products,id',
        'user_id' => 'nullable|exists:users,id',
        'order_id' => 'nullable|exists:orders,id',
    ];

    public function createKeys()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->createKeys = true;
    }

    public function create()
    {
        $this->validate();

        $key = Keys::create([
            'key' => $this->key,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'order_id' => $this->order_id,
        ]);

        session()->flash('message', 'Key created successfully.');

        $this->resetForm();
        $this->emit('refreshIndex');
        $this->createKeys = false;
    }

    private function resetForm()
    {
        $this->key = '';
        $this->product_id = null;
        $this->user_id = null;
        $this->order_id = null;
    }

    public function render()
    {
        return view('livewire.admin.keys.create', [
            'products' => Product::all(),
            'users' => User::all(),
            'orders' => Order::all(),
        ]);
    }
}
