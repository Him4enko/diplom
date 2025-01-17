<div>
    @if($editModal)
    <x-modal wire:model="editModal">
        <x-slot name="title">
            {{ __('Edit Product') }} - {{ $product->name }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="update">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="sm:w-full lg:w-1/2 px-3 ">
                            <x-label for="name" :value="__('Product Name')" required autofocus />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                wire:model="product.name" required autofocus />
                            <x-input-error :messages="$errors->get('product.name')" for="product.name" class="mt-2" />
                        </div>
                        <div class="sm:w-full lg:w-1/2 px-3 ">
                            <x-label for="slug" :value="__('Product Slug')" required />
                            <x-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                                wire:model="product.slug" required />
                            <x-input-error :messages="$errors->get('product.slug')" for="product.code" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-2 mb-3">
                        <div class="sm:w-full lg:w-1/2 px-3 ">
                            <x-label for="category_id" :value="__('Category')" required />
                            <select
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="category_id" name="category_id" wire:model="product.category_id"
                                wire:change="fetchSubcategories">
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach ($this->categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                                <x-input-error :messages="$errors->get('product.category_id')" for="product.category_id" class="mt-2" />
                            </select>
                        </div>

                        <div class="sm:w-full lg:w-1/2 px-3 ">
                            <x-label for="subcategory" :value="__('Subcategory')" />
                            <select id="subcategories" name="subcategories"
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                wire:model.defer="product.subcategories" multiple>
                                @foreach ($this->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        @if (in_array($subcategory->id, $product->subcategories ?? [])) selected @endif>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('product.subcategories')" for="subcategories" class="mt-2" />
                        </div>

                        <div class="sm:w-full lg:w-1/2 px-3 ">
                            <x-label for="price" :value="__('Price')" required />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                                wire:model="product.price" required />
                            <x-input-error :messages="$errors->get('product.price')" for="product.price" class="mt-2" />

                        </div>

                        <div class="sm:w-full lg:w-1/2 px-3 ">
                            <x-label for="old_price" :value="__('Old Price')" />
                            <x-input id="old_price" class="block mt-1 w-full" type="number" name="old_price"
                                wire:model="product.old_price" />
                            <x-input-error :messages="$errors->get('product.old_price')" for="product.old_price" class="mt-2" />
                        </div>

                        <div class="sm:w-full lg:w-1/2 px-3 ">
                            <x-label for="brand_id" :value="__('Brand')" />
                            <select
                                class="block bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                                id="brand_id" name="brand_id" wire:model="product.brand_id">
                                <option value="">{{ __('Select Brand') }}</option>
                                @foreach ($this->brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        @if ($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
                                @endforeach
                                <x-input-error :messages="$errors->get('product.brand_id')" for="product.brand_id" class="mt-2" />
                            </select>
                        </div>

                        <div class="sm:w-full lg:w-1/2 px-3 ">
                            <x-label for="video" :value="__('Condition')" />
                            <x-input id="condition" class="block mt-1 w-full" type="text" name="condition"
                                wire:model="product.condition" />
                            <x-input-error :messages="$errors->get('product.condition')" for="product.condition" class="mt-2" />
                        </div>

                        <div class="w-full mb-4 px-3">
                            <x-label for="description" :value="__('Description')" />
                            <livewire:quill :value="$description" />
                        </div>

                        <div class="w-full px-3 my-2">
                            <x-label for="image" :value="__('Product Image')" />
                            <x-media-upload title="{{ __('Product Image') }}" name="image" wire:model="image"
                                :file="$image" :preview="$this->imagepreview" single types="PNG / JPEG / WEBP"
                                fileTypes="image/*" />
                        </div>


                        <div class="w-full px-3 my-2">
                            <x-label for="gallery" :value="__('Gallery')" />
                            <x-media-upload title="{{ __('Gallery') }}" name="gallery" wire:model="gallery"
                                :preview="$this->gallerypreview" :file="$gallery" multiple types="PNG / JPEG / WEBP"
                                fileTypes="image/*" />
                        </div>
                    </div>

                    <x-accordion title="{{ 'More Details' }}">
                        <div class="flex flex-wrap -mx-2 mb-3">

                            <div class="w-full px-2">
                                <div class="space-y-4 flex flex-col items-center justify-center my-4">
                                    @foreach ($options as $index => $option)
                                        <div class="flex flex-row w-full items-center space-x-4">
                                            <select wire:model.lazy="options.{{ $index }}.type"
                                                class="block w-full bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm focus:shadow-outline-blue focus:border-blue-500">
                                                <option value="">{{ __('Choose an option') }}</option>
                                                <option value="color" {{ $option['type'] == 'color' ? 'selected' : '' }}>
                                                    {{ __('Color') }}
                                                </option>
                                                <option value="movementType" {{ $option['type'] == 'movementType' ? 'selected' : '' }}>
                                                    {{ __('Movement type') }}</option>
                                                <option value="waterproof" {{ $option['type'] == 'waterproof' ? 'selected' : '' }}>
                                                    {{ __('Water Resiste') }}</option>
                                                <option value="displayType" {{ $option['type'] == 'displayType' ? 'selected' : '' }}>
                                                    {{ __('Display type') }}</option>
                                                <option value="bandColor" {{ $option['type'] == 'bandColor' ? 'selected' : '' }}>
                                                    {{ __('Band color') }}</option>
                                                <option value="materials" {{ $option['type'] == 'materials' ? 'selected' : '' }}>
                                                    {{ __('Materials') }}</option>
                                                <option value="size" {{ $option['type'] == 'size' ? 'selected' : '' }}>{{ __('Size') }}
                                                </option>
                                            </select>
                                            @if ($option['type'] === 'color')
                                                <input type="color" wire:model.lazy="options.{{ $index }}.value">
                                            @else
                                                <input type="text" wire:model.lazy="options.{{ $index }}.value">
                                            @endif
                                            <x-button danger type="button" wire:click="removeOption({{ $index }})">{{ __('Remove') }}
                                            </x-button>
                                        </div>
                                    @endforeach
                                    <x-button primary type="button" wire:click="addOption">{{ __('Add Option') }}</x-button>
                                </div>
                            </div>

                            <div class="w-1/2 sm:w-full px-2">
                                <x-label for="meta_title" :value="__('Meta Title')" />
                                <x-input id="meta_title" class="block mt-1 w-full" type="text" name="meta_title"
                                    wire:model="product.meta_title" />
                                <x-input-error :messages="$errors->get('product.meta_title')" for="product.meta_title" class="mt-2" />

                            </div>

                            <div class="w-1/2 sm:w-full px-2">
                                <x-label for="meta_description" :value="__('Meta Description')" />
                                <x-input id="meta_description" class="block mt-1 w-full" type="text"
                                    name="meta_description" wire:model="product.meta_description" />
                                <x-input-error :messages="$errors->get('product.meta_description')" for="product.meta_description" class="mt-2" />

                            </div>

                            <div class="w-1/2 sm:w-full px-2">
                                <x-label for="meta_keywords" :value="__('Meta Keywords')" />
                                <x-input id="meta_keywords" class="block mt-1 w-full" type="text"
                                    name="meta_keywords" wire:model="product.meta_keywords" />
                                <x-input-error :messages="$errors->get('product.meta_keywords')" for="product.meta_keywords" class="mt-2" />
                            </div>
                            <div class="w-full px-2 mt-4">
                                <x-label for="video" :value="__('Embeded Video')" />
                                <x-input id="embeded_video" class="block mt-1 w-full" type="text"
                                    name="embeded_video" wire:model="product.embeded_video" />
                                <x-input-error :messages="$errors->get('product.embeded_video')" for="product.embeded_video" class="mt-2" />
                            </div>
                        </div>
                    </x-accordion>


                    <div class="w-full flex justify-center py-4 px-2">
                        <x-button primary type="submit" class="text-center  w-full" wire:loading.attr="disabled">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    @endif
</div>
