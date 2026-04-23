<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        
        if (!$member) {
            return redirect()->route('dashboard')->with('error', 'Member profile not found.');
        }

        // Calculate days until expiry
        $expiryDate = \Carbon\Carbon::parse($member->expiry_date);
        $daysUntilExpiry = $expiryDate->diffInDays(now());
        
        // Get membership price based on type
        $membershipPrices = [
            'basic' => 500,
            'premium' => 700,
            'vip' => 1000,
        ];
        
        $currentPrice = $membershipPrices[$member->membership_type] ?? 0;

        return view('member-portal', [
            'member' => $member,
            'user' => $user,
            'daysUntilExpiry' => $daysUntilExpiry,
            'currentPrice' => $currentPrice,
            'isExpiringSoon' => $daysUntilExpiry <= 30,
            'expiryPercentage' => $this->calculateExpiryPercentage($member->join_date, $member->expiry_date)
        ]);
    }

    private function calculateExpiryPercentage($joinDate, $expiryDate)
    {
        $join = \Carbon\Carbon::parse($joinDate);
        $expiry = \Carbon\Carbon::parse($expiryDate);
        $now = now();
        
        $totalDays = $join->diffInDays($expiry);
        $elapsedDays = $join->diffInDays($now);
        
        return min(100, max(0, ($elapsedDays / $totalDays) * 100));
    }
}
