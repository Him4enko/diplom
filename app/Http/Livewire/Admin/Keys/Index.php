<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Keys;
use App\Imports\KeysImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Keys;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $perPage = 10;
    public $search = '';
    public $selected = [];
    public $selectPage = false;
    public $importModal = false;
    public $import;
    public $key;

    protected $listeners = ['refreshIndex' => '$refresh'];

    protected $paginationOptions = [10, 25, 50, 100];

    public function render()
    {
        $keys = Keys::with(['product', 'user', 'order'])
            ->where('key', 'like', '%' . $this->search . '%')
            ->orWhere('product_id', 'like', '%' . $this->search . '%')
            ->orWhere('user_id', 'like', '%' . $this->search . '%')
            ->orWhere('order_id', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.admin.keys.index', [
            'keys' => $keys,
            'paginationOptions' => $this->paginationOptions,
            'selectedCount' => count($this->selected),
        ]);
    }

    public function openImportModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->importModal = true;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selected = Keys::pluck('id')->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function deleteSelected()
    {
        Keys::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->selectPage = false;
        session()->flash('message', 'Selected keys have been deleted.');
    }

    public function edit($id)
    {
        $this->key = Keys::find($id);
        $this->emit('openEditModal');
    }

    public function delete(array $key)
    {
        Keys::find($key['id'])->delete();
        session()->flash('message', 'Key has been deleted.');
    }

    public function import()
    {
        $this->validate([
            'import' => 'required|file|mimes:txt,csv|max:10240', // Валидация файла
        ]);

        $extension = $this->import->getClientOriginalExtension();

        if ($extension === 'txt') {
            // Импорт из TXT файла
            $contents = file_get_contents($this->import->getRealPath());
            $lines = explode("\n", $contents);

            foreach ($lines as $line) {
                $line = trim($line);
                if ($line !== '') {
                    // Разделение ключа и ID продукта по слешу
                    list($keyValue, $productId) = explode('/', $line);

                    // Создание записи ключа
                    Keys::create([
                        'key' => trim($keyValue),
                        'product_id' => trim($productId),
                    ]);
                }
            }
        } elseif ($extension === 'csv') {
            // Импорт из CSV файла
            $path = $this->import->store('temp'); // Временное сохранение файла

            $keys = \Excel::toCollection(new KeysImport(), $path);

            foreach ($keys[0] as $row) {
                Keys::create([
                    'key' => $row['Key'],
                    'product_id' => $row['Product_id'],
                ]);
            }
        }

        $this->importModal = false;
        $this->import = null;

        session()->flash('message', 'Keys imported successfully.');
    }

}
