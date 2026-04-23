<x-trainor-layout>

    <div class="py-6  px-6 sm:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="p-2 flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">

            <!-- Workout Plans List -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Workout Plans</h3>
                        </div>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3 w-full sm:w-auto">
                            <button
                    x-data
                    @click="$dispatch('open-modal', 'create-workout-plan')"
                    class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-purple-500/25 w-full sm:w-auto"
                >
                    Create Workout Plan
                </button>
                            <div class="relative w-full sm:w-64">
                                <input type="text" id="searchInput" placeholder="Search plans..." class="glass-effect border border-white/20 rounded-xl px-4 py-2 text-white placeholder-white/50 focus:border-white/40 focus:outline-none w-full">
                                <svg class="w-5 h-5 text-white/50 absolute right-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6">
                        @if($userWorkoutPlans->count() > 0)
                            <h3 class="text-xl font-bold text-white col-span-full mb-4">Your Workout Plans</h3>
                            @foreach($userWorkoutPlans as $plan)
                                <a href="{{ route('workout_plans.show', $plan->id) }}" class="glass-effect border border-white/20 rounded-2xl p-4 hover:bg-white/5 transition-all duration-300 shadow-lg hover:shadow-purple-500/10 cursor-pointer block">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center space-x-2">
                                            <div>
                                                <h4 class="text-lg font-semibold text-white">{{ $plan->title }}</h4>
                                                <p class="text-sm text-white/70">{{ $plan->category_goal }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-white/80 mb-4">{{ Str::limit($plan->description, 80) }}</p>
                                    <div class="flex items-center justify-start">
                                        <div class="flex space-x-1">
                                            <button
                                                x-data
                                                @click.prevent.stop="$dispatch('open-modal', 'edit-workout-plan-{{ $plan->id }}')"
                                                class="text-blue-400 hover:text-blue-300 transition-colors duration-200 p-3 sm:p-2 rounded-lg hover:bg-white/10 min-w-[44px] min-h-[44px] flex items-center justify-center"
                                                type="button"
                                                title="Edit"
                                            >
                                                <svg class="w-5 h-5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2-2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button
                                                x-data
                                                @click.prevent.stop="$dispatch('open-modal', 'suggest-workout-plan-{{ $plan->id }}')"
                                                class="text-green-400 hover:text-green-300 transition-colors duration-200 p-3 sm:p-2 rounded-lg hover:bg-white/10 min-w-[44px] min-h-[44px] flex items-center justify-center"
                                                type="button"
                                                title="Suggest to Member"
                                            >
                                                <svg class="w-5 h-5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                </svg>
                                            </button>
                                            <form method="POST" action="{{ route('workout_plans.destroy', $plan->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this workout plan?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" @click.stop class="text-red-400 hover:text-red-300 transition-colors duration-200 p-3 sm:p-2 rounded-lg hover:bg-white/10 min-w-[44px] min-h-[44px] flex items-center justify-center" title="Delete">
                                                    <svg class="w-5 h-5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        @if($otherWorkoutPlans->count() > 0)
                            <h3 class="text-xl font-bold text-white col-span-full mt-8 mb-4">Other Workout Plans</h3>
                            @foreach($otherWorkoutPlans as $plan)
                                <a href="{{ route('workout_plans.show', $plan->id) }}" class="glass-effect border border-white/20 rounded-2xl p-4 hover:bg-white/5 transition-all duration-300 shadow-lg hover:shadow-purple-500/10 cursor-pointer block">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center space-x-2">
                                            <div>
                                                <h4 class="text-lg font-semibold text-white">{{ $plan->title }}</h4>
                                                <p class="text-sm text-white/70">{{ $plan->category_goal }}</p>
                                                <p class="text-xs text-white/50">By: {{ $plan->trainor->user->name ?? 'Unknown' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-white/80 mb-4">{{ Str::limit($plan->description, 80) }}</p>
                                    <div class="flex items-center justify-start">
                                        <div class="flex space-x-1">
                                            <button
                                                x-data
                                                @click.prevent.stop="$dispatch('open-modal', 'suggest-workout-plan-{{ $plan->id }}')"
                                                class="text-green-400 hover:text-green-300 transition-colors duration-200 p-3 sm:p-2 rounded-lg hover:bg-white/10 min-w-[44px] min-h-[44px] flex items-center justify-center"
                                                type="button"
                                                title="Suggest to Member"
                                            >
                                                <svg class="w-5 h-5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        @if($userWorkoutPlans->isEmpty() && $otherWorkoutPlans->isEmpty())
                            <div class="col-span-full flex flex-col items-center justify-center py-12">
                                <svg class="w-16 h-16 text-white/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <p class="text-white/70 text-lg font-medium">No workout plans yet</p>
                                <p class="text-white/50 text-sm">Create your first workout plan to get started</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @forelse($workoutPlans as $plan)
        <!-- Edit Modal for this plan -->
        <x-modal name="edit-workout-plan-{{ $plan->id }}" :show="old('title') || $errors->any()" maxWidth="2xl" focusable>
            <form method="POST" class="p-8 rounded-lg" action="{{ route('workout_plans.update', $plan->id) }}">
                @csrf
                @method('PATCH')

                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Edit Workout Plan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title-{{ $plan->id }}" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Workout Plan Title</label>
                        <input type="text" id="title-{{ $plan->id }}" name="title" value="{{ old('title', $plan->title) }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white" placeholder="e.g., Beginner Strength Training" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category/Goal -->
                    <div>
                        <label for="category_goal-{{ $plan->id }}" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Category/Goal</label>
                        <input type="text" id="category_goal-{{ $plan->id }}" name="category_goal" value="{{ old('category_goal', $plan->category_goal) }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white" placeholder="Enter category or goal" required>
                        @error('category_goal')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description-{{ $plan->id }}" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Description (Optional)</label>
                        <textarea id="description-{{ $plan->id }}" name="description" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white resize-none" placeholder="Describe the workout plan, exercises, goals, etc.">{{ old('description', $plan->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" @click="$dispatch('close-modal', 'edit-workout-plan-{{ $plan->id }}')" class="bg-white/10 hover:bg-white/20 text-gray-900 dark:text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 border border-gray-300 dark:border-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-8 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-purple-500/25">
                        Update Workout Plan
                    </button>
                </div>
            </form>
        </x-modal>

        <!-- Suggest Modal for this plan -->
        <x-modal name="suggest-workout-plan-{{ $plan->id }}" :show="$errors->any()" maxWidth="2xl" focusable>
            <form method="POST" class="p-8 rounded-lg" action="{{ route('workout_plans.suggest', $plan->id) }}">
                @csrf

                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Suggest Workout Plan</h2>

                <p class="mb-6 text-gray-700 dark:text-gray-300">Suggest "{{ $plan->title }}" to one of your members.</p>

                <div class="grid grid-cols-1 gap-8">
                    <!-- Member Selection -->
                    <div>
                        <label for="member_id-{{ $plan->id }}" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Select Member</label>
                        <select id="member_id-{{ $plan->id }}" name="member_id" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white" required>
                            <option value="">Choose a member...</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" @click="$dispatch('close-modal', 'suggest-workout-plan-{{ $plan->id }}')" class="bg-white/10 hover:bg-white/20 text-gray-900 dark:text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 border border-gray-300 dark:border-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white px-8 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-green-500/25">
                        Suggest Plan
                    </button>
                </div>
            </form>
        </x-modal>
    @empty
    @endforelse

    <x-modal name="create-workout-plan" :show="old('title') || $errors->any()" maxWidth="2xl" focusable>
        <form method="POST" action="{{ route('workout_plans.store') }}" class="p-8">
            @csrf

            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Create Workout Plan</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Workout Plan Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white" placeholder="e.g., Beginner Strength Training" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category/Goal -->
                <div>
                    <label for="category_goal" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Category/Goal</label>
                    <input type="text" id="category_goal" name="category_goal" value="{{ old('category_goal') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white" placeholder="Enter category or goal" required>
                    @error('category_goal')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Description (Optional)</label>
                    <textarea id="description" name="description" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white resize-none" placeholder="Describe the workout plan, exercises, goals, etc.">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex justify-end space-x-4">
                <button type="button" @click="$dispatch('close-modal', 'create-workout-plan')" class="bg-white/10 hover:bg-white/20 text-gray-900 dark:text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 border border-gray-300 dark:border-gray-600">
                    Cancel
                </button>
                <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-8 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-purple-500/25">
                    Create Workout Plan
                </button>
            </div>
        </form>
    </x-modal>



</x-trainor-layout>
