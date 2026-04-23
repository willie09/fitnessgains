<x-trainor-layout>
    <div class="py-12 px-4 sm:px-0">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 p-6">
                    <h1 class="text-2xl font-bold text-white">Messages with {{ $otherUser->name }}</h1>
                </div>
                <div class="p-6">
                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
                        @forelse($messages as $message)
                            <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->sender_id == auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                                    <p>{{ $message->message }}</p>
                                    <p class="text-xs mt-1 {{ $message->sender_id == auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">{{ $message->created_at->format('M d, H:i') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-white/70">No messages yet. Start the conversation!</p>
                        @endforelse
                    </div>
                    <form method="POST" action="{{ route('trainor.messages.store') }}" class="flex space-x-4">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
                        <input type="text" name="message" placeholder="Type your message..." class="flex-1 glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" required>
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-trainor-layout>
