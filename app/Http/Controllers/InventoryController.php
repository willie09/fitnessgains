<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = \App\Models\Inventory::orderBy('date', 'desc')->get();
        $products = \App\Models\Product::all();
        return view('admin.inventory', compact('inventories', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'quantity' => 'required|integer|min:0',
            'amount' => 'required|numeric|min:0',
        ]);

        $inventory = Inventory::create($validated);

        // Add inventory amount to expenses if checkbox is checked
        if ($request->has('add_to_expenses')) {
            \App\Models\Expense::create([
                'name' => 'Inventory: ' . $validated['name'],
                'date' => $validated['date'],
                'amount' => $validated['amount'],
            ]);
        }

        return redirect()->route('inventory')->with('success', 'Inventory added successfully.');
    }

    
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        // Delete corresponding expense
        $expense = \App\Models\Expense::where('name', 'Inventory: ' . $inventory->name)
            ->whereDate('date', $inventory->date)
            ->first();

        if ($expense) {
            $expense->delete();
        }

        $inventory->delete();

        return redirect()->route('inventory')->with('success', 'Inventory deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'quantity' => 'required|integer|min:0',
            'amount' => 'required|numeric|min:0',
        ]);

        $inventory->update($validated);

        // Update corresponding expense
        $expense = \App\Models\Expense::where('name', 'Inventory: ' . $inventory->name)
            ->whereDate('date', $inventory->date)
            ->first();

        if ($expense) {
            $expense->update([
                'name' => 'Inventory: ' . $validated['name'],
                'date' => $validated['date'],
                'amount' => $validated['amount'],
            ]);
        }

        return redirect()->route('inventory')->with('success', 'Inventory updated successfully.');
    }
}
