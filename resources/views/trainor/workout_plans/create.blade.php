<x-trainor-layout>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="glass-effect border border-white/20 rounded-2xl p-6 shadow-xl mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Create Workout Plan</h1>
                            <p class="text-white/70">Assign a new workout plan to one of your members</p>
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
                <form method="POST" action="{{ route('workout_plans.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-semibold text-white/80 mb-2">Workout Plan Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" placeholder="e.g., Beginner Strength Training" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category/Goal -->
                        <div>
                            <label for="category_goal" class="block text-sm font-semibold text-white/80 mb-2">Category/Goal</label>
                            <input type="text" id="category_goal" name="category_goal" value="{{ old('category_goal') }}" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" placeholder="Enter category or goal" required>
                            @error('category_goal')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-semibold text-white/80 mb-2">Description (Optional)</label>
                            <textarea id="description" name="description" rows="4" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 resize-none" placeholder="Describe the workout plan, exercises, goals, etc.">{{ old('description') }}</textarea>
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
                            Create Workout Plan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-trainor-layout>
