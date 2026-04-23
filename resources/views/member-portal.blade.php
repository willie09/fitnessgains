
<x-mapp-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <!-- Background Effects -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-full opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full opacity-10 animate-pulse" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative z-10 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Welcome Section -->
                <div class="mb-8">
                    <div class="glass-effect border border-white/20 rounded-2xl p-8 shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-4xl font-extrabold text-white mb-2">
                                    Welcome back,
                                    <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">
                                        {{ Auth::user()->name }}!
                                    </span>
                                </h1>
                                <p class="text-gray-300 text-lg">
                                    Here's your membership overview and quick access to important features.
                                </p>
                            </div>
                            <div class="hidden md:flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                    <!-- Membership Status -->
                    <div class="group glass-effect border border-white/20 rounded-2xl p-4 sm:p-6 shadow-xl hover:border-emerald-400/50 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                    <h4 class="text-xl sm:text-2xl font-bold text-white mb-1">@if($isActive) Active @else Expired @endif</h4>
                                    <p class="text-white/70 text-xs sm:text-sm font-medium">Membership Status</p>
                                    <div class="w-full bg-white/10 rounded-full h-1 mt-2">
                                        <div class="bg-gradient-to-r from-emerald-500 to-cyan-500 h-1 rounded-full @if($isActive) w-full @else w-0 @endif"></div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!-- Days Remaining -->
                    <div class="group glass-effect border border-white/20 rounded-2xl p-4 sm:p-6 shadow-xl hover:border-blue-400/50 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl sm:text-2xl font-bold text-white mb-1">{{ $daysRemaining }}</h4>
                                <p class="text-white/70 text-xs sm:text-sm font-medium">Days Remaining</p>
                                <div class="w-full bg-white/10 rounded-full h-1 mt-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-1 rounded-full @if($daysRemaining > 0) w-3/4 @else w-0 @endif"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assigned Trainor -->
                    <div class="group glass-effect border border-white/20 rounded-2xl p-4 sm:p-6 shadow-xl hover:border-purple-400/50 transition-all duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg sm:text-xl font-bold text-white mb-1">
                                    @if($member->trainor)
                                        {{ $member->trainor->name }}
                                    @else
                                        No Trainor
                                    @endif
                                </h4>
                                <p class="text-white/70 text-xs sm:text-sm font-medium">Assigned Trainor</p>
                                <div class="w-full bg-white/10 rounded-full h-1 mt-2">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-1 rounded-full @if($member->trainor) w-full @else w-0 @endif"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Quick Actions Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                    <!-- Workout Plans -->
                    <div class="glass-effect border border-white/20 rounded-2xl p-8 shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-white">My Workout Plans</h3>
                            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @foreach($workoutPlans as $plan)
                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10">
                                <div>
                                    <h4 class="text-white font-semibold">{{ $plan->title }}</h4>
                                    <p class="text-gray-400 text-sm">{{ $plan->description }}</p>
                                </div>
                                <a href="{{ route('member.workout_plans.show', $plan->id) }}" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white rounded-lg hover:from-emerald-600 hover:to-cyan-600 transition-all duration-300 inline-block">
                                    View Plan
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="glass-effect border border-white/20 rounded-2xl p-8 shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-white">Recent Orders</h3>
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentOrders as $order)
                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10">
                                <div>
                                    <h4 class="text-white font-semibold">{{ $order->product->product_name }}</h4>
                                    <p class="text-gray-400 text-sm">Qty: {{ $order->quantity }} | P{{ number_format($order->total_amount, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs">{{ ucfirst($order->status) }}</span>
                                    <p class="text-gray-400 text-xs mt-1">{{ $order->order_date->format('M j') }}</p>
                                </div>
                            </div>
                            @empty
                            <p class="text-gray-400 text-sm">No recent orders.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
        </div>




            <script>
                let autoReplyInterval = null;
                let autoReplyActive = false;
                const AUTO_REPLY_DELAY = 30000; // 30 seconds

                function startAutoReply() {
                    if (autoReplyActive) return;
                    autoReplyActive = true;
                    autoReplyInterval = setInterval(() => {
                        if (document.getElementById('chat-window').classList.contains('hidden')) {
                            // Chat window is hidden, do not send auto message
                            return;
                        }
                        sendAutoMessage(AUTO_REPLY_PREDEFINED_MESSAGE);
                    }, AUTO_REPLY_DELAY);
                }

                function stopAutoReply() {
                    autoReplyActive = false;
                    if (autoReplyInterval) {
                        clearInterval(autoReplyInterval);
                        autoReplyInterval = null;
                    }
                }

                function sendAutoMessage(message) {
                    addMessage('user', message);
                    fetch('/chatbot/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ message })
                    })
                    .then(response => response.json())
                    .then(data => {
                        addMessage('bot', data.reply);
                    })
                    .catch(error => {
                        addMessage('bot', 'Sorry, I am unable to respond right now.');
                    });
                }

                document.getElementById('chat-toggle').addEventListener('click', function() {
                    document.getElementById('chat-window').classList.toggle('hidden');
                    if (!document.getElementById('chat-window').classList.contains('hidden')) {
                        startAutoReply();
                    } else {
                        stopAutoReply();
                    }
                });

                document.getElementById('chat-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const input = document.getElementById('chat-input');
                    const message = input.value.trim();
                    if (!message) return;
                    addMessage('user', message);
                    input.value = '';
                    stopAutoReply(); // Stop auto replies when user sends a message
                    fetch('/chatbot/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ message })
                    })
                    .then(response => response.json())
                    .then(data => {
                        addMessage('bot', data.reply);
                        startAutoReply(); // Resume auto replies after bot response
                    })
                    .catch(error => {
                        addMessage('bot', 'Sorry, I am unable to respond right now.');
                        startAutoReply(); // Resume auto replies even on error
                    });
                });

                function addMessage(sender, text) {
                    const messages = document.getElementById('chat-messages');
                    const msgDiv = document.createElement('div');
                    msgDiv.className = sender === 'user' ? 'text-right mb-2' : 'text-left mb-2';
                    const bubble = document.createElement('div');
                    bubble.className = sender === 'user' ? 'inline-block bg-gradient-to-r from-emerald-500 to-cyan-500 text-white px-3 py-2 rounded-lg break-words' : 'inline-block bg-white/10 text-white px-3 py-2 rounded-lg break-words';
                    bubble.textContent = text;
                    msgDiv.appendChild(bubble);
                    messages.appendChild(msgDiv);
                    messages.scrollTop = messages.scrollHeight;
                }


        </script>
    
    </div>
    <script>
        window.botpressWebChat = {
          botId: "fitnessgains",
          hostUrl: "https://cdn.botpress.cloud/webchat/v3.4",
          messagingUrl: "https://messaging.botpress.cloud",
          clientId: "YOUR_CLIENT_ID", // Optional
          clientSecret: "YOUR_CLIENT_SECRET", // Optional
          botName: "Fitness Coach",
          welcomeMsg: "Hello! How can I assist you with your fitness journey today?",
          bubble: true,
          showConversationsButton: true,
          enableTranscriptDownload: true,
          modals: {
            showCloseButton: true
          },
          theme: {
            brandColor: "#10B981",
            brandTextColor: "#FFFFFF",
            headerColor: "linear-gradient(to right, #10B981, #06B6D4)",
            bubbleBackground: "linear-gradient(to right, #10B981, #06B6D4)",
            bubbleTextColor: "#FFFFFF"
          },
          window: {
            defaultHeight: "600px",
            defaultWidth: "400px",
            maxHeight: "700px",
            maxWidth: "450px",
            borderRadius: "12px",
            boxShadow: "0 4px 14px 0 rgba(0, 0, 0, 0.3)"
          }
        }
    </script>
    <script src="https://cdn.botpress.cloud/webchat/v3.4/inject.js"></script>
    <script src="https://files.bpcontent.cloud/2025/11/22/14/20251122141901-NRXHT5L1.js" defer></script>
</x-mapp-layout>
