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
    private function sendToRoboflow($imagePath)
    {
        try {
            // Convert the image to base64
            $imageBase64 = base64_encode(file_get_contents($imagePath));
    
            // Prepare the GuzzleHttp client
            $client = new \GuzzleHttp\Client();
    
            // Make the POST request to Roboflow API
            $response = $client->post(env('ROBOFLOW_API_URL'), [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'query' => [
                    'api_key' => env('ROBOFLOW_API_KEY'),
                ],
                'body' => $imageBase64,
            ]);
    
            // Parse the response and return the JSON result
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Handle errors
            return ['error' => $e->getMessage()];
        }
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

    
    // Store Function
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

            if ($request->hasFile('p_gambar')) {
                $file = $request->file('p_gambar');

                // Generate filename
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Move file
                $file->move(public_path('images'), $filename);

                $filePath = public_path('images');
                
               
                
                // Update path
                $validatedData['p_gambar'] = $filename;

                // Get the full path of the image
                $fileFullPath = $filePath . "\\" . $filename;
        
                // Send the image to the Roboflow API using Guzzle
                $response = $this->sendToRoboflow($fileFullPath);
                
                if ($response['predictions'][0]['confidence'] > 0.6) {
                    $halalStatus = 'Halal';
                } else {
                    $halalStatus = 'Unsure';
                }

                $validatedData['halal_status'] = $halalStatus;
             
            }

            $validatedData['halal_status'] = $halalStatus;
            echo $halalStatus;
            dd($valideatedData);

            $validatedData['penjual_p_id'] = auth()->id();
            
            // Create product
            $product = produk::create($validatedData);

            return redirect()->route('dashboard')
                ->with('success', "Product created successfully! Halal Status:");
    }


    // public function store(StoreprodukRequest $request)
    // {
    //     // Validate request data
    //     $validatedData = $request->validate([
    //         'p_id' => 'required|unique:products,p_id',
    //         'p_nama' => 'required|string',
    //         'p_harga' => 'required|integer',
    //         'p_stok' => 'required|integer',
    //         'p_deskripsi' => 'required|string',
    //         'p_kategori' => 'required|string',
    //         'p_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'p_berat' => 'required|integer',
    //         'penjual_p_id' => 'required|integer',
    //     ]);
    
    //     // Save the uploaded image to the public path
    //     if ($request->file('image')) {
    //         $imageName = time() . '.' . $request->image->extension();
    //         $imagePath = public_path('images/');

    
    //         // Move the image to the 'images/search' directory
    //         $request->image->move($imagePath, $imageName);

    //         $validatedData['p_gambar'] = $imageName;
    
    //         // Get the full path of the image
    //         $imageFullPath = $imagePath . '/' . $imageName;
    //         echo $imageFullPath;
    //         dd($imageFullPath);
    
    //         // Send the image to the Roboflow API using Guzzle
    //         $response = $this->sendToRoboflow($imageFullPath);
    //         dd($response);

            
    //     }
    //     $validatedData['penjual_p_id'] = auth()->id();

    //     $product = produk::create($validatedData);

    // //         return redirect()->route('dashboard')
    // //             ->with('success', "Product created successfully! Halal Status:");

    // }


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
