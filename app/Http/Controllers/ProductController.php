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

function resizeImage($filePath, $width, $height)
{
    $image = imagecreatefromstring(file_get_contents($filePath));
    $resizedImage = imagescale($image, $width, $height);
    imagejpeg($resizedImage, $filePath); // Overwrite the original file
    imagedestroy($image);
    imagedestroy($resizedImage);
}

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
        $validatedData = $request->validate([
            'p_id' => 'required|unique:products,p_id',
            'p_nama' => 'required|string',
            'p_harga' => 'required|integer',
            'p_stok' => 'required|integer',
            'p_deskripsi' => 'required|string',
            'p_kategori' => 'required|string',
            'p_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'p_berat' => 'required|integer',
        ]);

        if (!$request->hasFile('p_gambar')) {
            return back()->withError('No file uploaded.');
        }

        $file = $request->file('p_gambar');
        if (!$file->isValid()) {
            return back()->withError('File upload failed.');
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        $fileFullPath = public_path("images/{$filename}");
        if (!file_exists($fileFullPath)) {
            return back()->withError('File not found after being uploaded.');
        }

        // Resize for Roboflow
        resizeImage($fileFullPath, 640, 640);

        $response = $this->sendToRoboflow($fileFullPath);
        if (isset($response['error'])) {
            Log::error('Roboflow Error: ' . $response['error']);
            return back()->withError('Failed to process image with Roboflow.');
        }

        Log::info('Roboflow Response: ', $response);

        $halalStatus = ($response['predictions'][0]['confidence'] > 0.4) ? 'Halal' : 'Unsure';

        $validatedData['p_gambar'] = $filename;
        $validatedData['halal_status'] = $halalStatus;
        $validatedData['penjual_p_id'] = Auth::id();

        produk::create($validatedData);

        return redirect()->route('dashboard')
            ->with('success', "Product created successfully! Halal Status: {$halalStatus}");
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
