<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display the messages for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $otherUserId = $request->query('with');

        if (!$otherUserId) {
            if ($user->isMember()) {
                $member = $user->member;
                if ($member && $member->trainor) {
                    $otherUserId = $member->trainor->user_id;
                } else {
                    abort(403, 'No trainor assigned.');
                }
            } else {
                abort(403, 'Select a user to message.');
            }
        }

        $otherUser = User::findOrFail($otherUserId);

        // Authorization: Members can only chat with their assigned trainor, Trainors with their members
        if ($user->isMember()) {
            $member = $user->member;
            if (!$member || $member->trainor_id != $otherUser->trainor->id) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->isTrainor()) {
            $trainor = $user->trainor;
            $member = $otherUser->member;
            if (!$member || $member->trainor_id != $trainor->id) {
                abort(403, 'Unauthorized');
            }
        } else {
            abort(403, 'Unauthorized');
        }

        $query = Message::where(function ($q) use ($user, $otherUser) {
            $q->where('sender_id', $user->id)->where('receiver_id', $otherUser->id);
        })->orWhere(function ($q) use ($user, $otherUser) {
            $q->where('sender_id', $otherUser->id)->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc');

        if ($request->ajax() && $request->has('after')) {
            $messages = $query->where('id', '>', $request->after)->get();
            return response()->json(['messages' => $messages]);
        }

        $messages = $query->get();

        if ($request->ajax()) {
            return response()->json(['messages' => $messages]);
        }

        if ($user->isMember()) {
            return view('member.messages', compact('messages', 'otherUser'));
        } elseif ($user->isTrainor()) {
            return view('trainor.messages', compact('messages', 'otherUser'));
        }
    }

    /**
     * Store a new message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $receiverId = $request->receiver_id;

        $receiver = User::findOrFail($receiverId);

        // Authorization
        if ($user->isMember()) {
            $member = $user->member;
            if (!$member || $member->trainor_id != $receiver->trainor->id) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->isTrainor()) {
            $trainor = $user->trainor;
            $member = $receiver->member;
            if (!$member || $member->trainor_id != $trainor->id) {
                abort(403, 'Unauthorized');
            }
        } else {
            abort(403, 'Unauthorized');
        }

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->back()->with('success', 'Message sent.');
    }
}
