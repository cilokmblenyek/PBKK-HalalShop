<x-guest-layout>
            <!-- Form Heading -->
            <h2 class="text-2xl font-extrabold text-gray-900 text-center">Welcome Back</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Or 
                <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-500">
                    create a new account
                </a>
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf
                
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" autocomplete="username" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        value="{{ old('email') }}" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" 
                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="remember_me" class="ms-2 block text-sm text-gray-700">Remember me</label>
                </div>

                <!-- Forgot Password and Submit Button -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-500">
                            Forgot your password?
                        </a>
                    @endif

                    <button type="submit" 
                        class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Log in
                    </button>
                </div>
            </form>
</x-guest-layout>
