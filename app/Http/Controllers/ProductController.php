<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;
use App\Services\RoboflowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $roboflowService;

    public function __construct(RoboflowService $roboflowService)
    {
        $this->roboflowService = $roboflowService;

        Log::info('Testing log creation');
    }

    // Read Function
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

    // Create Function
    public function store(StoreprodukRequest $request)
    {
        // Validate request data
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
            
            /// Simpan file
            $file->move(public_path('images'), $filename);
            
            // Update path gambar di database
            $validatedData['p_gambar'] = $filename;

            // Path untuk Roboflow
            $fullPath = storage_path('app/public/images/' . $filename);

            
            $halalStatus = $this->roboflowService->detectHalalStatus($fullPath);
            $validatedData['halal_status'] = $halalStatus;
            
        }
        $validatedData['penjual_p_id'] = Auth::user()->id;
        
        // Create a new product
        produk::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Product created successfully!');
    }


    // Show product details
    public function show(produk $produk)
    {
        return view('products.show', compact('produk')); // Menggunakan view untuk menampilkan detail
    }

    // Show the form for editing the specified resource
    public function edit(produk $produk)
    {
        return view('products.edit', compact('produk')); 
    }
    
    
    // Update Function
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

    // Delete Function
    public function destroy(produk $produk)
    {
        // Delete the product image if it exists
        if ($produk->p_gambar && Storage::disk('public')->exists("images/{$produk->p_gambar}")) {
            Storage::disk('public')->delete("images/{$produk->p_gambar}");
        }

        // Delete the product from the database
        $produk->delete();

        return redirect()->route('dashboard')->with('success', 'Produk berhasil dihapus.');
    }
}
