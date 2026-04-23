<?php

namespace App\Http\Controllers;

use App\Models\WalkInLog;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalkInLogController extends Controller
{
    public function index()
    {
        $walkInLogs = WalkInLog::all();
        return view('admin.walkins', compact('walkInLogs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $walkInLog = WalkInLog::create($validated);

        // Create corresponding sale entry
        Sale::create([
            'type' => 'walkin',
            'description' => 'Walk-in: ' . $validated['name'],
            'amount' => $validated['amount'],
            'sale_date' => $validated['date'],
            'member_id' => null,
            'user_id' => Auth::id(),
            'metadata' => ['time' => $validated['time']],
        ]);

        return redirect()->route('walkins')->with('success', 'Walk-in log added successfully.');
    }
    
    public function destroy($id)
{
$walkInLog = WalkInLog::findOrFail($id);
$walkInLog->delete();


return redirect()->route('walkins')->with('success', 'Walk-in log deleted successfully.');
}
}
