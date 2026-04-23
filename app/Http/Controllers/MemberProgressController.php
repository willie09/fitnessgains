<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgressEntry;

class MemberProgressController extends Controller
{
    public function index()
    {
        $member = Auth::user()->member;

        $progressEntries = ProgressEntry::where('member_id', $member->id)
            ->orderBy('date', 'asc')
            ->get();

        return view('member.progress.index', compact('progressEntries'));
    }
}
