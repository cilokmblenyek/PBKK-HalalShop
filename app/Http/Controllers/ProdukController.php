<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;
use Illuminate\Http\Request;

class produkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search']);
        
        return view('dashboard', [
            "produkku" => produk::filter($filters)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create'); // Menampilkan form untuk membuat produk baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreprodukRequest $request)
    {
        produk::create($request->validated()); // Menyimpan produk baru dengan data validasi
        return redirect()->route('dashboard')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(produk $produk)
    {
        // Menampilkan detail produk
        return view('products.show', compact('produk')); // Menggunakan view untuk menampilkan detail
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk $produk)
    {
        return view('products.edit', compact('produk')); // Menampilkan form untuk mengedit produk
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprodukRequest $request, produk $produk)
    {
        $produk->update($request->validated()); // Memperbarui produk dengan data validasi
        return redirect()->route('dashboard')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk $produk)
    {
        $produk->delete(); // Menghapus produk
        return redirect()->route('dashboard')->with('success', 'Produk berhasil dihapus.');
    }
}
