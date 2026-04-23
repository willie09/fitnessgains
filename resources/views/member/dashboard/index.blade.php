<x-mapp-layout>
    <div class="py-12 px-4 sm:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6 mb-6">
                <h1 class="text-2xl font-bold text-white">Dashboard</h1>
                <p class="text-white/70 mt-2">Welcome to your member dashboard.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Quick Links -->
                <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Quick Links</h3>
                    <div class="space-y-3">
                        <a href="{{ route('member.profile') }}" class="block p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-white">Profile</span>
                            </div>
                        </a>
                        <a href="{{ route('member.workout_plans.index') }}" class="block p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-white">Workout Plans</span>
                            </div>
                        </a>
                        <a href="{{ route('member.attendance') }}" class="block p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-white">Attendance</span>
                            </div>
                        </a>
                        <a href="{{ route('member.products') }}" class="block p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span class="text-white">Products</span>
                            </div>
                        </a>
                        <a href="{{ route('member.messages') }}" class="block p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span class="text-white">Messages</span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Activity or Stats -->
                <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6 md:col-span-2 lg:col-span-1">
                    <h3 class="text-lg font-bold text-white mb-4">Recent Activity</h3>
                    <ul class="space-y-2 text-white/70">
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Profile updated</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Attendance marked</span>
                        </li>
                        <!-- Add more as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-mapp-layout>
