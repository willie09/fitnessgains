<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'FG') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    

        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.3); }
                50% { box-shadow: 0 0 40px rgba(34, 197, 94, 0.6); }
            }
            .float-animation { animation: float 3s ease-in-out infinite; }
            .pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
        </style>
    </head>
    <body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 min-h-screen flex flex-col overflow-x-hidden">
        <!-- nav bar section -->
        <nav class="bg-black/20 backdrop-blur-md border-b border-white/10 shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-6 flex items-center justify-between py-3 sm:py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg pulse-glow">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-xl sm:text-2xl font-bold text-white tracking-wide bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">
                        Fitness Gain$
                    </span>
                </div>

                <!-- Right Buttons -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <a href="{{ route('login') }}"
                       class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white font-semibold rounded-xl shadow-lg hover:from-emerald-600 hover:to-cyan-600 transition-all duration-300 transform hover:scale-105">
                        Get Started
                    </a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-6 py-16 grid lg:grid-cols-2 gap-16 items-center flex-grow">
            <!-- Left Content -->
            <div class="space-y-8">
                <div class="space-y-4">
                    <div class="inline-flex items-center px-4 py-2 bg-emerald-500/20 border border-emerald-400/30 rounded-full text-emerald-300 text-sm font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                        Premium Fitness Platform
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white leading-tight">
                        Transform Your
                        <span class="bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent">
                            Fitness Journey
                        </span>
                    </h1>
                    <p class="text-xl text-gray-300 leading-relaxed max-w-lg">
                        Track workouts, monitor progress, and achieve your fitness goals with our comprehensive platform designed for serious athletes and fitness enthusiasts.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="{{ route('login') }}"
                       class="px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white font-bold rounded-xl shadow-xl hover:from-emerald-600 hover:to-cyan-600 transition-all duration-300 transform hover:scale-105 text-center">
                        Start Your Journey
                    </a>
                    <a href="#features"
                       class="px-6 sm:px-8 py-3 sm:py-4 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/50 transition-all duration-300 text-center">
                        Explore Features
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 sm:grid-cols-3 gap-6 sm:gap-8 pt-6 sm:pt-8">
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-emerald-400">500+</div>
                        <div class="text-gray-400 text-sm">Active Members</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-cyan-400">50+</div>
                        <div class="text-gray-400 text-sm">Expert Trainers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-blue-400">24/7</div>
                        <div class="text-gray-400 text-sm">Support</div>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="relative">
                <div class="relative z-10 float-animation">
                    <img src="https://img.freepik.com/premium-vector/young-man-shows-off-muscles-he-has-been-working-fitness-room-healthy-active-lifestyle-flat-style-cartoon-illustration-vector_610956-762.jpg?w=740"
                         alt="Fitness Illustration"
                         class="rounded-2xl shadow-2xl mx-auto max-w-xs sm:max-w-md lg:max-w-lg opacity-95" />
                </div>


                <!-- Floating Elements -->
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-full opacity-20 animate-pulse"></div>
                <div class="absolute -bottom-6 -left-6 w-16 h-16 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-full opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 -right-8 w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full opacity-25 animate-pulse" style="animation-delay: 2s;"></div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="bg-gradient-to-b from-black/0 to-slate-900/80 py-24">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-5xl font-extrabold text-white mb-4">
                        Powerful Features for
                        <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">
                            Peak Performance
                        </span>
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Everything you need to transform your fitness journey with cutting-edge tools and expert guidance.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-8 hover:border-emerald-400/50 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 3a4 4 0 100-8 4 4 0 000 8zm10 0a4 4 0 100-8 4 4 0 000 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Smart Workout Tracking</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Advanced workout logging with real-time progress tracking, exercise recommendations, and performance analytics to optimize your training.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-8 hover:border-cyan-400/50 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Progress Analytics</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Comprehensive progress visualization with detailed charts, body measurements tracking, and AI-powered insights to accelerate your results.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-8 hover:border-blue-400/50 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Expert Community</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Connect with certified trainers and fellow fitness enthusiasts. Share achievements, get personalized advice, and stay motivated together.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Us Section -->
        <section id="contact" class="bg-gradient-to-b from-slate-900/80 to-black py-24">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-5xl font-extrabold text-white mb-4">
                        Get In
                        <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">
                            Touch
                        </span>
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Ready to start your fitness transformation? Reach out to our expert team and begin your journey today.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-8">
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                Visit Our Location
                            </h3>
                            <div class="space-y-4 text-gray-300">
                                <p class="text-lg leading-relaxed">
                                    <span class="font-semibold text-emerald-400">Address:</span><br>
                                    2nd Floor King Hardware<br>
                                    Ramon Magsaysay Highway<br>
                                    Sindangan, Philippines, 7112
                                </p>
                                <div class="pt-4">
                                    <h4 class="text-lg font-semibold text-white mb-3">Follow Us</h4>
                                    <a href="https://www.facebook.com/share/14KGmwx1gyx/"
                                       target="_blank"
                                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105">
                                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                        Facebook Page
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Stats -->
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 border border-emerald-400/30 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-emerald-400 mb-2">24/7</div>
                                <div class="text-gray-300 text-sm">Support Available</div>
                            </div>
                            <div class="bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-400/30 rounded-xl p-6 text-center">
                                <div class="text-3xl font-bold text-cyan-400 mb-2">Fast</div>
                                <div class="text-gray-300 text-sm">Response Time</div>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-8">
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                            </div>
                            Find Us Here
                        </h3>
                        <div class="rounded-xl overflow-hidden border border-slate-600/50">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3943.9279279279277!2d123.83330531533444!3d8.32691459214668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1sen!2sph!4v1690000000000!5m2!1sen!2sph"
                                width="100%"
                                height="300"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="rounded-xl">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-black/80 backdrop-blur-sm border-t border-slate-700/50 py-8 sm:py-12 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 mb-8">
                    <!-- Brand -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 sm:space-x-3">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="text-lg sm:text-xl font-bold text-white">Fitness Gain$</span>
                        </div>
                        <p class="text-gray-400 text-xs sm:text-sm leading-relaxed">
                            Your ultimate fitness companion for tracking workouts and achieving your goals.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-white font-semibold mb-3 sm:mb-4 text-sm sm:text-base">Quick Links</h4>
                        <ul class="space-y-1 sm:space-y-2 text-gray-400 text-xs sm:text-sm">
                            <li><a href="#features" class="hover:text-emerald-400 transition-colors">Features</a></li>
                            <li><a href="#contact" class="hover:text-emerald-400 transition-colors">Contact</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-emerald-400 transition-colors">Login</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div>
                        <h4 class="text-white font-semibold mb-3 sm:mb-4 text-sm sm:text-base">Services</h4>
                        <ul class="space-y-1 sm:space-y-2 text-gray-400 text-xs sm:text-sm">
                            <li>Workout Tracking</li>
                            <li>Progress Analytics</li>
                            <li>Expert Community</li>
                            <li>Personal Training</li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="text-white font-semibold mb-3 sm:mb-4 text-sm sm:text-base">Get In Touch</h4>
                        <div class="space-y-1 sm:space-y-2 text-gray-400 text-xs sm:text-sm">
                            <p>Sindangan, Philippines</p>
                            <p>24/7 Support Available</p>
                            <a href="https://www.facebook.com/share/14KGmwx1gyx/"
                               target="_blank"
                               class="inline-flex items-center text-emerald-400 hover:text-emerald-300 transition-colors text-xs sm:text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                Follow Us
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="border-t border-slate-700/50 pt-6 sm:pt-8 flex flex-col md:flex-row justify-between items-center text-xs sm:text-sm">
                    <p class="text-gray-400">
                        &copy; {{ date('Y') }} Fitness Gain$. All rights reserved.
                    </p>
                    <div class="flex space-x-4 sm:space-x-6 mt-3 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>
