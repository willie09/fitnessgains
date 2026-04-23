<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::all();
        return view('admin.inventory')->with('products', $products);
    }

    // Store a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
            'amount_sold' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $validated['image'] = $imagePath;

        $product = Product::create($validated);

        // Add product to expenses
        Expense::create([
            'name' => 'Product: ' . $validated['product_name'],
            'date' => Carbon::now(),
            'amount' => $validated['quantity'] * $validated['amount_sold'],
        ]);

        return redirect()->route('inventory')->with('success', 'Product added successfully.');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete corresponding expense
        $expense = Expense::where('name', 'Product: ' . $product->product_name)->first();
        if ($expense) {
            $expense->delete();
        }

        $product->delete();

        return redirect()->route('inventory')->with('success', 'Product deleted successfully.');
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
            'amount_sold' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $validated['image'] = $imagePath;

        $oldName = $product->product_name;
        $product->update($validated);

        // Update corresponding expense
        $expense = Expense::where('name', 'Product: ' . $oldName)->first();
        if ($expense) {
            $expense->update([
                'name' => 'Product: ' . $validated['product_name'],
                'amount' => $validated['quantity'] * $validated['amount_sold'],
            ]);
        }

        return redirect()->route('inventory')->with('success', 'Product updated successfully.');
    }
}
