<x-app-layout >
    <div class="bg-white">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Your Cart') }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (count($cart) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-green-300 shadow overflow-hidden sm:rounded-lg">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase">
                                    Product Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase">
                                    Price
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase">
                                    Quantity
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $p_id => $item)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $item['name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 ">
                                        Rp{{ number_format($item['price'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 ">
                                        <div class="flex items-center space-x-2">
                                            <!-- Decrease Quantity Button -->
                                            <form action="{{ route('cart.decrease', $p_id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md text-xs text-black dark:text-white uppercase hover:bg-gray-400 focus:outline-none">
                                                    -
                                                </button>
                                            </form>
                                            <!-- Display Current Quantity -->
                                            <span>{{ $item['quantity'] }}</span>
                                            <!-- Increase Quantity Button -->
                                            <form action="{{ route('cart.increase', $p_id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md text-xs text-black dark:text-white uppercase hover:bg-gray-400 focus:outline-none">
                                                    +
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('cart.remove', $p_id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                            Checkout
                        </button>
                    </form>
                </div>
            @else
                <p class="text-gray-500 ">Your cart is empty.</p>
            @endif
        </div>
    </div>

</x-app-layout>
