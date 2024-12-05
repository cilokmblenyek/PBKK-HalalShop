<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-800">

                    <!-- Search Bar -->
                    <form action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8">
                        <input type="text" name="search" id="search" placeholder="Search for products..."
                            class="px-4 py-2 flex-grow max-w-full md:max-w-md rounded-lg bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500"
                        >
                        <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                            Search
                        </button>
                    </form>

                    <!-- Create Product Button -->
                    <a href="{{ route('products.create') }}" method="GET"
                        class="mb-8 inline-block px-6 py-2 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        Create New Product
                    </a>

                    <!-- Product Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($produkku as $product)
                            <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                                <!-- Product Image -->
                                <img src="{{ URL::asset('images/' . $product->p_gambar) }}" 
                                     alt="{{ $product->p_nama }}" 
                                     class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <!-- Product Name -->
                                    <h3 class="text-lg font-bold text-gray-800">
                                        {{ $product->p_nama }}
                                    </h3>
                                    <!-- Product Description -->
                                    <p class="mt-2 text-gray-600">
                                        {{ $product->p_deskripsi }}
                                    </p>
                                    <!-- Product Price -->
                                    <div class="mt-4">
                                        <span class="text-green-600 font-semibold text-lg">
                                            Rp{{ number_format($product->p_harga, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <!-- Product Actions -->
                                    <div class="mt-6 flex items-center gap-4">
                                        <!-- Detail Product -->
                                        <a href="{{ route('products.show', $product->p_id) }}" 
                                           class="text-sm text-gray-800 hover:text-gray-900 font-medium">
                                            Detail Produk
                                        </a>
                                        <!-- Add to Cart Button -->
                                        <a href="{{ route('cart.add', $product->p_id) }}"
                                            class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                            Add to Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
