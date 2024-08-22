<div>
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-1/2 md:w-1/2 sm:w-full flex flex-wrap my-md-0 my-2">
            <select wire:model="perPage"
                    class="w-20 border border-gray-300 rounded-md shadow-sm py-2 px-4 bg-white text-sm leading-5 font-medium text-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out">
                @foreach ($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <x-button danger type="button" wire:click="openImportModal" wire:loading.attr="disabled">
                {{ __('Import') }}
            </x-button>
            @if($this->selected)
                <x-button danger type="button"  wire:click="deleteSelected" class="ml-3">
                    <i class="fas fa-trash-alt"></i>
                </x-button>
            @endif
            @if ($selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
        </div>
        <div class="lg:w-1/2 md:w-1/2 sm:w-full my-2 my-md-0">
            <div class="flex items-center mr-3 pl-4">
                <input wire:model="search" type="text"
                       class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pr-10"
                       placeholder="{{__('Search...')}}" />
            </div>
        </div>
    </div>

    <x-table>
        <x-slot name="thead">
            <x-table.th class="pr-0 w-8">
                <input wire:model="selectPage" type="checkbox" />
            </x-table.th>
            <x-table.th>
                {{ __('Key') }}
            </x-table.th>
            <x-table.th>
                {{ __('Product ID') }}
            </x-table.th>
            <x-table.th>
                {{ __('User ID') }}
            </x-table.th>
            <x-table.th>
                {{ __('Order ID') }}
            </x-table.th>
            <x-table.th>
                {{ __('Activated') }}
            </x-table.th>
            <x-table.th>
                {{ __('Actions') }}
            </x-table.th>
        </x-slot>
        <x-table.tbody>
            @forelse($keys as $key)
                <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $key->id }}">
                    <x-table.td>
                        <input type="checkbox" value="{{ $key->id }}" wire:model="selected">
                    </x-table.td>
                    <x-table.td>
                        {{ $key->key }}
                    </x-table.td>
                    <x-table.td>
                        {{ $key->product_id }}
                    </x-table.td>
                    <x-table.td>
                        {{ $key->user_id }}
                    </x-table.td>
                    <x-table.td>
                        {{ $key->order_id }}
                    </x-table.td>
                    <x-table.td>
                        <livewire:toggle-button :model="$key" field="is_activated" key="{{ $key->id }}" />
                    </x-table.td>
                    <x-table.td>
                        <div class="flex justify-start space-x-2">
                            <x-button primary type="button" onclick="Livewire.emit('editKeys', {{ $key->id }})"
                                      wire:loading.attr="disabled">
                                <i class="fas fa-edit"></i>
                            </x-button>
                            <x-button danger type="button"  wire:click="delete({{ $key }})"
                                      wire:loading.attr="disabled">
                                <i class="fas fa-trash-alt"></i>
                            </x-button>
                        </div>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="10" class="text-center">
                        {{ __('No entries found.') }}
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-table.tbody>
    </x-table>

    <div class="p-4">
        <div class="pt-3">
            {{ $keys->links() }}
        </div>
    </div>

    <!-- Create Modal -->
    @livewire('admin.keys.create')

    @livewire('admin.keys.edit', ['key' => $key])

    <x-modal wire:model="importModal">
        <x-slot name="title">
            {{ __('Import Keys') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="import">
                <div class="space-y-4">
                    <div class="mt-4">
                        <x-label for="import" :value="__('Choose File to Import')" />
                        <x-input id="import" class="block mt-1 w-full" type="file" name="import"
                                 wire:model.defer="import" />
                        <x-input-error :messages="$errors->get('import')" for="import" class="mt-2" />
                    </div>

                    <div class="w-full px-3">
                        <x-button primary type="submit" wire:loading.attr="disabled">
                            {{ __('Import') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>

</div>
