<x-mapp-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

        <div class="bg-gradient-to-r from-violet-600/50 to-indigo-600/50 rounded-2xl shadow-lg p-6 text-white">
            <h1 class="text-3xl font-bold mb-2">View My Progress</h1>
            <p class="text-white/80 mb-6">Personal progress dashboard with weight trend, performance charts, workout completion log, and trainer feedback.</p>

            <!-- Progress Charts -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white/10 rounded-xl p-4">
                    <h2 class="text-xl font-semibold mb-4">Weight Trend (kg)</h2>
                    <canvas id="weightChart" class="w-full h-48"></canvas>
                </div>
                <div class="bg-white/10 rounded-xl p-4">
                    <h2 class="text-xl font-semibold mb-4">Body Fat %</h2>
                    <canvas id="bodyFatChart" class="w-full h-48"></canvas>
                </div>
                <div class="bg-white/10 rounded-xl p-4">
                    <h2 class="text-xl font-semibold mb-4">BMI</h2>
                    <canvas id="bmiChart" class="w-full h-48"></canvas>
                </div>
            </div>

            <!-- Workout Completion Log -->
            <div class="bg-white/10 rounded-xl p-6 mb-8">
                <h2 class="text-2xl font-semibold mb-4">Workout Completion Log</h2>
                @if($progressEntries->isEmpty())
                    <p class="text-white/70">No workout performance entries found.</p>
                @else
                    <ul class="space-y-4 max-h-64 overflow-y-auto">
                        @foreach($progressEntries as $entry)
                            <li class="bg-white/20 rounded-lg p-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold">{{ $entry->date->format('M d, Y') }}</span>
                                    <span class="text-sm text-white/70">Weight: {{ $entry->weight ?? 'N/A' }} kg</span>
                                </div>
                                <p class="whitespace-pre-line text-white/90">{{ $entry->workout_performance ?? 'No workout details' }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Trainer Feedback -->
            <div class="bg-white/10 rounded-xl p-6">
                <h2 class="text-2xl font-semibold mb-4">Trainer Feedback</h2>
                @if($progressEntries->isEmpty())
                    <p class="text-white/70">No trainer feedback available.</p>
                @else
                    <ul class="space-y-4 max-h-48 overflow-y-auto">
                        @foreach($progressEntries as $entry)
                            @if($entry->notes)
                                <li class="bg-white/20 rounded-lg p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-semibold">{{ $entry->date->format('M d, Y') }}</span>
                                    </div>
                                    <p class="whitespace-pre-line text-white/90">{{ $entry->notes }}</p>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const progressEntries = @json($progressEntries);

        const labels = progressEntries.map(e => new Date(e.date).toLocaleDateString());
        const weightData = progressEntries.map(e => e.weight);
        const bodyFatData = progressEntries.map(e => e.body_fat_percentage);
        const bmiData = progressEntries.map(e => e.bmi);

        function createChart(ctx, label, data, borderColor, backgroundColor) {
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: borderColor,
                        backgroundColor: backgroundColor,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            ticks: { color: 'white' },
                            grid: { color: 'rgba(255,255,255,0.1)' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { color: 'white' },
                            grid: { color: 'rgba(255,255,255,0.1)' }
                        }
                    },
                    plugins: {
                        legend: { labels: { color: 'white' } },
                        title: {
                            display: false
                        }
                    }
                }
            });
        }

        const weightCtx = document.getElementById('weightChart').getContext('2d');
        const bodyFatCtx = document.getElementById('bodyFatChart').getContext('2d');
        const bmiCtx = document.getElementById('bmiChart').getContext('2d');

        createChart(weightCtx, 'Weight (kg)', weightData, 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 0.2)');
        createChart(bodyFatCtx, 'Body Fat %', bodyFatData, 'rgba(255, 99, 132, 1)', 'rgba(255, 99, 132, 0.2)');
        createChart(bmiCtx, 'BMI', bmiData, 'rgba(255, 206, 86, 1)', 'rgba(255, 206, 86, 0.2)');
    </script>
</x-mapp-layout>
