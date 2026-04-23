<x-mapp-layout>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-indigo-900">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('member.workout_plans.index') }}" class="text-white hover:text-blue-400 transition-all duration-300 transform hover:scale-105">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-4 py-2 rounded-xl shadow-lg">
                    <h1 class="text-3xl font-bold">{{ $workoutPlan->title }}</h1>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <p class="text-gray-300">Created by {{ $workoutPlan->trainor->name ?? 'Unknown Trainor' }}</p>
            </div>
        </div>

        <!-- Workout Plan Details -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Category/Goal</h3>
                        <p class="text-white/80">{{ $workoutPlan->category_goal }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Created At</h3>
                        <p class="text-white/80">{{ $workoutPlan->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="md:col-span-2" x-data="{ expanded: false }">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white mb-2">Description</h3>
                        <button @click="expanded = !expanded" class="text-blue-400 hover:text-blue-300 text-sm transition-colors" x-text="expanded ? 'Show Less' : 'Show More'"></button>
                    </div>
                    <p class="text-white/80" :class="{ 'line-clamp-3': !expanded }" x-show="!expanded">{{ $workoutPlan->description ?: 'No description provided.' }}</p>
                    <p class="text-white/80" x-show="expanded" x-transition>{{ $workoutPlan->description ?: 'No description provided.' }}</p>
                </div>
            </div>
        </div>

        <!-- Weekly Schedule Section -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 mb-8">
            <div class="mb-4">
                <h3 class="text-xl font-bold text-white">Weekly Schedule</h3>
            </div>
            @php
                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                $currentDay = now()->format('l');
                $workoutDays = collect();
                foreach ($workoutPlan->exercises as $exercise) {
                    $workoutDays->push(ucfirst(strtolower($exercise->day)));
                }
                $workoutDays = $workoutDays->unique()->toArray();
            @endphp
            <!-- Desktop Grid -->
            <div class="hidden md:grid grid-cols-7 gap-3">
                @foreach($days as $index => $day)
                <div class="bg-white/5 rounded-xl p-3 text-center flex flex-col justify-center items-center transition-all duration-300 hover:scale-105 {{ $currentDay === $day ? 'ring-2 ring-blue-400 shadow-lg shadow-blue-500/25 bg-blue-500/10' : '' }} {{ in_array($day, $workoutDays) ? 'bg-green-500/20 border border-green-400/50' : 'bg-gray-500/20 border border-gray-400/30' }}">
                    <div class="text-white font-semibold text-sm mb-2">{{ substr($day, 0, 3) }}</div>
                    <div class="text-3xl mb-2">
                        @if(in_array($day, $workoutDays))
                            <span class="text-green-400">🏋️‍♂️</span>
                        @else
                            <span class="text-gray-500">💤</span>
                        @endif
                    </div>
                    @if($currentDay === $day)
                    <div class="text-xs text-blue-400 font-medium bg-blue-500/20 rounded-full px-2 py-1">Today</div>
                    @endif
                </div>
                @endforeach
            </div>
            <!-- Mobile Horizontal Scroll -->
            <div class="md:hidden overflow-x-auto scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                <div class="flex space-x-3 pb-2" style="width: max-content;">
                    @foreach($days as $index => $day)
                    <div class="bg-white/5 rounded-xl p-3 text-center flex flex-col justify-center items-center min-w-[80px] transition-all duration-300 {{ $currentDay === $day ? 'ring-2 ring-blue-400 shadow-lg shadow-blue-500/25 bg-blue-500/10' : '' }} {{ in_array($day, $workoutDays) ? 'bg-green-500/20 border border-green-400/50' : 'bg-gray-500/20 border border-gray-400/30' }}">
                        <div class="text-white font-semibold text-xs mb-1">{{ substr($day, 0, 3) }}</div>
                        <div class="text-2xl mb-1">
                            @if(in_array($day, $workoutDays))
                                <span class="text-green-400">🏋️‍♂️</span>
                            @else
                                <span class="text-gray-500">💤</span>
                            @endif
                        </div>
                        @if($currentDay === $day)
                        <div class="text-xs text-blue-400 font-medium bg-blue-500/20 rounded-full px-1 py-0.5">Today</div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Schedule Legend -->
            <div class="mt-6 flex flex-wrap gap-4 text-sm text-gray-300 justify-center">
                <div class="flex items-center space-x-2">
                    <span class="text-green-400 text-lg">🏋️‍♂️</span>
                    <span>Workout Day</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-500 text-lg">💤</span>
                    <span>Rest Day</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-blue-400 text-lg">🔵</span>
                    <span>Today</span>
                </div>
            </div>
        </div>

        <!-- Exercises Section -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-white">Exercises by Day</h3>
            </div>
            <div class="space-y-6">
                @php
                    $exercisesByDay = collect();
                    foreach ($workoutPlan->exercises as $exercise) {
                        $day = ucfirst(strtolower($exercise->day));
                        $exercisesByDay->push(['day' => $day, 'exercise' => $exercise]);
                    }
                    $exercisesByDay = $exercisesByDay->groupBy('day');
                    $sortedDays = $exercisesByDay->keys()->sortBy(function($day) use ($days) {
                        return array_search($day, $days);
                    });
                @endphp
                @if($workoutPlan->exercises->count() > 0)
                    @foreach($sortedDays as $day)
                        <div class="bg-black/20 rounded-xl p-4" x-data="{ open: {{ $currentDay === $day ? 'true' : 'false' }} }">
                            <div class="flex items-center justify-between cursor-pointer" @click="open = !open">
                                <h4 class="text-lg font-semibold text-white flex items-center space-x-2">
                                    <span class="text-green-400">🏋️‍♂️</span>
                                    <span>{{ $day }}</span>
                                    @if($currentDay === $day)
                                        <span class="text-xs bg-blue-500/20 text-blue-400 px-2 py-1 rounded">Today</span>
                                    @endif
                                </h4>
                                <svg class="w-5 h-5 text-white/70 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <div x-show="open" x-transition class="mt-4 space-y-3">
                                @foreach($exercisesByDay[$day] as $item)
                                    <div class="bg-white/5 rounded-lg p-4 border border-white/10 hover:bg-white/10 transition-colors">
                                        <div class="flex items-start space-x-3">
                                            <span class="text-2xl">💪</span>
                                            <div class="flex-1">
                                                <h5 class="text-md font-medium text-white">{{ $item['exercise']->name }}</h5>
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3 text-sm text-white/80">
                                                    <div class="flex items-center space-x-2">
                                                        <span class="text-blue-400">🔢</span>
                                                        <span><strong>Sets:</strong> {{ $item['exercise']->sets ?: 'N/A' }}</span>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <span class="text-purple-400">⏱️</span>
                                                        <span><strong>Reps/Time:</strong> {{ $item['exercise']->reps_or_time ?: 'N/A' }}</span>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <span class="text-green-400">⏳</span>
                                                        <span><strong>Rest:</strong> {{ $item['exercise']->rest_time ?: 'N/A' }}</span>
                                                    </div>
                                                </div>
                                                @if($item['exercise']->instructions)
                                                    <div class="mt-3 p-3 bg-black/20 rounded-lg">
                                                        <p class="text-white/70 text-sm"><strong>Instructions:</strong> {{ $item['exercise']->instructions }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-white/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-white/70 text-lg font-medium">No exercises added yet</p>
                        <p class="text-white/50 text-sm">This workout plan doesn't have any exercises yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Motivational Footer -->
        <div class="mt-8 text-center">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-4 rounded-xl shadow-lg">
                <p class="text-lg font-semibold">Stay Motivated! 💪</p>
                <p class="text-sm opacity-90">Consistency is key to achieving your fitness goals.</p>
            </div>
        </div>
    </div>
</div>
</x-mapp-layout>
