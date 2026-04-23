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
            <?php echo e(__('Inventory')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="relative z-10 rounded-xl py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Inventories Table -->
           
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                 <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Inventories</h3>
                <button onclick="document.getElementById('inventoryModal').style.display='flex'" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Add Inventory
                </button>
            </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100"><?php echo e($inventory->name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"><?php echo e(\Carbon\Carbon::parse($inventory->date)->format('Y-m-d')); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"><?php echo e($inventory->quantity); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"><?php echo e(number_format($inventory->amount, 2)); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-sm font-medium space-x-2">
                                    <button onclick="openInventoryEditModal(<?php echo e($inventory->id); ?>, <?php echo e(json_encode($inventory->name)); ?>, <?php echo e(json_encode($inventory->date)); ?>, <?php echo e($inventory->quantity); ?>, <?php echo e($inventory->amount); ?>)" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    <form method="POST" action="<?php echo e(route('inventories.destroy', $inventory->id)); ?>" class="inline" onsubmit="return confirm('Are you sure you want to delete this inventory?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Products</h3>
                    <button onclick="document.getElementById('productModal').style.display='flex'" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Add Product
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Selling Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount Sold</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100"><?php echo e($product->product_name); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"><?php echo e($product->quantity); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"><?php echo e(number_format($product->selling_price, 2)); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"><?php echo e(number_format($product->amount_sold, 2)); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-sm font-medium space-x-2">
                                    <button onclick="openProductEditModal(<?php echo e($product->id); ?>, <?php echo e(json_encode($product->product_name)); ?>, <?php echo e($product->quantity); ?>, <?php echo e($product->selling_price); ?>, <?php echo e($product->amount_sold); ?>, <?php echo e(json_encode($product->image)); ?>)" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    <form method="POST" action="<?php echo e(route('products.destroy', $product->id)); ?>" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div id="inventoryModal" style="display:none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Add Inventory</h2>
            <form method="POST" action="<?php echo e(route('inventories.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Name</label>
                    <input type="text" name="name" id="name" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Date</label>
                    <input type="date" name="date" id="date" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="0" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Amount</label>
                    <input type="number" name="amount" id="amount" min="0" step="0.01" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="add_to_expenses" class="flex items-center text-gray-700 dark:text-gray-300 font-medium">
                        <input type="checkbox" name="add_to_expenses" id="add_to_expenses" value="1" class="mr-2">
                        Add to expenses?
                    </label>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('inventoryModal').style.display='none'" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded-md text-gray-700 dark:text-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-500">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div id="productModal" style="display:none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Add Product</h2>
            <form method="POST" action="<?php echo e(route('products.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label for="product_name" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Product Name</label>
                    <input type="text" name="product_name" id="product_name" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="0" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="selling_price" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Selling Price</label>
                    <input type="number" name="selling_price" id="selling_price" min="0" step="0.01" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="amount_sold" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Amount Sold</label>
                    <input type="number" name="amount_sold" id="amount_sold" min="0" step="0.01" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('productModal').style.display='none'" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 rounded-md text-gray-700 dark:text-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-500">Add</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Inventory Modal -->
    <div id="inventoryEditModal" style="display:none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Edit Inventory</h2>
            <form method="POST" id="inventoryEditForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="mb-4">
                    <label for="edit_name" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Name</label>
                    <input type="text" name="name" id="edit_name" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="edit_date" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Date</label>
                    <input type="date" name="date" id="edit_date" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="edit_quantity" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Quantity</label>
                    <input type="number" name="quantity" id="edit_quantity" min="0" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="edit_amount" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Amount</label>
                    <input type="number" name="amount" id="edit_amount" min="0" step="0.01" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeInventoryEditModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-400 dark:bg-gray-600 rounded-md text-gray-700 dark:text-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-500">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="productEditModal" style="display:none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Edit Product</h2>
            <form method="POST" id="productEditForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="mb-4">
                    <label for="edit_product_name" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Product Name</label>
                    <input type="text" name="product_name" id="edit_product_name" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="edit_quantity" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Quantity</label>
                    <input type="number" name="quantity" id="edit_product_quantity" min="0" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="edit_selling_price" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Selling Price</label>
                    <input type="number" name="selling_price" id="edit_selling_price" min="0" step="0.01" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="edit_amount_sold" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Amount Sold</label>
                    <input type="number" name="amount_sold" id="edit_amount_sold" min="0" step="0.01" required class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="edit_image" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Product Image</label>
                    <input type="file" name="image" id="edit_image" accept="image/*" class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                    <div id="current_image" class="mt-2"></div>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeProductEditModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-400 dark:bg-gray-600 rounded-md text-gray-700 dark:text-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gray-200 text-black rounded-md hover:bg-gray-400">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openInventoryEditModal(id, name, date, quantity, amount) {
            document.getElementById('inventoryEditModal').style.display = 'flex';
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_date').value = date;
            document.getElementById('edit_quantity').value = quantity;
            document.getElementById('edit_amount').value = amount;
            document.getElementById('inventoryEditForm').action = '/inventories/' + id;
            document.body.style.overflow = 'hidden'; // Prevent background scrolling when modal is open
        }

        function closeInventoryEditModal() {
            document.getElementById('inventoryEditModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        function openProductEditModal(id, productName, quantity, sellingPrice, amountSold, image) {
            document.getElementById('productEditModal').style.display = 'flex';
            document.getElementById('edit_product_name').value = productName;
            document.getElementById('edit_product_quantity').value = quantity;
            document.getElementById('edit_selling_price').value = sellingPrice;
            document.getElementById('edit_amount_sold').value = amountSold;
            document.getElementById('productEditForm').action = '/products/' + id;
            document.body.style.overflow = 'hidden'; // Prevent background scrolling when modal is open

            // Handle current image display
            const currentImageDiv = document.getElementById('current_image');
            if (image) {
                currentImageDiv.innerHTML = '<p class="text-sm text-gray-600 dark:text-gray-400">Current Image:</p><img src="/storage/' + image + '" alt="Current Image" class="w-16 h-16 object-cover rounded mt-1">';
            } else {
                currentImageDiv.innerHTML = '<p class="text-sm text-gray-600 dark:text-gray-400">No current image</p>';
            }
        }

        function closeProductEditModal() {
            document.getElementById('productEditModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }
    </script>
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
<?php /**PATH D:\Downloads\fitnessgains.site (2)\fitnessgains.site (1)\willie\resources\views/admin/inventory.blade.php ENDPATH**/ ?>