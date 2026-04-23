        <x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-start items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex-grow">
                {{ __('Trainors') }}
            </h2>
            <button onclick="openAddTrainorModal()" class="bg-gray-300 hover:bg-gray-100 text-black px-4 py-2 rounded-md text-sm font-medium w-full sm:w-auto flex-shrink-0">
                Add Trainor
            </button>
            <div class="relative w-full sm:w-48">
                <input type="text" id="searchTrainor" placeholder="Search Trainors..."
                       class="w-full px-4 py-1.5 pr-10 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       oninput="filterTrainors()">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    
                
                    <!-- Trainors Profile Cards Grid -->
                    <div class="mt-2 ">
                        <div class="grid grid-cols-2 lg:grid-cols-5 gap-6">
                            @forelse($trainors as $trainor)
                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                    <div class="p-4 sm:p-6">
                                        <!-- Profile Image -->
                                        <div class="flex justify-center mb-4">
                                            @if($trainor->profile_image && file_exists(public_path('storage/' . $trainor->profile_image)))
                                                <img src="{{ asset('storage/' . $trainor->profile_image) }}" alt="{{ $trainor->name }}" class="w-16 h-16 sm:w-24 sm:h-24 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                                            @else
                                                <div class="w-16 h-16 sm:w-24 sm:h-24 rounded-full bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center text-white text-xl sm:text-2xl font-bold">
                                                    {{ strtoupper(substr($trainor->name, 0, 2)) }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Trainor Info -->
                                        <div class="text-center">
                                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $trainor->name }}</h3>
                                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $trainor->email }}</p>


                                            @if($trainor->phone)
                                                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $trainor->phone }}</p>
                                            @endif

                                            <!-- Password Display -->
                                            <div class="mb-4">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Password:</p>
                                                <div class="flex items-center justify-center">
                                                    <span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                        {{ $trainor->random_password ?? 'N/A' }}
                                                    </span>
                                                    <button
                                                        onclick="navigator.clipboard.writeText('{{ $trainor->random_password ?? 'N/A' }}')"
                                                        class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                                        title="Copy password"
                                                    >
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Members Mentored -->
                                            <div class="mb-4">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Members Mentored:</p>
                                                <div class="flex items-center">

                                                        <button onclick="openMembersModal({{ $trainor->id }})" class="text-xs text-blue-500 mx-auto hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                                            {{ $trainor->members_count }}
                                                            @if($trainor->members_count > 0) View
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>




                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex justify-center space-x-1 sm:space-x-2 pt-4 px-2 border-t border-gray-200 dark:border-gray-700">
                                            <button onclick="openViewTrainorModal({{ $trainor }})" class="text-xs sm:text-sm text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 font-medium">
                                                View
                                            </button>
                                            <button onclick="openEditTrainorModal({{ $trainor }})" class="text-xs sm:text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                                                Edit
                                            </button>
                                            <form action="{{ route('trainors.destroy', $trainor) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs sm:text-sm text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-medium" onclick="return confirm('Are you sure you want to delete this trainor?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full">
                                    <div class="text-center py-12">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-9.5M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No trainors found</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add your first trainor to get started.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Add Trainor Modal -->
                    <div id="addTrainorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
                            <div class="mt-3">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Add New Trainor</h3>
                                    <button onclick="closeAddTrainorModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-300">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <form id="addTrainorForm" method="POST" enctype="multipart/form-data" action="{{ route('trainors.store') }}" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('phone')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                                        <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('date_of_birth')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="age" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Age</label>
                                        <input type="number" name="age" id="age" value="{{ old('age') }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('age')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                        <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('address') }}</textarea>
                                        @error('address')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="profile_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Photo</label>
                                        <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                                        @error('profile_photo')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" onclick="closeAddTrainorModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                            Add Trainor
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
        // Store current trainor ID for members modal
        let currentTrainorId = null;

        function filterTrainors() {
            const searchInput = document.getElementById('searchTrainor').value.toLowerCase();
            const trainorCards = document.querySelectorAll('.grid > div');

            trainorCards.forEach(card => {
                const name = card.querySelector('h3').textContent.toLowerCase();
                if (name.includes(searchInput)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function openAddTrainorModal() {
            document.getElementById('addTrainorModal').classList.remove('hidden');
        }

        function closeAddTrainorModal() {
            document.getElementById('addTrainorModal').classList.add('hidden');
            document.getElementById('addTrainorForm').reset();
        }

        // Edit modal functions
        function openEditTrainorModal(trainor) {
            document.getElementById('editTrainorModal').classList.remove('hidden');
            document.getElementById('editTrainorForm').action = `/trainors/${trainor.id}`;
            document.getElementById('edit_name').value = trainor.name;
            document.getElementById('edit_email').value = trainor.email;
            document.getElementById('edit_phone').value = trainor.phone || '';
            document.getElementById('edit_gender').value = trainor.gender || '';
            document.getElementById('edit_date_of_birth').value = trainor.date_of_birth || '';
            document.getElementById('edit_age').value = trainor.age || '';
            document.getElementById('edit_address').value = trainor.address || '';
            document.getElementById('edit_specialization').value = trainor.specialization || '';
            document.getElementById('edit_years_of_experience').value = trainor.years_of_experience || 0;
            document.getElementById('edit_bio').value = trainor.bio || '';
        }

        function closeEditTrainorModal() {
            document.getElementById('editTrainorModal').classList.add('hidden');
            document.getElementById('editTrainorForm').reset();
        }

        // View modal functions
        function openViewTrainorModal(trainor) {
            document.getElementById('viewTrainorModal').classList.remove('hidden');
            document.getElementById('view_name').textContent = trainor.name || 'N/A';
            document.getElementById('view_email').textContent = trainor.email || 'N/A';
            document.getElementById('view_phone').textContent = trainor.phone || 'N/A';
            document.getElementById('view_gender').textContent = trainor.gender ? trainor.gender.charAt(0).toUpperCase() + trainor.gender.slice(1) : 'N/A';
            document.getElementById('view_date_of_birth').textContent = trainor.date_of_birth || 'N/A';
            document.getElementById('view_age').textContent = trainor.age || 'N/A';
            document.getElementById('view_address').textContent = trainor.address || 'N/A';
            document.getElementById('view_specialization').textContent = trainor.specialization || 'N/A';
            document.getElementById('view_years_of_experience').textContent = trainor.years_of_experience || 'N/A';
            document.getElementById('view_bio').textContent = trainor.bio || 'N/A';
            document.getElementById('view_created_at').textContent = trainor.created_at ? new Date(trainor.created_at).toLocaleDateString() : 'N/A';
        }

        function closeViewTrainorModal() {
            document.getElementById('viewTrainorModal').classList.add('hidden');
        }

        // Members modal functions
        function openMembersModal(trainorId) {
            currentTrainorId = trainorId;
            document.getElementById('membersModal').classList.remove('hidden');
            fetchMembers(trainorId);
        }

        function closeMembersModal() {
            document.getElementById('membersModal').classList.add('hidden');
            // Clear the members list
            document.getElementById('membersList').innerHTML = '';
        }

        function fetchMembers(trainorId) {
            // Show loading state
            document.getElementById('membersList').innerHTML = '<p class="text-center py-4">Loading...</p>';
            
            // Fetch members from the API
            fetch(`/trainors/${trainorId}/members`)
                .then(response => response.json())
                .then(members => {
                    displayMembers(members);
                })
                .catch(error => {
                    console.error('Error fetching members:', error);
                    document.getElementById('membersList').innerHTML = '<p class="text-center py-4 text-red-500">Error loading members</p>';
                });
        }

        function displayMembers(members) {
            const membersList = document.getElementById('membersList');
            
            if (members.length === 0) {
                membersList.innerHTML = '<p class="text-center py-4">No members found</p>';
                return;
            }
            
            let membersHtml = '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
            members.forEach(member => {
                membersHtml += `
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 dark:text-gray-100">${member.name}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">${member.email}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Membership: ${member.membership_type || 'N/A'}</p>
                    </div>
                `;
            });
            membersHtml += '</div>';
            
            membersList.innerHTML = membersHtml;
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const addModal = document.getElementById('addTrainorModal');
            const editModal = document.getElementById('editTrainorModal');
            const viewModal = document.getElementById('viewTrainorModal');
            const membersModal = document.getElementById('membersModal');
            if (event.target === addModal) {
                closeAddTrainorModal();
            }
            if (event.target === editModal) {
                closeEditTrainorModal();
            }
            if (event.target === viewModal) {
                closeViewTrainorModal();
            }
            if (event.target === membersModal) {
                closeMembersModal();
            }
        }

        // Auto-close add modal after successful submission
        @if(session('success'))
            closeAddTrainorModal();
            closeEditTrainorModal();
        @endif
    </script>

    <!-- Edit Trainor Modal -->
    <div id="editTrainorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Edit Trainor</h3>
                    <button onclick="closeEditTrainorModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="editTrainorForm" method="POST" action="" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="edit_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" name="name" id="edit_name" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="edit_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="edit_email" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="edit_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                        <input type="tel" name="phone" id="edit_phone" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="edit_gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                        <select name="gender" id="edit_gender" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="edit_date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="edit_date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="edit_age" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Age</label>
                        <input type="number" name="age" id="edit_age" min="0" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="edit_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <textarea name="address" id="edit_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeEditTrainorModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Update Trainor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Members Modal -->
    <div id="membersModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Members Mentored</h3>
                    <button onclick="closeMembersModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div id="membersList" class="mt-4">
                    <!-- Members will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- View Trainor Modal -->
    <div id="viewTrainorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">View Trainor Details</h3>
                    <button onclick="closeViewTrainorModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                            <p id="view_name" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <p id="view_email" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <p id="view_phone" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                            <p id="view_gender" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                            <p id="view_date_of_birth" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Age</label>
                            <p id="view_age" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <p id="view_address" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Specialization</label>
                            <p id="view_specialization" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Years of Experience</label>
                            <p id="view_years_of_experience" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                            <p id="view_bio" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                            <p id="view_created_at" class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 p-2 rounded"></p>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button onclick="closeViewTrainorModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
