<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;
use Illuminate\Http\Request;

class produkController extends Controller
{
    // Display a listing of the products on the dashboard
    public function index(Request $request)
    {
        $filters = $request->only(['search']);
        
        return view('dashboard', [
            "produkku" => produk::filter($filters)->get()
        ]);
    }

    public function create()
    {
        
        return view('products.buat'); 
    }

    // // Store a newly created product in storage
    public function store(StoreprodukRequest $request)
    {
    // // Validate request data
    $validatedData = $request->validate([
        'p_id' => 'required|unique:products,p_id',
        'p_nama' => 'required|string',
        'p_harga' => 'required|integer',
        'p_stok' => 'required|integer',
        'p_deskripsi' => 'required|string',
        'p_kategori' => 'required|string',
        'p_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'p_berat' => 'required|integer',
        'penjual_p_id' => 'required|integer',
    ]);

    // Handle file upload
    if ($request->hasFile('p_gambar')) {
        $file = $request->file('p_gambar');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        echo $filename;
        $file->storeAs('images/', $filename);
        echo public_path('images');
        $validatedData['p_gambar'] = $filename;
    }

    $validatedData['penjual_p_id'] = auth()->id();
    
    // Create a new product
    produk::create($validatedData);

    return redirect()->route('dashboard')->with('success', 'Product created successfully!');
    }


    // Show product details
    public function show(produk $produk)
    {
        // Menampilkan detail produk
        return view('products.show', compact('produk')); // Menggunakan view untuk menampilkan detail
    }

    // Show the form for editing the specified resource
    public function edit(produk $produk)
    {
        return view('products.edit', compact('produk')); // Menampilkan form untuk mengedit produk
    }
    
    
    // Update the specified resource in storage
    public function update(UpdateprodukRequest $request, produk $produk)
    {
        // Validasi data yang diinput
        $validatedData = $request->validate([
            'p_nama' => 'required|string',
            'p_harga' => 'required|integer',
            'p_stok' => 'required|integer',
            'p_deskripsi' => 'required|string',
            'p_kategori' => 'required|string',
            'p_gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'p_berat' => 'required|integer',
        ]);

        // Jika ada gambar baru yang diunggah, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('p_gambar')) {
            // Hapus gambar lama jika ada dan file-nya benar-benar ada di server
            if ($produk->p_gambar && file_exists(public_path('images/' . $produk->p_gambar))) {
                unlink(public_path('images/' . $produk->p_gambar));
            }
            
            // Simpan gambar baru
            $file = $request->file('p_gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            
            // Set the new filename in the validated data array
            $validatedData['p_gambar'] = $filename;
        }

        // Update produk dengan data yang telah divalidasi
        $produk->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(produk $produk)
    {
        // Hapus gambar jika ada
        if ($produk->p_gambar) {
            unlink(public_path('images/' . $produk->p_gambar));
        }

        // Hapus produk
        $produk->delete();

        return redirect()->route('dashboard')->with('success', 'Produk berhasil dihapus.');
    }
}
