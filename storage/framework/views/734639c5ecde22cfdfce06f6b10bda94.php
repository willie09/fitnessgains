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
    <div class="py-12  px-4 sm:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Card -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden max-w-4xl mx-auto">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 p-4 sm:p-8 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.2) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 relative z-10">
                        <!-- Profile Image -->
                        <div class="relative group">
                            <?php if($member->profile_photo): ?>
                                <img src="<?php echo e(asset('storage/' . $member->profile_photo)); ?>" alt="Profile Picture" class="w-16 h-16 sm:w-24 sm:h-24 rounded-full object-cover shadow-lg ring-4 ring-white/20 transition-all duration-300 group-hover:ring-white/40">
                            <?php else: ?>
                                <div class="w-16 h-16 sm:w-24 sm:h-24 bg-white/20 rounded-full flex items-center justify-center shadow-lg ring-4 ring-white/20 transition-all duration-300 group-hover:ring-white/40">
                                    <svg class="w-8 h-8 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <!-- Upload Button Overlay -->
                            <button onclick="openEditModal()" class="absolute inset-0 w-16 h-16 sm:w-24 sm:h-24 bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer">
                                <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Basic Info -->
                        <div class="flex-1 text-center sm:text-left">
                            <h1 class="text-2xl sm:text-3xl font-bold text-white"><?php echo e($member->name); ?></h1>
                            <p class="text-white/80 text-base sm:text-lg"><?php echo e(ucfirst($member->membership_type)); ?> Member</p>
                        </div>

                        <!-- Edit Button -->
                        <div class="flex-shrink-0">
                            <button onclick="openEditModal()" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 sm:px-6 sm:py-3 rounded-xl font-medium transition-all duration-300 border border-white/30 hover:shadow-lg hover:shadow-white/20 transform hover:scale-105 text-sm sm:text-base">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Membership Stats -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-xl font-bold text-white mb-4">Membership Details</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Membership Type</p>
                                            <p class="text-white font-semibold"><?php echo e(ucfirst($member->membership_type)); ?></p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Join Date</p>
                                            <p class="text-white font-semibold"><?php echo e($member->join_date->format('M d, Y')); ?></p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Expiry Date</p>
                                            <p class="text-white font-semibold"><?php echo e($member->expiry_date->format('M d, Y')); ?></p>
                                        </div>
                                    </div>

                                    <?php if($daysRemaining > 0): ?>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-white/70 text-sm">Days Remaining</p>
                                                <p class="text-white font-semibold"><?php echo e($daysRemaining); ?> days</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Membership Progress -->
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-3">Membership Progress</h4>
                                <div class="w-full bg-white/10 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full" style="width: <?php echo e($progressPercentage); ?>%"></div>
                                </div>
                                <p class="text-white/70 text-sm mt-2"><?php echo e($progressPercentage); ?>% complete</p>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div>
                            <h3 class="text-xl font-bold text-white mb-4">Personal Information</h3>
                            <div class="space-y-4">
                                <!-- Email -->
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/70 text-sm">Email</p>
                                        <p class="text-white font-semibold"><?php echo e($member->email); ?></p>
                                    </div>
                                </div>

                                <?php if($member->contact_number): ?>
                                    <!-- Contact Number -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Contact Number</p>
                                            <p class="text-white font-semibold"><?php echo e($member->contact_number); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($member->gender): ?>
                                    <!-- Gender -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Gender</p>
                                            <p class="text-white font-semibold"><?php echo e(ucfirst($member->gender)); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($age): ?>
                                    <!-- Age -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Age</p>
                                            <p class="text-white font-semibold"><?php echo e($age); ?> years old</p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($member->date_of_birth): ?>
                                    <!-- Date of Birth -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Date of Birth</p>
                                            <p class="text-white font-semibold"><?php echo e($member->date_of_birth->format('M d, Y')); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($member->weight): ?>
                                    <!-- Weight -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0m-6.001-9h6m6 3l3-3m-3 3l-3-3m3 3v12.055c0 .373-.239.69-.6.809L9 21.055V3.055l8.4 3.9c.361.169.6.486.6.809V15z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Weight</p>
                                            <p class="text-white font-semibold"><?php echo e($member->weight); ?> kg</p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($member->address): ?>
                                    <!-- Address -->
                                    <div class="flex items-start space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Address</p>
                                            <p class="text-white leading-relaxed"><?php echo e($member->address); ?></p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <p class="text-white/60 italic mb-4">No address provided. Click "Edit Profile" to add your address.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

            <!-- Success/Error Messages -->
            <?php if(session('success')): ?>
                <div class="mt-6 max-w-4xl mx-auto">
                    <div class="glass-effect border border-green-500/20 bg-green-500/10 p-4 rounded-xl">
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
                <div class="mt-6 max-w-4xl mx-auto">
                    <div class="glass-effect border border-red-500/20 bg-red-500/10 p-4 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <p class="text-red-400 font-medium"><?php echo e(session('error')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Edit Profile Modal -->
            <div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="glass-effect border border-white/20 rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto scrollbar-hide sm:scrollbar-default">
                            <div class="p-4 sm:p-6 lg:p-8">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-2xl font-bold text-white">Edit Profile</h3>
                                    <button onclick="closeEditModal()" class="text-white/70 hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <form method="POST" action="<?php echo e(route('member.profile.update')); ?>" enctype="multipart/form-data" class="space-y-4 sm:space-y-6">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                        <div class="px-2 sm:px-0">
                                            <label for="profile_photo" class="block text-sm font-medium text-white/80 mb-2">Profile Picture</label>
                                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                                            <?php $__errorArgs = ['profile_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="px-2 sm:px-0">
                                            <label for="contact_number" class="block text-sm font-medium text-white/80 mb-2">Contact Number</label>
                                            <input type="tel" name="contact_number" id="contact_number" value="<?php echo e(old('contact_number', $member->contact_number)); ?>" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                                            <?php $__errorArgs = ['contact_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="px-2 sm:px-0">
                                            <label for="gender" class="block text-sm font-medium text-white/80 mb-2">Gender</label>
                                            <select name="gender" id="gender" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                                                <option value="">Select Gender</option>
                                                <option value="male" <?php echo e(old('gender', $member->gender) == 'male' ? 'selected' : ''); ?>>Male</option>
                                                <option value="female" <?php echo e(old('gender', $member->gender) == 'female' ? 'selected' : ''); ?>>Female</option>
                                                <option value="other" <?php echo e(old('gender', $member->gender) == 'other' ? 'selected' : ''); ?>>Other</option>
                                            </select>
                                            <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="px-2 sm:px-0">
                                            <label for="date_of_birth" class="block text-sm font-medium text-white/80 mb-2">Date of Birth</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo e(old('date_of_birth', $member->date_of_birth ? $member->date_of_birth->format('Y-m-d') : '')); ?>" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                                            <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="px-2 sm:px-0">
                                            <label for="weight" class="block text-sm font-medium text-white/80 mb-2">Weight (kg)</label>
                                            <input type="number" name="weight" id="weight" value="<?php echo e(old('weight', $member->weight)); ?>" step="0.01" min="1" max="999.99" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                                            <?php $__errorArgs = ['weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="px-2 sm:px-0">
                                        <label for="address" class="block text-sm font-medium text-white/80 mb-2">Address</label>
                                        <textarea name="address" id="address" rows="4" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 resize-none"><?php echo e(old('address', $member->address)); ?></textarea>
                                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-4 px-2 sm:px-0">
                                        <button type="button" onclick="closeEditModal()" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 border border-white/20 w-full sm:w-auto">
                                            Cancel
                                        </button>
                                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-8 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-blue-500/25 w-full sm:w-auto">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 640px) {
            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
        }
    </style>

    <script>
        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
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
<?php /**PATH D:\Downloads\fitnessgains.site (2)\fitnessgains.site (1)\willie\resources\views/member/profile.blade.php ENDPATH**/ ?>