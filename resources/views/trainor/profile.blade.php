<x-trainor-layout>

    <div class="py-12  px-6 sm:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Card -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl overflow-hidden max-w-4xl mx-auto">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <!-- Profile Image -->
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full flex items-center justify-center shadow-lg overflow-hidden">
                            @if($trainor->profile_image && file_exists(public_path('storage/' . $trainor->profile_image)))
                                <img src="{{ asset('storage/' . $trainor->profile_image) }}" alt="{{ $trainor->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-white/20 flex items-center justify-center">
                                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Name and Edit Button -->
                        <div class="flex-1 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0 w-full">
                            <h1 class="text-2xl sm:text-3xl font-bold text-white text-center sm:text-left">{{ $trainor->name }}</h1>
                            <button onclick="openEditModal()" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 sm:px-6 sm:py-3 rounded-xl font-medium transition-all duration-300 border border-white/30 self-center sm:self-auto">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                        <!-- Basic Information -->
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4 sm:p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Basic Information</h3>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/70 text-sm">Name</p>
                                        <p class="text-white font-semibold ml-4">{{ $trainor->name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/70 text-sm">Specialization</p>
                                        <p class="text-white font-semibold ml-4">{{ $trainor->specialization ?? 'Fitness Trainer' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/70 text-sm">Email</p>
                                        <p class="text-white font-semibold ml-4">{{ Str::limit($trainor->email, 12) }}</p>
                                    </div>
                                </div>

                                @if($trainor->phone)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Phone</p>
                                            <p class="text-white font-semibold ml-4">{{ $trainor->phone }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Experience & Stats -->
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4 sm:p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Experience & Stats</h3>
                            <div class="space-y-4">
                                @if($trainor->years_of_experience)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/70 text-sm">Years of Experience</p>
                                            <p class="text-white font-semibold ml-4">{{ $trainor->years_of_experience }} years</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/70 text-sm">Active Members</p>
                                        <p class="text-white font-semibold ml-4">{{ $trainor->members->count() }} members</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4 sm:p-6">
                            <h3 class="text-xl font-bold text-white mb-4">About</h3>
                            @if($trainor->bio)
                                <p class="text-white/80 leading-relaxed">{{ $trainor->bio }}</p>
                            @else
                                <p class="text-white/60 italic">No bio available. Click "Edit Profile" to add your bio.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Modal -->
            <div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="glass-effect border border-white/20 rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                        <div class="p-4 sm:p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-bold text-white">Edit Profile</h3>
                                <button onclick="closeEditModal()" class="text-white/70 hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <form method="POST" action="{{ route('trainor.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                @method('PATCH')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-white/80 mb-2">Phone</label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $trainor->phone) }}" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                                    </div>

                                    <div>
                                        <label for="specialization" class="block text-sm font-medium text-white/80 mb-2">Specialization</label>
                                        <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $trainor->specialization) }}" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                                    </div>

                                    <div>
                                        <label for="years_of_experience" class="block text-sm font-medium text-white/80 mb-2">Years of Experience</label>
                                        <input type="number" name="years_of_experience" id="years_of_experience" value="{{ old('years_of_experience', $trainor->years_of_experience) }}" min="0" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                                    </div>
                                </div>

                                <div>
                                    <label for="bio" class="block text-sm font-medium text-white/80 mb-2">Bio</label>
                                    <textarea name="bio" id="bio" rows="4" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 resize-none">{{ old('bio', $trainor->bio) }}</textarea>
                                </div>

                                <div>
                                    <label for="profile_image" class="block text-sm font-medium text-white/80 mb-2">Profile Photo</label>
                                    <input type="file" name="profile_image" id="profile_image" accept="image/*" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-500 file:text-white hover:file:bg-purple-600">
                                </div>

                                <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                                    <button type="button" onclick="closeEditModal()" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 border border-white/20 w-full sm:w-auto">
                                        Cancel
                                    </button>
                                    <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-8 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-purple-500/25 w-full sm:w-auto">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</x-trainor-layout>
