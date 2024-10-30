<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateprodukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Set to true if authorization is handled elsewhere
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'p_nama' => 'required|string|max:255',
            'p_harga' => 'required|integer|min:0',
            'p_stok' => 'required|integer|min:0',
            'p_deskripsi' => 'required|string',
            'p_kategori' => 'required|string',
            'p_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'p_berat' => 'required|integer|min:0',
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'p_nama.required' => 'Nama produk harus diisi.',
            'p_harga.required' => 'Harga produk harus diisi.',
            'p_stok.required' => 'Stok produk harus diisi.',
            'p_deskripsi.required' => 'Deskripsi produk harus diisi.',
            'p_kategori.required' => 'Kategori produk harus diisi.',
            'p_gambar.image' => 'File harus berupa gambar.',
            'p_gambar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'p_gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'p_berat.required' => 'Berat produk harus diisi.',
        ];
    }
}
