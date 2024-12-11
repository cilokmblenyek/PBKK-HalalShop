<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $produk->p_nama }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-800">

                    <!-- Product Details -->
                    <div class="max-w-2xl mx-auto bg-gray-100 p-6 rounded-lg shadow">
                        <h1 class="text-2xl font-bold mb-4">{{ $produk->p_nama }}</h1>
                        
                        <img src="{{ asset('images/' . $produk->p_gambar) }}" alt="{{ $produk->p_nama }}" class="w-full h-auto mb-6 rounded-lg shadow-md">
                        
                        <p class="mb-6 text-gray-600">{{ $produk->p_deskripsi }}</p>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="font-medium text-gray-700">Stock:</p>
                                <p class="text-gray-800">{{ $produk->p_stok }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-700">Price:</p>
                                <p class="text-green-600 font-semibold">Rp{{ number_format($produk->p_harga, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-700">Category:</p>
                                <p class="text-gray-800">{{ $produk->p_kategori }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-700">Weight:</p>
                                <p class="text-gray-800">{{ $produk->p_berat }} grams</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-700">Halal Status:</p>
                                <p class="text-gray-800">{{ $produk->halal_status }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <p class="font-medium text-gray-700">Created At:</p>
                            <p class="text-gray-800">{{ $produk->p_tgldibuat }}</p>
                        </div>
                        <div class="mt-2">
                            <p class="font-medium text-gray-700">Updated At:</p>
                            <p class="text-gray-800">{{ $produk->p_tglupdate }}</p>
                        </div>

                        <!-- Update Product Button -->
                        <a href="{{ route('products.edit', $produk) }}" 
                           class="mt-6 inline-block px-4 py-2 bg-yellow-500 text-white font-medium rounded-lg shadow-md hover:bg-yellow-600 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 transition">
                            Update Product
                        </a>
                        
                        <!-- Delete Product Form -->
                        <form action="{{ route('products.destroy', $produk) }}" method="POST" class="inline-block mt-6">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this product?');"
                                    class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg shadow-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-400 transition">
                                Delete Product
                            </button>
                        </form>

                        <!-- Back to Products Button -->
                        <a href="{{ route('dashboard') }}"
                           class="mt-6 inline-block px-4 py-2 bg-gray-200 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-300 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition">
                            Back to Products
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
