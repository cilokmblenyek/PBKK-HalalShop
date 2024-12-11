<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;
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
            Log::info('Encoding image to base64.');
            $imageBase64 = base64_encode(file_get_contents($imagePath));

            Log::info('Image encoded successfully.');

            $client = new \GuzzleHttp\Client();
            Log::info('Sending request to Roboflow API.');
            $response = $client->post(env('ROBOFLOW_API_URL'), [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'query' => [
                    'api_key' => env('ROBOFLOW_API_KEY'),
                ],
                'body' => $imageBase64,
            ]);


            Log::info('Received response from Roboflow.');

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Error while sending request to Roboflow: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }


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

        if ($request->hasFile('p_gambar') && $request->file('p_gambar')->isValid()) {
            try {
                $file = $request->file('p_gambar');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file di public/images
                $file->move(public_path('images'), $filename);

                // Resize gambar
                $fullPath = public_path("images/{$filename}");
                resizeImage($fullPath, 640, 640);

                $response = $this->sendToRoboflow($fullPath);

                if (!$response || isset($response['error'])) {
                    // Log error if there's no response or an error is encountered
                    $errorMessage = $response['error'] ?? 'No response from Roboflow.';
                    Log::error('Roboflow Error: ' . $errorMessage);

                    // Set default Halal Status to 'Unsure'
                    $halalStatus = 'Unsure';
                } else {
                    // Check if predictions exist in the response
                    if (empty($response['predictions'])) {
                        Log::info('No predictions found in Roboflow response.');
                        $halalStatus = 'Unsure';
                    } else {
                        // Use the highest confidence prediction
                        $highestConfidencePrediction = $response['predictions'][0];
                        $halalStatus = ($highestConfidencePrediction['confidence'] > 0.4) ? 'Halal' : 'Unsure';
                    }
                }

                // Ensure required data is prepared
                $validatedData['p_gambar'] = $filename;
                $validatedData['halal_status'] = $halalStatus;
                $validatedData['penjual_p_id'] = Auth::id();

                // Create the product
                produk::create($validatedData);

                return redirect()->route('dashboard')->with('success', "Product created successfully! Halal Status: {$halalStatus}");
            } catch (\Exception $e) {
                Log::error('File Upload or Processing Error: ' . $e->getMessage());
                return back()->withError('An error occurred during file upload or processing. Please try again.');
            }
        }

        return back()->withError('File upload failed or invalid file.');
    }


    public function show(produk $produk)
    {
        $previous = Produk::where('p_id', '<', $produk->p_id)
            ->orderBy('p_id', 'desc')
            ->first();
        // dd($previous);

        $next = Produk::where('p_id', '>', $produk->p_id)
            ->orderBy('p_id', 'asc')
            ->first();

        return view('products.show', compact('produk', 'previous', 'next'));
    }

    public function edit(produk $produk)
    {
        return view('products.edit', compact('produk'));
    }

    public function update(UpdateprodukRequest $request, produk $produk)
    {
        $validatedData = $request->validate([
            'p_nama' => 'required|string',
            'p_harga' => 'required|integer',
            'p_stok' => 'required|integer',
            'p_deskripsi' => 'required|string',
            'p_kategori' => 'required|string',
            'p_gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'p_berat' => 'required|integer',
        ]);

        if ($request->hasFile('p_gambar')) {
            if ($produk->p_gambar && file_exists(public_path('images/' . $produk->p_gambar))) {
                unlink(public_path('images/' . $produk->p_gambar));
            }

            $file = $request->file('p_gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validatedData['p_gambar'] = $filename;
        }

        $produk->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(produk $produk)
    {
        if ($produk->p_gambar && Storage::disk('public')->exists("images/{$produk->p_gambar}")) {
            Storage::disk('public')->delete("images/{$produk->p_gambar}");
        }

        $produk->delete();

        return redirect()->route('dashboard')->with('success', 'Produk berhasil dihapus.');
    }
}
