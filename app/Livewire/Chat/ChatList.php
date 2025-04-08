<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use Auth;
use Livewire\Component;

class ChatList extends Component
{
    public $selectedConversation;
    public $query;
    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.chat.chat-list', [
            'conversations' => Auth::user()->conversations()->latest('updated_at')->get()
        ]);
    }
}
