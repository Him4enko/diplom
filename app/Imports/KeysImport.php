<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Keys;

class KeysImport implements ToModel
{
    public function model(array $row)
    {
        return new Keys([
            'key' => $row[0],
        ]);
    }
}
