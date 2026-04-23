<x-mapp-layout>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.stagger-animation {
    animation: fadeInUp 0.6s ease-out forwards;
}
.glass-effect {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}
.btn-ripple {
    position: relative;
    overflow: hidden;
}
.btn-ripple::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}
.btn-ripple:hover::before {
    width: 300px;
    height: 300px;
}
@media (max-width: 768px) {
    .text-xl {
        font-size: 1.125rem;
    }
    .text-lg {
        font-size: 1rem;
    }
    .text-sm {
        font-size: 0.875rem;
    }
}
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-indigo-900 relative">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>

    <div class="relative z-10 container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="glass-effect rounded-2xl p-6 md:p-8 mb-8 relative overflow-hidden stagger-animation">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.2) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
            </div>
            <div class="relative z-10 text-center">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 md:w-12 md:h-12 text-white mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">Available Workout Plans</h1>
                </div>
                <p class="text-white/80 text-base md:text-lg leading-relaxed">View workout plans created by trainers available to all members</p>
            </div>
        </div>


        @if($workoutPlans->count() > 0)
            @php
                // Group workout plans by trainor_id
                $groupedPlans = $workoutPlans->groupBy('trainor_id');

                // Sort to put member's trainor first
                if ($memberTrainor) {
                    $memberTrainorId = $memberTrainor->id;
                    $groupedPlans = $groupedPlans->sortBy(function($plans, $trainorId) use ($memberTrainorId) {
                        return $trainorId == $memberTrainorId ? 0 : 1;
                    });
                }
            @endphp

            @foreach($groupedPlans as $trainorId => $plans)
                @php
                    $trainorName = $plans->first()->trainor->name ?? 'Unknown Trainor';
                    $header = ($memberTrainor && $trainorId == $memberTrainor->id) ? 'Suggested by Your Trainor' : 'Workout Plans';
                @endphp
                <!-- Section Header -->
                <div class="mb-8">
                    <div class="flex items-center mb-4 border-b border-white/20 pb-2">
                        @if($memberTrainor && $trainorId == $memberTrainor->id)
                            <svg class="w-8 h-8 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        @else
                            <svg class="w-8 h-8 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        @endif
                        <h2 class="text-xl font-bold text-white">
                            {{ $header }}
                        </h2>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        @foreach($plans as $index => $plan)
                        <div class="glass-effect rounded-xl p-6 hover:shadow-xl hover:shadow-purple-500/20 hover:scale-105 transition-all duration-500 stagger-animation" style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center mb-3">
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 @if($plan->category_goal == 'Beginner') bg-green-500/20 @elseif($plan->category_goal == 'Intermediate') bg-yellow-500/20 @else bg-red-500/20 @endif">
                                            @if($plan->category_goal == 'Beginner')
                                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                </svg>
                                            @elseif($plan->category_goal == 'Intermediate')
                                                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="text-lg md:text-xl font-semibold text-white mb-1">{{ $plan->title }}</h3>
                                            <span class="bg-{{ $plan->category_goal == 'Beginner' ? 'green' : ($plan->category_goal == 'Intermediate' ? 'yellow' : 'red') }}-500/20 text-{{ $plan->category_goal == 'Beginner' ? 'green' : ($plan->category_goal == 'Intermediate' ? 'yellow' : 'red') }}-400 px-3 py-1 rounded-full text-xs md:text-sm font-medium">
                                                {{ $plan->category_goal }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 mb-4 text-sm md:text-base leading-relaxed">{{ $plan->description }}</p>
                                </div>
                            </div>

                            <!-- View Button -->
                            <div class="mt-6">
                                <a href="{{ route('member.workout_plans.show', $plan->id) }}" class="btn-ripple inline-flex items-center px-6 py-3 text-sm md:text-base bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-blue-500/25 transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Full Details
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="glass-effect rounded-xl p-6 md:p-8 text-center max-w-md mx-auto stagger-animation">
                <div class="mb-6">
                    <svg class="w-12 h-12 md:w-16 md:h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h2 class="text-xl md:text-2xl font-semibold text-white mb-4">No Workout Plans Yet</h2>
                <p class="text-gray-300 mb-6 text-sm md:text-base leading-relaxed">Your trainer hasn't assigned any workout plans yet. Check back later or contact your trainer for personalized plans!</p>
                <div class="animate-pulse-slow">
                    <svg class="w-6 h-6 md:w-8 md:h-8 text-blue-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
            </div>
        @endif
    </div>
</div>
</x-mapp-layout>
