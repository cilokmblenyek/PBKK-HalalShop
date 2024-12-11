<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Halal - Belanja Online Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .stroke-text {
            color: transparent;
            -webkit-text-stroke: 2px white; 
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); 
        }
    </style>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100">
    <!-- Navigasi -->
    <header class="fixed top-0 left-0 w-full bg-white dark:bg-gray-900 shadow-md z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between py-4">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('assets/images/final-logo-type1.png') }}" alt="Logo" class="w-36 h-auto">
            </div>
            <div class="flex items-center space-x-2">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold rounded-lg shadow-lg hover:from-emerald-600 hover:to-emerald-700 focus:ring-4 focus:ring-emerald-300 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 focus:ring-4 focus:ring-emerald-300 transition">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 focus:ring-4 focus:ring-emerald-300 transition">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section dengan Carousel -->
    <section class="relative flex items-center justify-center min-h-screen bg-gradient-to-br from-emerald-400 via-emerald-300 to-emerald-200 dark:from-emerald-800 dark:to-emerald-700 pt-24">
        <!-- Carousel -->
        <div class="absolute inset-0 w-full h-full overflow-hidden">
            <div class="carousel flex w-full h-full transition-transform duration-700 ease-in-out" style="transform: translateX(0);">
                <div class="flex-shrink-0 w-full h-full">
                    <img src="{{ asset('assets/images/carousel_1.jpg') }}" alt="Halal Food" class="w-full h-full object-cover">
                </div>
                <div class="flex-shrink-0 w-full h-full">
                    <img src="{{ asset('assets/images/carousel_2.jpg') }}" alt="Halal Beverage" class="w-full h-full object-cover">
                </div>
                <div class="flex-shrink-0 w-full h-full">
                    <img src="{{ asset('assets/images/carousel_3.jpg') }}" alt="Halal Fashion" class="w-full h-full object-cover">
                </div>
            </div>
            <!-- Carousel Controls -->
            <button class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white bg-black/50 p-3 rounded-full hover:bg-black/70 z-10" id="prev-slide">❮</button>
            <button class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white bg-black/50 p-3 rounded-full hover:bg-black/70 z-10" id="next-slide">❯</button>
        </div>

         <!-- Overlay Content -->
         <div class="relative z-20 max-w-5xl px-6 text-center">
            <h1 class="text-5xl font-extrabold stroke-text leading-tight">
                Temukan Produk Halal<br>Untuk Gaya Hidup Yang Lebih Baik
            </h1>
            <p class="mt-4 text-lg text-white/80 italic">
                Belanja dengan tenang dan yakin dengan koleksi produk halal terbaik.
            </p>
        </div>
    </section>


    <!-- Script untuk Carousel -->
    <script>
        const carousel = document.querySelector('.carousel');
        const slides = document.querySelectorAll('.carousel > div');
        const prevSlide = document.getElementById('prev-slide');
        const nextSlide = document.getElementById('next-slide');
        let currentSlide = 0;
    
        function updateCarousel() {
            const slideWidth = slides[0].clientWidth;
            carousel.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
        }
    
        prevSlide.addEventListener('click', () => {
            currentSlide = (currentSlide === 0) ? slides.length - 1 : currentSlide - 1;
            updateCarousel();
        });
    
        nextSlide.addEventListener('click', () => {
            currentSlide = (currentSlide === slides.length - 1) ? 0 : currentSlide + 1;
            updateCarousel();
        });
    
        // Auto-slide every 5 seconds
        setInterval(() => {
            nextSlide.click();
        }, 5000);
    </script>

    <!-- Section Kategori -->
    <section id="categories" class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <h2 class="text-4xl font-bold text-center text-gray-800 dark:text-gray-100">Kategori Produk</h2>
            <p class="mt-4 text-lg text-center text-gray-600 dark:text-gray-300">Jelajahi berbagai kategori produk Halal yang kami sediakan.</p>
            
            <div class="mt-12 grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <!-- Kategori 1 -->
                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <img src="{{ asset('assets/images/category_halal_food.jpg') }}" alt="Halal Food" class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-center text-gray-800 dark:text-gray-100">Makanan</h3>
                </div>
                
                <!-- Kategori 2 -->
                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <img src="{{ asset('assets/images/category_halal_cosmetic.jpg') }}" alt="Halal Cosmetic" class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-center text-gray-800 dark:text-gray-100">Kosmetik</h3>
                </div>

                <!-- Kategori 3 -->
                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <img src="{{ asset('assets/images/category_halal_beverages.jpg') }}" alt="Halal Beverages" class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-center text-gray-800 dark:text-gray-100">Minuman</h3>
                </div>
                
                <!-- Kategori 4 -->
                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <img src="{{ asset('assets/images/category_halal_fashion.jpg') }}" alt="Halal Fashion" class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-center text-gray-800 dark:text-gray-100">Fashion</h3>
                </div>

                <!-- Kategori 5 -->
                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <img src="{{ asset('assets/images/category_halal_electronic.jpg') }}" alt="Halal Electronics" class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-center text-gray-800 dark:text-gray-100">Elektronik</h3>
                </div>

                <!-- Kategori 6 -->
                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <img src="{{ asset('assets/images/category_halal_tools.jpg') }}" alt="Halal Tools" class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-center text-gray-800 dark:text-gray-100">Peralatan Rumah</h3>
                </div>

                <!-- Kategori 7 -->
                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <img src="{{ asset('assets/images/category_halal_hygine.jpg') }}" alt="Halal Hygiene" class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-center text-gray-800 dark:text-gray-100">Kesehatan & Kebersihan</h3>
                </div>

                <!-- Kategori 8 -->
                <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                        <img src="{{ asset('assets/images/category_halal_book.jpg') }}" alt="Halal Books" class="w-full h-full object-cover">
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-center text-gray-800 dark:text-gray-100">Buku & Edukasi</h3>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-100 py-6 text-center">
        <p class="text-sm">
            Situs ini masih dalam tahap pengembangan. Jika Anda tertarik untuk bekerja sama, <a href="mailto:your-email@example.com" class="text-emerald-400 underline">hubungi kami</a>.
        </p>
    </footer>
</body>
</html>
