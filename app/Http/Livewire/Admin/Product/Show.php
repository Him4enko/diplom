<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Show extends Component
{
    public $product;
    public $subcategories;

    public $listeners = [
        'showModal',
    ];

    public $showModal = false;

    public function showModal($id)
    {
        abort_if(Gate::denies('product_show'), 403);

        $this->product = Product::findOrFail($id);

        foreach ($this->product->subcategories as $subcategory) {
            $this->subcategories[] = Subcategory::findOrFail($subcategory);
        }

        $this->showModal = true;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.product.show');
    }
}
