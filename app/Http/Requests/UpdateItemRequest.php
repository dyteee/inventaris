<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('items', 'code')->ignore($this->route('item')),
            ],
            'stock' => ['required', 'integer', 'min:0'],
            'condition' => ['required', 'in:baik,rusak ringan,rusak berat'],
            'location' => ['required', 'string', 'max:255'],
            'source_fund' => ['nullable', 'string', 'max:100'],
            'procurement_year' => ['nullable', 'integer', 'min:1990', 'max:' . (date('Y') + 1)],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori barang wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'name.required' => 'Nama barang wajib diisi.',
            'name.max' => 'Nama barang maksimal 255 karakter.',
            'code.required' => 'Kode barang wajib diisi.',
            'code.unique' => 'Kode barang sudah digunakan.',
            'code.max' => 'Kode barang maksimal 50 karakter.',
            'stock.required' => 'Jumlah stok barang wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
            'stock.min' => 'Stok minimal 0.',
            'condition.required' => 'Kondisi barang wajib dipilih.',
            'condition.in' => 'Kondisi barang harus salah satu dari: baik, rusak ringan, atau rusak berat.',
        ];
    }
}
