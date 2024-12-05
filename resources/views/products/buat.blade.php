<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Create New Product') }}
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

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

<<<<<<< HEAD
                        <!-- Product ID -->
                        <div class="mb-6">
                            <label for="p_id" class="block text-sm font-medium text-gray-700">
                                Product ID
                            </label>
                            <input type="text" name="p_id" id="p_id" placeholder="Enter product ID"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
=======
                        <div class="mb-4">
                            <input type="hidden" name="penjual_p_id" value="{{ Auth::id() }}">
                        </div>

                        <div class="mb-4">
                            <label for="p_id" class="block text-gray-700 dark:text-gray-200">Product id</label>
                            <input type="text" name="p_id" id="p_id"
                                class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-700 rounded-md">
>>>>>>> dc4303fe87e55f08268c71760d50e2dfef482ce5
                        </div>

                        <!-- Product Name -->
                        <div class="mb-6">
                            <label for="p_nama" class="block text-sm font-medium text-gray-700">
                                Product Name
                            </label>
                            <input type="text" name="p_nama" id="p_nama" placeholder="Enter product name"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Price -->
                        <div class="mb-6">
                            <label for="p_harga" class="block text-sm font-medium text-gray-700">
                                Price
                            </label>
                            <input type="number" name="p_harga" id="p_harga" placeholder="Enter price"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Stock -->
                        <div class="mb-6">
                            <label for="p_stok" class="block text-sm font-medium text-gray-700">
                                Stock
                            </label>
                            <input type="number" name="p_stok" id="p_stok" placeholder="Enter stock quantity"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="p_deskripsi" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea name="p_deskripsi" id="p_deskripsi" rows="4" placeholder="Enter product description"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"></textarea>
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label for="p_kategori" class="block text-sm font-medium text-gray-700">
                                Category
                            </label>
                            <input type="text" name="p_kategori" id="p_kategori" placeholder="Enter product category"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Product Image -->
                        <div class="mb-6">
                            <label for="p_gambar" class="block text-sm font-medium text-gray-700">
                                Product Image
                            </label>
                            <input type="file" name="p_gambar" id="p_gambar"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Weight -->
                        <div class="mb-6">
                            <label for="p_berat" class="block text-sm font-medium text-gray-700">
                                Weight (grams)
                            </label>
                            <input type="number" name="p_berat" id="p_berat" placeholder="Enter product weight"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

<<<<<<< HEAD
                        <!-- Seller ID -->
                        <div class="mb-6">
                            <label for="penjual_id" class="block text-sm font-medium text-gray-700">
                                Seller ID
                            </label>
                            <input type="number" name="penjual_p_id" id="penjual_p_id" placeholder="Enter seller ID"
                                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
=======
                        <div class="flex items-center justify-end mt-4">
>>>>>>> dc4303fe87e55f08268c71760d50e2dfef482ce5
                            <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
