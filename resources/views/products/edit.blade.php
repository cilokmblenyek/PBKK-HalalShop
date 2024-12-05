<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Product') }} - ID: {{ $produk->p_id }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.update', $produk) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Product ID (Read-Only) -->
                        <div class="mb-6">
                            <label for="p_id" class="block text-sm font-medium text-gray-700">
                                Product ID
                            </label>
                            <input type="text" name="p_id" id="p_id" value="{{ $produk->p_id }}" readonly
                                class="mt-2 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <!-- Product Name -->
                        <div class="mb-6">
                            <label for="p_nama" class="block text-sm font-medium text-gray-700">
                                Product Name
                            </label>
                            <input type="text" name="p_nama" id="p_nama" value="{{ $produk->p_nama }}"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Price -->
                        <div class="mb-6">
                            <label for="p_harga" class="block text-sm font-medium text-gray-700">
                                Price
                            </label>
                            <input type="number" name="p_harga" id="p_harga" value="{{ $produk->p_harga }}"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Stock -->
                        <div class="mb-6">
                            <label for="p_stok" class="block text-sm font-medium text-gray-700">
                                Stock
                            </label>
                            <input type="number" name="p_stok" id="p_stok" value="{{ $produk->p_stok }}"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="p_deskripsi" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea name="p_deskripsi" id="p_deskripsi" rows="4"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">{{ $produk->p_deskripsi }}</textarea>
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label for="p_kategori" class="block text-sm font-medium text-gray-700">
                                Category
                            </label>
                            <input type="text" name="p_kategori" id="p_kategori" value="{{ $produk->p_kategori }}"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Product Image -->
                        <div class="mb-6">
                            <label for="p_gambar" class="block text-sm font-medium text-gray-700">
                                Product Image
                            </label>
                            <input type="file" name="p_gambar" id="p_gambar"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                            @if ($produk->p_gambar)
                                <p class="mt-2 text-sm text-gray-600">Current Image: <span class="font-medium">{{ $produk->p_gambar }}</span></p>
                            @endif
                        </div>

                        <!-- Weight -->
                        <div class="mb-6">
                            <label for="p_berat" class="block text-sm font-medium text-gray-700">
                                Weight (grams)
                            </label>
                            <input type="number" name="p_berat" id="p_berat" value="{{ $produk->p_berat }}"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Seller ID -->
                        <div class="mb-6">
                            <label for="penjual_id" class="block text-sm font-medium text-gray-700">
                                Seller ID
                            </label>
                            <input type="number" name="penjual_p_id" id="penjual_p_id" value="{{ $produk->penjual_p_id }}"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-yellow-600 text-white font-medium rounded-lg shadow-md hover:bg-yellow-700 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
