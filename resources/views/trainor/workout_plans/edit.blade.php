<x-trainor-layout>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="glass-effect border border-white/20 rounded-2xl p-6 shadow-xl mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Edit Workout Plan</h1>
                            <p class="text-white/70">Update the workout plan details</p>
                        </div>
                    </div>
                    <a href="{{ route('workout_plans.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 border border-white/20">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Plans
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-8">
                <form method="POST" action="{{ route('workout_plans.update', $workoutPlan->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Category/Goal -->
                        <div class="md:col-span-2">
                            <label for="category_goal" class="block text-sm font-semibold text-white/80 mb-2">Category/Goal</label>
                            <input type="text" id="category_goal" name="category_goal" value="{{ old('category_goal', $workoutPlan->category_goal) }}" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" placeholder="e.g., Weight Loss, Muscle Gain, General Fitness" required>
                            @error('category_goal')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-semibold text-white/80 mb-2">Workout Plan Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $workoutPlan->title) }}" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" placeholder="e.g., Beginner Strength Training" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-semibold text-white/80 mb-2">Difficulty Level</label>
                            <select id="type" name="type" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" required>
                                <option value="" class="bg-gray-800">Select difficulty...</option>
                                <option value="Beginner" class="bg-gray-800" {{ old('type', $workoutPlan->type) === 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" class="bg-gray-800" {{ old('type', $workoutPlan->type) === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" class="bg-gray-800" {{ old('type', $workoutPlan->type) === 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-semibold text-white/80 mb-2">Description (Optional)</label>
                            <textarea id="description" name="description" rows="4" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 resize-none" placeholder="Describe the workout plan, exercises, goals, etc.">{{ old('description', $workoutPlan->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('workout_plans.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 border border-white/20">
                            Cancel
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-8 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-purple-500/25">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Workout Plan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-trainor-layout>
