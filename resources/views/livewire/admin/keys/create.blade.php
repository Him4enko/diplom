<x-modal wire:model="createKeys">
    <x-slot name="title">
        {{ __('Create Key') }}
    </x-slot>

    <x-slot name="content">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form wire:submit.prevent="create">
            <div>
                <label for="key" class="block font-medium text-sm text-gray-700">Key</label>
                <input wire:model.defer="key" id="key" type="text" class="form-input mt-1 block w-full" autofocus required>
            </div>

            <div class="mt-4">
                <label for="product_id" class="block font-medium text-sm text-gray-700">Product</label>
                <select wire:model.defer="product_id" id="product_id" class="form-select mt-1 block w-full">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="user_id" class="block font-medium text-sm text-gray-700">User (optional)</label>
                <select wire:model.defer="user_id" id="user_id" class="form-select mt-1 block w-full">
                    <option value="">None</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name . ' (' . $user->id . ')' }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="order_id" class="block font-medium text-sm text-gray-700">Order (optional)</label>
                <select wire:model.defer="order_id" id="order_id" class="form-select mt-1 block w-full">
                    <option value="">None</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}">{{ $order->reference }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Key</button>
            </div>
        </form>
    </x-slot>
</x-modal>
