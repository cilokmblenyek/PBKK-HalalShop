<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Product') }} - ID: {{ $produk->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.update', $produk) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="p_id" class="block text-gray-700 dark:text-gray-200">Product ID</label>
                            <input type="text" name="p_id" id="p_id" value="{{ $produk->p_id }}"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="p_nama" class="block text-gray-700 dark:text-gray-200">Product Name</label>
                            <input type="text" name="p_nama" id="p_nama" value="{{ $produk->p_nama }}"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="p_harga" class="block text-gray-700 dark:text-gray-200">Price</label>
                            <input type="number" name="p_harga" id="p_harga" value="{{ $produk->p_harga }}"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="p_stok" class="block text-gray-700 dark:text-gray-200">Stock</label>
                            <input type="number" name="p_stok" id="p_stok" value="{{ $produk->p_stok }}"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="p_deskripsi" class="block text-gray-700 dark:text-gray-200">Description</label>
                            <textarea name="p_deskripsi" id="p_deskripsi"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">{{ $produk->p_deskripsi }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="p_kategori" class="block text-gray-700 dark:text-gray-200">Category</label>
                            <input type="text" name="p_kategori" id="p_kategori" value="{{ $produk->p_kategori }}"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="p_gambar" class="block text-gray-700 dark:text-gray-200">Product Image</label>
                            <input type="file" name="p_gambar" id="p_gambar"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                            @if($produk->p_gambar)
                                <p class="mt-2 text-sm">Current Image: {{ $produk->p_gambar }}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="p_berat" class="block text-gray-700 dark:text-gray-200">Weight (grams)</label>
                            <input type="number" name="p_berat" id="p_berat" value="{{ $produk->p_berat }}"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="penjual_id" class="block text-gray-700 dark:text-gray-200">Seller ID</label>
                            <input type="number" name="penjual_p_id" id="penjual_p_id" value="{{ $produk->penjual_p_id }}"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-yellow-600 text-white font-semibold rounded-md hover:bg-yellow-500">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
