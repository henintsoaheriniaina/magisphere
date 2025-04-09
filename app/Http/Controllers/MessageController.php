<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function message($userId)
    {

        //  $createdConversation =   Conversation::updateOrCreate(['sender_id' => auth()->id(), 'receiver_id' => $userId]);
        if (Auth::id() == $userId) {
            return redirect()->back();
        }

        $authenticatedUserId = Auth::id();

        # Check if conversation already exists
        $existingConversation = Conversation::where(function ($query) use ($authenticatedUserId, $userId) {
            $query->where('sender_id', $authenticatedUserId)
                ->where('receiver_id', $userId);
        })
            ->orWhere(function ($query) use ($authenticatedUserId, $userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $authenticatedUserId);
            })->first();

        if (!$existingConversation) {
            $existingConversation = Conversation::create([
                'sender_id' => $authenticatedUserId,
                'receiver_id' => $userId,
            ]);
        }
        return redirect()->route('chat.main', ['query' => $existingConversation->id]);
    }
}
