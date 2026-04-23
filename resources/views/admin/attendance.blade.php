<x-app-layout>
  

   <div class="relative z-10 rounded-xl py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 dark:bg-green-900 dark:border-green-600 dark:text-green-300 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 dark:bg-red-900 dark:border-red-600 dark:text-red-300 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

<!-- Mark Attendance Form -->
<div class="bg-white dark:bg-gray-800 shadow overflow-hidden mb-4 sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-600">
        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Mark Attendance</h3>
    </div>
    <div class="px-4 py-5 sm:p-6">

<div class="flex justify-center mb-6">
    <div id="member-photo-container" class="w-32 h-32 rounded-full overflow-hidden border-4 border-indigo-600 shadow-lg bg-gray-100 dark:bg-gray-800 hidden">
        <img id="member-profile-photo" src="" alt="Member Profile Photo" class="w-full h-full object-cover" />
    </div>
<div id="member-photo-placeholder" class="flex items-center justify-center w-32 h-32 rounded-full border-4 border-gray-300 dark:border-gray-700 shadow-lg bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.89 0 5.55 1.006 7.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0zM19.071 4.929a10 10 0 11-14.142 0 10 10 0 0114.142 0z" />
    </svg>
</div>
</div>

        <form method="POST" action="{{ route('admin.store.attendance') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="member_search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search Member</label>
                    <input type="text" id="member_search" name="member_search" placeholder="Type to search members..." required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" value="{{ old('member_search', old('member_id') ? \App\Models\Member::find(old('member_id'))->name . ' (' . \App\Models\Member::find(old('member_id'))->email . ')' : '') }}">
                    <input type="hidden" id="member_id" name="member_id" value="{{ old('member_id') }}">
                    <div id="member-dropdown" class="relative">
                        <div id="member-options" class="absolute z-10 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-lg max-h-60 overflow-y-auto hidden">
                            @foreach($members as $member)
                                <div class="member-option px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer" data-id="{{ $member->id }}" data-trainor="{{ $member->trainor_id ?? '' }}" data-photo-url="{{ $member->profile_photo ? asset('storage/' . $member->profile_photo) : '' }}">
                                    {{ $member->name }} ({{ $member->email }})
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('member_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                            <script>
document.addEventListener('DOMContentLoaded', function() {
    const memberSearch = document.getElementById('member_search');
    const memberId = document.getElementById('member_id');
    const memberOptions = document.getElementById('member-options');
    const photoContainer = document.getElementById('member-photo-container');
    const photoPlaceholder = document.getElementById('member-photo-placeholder');
    const photoImg = document.getElementById('member-profile-photo');

    function updatePhoto(photoUrl) {
        if (photoUrl) {
            photoImg.src = photoUrl;
            photoContainer.classList.remove('hidden');
            photoPlaceholder.classList.add('hidden');
        } else {
            photoImg.src = '';
            photoContainer.classList.add('hidden');
            photoPlaceholder.classList.remove('hidden');
        }
    }

    function filterOptions() {
        const query = memberSearch.value.toLowerCase().trim();
        const options = memberOptions.querySelectorAll('.member-option');
        let hasVisible = false;

        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            if (text.includes(query)) {
                option.style.display = 'block';
                hasVisible = true;
            } else {
                option.style.display = 'none';
            }
        });

        if (hasVisible && query.length > 0) {
            memberOptions.classList.remove('hidden');
        } else if (query.length === 0) {
            // Show all options when input is empty
            options.forEach(option => option.style.display = 'block');
            memberOptions.classList.remove('hidden');
        } else {
            memberOptions.classList.add('hidden');
        }
    }

    memberSearch.addEventListener('focus', function() {
        if (memberSearch.value.trim().length > 0) {
            filterOptions();
        }
    });

    memberSearch.addEventListener('input', filterOptions);

    memberSearch.addEventListener('blur', function() {
        // Delay hiding to allow click events on options
        setTimeout(() => {
            memberOptions.classList.add('hidden');
        }, 200);
    });

    // Use event delegation for better performance and reliability
    memberOptions.addEventListener('mousedown', function(e) {
        e.preventDefault(); // Prevent blur from firing before click
        if (e.target.classList.contains('member-option')) {
            const option = e.target;
            memberSearch.value = option.textContent.trim();
            memberId.value = option.getAttribute('data-id');
            updatePhoto(option.getAttribute('data-photo-url'));
            memberOptions.classList.add('hidden');
            memberSearch.blur(); // Remove focus to hide keyboard on mobile
        }
    });

    // Initialize photo if member_id is set
    if (memberId.value) {
        const selectedOption = memberOptions.querySelector(`[data-id="${memberId.value}"]`);
        if (selectedOption) {
            updatePhoto(selectedOption.getAttribute('data-photo-url'));
        }
    }
});
                            </script>

                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Session Date</label>
                                <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                                @error('date')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Attendance Status</label>
                                <select id="status" name="status" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                    <option value="">Select Status</option>
                                    <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                                    <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                </select>
                                @error('status')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Mark Attendance
                            </button>
                        </div>
                    </form>


                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">

                <div class="border-t border-gray-200 dark:border-gray-600">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Member</th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Trainor</th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Time</th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($attendances as $attendance)
                                    <tr>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $attendance->member->name ?? 'N/A' }}<br/>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $attendance->member->email ?? '' }}</span>
                                        </td>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $attendance->trainor->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $attendance->date->format('M j, Y') }}
                                        </td>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap">
                                            @if($attendance->status == 'present')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Present</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">Absent</span>
                                            @endif
                                        </td>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $attendance->time ? $attendance->time->format('h:i A') : '-' }}
                                        </td>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            <form method="POST" action="{{ route('admin.attendance.destroy', $attendance->id) }}" onsubmit="return confirm('Are you sure you want to delete this attendance record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-white text-xs hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-2 py-2 sm:px-6 sm:py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No attendance records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
