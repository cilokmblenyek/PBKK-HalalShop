<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreprodukRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to true if the request should be authorized
    }

    public function rules()
    {
        return [
            'p_id' => 'required|unique:products,p_id',
            'p_nama' => 'required|string',
            'p_harga' => 'required|integer',
            'p_stok' => 'required|integer',
            'p_deskripsi' => 'required|string',
            'p_kategori' => 'required|string',
            'p_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'p_berat' => 'required|integer',
            'penjual_p_id' => 'required|integer',
        ];
    }
}
