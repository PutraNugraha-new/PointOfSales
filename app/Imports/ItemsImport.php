<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Item([
            'category_id' => $row['category_id'],
            'name' => $row['name'],
            'sku' => $row['sku'],
            'description' => $row['description'],
            'unit' => $row['unit'],
            'stock' => $row['stock'],
            'min_stock' => $row['min_stock'],
            'purchase_price' => $row['purchase_price'],
            'selling_price' => $row['selling_price'],
        ]);
    }
}
