<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Halal Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100">
    <!-- Navigation Bar -->
    <header class="absolute top-0 left-0 w-full bg-transparent z-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between py-4">
            <div>
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="h-10">
            </div>
            <nav class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-500">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-500">
                            Log In
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-5 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-500">
                                Sign Up
                            </a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative flex flex-col items-center justify-center min-h-screen text-center bg-gradient-to-br from-green-400 via-green-300 to-green-200 dark:from-green-800 dark:to-green-700">
        <div class="max-w-4xl px-6">
            <h1 class="text-5xl lg:text-7xl font-extrabold text-white drop-shadow-lg">
                Welcome to Halal Shop
            </h1>
            <p class="mt-6 text-lg lg:text-2xl text-white/80">
                Simplifying the way you find Halal-certified products with confidence.
            </p>
            <div class="mt-8 flex flex-wrap gap-4 justify-center">
                <a href="{{ route('login') }}" 
                   class="px-6 py-3 bg-white text-green-600 font-semibold rounded-lg shadow-lg hover:bg-gray-100 focus:ring-4 focus:ring-green-500">
                    Get Started
                </a>
                <a href="#features" 
                   class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                    Learn More
                </a>
            </div>
        </div>
        <div class="absolute inset-0">
            <img src="https://plus.unsplash.com/premium_photo-1673108852141-e8c3c22a4a22?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                 alt="Halal Shop Background" 
                 class="w-full h-full object-cover opacity-10">
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-100">Why Choose Halal Shop?</h2>
            <p class="mt-4 text-lg text-center text-gray-600 dark:text-gray-300">
                Explore our key features that make your shopping experience seamless and reliable.
            </p>
            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                <!-- Feature Card -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-700 dark:text-green-400">Halal Logo Detection</h3>
                    <p class="mt-4 text-gray-600 dark:text-gray-300">
                        Upload product images to detect Halal certifications instantly.
                    </p>
                </div>
                <!-- Feature Card -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-700 dark:text-green-400">Verified Products</h3>
                    <p class="mt-4 text-gray-600 dark:text-gray-300">
                        Browse trusted products verified for Halal compliance.
                    </p>
                </div>
                <!-- Feature Card -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-green-700 dark:text-green-400">Community Support</h3>
                    <p class="mt-4 text-gray-600 dark:text-gray-300">
                        Collaborate with others to expand the Halal shopping ecosystem.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-100 py-6 text-center">
        <p class="text-sm">
            This website is in the development phase. If you're interested in collaborating, <a href="mailto:your-email@example.com" class="text-green-400 underline">contact us</a>.
        </p>
    </footer>
</body>
</html>
