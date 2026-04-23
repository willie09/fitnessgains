<x-trainor-layout>
<div class="py-2  px-6 sm:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <!-- Welcome Section -->
        <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold text-white mb-2">Welcome back, {{ $trainor->name }}!</h3>
            <p class="text-white/70">Here's an overview of your activities and assigned members.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
            <div class="glass-effect stats-card border border-white/20 rounded-2xl shadow-xl p-4 sm:p-6 flex items-center space-x-4">
                <div class="p-2 sm:p-3 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-xl sm:text-2xl font-bold text-white">{{ $assignedMembers->count() }}</h4>
                    <p class="text-white/70 text-xs sm:text-sm">Assigned Members</p>
                </div>
            </div>

            <div class="glass-effect stats-card border border-white/20 rounded-2xl shadow-xl p-4 sm:p-6 flex items-center space-x-4">
                <div class="p-2 sm:p-3 rounded-full bg-gradient-to-r from-green-500 to-emerald-500">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-xl sm:text-2xl font-bold text-white">{{ $assignedMembers->where('is_active', true)->count() }}</h4>
                    <p class="text-white/70 text-xs sm:text-sm">Active Members</p>
                </div>
            </div>

            <div class="glass-effect stats-card border border-white/20 rounded-2xl shadow-xl p-4 sm:p-6 flex items-center space-x-4">
                <div class="p-2 sm:p-3 rounded-full bg-gradient-to-r from-purple-500 to-pink-500">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-xl sm:text-2xl font-bold text-white">{{ $trainor->years_of_experience }}</h4>
                    <p class="text-white/70 text-xs sm:text-sm">Years Experience</p>
                </div>
            </div>
        </div>
        <!-- Messaging -->
        <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold text-white mb-4">Messaging</h3>
            <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-4">
                @foreach($assignedMembers as $member)
                    <div class="flex flex-col items-center space-y-2">
                        <button onclick="openChatHead({{ $member->user_id }}, '{{ $member->name }}')" class="relative group w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-110 flex items-center justify-center ring-2 ring-white/20 hover:ring-white/40">
                            <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <!-- Online indicator -->
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                        </button>
                        <p class="text-xs text-white/70 text-center truncate w-full">{{ $member->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Chatheads Container -->
        <div id="chatheads-container" class="fixed bottom-4 right-4 z-50 space-y-2"></div>
        <!-- Recent Activity -->
        <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold text-white mb-4">Recent Assigned Members</h3>
            @if($assignedMembers->isEmpty())
                <p class="text-white/70">No members assigned yet.</p>
            @else
                <div class="space-y-3">
                    @foreach($assignedMembers->take(5) as $member)
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-lg">
                            <div>
                                <p class="font-medium text-white">{{ $member->name }}</p>
                                <p class="text-sm text-white/70">{{ $member->email }}</p>
                            </div>

                        </div>
                    @endforeach
                </div>
                @if($assignedMembers->count() > 5)
                    <a href="{{ route('trainor.members') }}" class="inline-block mt-4 text-blue-400 hover:text-blue-300">View all members →</a>
                @endif
            @endif
        </div>

       
    </div>
    </div>
    </div>

    <script>
        let chatHeads = {};

        function openChatHead(memberId, memberName) {
            if (chatHeads[memberId]) {
                // If already open, focus it
                chatHeads[memberId].style.zIndex = getMaxZIndex() + 1;
                return;
            }

            const chatHead = document.createElement('div');
            chatHead.className = 'chat-head bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-2xl w-80 h-96 flex flex-col';
            chatHead.style.position = 'absolute';
            chatHead.style.bottom = '0';
            chatHead.style.right = `${Object.keys(chatHeads).length * 320}px`;
            chatHead.style.zIndex = getMaxZIndex() + 1;

            chatHead.innerHTML = `
                <div class="bg-gradient-to-r rounded-xl from-blue-500 to-indigo-500 p-4 flex items-center justify-between">
                    <h1 class="text-lg font-bold text-white">Messages with ${memberName}</h1>
                    <button onclick="closeChatHead(${memberId})" class="text-white/70 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="messages-${memberId}" class="flex-1 overflow-y-auto p-4 space-y-4 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900"></div>
                <form id="form-${memberId}" class="p-4 border-t border-white/20 flex space-x-4">
                    <input type="text" id="input-${memberId}" class="flex-1 glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" placeholder="Type your message...">
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300">Send</button>
                </form>
            `;

            document.getElementById('chatheads-container').appendChild(chatHead);
            chatHeads[memberId] = chatHead;

            // Load messages
            loadMessages(memberId);

            // Handle form submit
            document.getElementById(`form-${memberId}`).addEventListener('submit', function(e) {
                e.preventDefault();
                const input = document.getElementById(`input-${memberId}`);
                const message = input.value.trim();
                if (!message) return;
                sendMessage(memberId, message, input);
            });

            // Make draggable
            makeDraggable(chatHead);
        }

        function closeChatHead(memberId) {
            if (chatHeads[memberId]) {
                chatHeads[memberId].remove();
                delete chatHeads[memberId];
                // Reposition remaining chatheads
                let index = 0;
                for (const id in chatHeads) {
                    chatHeads[id].style.right = `${index * 320}px`;
                    index++;
                }
            }
        }

        function loadMessages(memberId) {
            fetch('/trainor/messages?with=' + memberId, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById(`messages-${memberId}`);
                container.innerHTML = '';
                data.messages.forEach(msg => {
                    addMessage(memberId, msg.sender_id == {{ Auth::id() }} ? 'me' : 'them', msg.message, msg.created_at);
                });
                container.scrollTop = container.scrollHeight;
            })
            .catch(error => {
                console.error('Error loading messages:', error);
            });
        }

        function sendMessage(memberId, message, input) {
            fetch('/trainor/messages', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ receiver_id: memberId, message })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    addMessage(memberId, 'me', message);
                    input.value = '';
                } else {
                    console.error('Message send failed:', data);
                    alert('Failed to send message: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                alert('Error sending message: ' + error.message);
            });
        }

        function addMessage(memberId, sender, text, time = null) {
            const messages = document.getElementById(`messages-${memberId}`);
            const msgDiv = document.createElement('div');
            msgDiv.className = sender === 'me' ? 'flex justify-end' : 'flex justify-start';
            const bubble = document.createElement('div');
            bubble.className = sender === 'me' ? 'max-w-xs lg:max-w-md px-4 py-2 rounded-lg bg-blue-500 text-white' : 'max-w-xs lg:max-w-md px-4 py-2 rounded-lg bg-gray-700 text-white';
            const messageP = document.createElement('p');
            messageP.textContent = text;
            bubble.appendChild(messageP);
            if (time) {
                const timeP = document.createElement('p');
                timeP.className = sender === 'me' ? 'text-xs mt-1 text-blue-100' : 'text-xs mt-1 text-gray-400';
                timeP.textContent = new Date(time).toLocaleString('en-US', {month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit', hour12: false}).replace(',', '');
                bubble.appendChild(timeP);
            }
            msgDiv.appendChild(bubble);
            messages.appendChild(msgDiv);
            messages.scrollTop = messages.scrollHeight;
        }

        function makeDraggable(element) {
            let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            const header = element.querySelector('div:first-child');
            header.onmousedown = dragMouseDown;

            function dragMouseDown(e) {
                e.preventDefault();
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                document.onmousemove = elementDrag;
                element.style.zIndex = getMaxZIndex() + 1;
            }

            function elementDrag(e) {
                e.preventDefault();
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                element.style.top = (element.offsetTop - pos2) + "px";
                element.style.left = (element.offsetLeft - pos1) + "px";
            }

            function closeDragElement() {
                document.onmouseup = null;
                document.onmousemove = null;
            }
        }

        function getMaxZIndex() {
            let maxZ = 0;
            const elements = document.querySelectorAll('*');
            elements.forEach(el => {
                const z = parseInt(window.getComputedStyle(el).zIndex) || 0;
                if (z > maxZ) maxZ = z;
            });
            return maxZ;
        }
    </script>
</x-trainor-layout>
