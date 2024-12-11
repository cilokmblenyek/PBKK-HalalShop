<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Update Product')); ?> - ID: <?php echo e($produk->p_id); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <?php if($errors->any()): ?>
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('products.update', $produk)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Product ID (Read-Only) -->
                        <div class="mb-6">
                            <label for="p_id" class="block text-sm font-medium text-gray-700">
                                Product ID
                            </label>
                            <input type="text" name="p_id" id="p_id" value="<?php echo e($produk->p_id); ?>" readonly
                                class="mt-2 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <!-- Product Name -->
                        <div class="mb-6">
                            <label for="p_nama" class="block text-sm font-medium text-gray-700">
                                Product Name
                            </label>
                            <input type="text" name="p_nama" id="p_nama" value="<?php echo e($produk->p_nama); ?>"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Price -->
                        <div class="mb-6">
                            <label for="p_harga" class="block text-sm font-medium text-gray-700">
                                Price
                            </label>
                            <input type="number" name="p_harga" id="p_harga" value="<?php echo e($produk->p_harga); ?>"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Stock -->
                        <div class="mb-6">
                            <label for="p_stok" class="block text-sm font-medium text-gray-700">
                                Stock
                            </label>
                            <input type="number" name="p_stok" id="p_stok" value="<?php echo e($produk->p_stok); ?>"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="p_deskripsi" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea name="p_deskripsi" id="p_deskripsi" rows="4"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"><?php echo e($produk->p_deskripsi); ?></textarea>
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label for="p_kategori" class="block text-sm font-medium text-gray-700">
                                Category
                            </label>
                            <input type="text" name="p_kategori" id="p_kategori" value="<?php echo e($produk->p_kategori); ?>"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Product Image -->
                        <div class="mb-6">
                            <label for="p_gambar" class="block text-sm font-medium text-gray-700">
                                Product Image
                            </label>
                            <input type="file" name="p_gambar" id="p_gambar"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                            <?php if($produk->p_gambar): ?>
                                <p class="mt-2 text-sm text-gray-600">Current Image: <span class="font-medium"><?php echo e($produk->p_gambar); ?></span></p>
                            <?php endif; ?>
                        </div>

                        <!-- Weight -->
                        <div class="mb-6">
                            <label for="p_berat" class="block text-sm font-medium text-gray-700">
                                Weight (grams)
                            </label>
                            <input type="number" name="p_berat" id="p_berat" value="<?php echo e($produk->p_berat); ?>"
                                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>

                        <!-- Seller ID -->
                        <div class="mb-6">
                            <label for="penjual_id" class="block text-sm font-medium text-gray-700">
                                Seller ID
                            </label>
                            <input type="number" name="penjual_p_id" id="penjual_p_id" value="<?php echo e($produk->penjual_p_id); ?>"
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /www/wwwroot/103.150.93.176/resources/views/products/edit.blade.php ENDPATH**/ ?>