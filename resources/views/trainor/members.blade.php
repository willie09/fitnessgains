<x-trainor-layout>

   <div class="py-8 px-6 sm:px-0 min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 animate-gradient-x">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           

            <!-- Members List -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Assigned Members</h3>
                        </div>
                        <div class="flex items-center space-x-3 w-full sm:w-auto">
                            <div class="relative w-full sm:w-64">
                                <input type="text" id="searchInput" placeholder="Search members..." class="glass-effect border border-white/20 rounded-xl px-4 py-2 text-white placeholder-white/50 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 focus:outline-none w-full transition-all duration-300">
                                <svg class="w-5 h-5 text-white/50 absolute right-3 top-2.5 transition-colors duration-300 focus-within:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 sm:gap-6">
                    @forelse($members as $member)
                        <div class="member-card glass-effect border border-white/20 rounded-2xl p-4 sm:p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/20 hover:border-cyan-400/30 group animate-fade-in-up relative overflow-hidden group-hover:bg-gradient-to-br group-hover:from-cyan-500/5 group-hover:to-purple-500/5">

                            <!-- Avatar and Status Row -->
                            <div class="relative flex flex-col sm:flex-row sm:items-center justify-between mb-4 z-10 space-y-2 sm:space-y-0">
                                <div class="flex items-center space-x-2 sm:space-x-3">
                                    @if($member->profile_photo)
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-cyan-400 via-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-cyan-500/50 transition-all duration-300 group-hover:scale-110 overflow-hidden">
                                            <img src="{{ asset('storage/' . $member->profile_photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover rounded-xl">
                                        </div>
                                    @else
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-cyan-400 via-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-cyan-500/50 transition-all duration-300 group-hover:scale-110">
                                            <span class="text-base sm:text-lg font-bold text-white">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-base sm:text-lg font-semibold text-white group-hover:text-cyan-200 transition-colors duration-300">{{ $member->name }}</h4>
                                        <p class="text-white/70 text-xs sm:text-sm">{{ $member->email }}</p>
                                    </div>
                                </div>
                                @if($member->expiry_date && $member->expiry_date > now())
                                    <div class="flex items-center space-x-1 px-2 py-1 bg-green-500/20 text-green-300 border border-green-500/30 rounded-full text-xs font-medium">
                                        <div class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></div>
                                        <span>Active</span>
                                    </div>
                                @else
                                    <div class="flex items-center space-x-1 px-2 py-1 bg-red-500/20 text-red-300 border border-red-500/30 rounded-full text-xs font-medium">
                                        <div class="w-1.5 h-1.5 bg-red-400 rounded-full"></div>
                                        <span>Expired</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Info Section -->
                            <div class="space-y-3 mb-4 relative z-10">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-white/80 text-sm truncate">{{ $member->membership_type ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-purple-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="text-white/80 text-sm">{{ $member->phone ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <button type="button" class="w-full bg-gradient-to-r from-cyan-500/20 to-purple-500/20 hover:from-cyan-500/30 hover:to-purple-500/30 border border-white/10 hover:border-cyan-400/30 text-white rounded-xl py-2.5 px-4 transition-all duration-300 flex items-center justify-center space-x-2 hover:shadow-lg hover:shadow-cyan-500/20 text-sm font-medium relative z-10" onclick="showMemberDetails({{ $member->id }})">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span>View Details</span>
                            </button>

                            <!-- Subtle decorative corner -->
                            <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-bl from-cyan-400/5 to-transparent rounded-bl-2xl"></div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="flex flex-col items-center space-y-4">
                                <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-white/70 text-lg font-medium">No members assigned yet</p>
                                    <p class="text-white/50 text-sm">Members will appear here once assigned to you</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Member Details Modal -->
    <div id="memberDetailsModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-4 sm:top-20 mx-auto p-4 sm:p-6 w-full max-w-sm sm:max-w-md glass-effect border border-white/20 rounded-2xl shadow-2xl animate-slide-in">
            <div class="mt-3">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-white" id="memberDetailsModalLabel">Member Details</h3>
                    <button type="button" class="text-white/70 hover:text-white hover:shadow-lg hover:shadow-cyan-500/50 transition-all duration-200 rounded-full p-1" onclick="closeModal()">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mt-4 text-white" id="memberDetailsContent">
                    <!-- Details will be populated here -->
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" class="px-4 py-2 glass-effect border border-white/20 text-white rounded-xl hover:bg-white/10 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/40 w-full sm:w-auto" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Store member data for JavaScript access
        const membersData = @json($members);

        // Add staggered animation to member cards
        document.addEventListener('DOMContentLoaded', function() {
            const memberCards = document.querySelectorAll('.animate-fade-in-up');
            memberCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });

        function showMemberDetails(memberId) {
            const member = membersData.find(m => m.id === memberId);
            if (!member) return;

            const isActive = member.expiry_date && new Date(member.expiry_date) > new Date();
            const statusClass = isActive ? 'text-green-600' : 'text-red-600';
            const statusText = isActive ? 'Active' : 'Expired';

            const content = `
                <div class="space-y-2">
                    <p class="text-sm"><span class="font-medium">Name:</span> ${member.name}</p>
                    <p class="text-sm"><span class="font-medium">Email:</span> ${member.email}</p>
                    <p class="text-sm"><span class="font-medium">Phone:</span> ${member.phone || 'N/A'}</p>
                    <p class="text-sm"><span class="font-medium">Membership Plan:</span> ${member.membership_type || 'N/A'}</p>
                    <p class="text-sm"><span class="font-medium">Join Date:</span> ${member.join_date ? new Date(member.join_date).toLocaleDateString() : 'N/A'}</p>
                    <p class="text-sm"><span class="font-medium">Expiry Date:</span> ${member.expiry_date ? new Date(member.expiry_date).toLocaleDateString() : 'N/A'}</p>
                    <p class="text-sm"><span class="font-medium">Status:</span> <span class="${statusClass}">${statusText}</span></p>
                </div>
            `;

            document.getElementById('memberDetailsContent').innerHTML = content;
            document.getElementById('memberDetailsModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('memberDetailsModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('memberDetailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</x-trainor-layout>


