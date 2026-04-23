<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Member;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['product', 'member'])->orderBy('order_date', 'desc')->paginate(20);
        $products = Product::all();
        $members = Member::all();

        return view('admin.orders', compact('orders', 'products', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'member_id' => 'nullable|exists:members,id',
            'order_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $totalAmount = $product->selling_price * $validated['quantity'];

        $order = Order::create([
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'total_amount' => $totalAmount,
            'member_id' => $validated['member_id'] ?? null,
            'order_date' => $validated['order_date'],
            'status' => $validated['status'],
        ]);

        // If order is created as completed, create sale record
        if ($validated['status'] === 'completed') {
            $this->createSaleFromOrder($order);
        }

        return redirect()->route('orders')->with('success', 'Order added successfully.');
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $oldStatus = $order->status;
        $order->update($validated);

        // If status changed to completed and wasn't completed before, create sale record
        if ($validated['status'] === 'completed' && $oldStatus !== 'completed') {
            $this->createSaleFromOrder($order);
        }

        return redirect()->route('orders')->with('success', 'Order updated successfully.');
    }

    private function createSaleFromOrder(Order $order)
    {
        Sale::create([
            'type' => 'product_sale',
            'description' => "Sale of {$order->quantity} x {$order->product->product_name}",
            'amount' => $order->total_amount,
            'sale_date' => $order->order_date,
            'member_id' => $order->member_id,
            'user_id' => Auth::id(),
            'metadata' => [
                'order_id' => $order->id,
                'product_id' => $order->product_id,
                'quantity' => $order->quantity,
            ],
        ]);
    }
}
