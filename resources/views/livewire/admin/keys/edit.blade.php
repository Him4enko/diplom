<x-modal wire:model="editKeys">
    <x-slot name="title">
        {{ __('Edit Key') }}
    </x-slot>

    <x-slot name="content">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form wire:submit.prevent="update">
            <div class="px-4">
                <div class="mt-4 py-2 w-full">
                    <x-label for="key" :value="__('Key')" />
                    <x-input id="key" class="block mt-1 w-full" type="text" name="key"
                             wire:model.lazy="key.key" />
                    <x-input-error :messages="$errors->get('key.key')" for="key.key" class="mt-2" />
                </div>

                <div class="mt-4 py-2 w-full">
                    <x-label for="product_id" :value="__('Product')" />
                    <select id="product_id" wire:model.lazy="key.product_id"
                            class="block mt-1 w-full form-select">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('key.product_id')" for="key.product_id" class="mt-2" />
                </div>

                <div class="mt-4 py-2 w-full">
                    <x-label for="user_id" :value="__('User')" />
                    <select id="user_id" wire:model.lazy="key.user_id"
                            class="block mt-1 w-full form-select">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->full_name . ' (' . $user->id . ')' }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('key.user_id')" for="key.user_id" class="mt-2" />
                </div>

                <div class="mt-4 py-2 w-full">
                    <x-label for="order_id" :value="__('Order')" />
                    <select id="order_id" wire:model.lazy="key.order_id"
                            class="block mt-1 w-full form-select">
                        <option value="">Select Order</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->id }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('key.order_id')" for="key.order_id" class="mt-2" />
                </div>

                <div class="mt-4 py-2 w-full">
                    <x-label for="is_activated" :value="__('Is Activated')" />
                    <x-input id="is_activated" class="block mt-1 w-full" type="checkbox" name="is_activated"
                             wire:model.lazy="key.is_activated" />
                    <x-input-error :messages="$errors->get('key.is_activated')" for="key.is_activated" class="mt-2" />
                </div>

                <div class="w-full px-3 mt-4">
                    <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-slot>
</x-modal>
