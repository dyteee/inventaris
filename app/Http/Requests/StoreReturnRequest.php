<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'loan_id' => ['required', 'exists:loans,id', 'unique:return_logs,loan_id'],
            'returned_at' => ['required', 'date'],
            'condition_on_return' => ['required', 'in:baik,rusak ringan,rusak berat'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'loan_id.required' => 'Data peminjaman wajib dipilih.',
            'loan_id.exists' => 'Data peminjaman tidak ditemukan.',
            'loan_id.unique' => 'Peminjaman ini sudah tercatat telah dikembalikan.',
            'returned_at.required' => 'Tanggal pengembalian barang wajib diisi.',
            'returned_at.date' => 'Format tanggal pengembalian tidak valid.',
            'condition_on_return.required' => 'Kondisi barang saat kembali wajib dipilih.',
            'condition_on_return.in' => 'Pilihan kondisi barang tidak valid.',
            'notes.max' => 'Catatan maksimal 1000 karakter.',
        ];
    }
}
