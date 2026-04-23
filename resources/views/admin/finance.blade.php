<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Financial Management') }}
        </h2>
    </x-slot>

    <div class="relative z-10 rounded-xl py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">{{ __('Income') }}</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Income Source</th>
                                    <th class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Sale Date</th>
                                    <th class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($sales as $sale)
                                <tr>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $sale->type ?? 'N/A' }}</td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $sale->sale_date->format('Y-m-d') }}</td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">P{{ number_format($sale->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-lg font-medium mb-4">{{ __('Expenses') }}</h3>
                        <button id="addExpenseBtn" class="mb-4 px-4 py-1 bg-white text-black rounded hover:bg-gray-400">Add Expense</button>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Expense Name</th>
                                        <th class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                        <th class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="expensesTableBody">
                                    @foreach ($expenses as $expense)
                                    <tr>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $expense->name }}</td>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>
                                        <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">P{{ number_format($expense->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="addExpenseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96">
                            <h3 class="text-lg font-medium mb-4">{{ __('Add Expense') }}</h3>
                            <form id="addExpenseForm">
                                <div class="mb-4">
                                    <label for="expenseName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expense Name</label>
                                    <input type="text" id="expenseName" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div class="mb-4">
                                    <label for="expenseDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                    <input type="date" id="expenseDate" name="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div class="mb-4">
                                    <label for="expenseAmount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                                    <input type="number" step="0.01" min="0" id="expenseAmount" name="amount" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" id="cancelExpenseBtn" class="mr-2 px-4 py-2 bg-gray-100  text-black rounded hover:bg-gray-400">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-gray-200 text-black rounded hover:bg-blue-700">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        document.getElementById('addExpenseBtn').addEventListener('click', function() {
                            document.getElementById('addExpenseModal').classList.remove('hidden');
                        });
                        document.getElementById('cancelExpenseBtn').addEventListener('click', function() {
                            document.getElementById('addExpenseModal').classList.add('hidden');
                        });
                        document.getElementById('addExpenseForm').addEventListener('submit', function(e) {
                            e.preventDefault();
                            const name = document.getElementById('expenseName').value;
                            const date = document.getElementById('expenseDate').value;
                            const amount = document.getElementById('expenseAmount').value;
                            fetch('/expenses', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ name, date, amount })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                const tbody = document.getElementById('expensesTableBody');
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">${data.name}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">${new Date(data.date).toISOString().split('T')[0]}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">P${parseFloat(data.amount).toFixed(2)}</td>
                                `;
                                tbody.prepend(tr);
                                document.getElementById('addExpenseModal').classList.add('hidden');
                                document.getElementById('addExpenseForm').reset();
                            })
                            .catch(error => {
                                alert('Failed to add expense: ' + error.message);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
