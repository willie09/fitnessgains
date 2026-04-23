<?php if (isset($component)) { $__componentOriginalc0f41e5d8f1bf9b69def8231202579a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc0f41e5d8f1bf9b69def8231202579a6 = $attributes; } ?>
<?php $component = App\View\Components\MappLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mapp-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\MappLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="relative z-10 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Products Header -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-8 sm:pl-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-bold text-white">Available Products</h1>
                            <p class="text-white/80 text-md mt-2">Browse our fitness products and supplements</p>
                        </div>
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <?php if($products->count() > 0): ?>
                <div class="grid grid-cols-2 lg:grid-cols-5 gap-2 lg:gap-8">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 p-2 sm:p-2">
                                <!-- Product Image Placeholder -->
                                <div class="h-48 flex items-center justify-center overflow-hidden rounded-t-2xl">
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->product_name); ?>" class="object-contain h-full w-full">
                                    <?php else: ?>
                                        <div class="bg-gradient-to-br from-gray-100 to-gray-200 h-full w-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            <!-- Product Details -->
                            <div class="p-4 sm:p-6 sm:pl-8">
                                <h3 class="text-lg font-bold text-white mb-2"><?php echo e($product->product_name); ?></h3>

                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-white/70">Price</span>
                                        <span class="text-lg font-bold text-green-400">₱<?php echo e(number_format($product->selling_price, 2)); ?></span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-white/70">Available Stock</span>
                                        <span class="text-white font-semibold"><?php echo e($product->quantity); ?></span>
                                    </div>
                                </div>

                                <!-- Stock Status -->
                                <?php if($product->quantity > 10): ?>
                                    <div class="flex items-center space-x-2 mb-4">
                                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                        <span class="text-green-400 text-sm font-medium">In Stock</span>
                                    </div>
                                <?php elseif($product->quantity > 0): ?>
                                    <div class="flex items-center space-x-2 mb-4">
                                        <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                        <span class="text-yellow-400 text-sm font-medium">Limited Stock</span>
                                    </div>
                                <?php else: ?>
                                    <div class="flex items-center space-x-2 mb-4">
                                        <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                        <span class="text-red-400 text-sm font-medium">Out of Stock</span>
                                    </div>
                                <?php endif; ?>

                                <!-- Action Button -->
                                <?php if($product->quantity > 0): ?>
                                    <button onclick="openOrderModal(<?php echo e($product->id); ?>, '<?php echo e($product->product_name); ?>', <?php echo e($product->selling_price); ?>, <?php echo e($product->quantity); ?>, '<?php echo e($product->image ? asset('storage/' . $product->image) : ''); ?>')" class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white py-3 px-2 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-green-500/25 transform hover:scale-105">
                                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Order Now
                                    </button>
                                <?php else: ?>
                                    <button disabled class="w-full bg-gray-500/20 text-gray-400 py-3 px-6 rounded-xl font-medium cursor-not-allowed">
                                        Out of Stock
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <!-- No Products Message -->
                <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-12 sm:pl-16 text-center">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-500 to-gray-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">No Products Available</h3>
                    <p class="text-white/70 text-lg">We're currently restocking our products. Please check back later!</p>
                </div>
            <?php endif; ?>

            <!-- Recent Orders Section -->
            <?php if($recentOrders->count() > 0): ?>
                <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden mt-8 mb-8">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-4 sm:pl-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-xl font-bold text-white">Recent Orders</h1>
                                <p class="text-white/80 text-md mt-2">Your latest product orders</p>
                            </div>
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            <?php echo e($order->order_date->format('M j, Y')); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            <?php echo e($order->product->product_name); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            <?php echo e($order->quantity); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            ₱<?php echo e(number_format($order->total_amount, 2)); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                <?php if($order->status == 'pending'): ?> bg-yellow-100 text-yellow-800
                                                <?php elseif($order->status == 'processing'): ?> bg-blue-100 text-blue-800
                                                <?php elseif($order->status == 'completed'): ?> bg-green-100 text-green-800
                                                <?php elseif($order->status == 'cancelled'): ?> bg-red-100 text-red-800
                                                <?php else: ?> bg-gray-100 text-gray-800
                                                <?php endif; ?>">
                                                <?php echo e(ucfirst($order->status)); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Success/Error Messages -->
            <?php if(session('success')): ?>
                <div class="mt-8 max-w-4xl mx-auto">
                    <div class="glass-effect border border-green-500/20 bg-green-500/10 p-4 sm:pl-6 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-green-400 font-medium"><?php echo e(session('success')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mt-8 max-w-4xl mx-auto">
                    <div class="glass-effect border border-red-500/20 bg-red-500/10 p-4 sm:pl-6 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <p class="text-red-400 font-medium"><?php echo e(session('error')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Order Modal -->
    <div id="orderModal" style="display:none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md p-6 mx-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Order Product</h2>
                <button onclick="closeOrderModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form method="POST" action="<?php echo e(route('member.orders.store')); ?>" id="orderForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" id="modal_product_id">

                <!-- Product Image in Modal -->
                <div class="mb-4 flex justify-center">
                    <div class="w-32 h-32 bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden flex items-center justify-center">
                        <img id="modal_product_image" src="" alt="Product Image" class="object-contain w-full h-full" style="display: none;">
                        <svg id="modal_image_placeholder" class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="modal_product_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Product</label>
                    <div class="text-lg font-semibold text-gray-900 dark:text-gray-100" id="modal_product_name"></div>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="decreaseQuantity()" class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </button>
                        <input type="number" name="quantity" id="quantity" min="1" value="1" class="w-20 text-center border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 dark:bg-gray-700 dark:text-white" readonly>
                        <button type="button" onclick="increaseQuantity()" class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Available: <span id="available_stock"></span></p>
                </div>

                <div class="mb-6">
                    <div class="flex items-center justify-between py-3 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-lg font-medium text-gray-700 dark:text-gray-300">Total Amount:</span>
                        <span class="text-2xl font-bold text-green-600 dark:text-green-400" id="total_amount">₱0.00</span>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="button" onclick="closeOrderModal()" class="flex-1 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 py-3 px-4 rounded-xl font-medium transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-green-500/25">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentProduct = null;
        let currentPrice = 0;
        let maxStock = 0;

        function openOrderModal(productId, productName, price, stock, imageUrl) {
            currentProduct = productId;
            currentPrice = price;
            maxStock = stock;

            document.getElementById('modal_product_id').value = productId;
            document.getElementById('modal_product_name').textContent = productName;
            document.getElementById('available_stock').textContent = stock;
            document.getElementById('quantity').value = 1;
            document.getElementById('quantity').max = stock;

            // Handle product image
            const imageElement = document.getElementById('modal_product_image');
            const placeholderElement = document.getElementById('modal_image_placeholder');

            if (imageUrl && imageUrl.trim() !== '') {
                imageElement.src = imageUrl;
                imageElement.style.display = 'block';
                placeholderElement.style.display = 'none';
            } else {
                imageElement.style.display = 'none';
                placeholderElement.style.display = 'block';
            }

            updateTotal();

            document.getElementById('orderModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeOrderModal() {
            document.getElementById('orderModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            currentProduct = null;
            currentPrice = 0;
            maxStock = 0;
        }

        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            const currentValue = parseInt(quantityInput.value);
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
                updateTotal();
            }
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateTotal();
            }
        }

        function updateTotal() {
            const quantity = parseInt(document.getElementById('quantity').value);
            const total = quantity * currentPrice;
            document.getElementById('total_amount').textContent = '₱' + total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        // Close modal when clicking outside
        document.getElementById('orderModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });

        // Update total when quantity changes (in case of manual input)
        document.getElementById('quantity').addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value < 1) this.value = 1;
            if (value > maxStock) this.value = maxStock;
            updateTotal();
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc0f41e5d8f1bf9b69def8231202579a6)): ?>
<?php $attributes = $__attributesOriginalc0f41e5d8f1bf9b69def8231202579a6; ?>
<?php unset($__attributesOriginalc0f41e5d8f1bf9b69def8231202579a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0f41e5d8f1bf9b69def8231202579a6)): ?>
<?php $component = $__componentOriginalc0f41e5d8f1bf9b69def8231202579a6; ?>
<?php unset($__componentOriginalc0f41e5d8f1bf9b69def8231202579a6); ?>
<?php endif; ?>
<?php /**PATH D:\Downloads\fitnessgains.site (2)\fitnessgains.site (1)\willie\resources\views/member/products.blade.php ENDPATH**/ ?>