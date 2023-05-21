<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'name_product' => [
                'required',
                Rule::unique('products', 'name_product')->where(function ($query) use ($row) {
                    return $query->where('name_product', $row['name_product']);
                })
            ],
            'sku' => [
                'required',
                Rule::unique('products', 'sku')->where(function ($query) use ($row) {
                    return $query->where('sku', $row['sku']);
                })
            ],
            'import_price' => 'nullable|numeric',
            'export_price' => 'nullable|numeric',
            'status' => 'nullable|in:active,inactive',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'unit' => 'nullable|required',
            'category' => 'required',
            'shelves' => 'nullable|required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('name_product')) {
                dd('name_product error');
            }

            if ($errors->has('sku')) {
                dd('sku error');
            }
        }
        $count_product = Product::count();
        $code_product = "SP" . str_pad($count_product + 1, 5, "0", STR_PAD_LEFT);

        return new Product([
            'name_product' => $row['name_product'],
            'sku' => $row['sku'],
            'import_price' => $row['import_price'],
            'export_price' => $row['export_price'],
            'status' => $row['status'],
            'description' => $row['description'],
            'unit_id' => $row['unit'],
            'category_id' => $row['category'],
            'shelves_id' => $row['shelves'],
            'image' => $row['image'],
            'code_product' => $code_product,
        ]);
    }
}
