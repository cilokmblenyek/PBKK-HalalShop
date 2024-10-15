<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Loop through products -->
                        @foreach ($produkku as $product)
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-lg">
                                <img src="{{ URL::asset('images/' . $product->p_gambar) }}" alt="{{ $product->p_nama }}"
                                    class="w-full h-40 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $product->p_nama }}
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $product->p_deskripsi }}</p>
                                    <div class="mt-4">
                                        <span
                                            class="text-green-500 font-bold">Rp{{ number_format($product->p_harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="mt-4">
                                        <!-- Add to Cart Button -->
                                        <a href="{{ route('cart.add', $product->p_id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
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
