<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2563eb;
        }
        .generated-at {
            font-size: 12px;
            color: #666;
            margin-top: 10px;
        }
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        .metric-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .metric-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #666;
        }
        .metric-value {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .chart-section {
            margin-bottom: 30px;
        }
        .chart-section h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }
        .recent-sales {
            margin-bottom: 30px;
        }
        .recent-sales h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }
        .sales-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .sales-table th,
        .sales-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .sales-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fitness Gains Admin Dashboard Report</h1>
        <div class="generated-at">Generated on: {{ $generatedAt }}</div>
    </div>

    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-title">Total Sales</div>
            <div class="metric-value">P{{ number_format($totalSales, 2) }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-title">Total Expenses</div>
            <div class="metric-value">P{{ number_format($totalExpenses, 2) }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-title">Net Worth</div>
            <div class="metric-value">P{{ number_format($netWorth, 2) }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-title">Total Members</div>
            <div class="metric-value">{{ $totalMembers }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-title">Total Trainors</div>
            <div class="metric-value">{{ $totalTrainors }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-title">Total Products</div>
            <div class="metric-value">{{ $totalProducts }}</div>
        </div>
    </div>

    <div class="chart-section">
        <h3>Monthly Income and Expenses Data</h3>
        <table class="sales-table">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Income</th>
                    <th>Expenses</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chartMonths as $index => $month)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($month . '-01')->format('M Y') }}</td>
                    <td>P{{ number_format($chartIncomeData[$index], 2) }}</td>
                    <td>P{{ number_format($chartExpensesData[$index], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="recent-sales">
        <h3>Recent Sales</h3>
        @if($recentSales->count() > 0)
        <table class="sales-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentSales as $sale)
                <tr>
                    <td>{{ $sale->description ?? 'Sale' }}</td>
                    <td>{{ $sale->sale_date ? \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') : 'N/A' }}</td>
                    <td>P{{ number_format($sale->amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No recent sales found.</p>
        @endif
    </div>

    <div class="inventory-section">
        <h3>Current Inventory</h3>
        @if($inventories->count() > 0)
        <table class="sales-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->name }}</td>
                    <td>{{ $inventory->date ? \Carbon\Carbon::parse($inventory->date)->format('M d, Y') : 'N/A' }}</td>
                    <td>{{ $inventory->quantity }}</td>
                    <td>P{{ number_format($inventory->amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No inventory items found.</p>
        @endif
    </div>

    <div class="products-section">
        <h3>Available Products</h3>
        @if($products->count() > 0)
        <table class="sales-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Selling Price</th>
                    <th>Amount Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>P{{ number_format($product->selling_price, 2) }}</td>
                    <td>P{{ number_format($product->amount_sold, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No products found.</p>
        @endif
    </div>

    <div class="footer">
        <p>This report was generated automatically by the Fitness Gains Management System.</p>
    </div>
</body>
</html>
