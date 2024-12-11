<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>PBKK Halal Shop</title>

    <link rel="icon" href="<?php echo e(asset('images/favicon.png')); ?>" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100 antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation Bar -->
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
            <header class="bg-gradient-to-br from-green-400 to-green-300 dark:from-green-800 dark:to-green-700 shadow-md">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-white">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main class="flex-grow">
            <?php echo e($slot); ?>

        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-100 py-6 text-center">
            <p class="text-sm">
                This website is in the development phase. If you're interested in collaborating, 
                <a href="mailto:your-email@example.com" class="text-green-400 underline">contact us</a>.
            </p>
        </footer>
    </div>
</body>
</html>
<?php /**PATH /www/wwwroot/103.150.93.176/resources/views/layouts/app.blade.php ENDPATH**/ ?>