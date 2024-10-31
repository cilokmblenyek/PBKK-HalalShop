<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $produk->p_nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h1 class="text-2xl font-bold mb-4">{{ $produk->p_nama }}</h1>
                        
                        <img src="{{ URL::asset('images/' . $produk->p_gambar) }}" alt="{{ $produk->p_nama }}" class="w-full h-auto mb-6 rounded-md">

                        <p class="mb-4 text-gray-600 dark:text-gray-400">{{ $produk->p_deskripsi }}</p>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="font-semibold">Stock:</p>
                                <p>{{ $produk->p_stok }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Price:</p>
                                <p>Rp{{ number_format($produk->p_harga, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Category:</p>
                                <p>{{ $produk->p_kategori }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Weight:</p>
                                <p>{{ $produk->p_berat }} grams</p>
                            </div>
                        </div>

                        <p class="mt-6 font-semibold">Created At: {{ $produk->p_tgldibuat }}</p>
                        <p class="mt-2 font-semibold">Updated At: {{ $produk->p_tglupdate }}</p>

                        <!-- Tombol Update -->
                        <a href="{{ route('products.edit', $produk) }}" 
                            class="mt-6 inline-block px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md hover:bg-yellow-400"
                            style="display: block;">
                             Update Product
                         </a>
                         
 
                         <!-- Tombol Delete -->
                         <form action="{{ route('products.destroy', $produk) }}" method="POST" class="inline-block mt-6">
                             @csrf
                             @method('DELETE')
                             <button type="submit"
                                     onclick="return confirm('Are you sure you want to delete this product?');"
                                     class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-500">
                                 Delete Product
                             </button>
                         </form>
 
                         <!-- Tombol Back to Products -->
                         <a href="{{ route('dashboard') }}"
                            class="mt-6 inline-block px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-100 rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                             Back to Products
                         </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>