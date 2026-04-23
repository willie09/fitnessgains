<!-- Navigation -->
<nav x-data="{ open: false }" class="sticky top-0 z-50 glass-effect border-b border-white/20 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('member-portal') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-purple-500/25 transition-all duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">Member Portal</span>
                    </a>
                </div>

                
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="flex space-x-2">
                    <a href="{{ route('member-portal') }}" class="flex items-center space-x-2 px-4 py-2 my-4 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('member-portal') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                    <a href="{{ route('member.workout_plans.index') }}" class="flex items-center space-x-2 px-4 py-2 my-4 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('member.workout_plans.*') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>{{ __('Workout Plans') }}</span>
                    </a>
                    <a href="{{ route('member.attendance') }}" class="flex items-center space-x-2 px-4 py-2 my-4 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('member.attendance') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>{{ __('Attendance') }}</span>
                    </a>
                    <a href="{{ route('member.progress.index') }}" class="flex items-center space-x-2 px-4 py-2 my-4 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('member.progress.index') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>{{ __('Progress') }}</span>
                    </a>
                    <a href="{{ route('member.products') }}" class="flex items-center space-x-2 px-4 py-2 my-4 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('member.products') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>{{ __('Products') }}</span>
                    </a>
                    <a href="{{ route('member.profile') }}" class="flex items-center space-x-2 px-4 py-2 my-4 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('member.profile') ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>{{ __('Profile') }}</span>
                    </a>
                </div>

                <!-- Settings Dropdown -->
                <div class="ml-6 relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-3 text-white/80 hover:text-white transition-colors duration-300">
                        @if(Auth::user()->member && Auth::user()->member->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->member->profile_photo) }}" alt="Profile Photo" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                                <span class="text-sm font-semibold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-3 w-48 bg-white/10 backdrop-blur-md rounded-xl shadow-xl border border-white/20 py-1 z-50">
                        <hr class="border-white/20 my-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center space-x-3 w-full px-4 py-3 text-sm text-white/80 hover:text-white hover:bg-white/10 transition-colors duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button 
                    @click="open = ! open" 
                    aria-label="Toggle navigation menu" 
                    :aria-expanded="open.toString()" 
                    class="inline-flex items-center justify-center p-3 rounded-md text-white bg-white/10 hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-300"
                    >
                    <svg class="h-6 w-6 transition-transform duration-300" stroke="currentColor" fill="none" viewBox="0 0 24 24" :class="{'rotate-90': open}">
                        <path :class="{'opacity-0': open, 'opacity-100': ! open }" class="opacity-100 transition-opacity duration-300" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'opacity-100': open, 'opacity-0': ! open }" class="opacity-0 transition-opacity duration-300" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Side Navigation for Mobile -->
    <div 
        role="dialog" 
        aria-modal="true" 
        :aria-hidden="(!open).toString()" 
        :class="{'translate-x-0': open, '-translate-x-full': ! open}" 
        class="fixed inset-y-0 left-0 z-50 w-64  transform transition-transform duration-300 ease-in-out sm:hidden shadow-lg rounded-r-lg">
        <!-- Close Button -->
     

        <!-- Navigation Links -->
        <div class="flex-1 px-6 py-4 space-y-3 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
            <a href="{{ route('member-portal') }}"
               @click="open = false"
               class="block px-4 py-3 bg-gray-400 rounded-lg text-base font-semibold text-white hover:bg-white/25 transition-all duration-300 shadow-sm shadow-black/50">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                    </svg>
                    <span>Dashboard</span>
                </div>
            </a>

            <a href="{{ route('member.workout_plans.index') }}"
               @click="open = false"
               class="block px-4 py-3 bg-gray-400 rounded-lg text-base font-semibold text-white hover:bg-white/25 transition-all duration-300 shadow-sm shadow-black/50">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span>Workout Plans</span>
                </div>
            </a>

            <a href="{{ route('member.products') }}"
               @click="open = false"
               class="block px-4 py-3 bg-gray-400 rounded-lg text-base font-semibold text-white hover:bg-white/25 transition-all duration-300 shadow-sm shadow-black/50">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>Products</span>
                </div>
            </a>

            <a href="{{ route('member.progress.index') }}"
               @click="open = false"
               class="block px-4 py-3 bg-gray-400 rounded-lg text-base font-semibold text-white hover:bg-white/25 transition-all duration-300 shadow-sm shadow-black/50">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span>My Progress</span>
                </div>
            </a>

            <a href="{{ route('member.profile') }}"
               @click="open = false"
               class="block px-4 py-3 bg-gray-400 rounded-lg text-base font-semibold text-white hover:bg-white/25 transition-all duration-300 shadow-sm shadow-black/50">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Profile</span>
                </div>
            </a>
        

    <!-- User Info and Logout -->
    

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 text-left text-base bg-gray-400 font-semibold text-white hover:bg-white/25 rounded-lg transition-all duration-300 shadow-sm shadow-black/50">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                {{ __('Log Out') }}
            </button>
        </form>
        </div>
    
</div>
    <!-- Backdrop Overlay -->
    <div :class="{'opacity-100': open, 'opacity-50 pointer-events-none': ! open}" @click="open = false" class="fixed inset-0 z-40 bg-black/60 backdrop-blur-md transition-opacity duration-300 sm:hidden"></div>
</nav>
