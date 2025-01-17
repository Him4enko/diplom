<div>
    <!-- Create Modal -->
    <x-modal wire:model="createProduct">
        <x-slot name="title">
            {{ __('Create Product') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="create">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="name" :value="__('Product Name')" required autofocus />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                wire:model="product.name" required autofocus />
                            <x-input-error :messages="$errors->get('name')" for="name" class="mt-2" />
                        </div>
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="code" :value="__('Product Code')" required />
                            <x-input id="code" class="block mt-1 w-full" type="text" name="code"
                                wire:model="product.code" disabled required />
                            <x-input-error :messages="$errors->get('code')" for="code" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="category_id" :value="__('Category')" required />
                            <select
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="category_id" name="category_id" wire:model="product.category_id"
                                wire:change="fetchSubcategories">
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <x-input-error :messages="$errors->get('product.category_id')" for="product.category_id" class="mt-2" />
                            </select>
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="subcategories" :value="__('Subcategories')" />
                            <select multiple id="subcategories" name="subcategories[]"
                                    class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                    wire:model="product.subcategories">
                                <option value="" disabled>{{ __('Select SubCategory') }}</option>
                                @foreach ($this->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('product.subcategories')" for="subcategories" class="mt-2" />
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="price" :value="__('Price')" required />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                                wire:model="product.price" required />
                            <x-input-error :messages="$errors->get('price')" for="price" class="mt-2" />

                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="old_price" :value="__('Old Price')" required />
                            <x-input id="old_price" class="block mt-1 w-full" type="number" name="old_price"
                                wire:model="product.old_price" />
                            <x-input-error :messages="$errors->get('product.old_price')" for="old_price" class="mt-2" />

                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="brand_id" :value="__('Brand')" />
                            <select
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="brand_id" name="brand_id" wire:model="product.brand_id">
                                <option value="">{{ __('Select Brand') }}</option>
                                @foreach ($this->brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('product.brand_id')" for="brand_id" class="mt-2" />
                        </div>

                        <div class="w-full lg:w-1/2 px-3 mb-6 lg:mb-0">
                            <x-label for="video" :value="__('Condition')" />
                            <x-input id="condition" class="block mt-1 w-full" type="text" name="condition"
                                wire:model="product.condition" />
                            <x-input-error :messages="$errors->get('product.condition')" for="product.condition" class="mt-2" />
                        </div>

                        <div class="w-full px-3 mb-6 lg:mb-0">
                            <x-label for="description" :value="__('Description')" />
                            <livewire:quill :value="$description" />
                        </div>

                        <div class="w-full px-4 my-2">
                            <x-label for="image" :value="__('Product Image')" />
                            <x-media-upload title="{{ __('Product Image') }}" name="image" wire:model="image"
                                :file="$image" single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                        </div>

                        <div class="w-full px-4 my-2">
                            <x-label for="gallery" :value="__('Gallery')" />
                            <x-media-upload title="{{ __('Gallery') }}" name="gallery" wire:model="gallery"
                                :file="$gallery" multiple types="PNG / JPEG / WEBP" fileTypes="image/*" />
                        </div>

                    </div>

                    <x-accordion title="{{ __('More Details') }}">
                        <div class="flex flex-wrap px-4 mb-3">

                            <div class="w-full px-2">
                                <livewire:admin.product.product-options />
                            </div>

                            <div class="lg:w-1/3 sm:w-1/2 px-2">
                                <x-label for="meta_title" :value="__('Meta Title')" />
                                <x-input id="meta_title" class="block mt-1 w-full" type="number" name="meta_title"
                                    wire:model="product.meta_title" />
                                <x-input-error :messages="$errors->get('meta_title')" for="meta_title" class="mt-2" />
                            </div>

                            <div class="lg:w-1/3 sm:w-1/2 px-2">
                                <x-label for="meta_description" :value="__('Meta Description')" />
                                <x-input id="meta_description" class="block mt-1 w-full" type="number"
                                    name="meta_description" wire:model="product.meta_description" />
                                <x-input-error :messages="$errors->get('meta_description')" for="meta_description" class="mt-2" />
                            </div>

                            <div class="lg:w-1/3 sm:w-1/2 px-2">
                                <x-label for="meta_keywords" :value="__('Meta Keywords')" />
                                <x-input id="meta_keywords" class="block mt-1 w-full" type="number"
                                    name="meta_keywords" wire:model="product.meta_keywords" />
                                <x-input-error :messages="$errors->get('meta_keywords')" for="meta_keywords" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-label for="video" :value="__('Embeded Video')" />
                                <x-input id="embeded_video" class="block mt-1 w-full" type="text"
                                name="embeded_video" wire:model="product.embeded_video" />
                                <x-input-error :messages="$errors->get('product.embeded_video')" for="product.embeded_video" class="mt-2" />
                                </div>
                            </div>
                    </x-accordion>

                    <div class="w-full px-4">
                        <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
