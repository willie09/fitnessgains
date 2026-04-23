<x-trainor-layout>
<div class="py-2 px-6 sm:px-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Header Section -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6">
                <div class="flex items-center space-x-4">
                    <div class="p-3 rounded-full bg-gradient-to-r from-green-500 to-emerald-500">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Progress Tracking</h1>
                        <p class="text-white/70">Monitor and record member fitness progress</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/30 text-green-100 p-4 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500/20 border border-red-500/30 text-red-100 p-4 rounded-2xl">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Add Progress Button -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6">
                <button id="addProgressBtn" class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-medium py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Add New Progress Entry</span>
                </button>
            </div>

            <!-- Member Progress History -->
            <div class="glass-effect border border-white/20 rounded-2xl shadow-xl p-6">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span>Member Progress History</span>
                </h2>

                <div class="mb-6">
                    <label for="history_member_id" class="block text-sm font-medium text-white/90 mb-2">Select Member</label>
                    <select name="history_member_id" id="history_member_id" class="w-full md:w-1/2 glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                        <option value="" class="bg-gray-800">Select Member</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" class="bg-gray-800">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="progress-history-container" class="mb-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white/5 border border-white/20 rounded-xl overflow-hidden">
                            <thead class="bg-white/10">
                                <tr>
                                    <th class="border border-white/20 px-4 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Date</th>
                                    <th class="border border-white/20 px-4 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Weight (kg)</th>
                                    <th class="border border-white/20 px-4 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Body Fat %</th>
                                    <th class="border border-white/20 px-4 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">BMI</th>
                                    <th class="border border-white/20 px-4 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Workout Performance</th>
                                    <th class="border border-white/20 px-4 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Notes</th>
                                    <th class="border border-white/20 px-4 py-3 text-left text-xs font-medium text-white/90 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="progress-history-body" class="divide-y divide-white/10">
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-white/70">Select a member to view progress history.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Progress Chart -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Progress Chart</span>
                    </h3>
                    <div class="glass-effect border border-white/20 rounded-xl p-4">
                        <canvas id="progress-chart" class="w-full h-64"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Add Progress Modal -->
<div id="addModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
    <div class="glass-effect border border-white/20 rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh]">
        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-t-2xl p-6">
            <h3 class="text-lg font-semibold text-white flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Add New Progress Entry</span>
            </h3>
        </div>
        <form id="addForm" action="{{ route('trainor.progress.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="member_id" class="block text-sm font-medium text-white/90 mb-2">Member Name</label>
                    <select name="member_id" id="member_id" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" required>
                        <option value="" class="bg-gray-800">Select Member</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" class="bg-gray-800">{{ $member->name }}</option>
                        @endforeach
                    </select>
                    @error('member_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-white/90 mb-2">Date of Record</label>
                    <input type="date" name="date" id="date" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" required>
                    @error('date') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="weight" class="block text-sm font-medium text-white/90 mb-2">Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" id="weight" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                    @error('weight') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="body_fat_percentage" class="block text-sm font-medium text-white/90 mb-2">Body Fat %</label>
                    <input type="number" step="0.1" name="body_fat_percentage" id="body_fat_percentage" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                    @error('body_fat_percentage') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="bmi" class="block text-sm font-medium text-white/90 mb-2">BMI</label>
                    <input type="number" step="0.1" name="bmi" id="bmi" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                    @error('bmi') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="workout_performance" class="block text-sm font-medium text-white/90 mb-2">Workout Performance (reps, sets, weight lifted)</label>
                <textarea name="workout_performance" id="workout_performance" rows="3" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 resize-none"></textarea>
                @error('workout_performance') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-white/90 mb-2">Notes / Feedback (Trainer Remarks)</label>
                <textarea name="notes" id="notes" rows="3" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 resize-none"></textarea>
                @error('notes') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelAddBtn" class="px-6 py-3 rounded-xl border border-white/20 hover:bg-white/10 text-white/90 transition-all duration-300">Cancel</button>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">Add Progress Entry</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
    <div class="glass-effect border border-white/20 rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-t-2xl p-6">
            <h3 class="text-lg font-semibold text-white flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Edit Progress Entry</span>
            </h3>
        </div>
        <form id="editForm" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PATCH')
            <input type="hidden" name="progressEntryId" id="edit_progressEntryId">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="edit_date" class="block text-sm font-medium text-white/90 mb-2">Date of Record</label>
                    <input type="date" name="date" id="edit_date" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="edit_weight" class="block text-sm font-medium text-white/90 mb-2">Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" id="edit_weight" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                </div>
                <div>
                    <label for="edit_body_fat_percentage" class="block text-sm font-medium text-white/90 mb-2">Body Fat %</label>
                    <input type="number" step="0.1" name="body_fat_percentage" id="edit_body_fat_percentage" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                </div>
                <div>
                    <label for="edit_bmi" class="block text-sm font-medium text-white/90 mb-2">BMI</label>
                    <input type="number" step="0.1" name="bmi" id="edit_bmi" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5">
                </div>
            </div>

            <div>
                <label for="edit_workout_performance" class="block text-sm font-medium text-white/90 mb-2">Workout Performance</label>
                <textarea name="workout_performance" id="edit_workout_performance" rows="3" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 resize-none"></textarea>
            </div>

            <div>
                <label for="edit_notes" class="block text-sm font-medium text-white/90 mb-2">Notes / Feedback</label>
                <textarea name="notes" id="edit_notes" rows="3" class="w-full glass-effect border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/50 focus:border-white/40 focus:outline-none bg-white/5 resize-none"></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelEditBtn" class="px-6 py-3 rounded-xl border border-white/20 hover:bg-white/10 text-white/90 transition-all duration-300">Cancel</button>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const historyMemberSelect = document.getElementById('history_member_id');
    const progressHistoryBody = document.getElementById('progress-history-body');
    const ctx = document.getElementById('progress-chart').getContext('2d');
    let progressChart;

    const addModal = document.getElementById('addModal');
    const addForm = document.getElementById('addForm');
    const cancelAddBtn = document.getElementById('cancelAddBtn');
    const addProgressBtn = document.getElementById('addProgressBtn');

    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const cancelEditBtn = document.getElementById('cancelEditBtn');

    historyMemberSelect.addEventListener('change', function() {
        const memberId = this.value;
        if (!memberId) {
            progressHistoryBody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-white/70">Select a member to view progress history.</td></tr>';
            if (progressChart) {
                progressChart.destroy();
            }
            return;
        }

        fetch(`/trainor/progress/member-history/${memberId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    progressHistoryBody.innerHTML = `<tr><td colspan="7" class="text-center py-8 text-red-400">${data.error}</td></tr>`;
                    if (progressChart) {
                        progressChart.destroy();
                    }
                    return;
                }

                if (data.length === 0) {
                    progressHistoryBody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-white/70">No progress entries found for this member.</td></tr>';
                    if (progressChart) {
                        progressChart.destroy();
                    }
                    return;
                }

                // Populate table
                progressHistoryBody.innerHTML = '';
                data.forEach(entry => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-white/5 transition-colors duration-200';
                    row.innerHTML = `
                        <td class="border border-white/20 px-4 py-3 text-white/90">${new Date(entry.date).toLocaleDateString()}</td>
                        <td class="border border-white/20 px-4 py-3 text-white/90">${entry.weight ?? ''}</td>
                        <td class="border border-white/20 px-4 py-3 text-white/90">${entry.body_fat_percentage ?? ''}</td>
                        <td class="border border-white/20 px-4 py-3 text-white/90">${entry.bmi ?? ''}</td>
                        <td class="border border-white/20 px-4 py-3 text-white/90">${entry.workout_performance ?? ''}</td>
                        <td class="border border-white/20 px-4 py-3 text-white/90">${entry.notes ?? ''}</td>
                        <td class="border border-white/20 px-4 py-3 text-white/90">
                            <button class="text-blue-400 hover:text-blue-300 mr-3 transition-colors duration-200" onclick="editEntry(${entry.id})">Edit</button>
                            <button class="text-red-400 hover:text-red-300 transition-colors duration-200" onclick="deleteEntry(${entry.id})">Delete</button>
                        </td>
                    `;
                    progressHistoryBody.appendChild(row);
                });

                // Prepare chart data
                const labels = data.map(entry => new Date(entry.date).toLocaleDateString());
                const weightData = data.map(entry => entry.weight);
                const bodyFatData = data.map(entry => entry.body_fat_percentage);
                const bmiData = data.map(entry => entry.bmi);

                if (progressChart) {
                    progressChart.destroy();
                }

                progressChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Weight (kg)',
                                data: weightData,
                                borderColor: 'rgba(54, 162, 235, 1)',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                fill: false,
                                tension: 0.1
                            },
                            {
                                label: 'Body Fat %',
                                data: bodyFatData,
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                fill: false,
                                tension: 0.1
                            },
                            {
                                label: 'BMI',
                                data: bmiData,
                                borderColor: 'rgba(255, 206, 86, 1)',
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                fill: false,
                                tension: 0.1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        stacked: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Progress Over Time',
                                color: 'white'
                            },
                            legend: {
                                labels: {
                                    color: 'white'
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: 'white'
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'white'
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                progressHistoryBody.innerHTML = `<tr><td colspan="7" class="text-center py-8 text-red-400">Error loading progress data.</td></tr>`;
                if (progressChart) {
                    progressChart.destroy();
                }
                console.error('Error fetching progress history:', error);
            });
    });

    function editEntry(id) {
        fetch(`/trainor/progress/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                document.getElementById('edit_progressEntryId').value = data.id;
                document.getElementById('edit_date').value = data.date;
                document.getElementById('edit_weight').value = data.weight ?? '';
                document.getElementById('edit_body_fat_percentage').value = data.body_fat_percentage ?? '';
                document.getElementById('edit_bmi').value = data.bmi ?? '';
                document.getElementById('edit_workout_performance').value = data.workout_performance ?? '';
                document.getElementById('edit_notes').value = data.notes ?? '';

                editForm.action = `/trainor/progress/${id}`;
                editModal.classList.remove('hidden');
            })
            .catch(error => {
                alert('Error fetching progress entry data.');
                console.error('Fetch error:', error);
            });
    }

    function deleteEntry(id) {
        if (confirm('Are you sure you want to delete this progress entry?')) {
            fetch(`/trainor/progress/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    alert('Progress entry deleted successfully.');
                    historyMemberSelect.dispatchEvent(new Event('change')); // Refresh data
                } else {
                    alert('Failed to delete progress entry.');
                }
            })
            .catch(error => {
                alert('Error deleting progress entry.');
                console.error('Delete error:', error);
            });
        }
    }

    addProgressBtn.addEventListener('click', () => {
        addModal.classList.remove('hidden');
    });

    cancelAddBtn.addEventListener('click', () => {
        addModal.classList.add('hidden');
    });

    cancelEditBtn.addEventListener('click', () => {
        editModal.classList.add('hidden');
    });

    // Optional: Close modal on outside click
    window.addEventListener('click', (event) => {
        if (event.target === addModal) {
            addModal.classList.add('hidden');
        }
        if (event.target === editModal) {
            editModal.classList.add('hidden');
        }
    });
</script>
</x-trainor-layout>
