<x-trainor-layout>

   <div class="py-2  px-6 sm:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="p-2 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('workout_plans.index') }}" class="text-white hover:text-blue-400 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-white">{{ $workoutPlan->title }}</h1>
                </div>
                <div class="flex space-x-2">
                  
                </div>
            </div>

            <!-- Workout Plan Details -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden mt-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Category/Goal</h3>
                            <p class="text-white/80">{{ $workoutPlan->category_goal }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Created At</h3>
                            <p class="text-white/80">{{ $workoutPlan->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold text-white mb-2">Description</h3>
                            <p class="text-white/80">{{ $workoutPlan->description ?: 'No description provided.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exercises Section -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden mt-6">
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white">Exercises</h3>
                        @if($workoutPlan->trainor_id == Auth::user()->trainor->id)
                            <button
                                x-data
                                @click="$dispatch('open-modal', 'add-exercise')"
                                class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-purple-500/25"
                            >
                                Add Exercise
                            </button>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    @if($exercises->count() > 0)
                        <div class="space-y-4">
                            @foreach($exercises as $exercise)
                                <div class="glass-effect border border-white/20 rounded-xl p-4">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="text-lg font-semibold text-white">{{ $exercise->name }}</h4>
                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2 text-sm text-white/80">
                                                <div>
                                                    <span class="font-medium">Sets:</span> {{ $exercise->sets ?: 'N/A' }}
                                                </div>
                                                <div>
                                                    <span class="font-medium">Reps/Time:</span> {{ $exercise->reps_or_time ?: 'N/A' }}
                                                </div>
                                                <div>
                                                    <span class="font-medium">Rest:</span> {{ $exercise->rest_time ?: 'N/A' }}
                                                </div>
                                                <div>
                                                    <span class="font-medium">Day:</span> {{ $exercise->day ?: 'N/A' }}
                                                </div>
                                            </div>
                                            @if($exercise->instructions)
                                                <p class="text-white/70 mt-2">{{ $exercise->instructions }}</p>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            @if($workoutPlan->trainor_id == Auth::user()->trainor->id)
                                                <form method="POST" action="{{ route('workout_plans.delete_exercise', [$workoutPlan->id, $exercise->id]) }}" onsubmit="return confirm('Are you sure you want to delete this exercise?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg font-medium transition-all duration-300">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-white/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p class="text-white/70 text-lg font-medium">No exercises added yet</p>
                            <p class="text-white/50 text-sm">Add exercises to this workout plan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

  

    <!-- Add Exercise Modal -->
    <x-modal name="add-exercise" maxWidth="xl" focusable>
        <div class="p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Add New Exercise</h2>
            <form method="POST" action="{{ route('workout_plans.add_exercise', $workoutPlan->id) }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Exercise Name</label>
                        <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div>
                        <label for="sets" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Sets</label>
                        <input type="number" id="sets" name="sets" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="reps_or_time" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Reps or Time</label>
                        <input type="text" id="reps_or_time" name="reps_or_time" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="rest_time" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Rest Time</label>
                        <input type="text" id="rest_time" name="rest_time" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="day" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Day</label>
                        <input type="text" id="day" name="day" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="md:col-span-2">
                        <label for="instructions" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Instructions</label>
                        <textarea id="instructions" name="instructions" rows="3" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:outline-none bg-white dark:bg-gray-700 dark:text-white resize-none"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" @click="$dispatch('close-modal', 'add-exercise')" class="bg-white/10 hover:bg-white/20 text-gray-900 dark:text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 border border-gray-300 dark:border-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-8 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-purple-500/25">
                        Add Exercise
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

</x-trainor-layout>
