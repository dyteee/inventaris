<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = [
            'item_id' => ['required', 'exists:items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'loan_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:loan_date'],
        ];

        if ($this->user()?->isAdmin()) {
            $rules['user_id'] = ['required', 'exists:users,id'];
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $item = Item::find($this->item_id);
            if ($item) {
                if ($this->quantity > $item->stock) {
                    $validator->errors()->add('quantity', "Jumlah peminjaman ({$this->quantity}) melebihi stok yang tersedia ({$item->stock}).");
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Peminjam wajib dipilih.',
            'user_id.exists' => 'Peminjam tidak ditemukan dalam sistem.',
            'item_id.required' => 'Barang inventaris wajib dipilih.',
            'item_id.exists' => 'Barang inventaris tidak ditemukan.',
            'quantity.required' => 'Jumlah barang wajib diisi.',
            'quantity.integer' => 'Jumlah barang harus berupa angka bulat.',
            'quantity.min' => 'Jumlah peminjaman minimal 1 unit.',
            'loan_date.required' => 'Tanggal peminjaman wajib diisi.',
            'loan_date.date' => 'Format tanggal peminjaman tidak valid.',
            'due_date.required' => 'Batas waktu pengembalian wajib diisi.',
            'due_date.date' => 'Format batas tanggal pengembalian tidak valid.',
            'due_date.after_or_equal' => 'Batas waktu pengembalian tidak boleh sebelum tanggal peminjaman.',
        ];
    }
}
