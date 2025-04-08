<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatMain extends Component
{
    public $selectedConversation;
    public $query;
    public function mount()
    {
        $this->selectedConversation = Conversation::findOrFail($this->query);

        //  mark receiver messages as read
        Message::where('conversation_id', $this->selectedConversation->id)
            ->where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }
    public function render()
    {
        return view('livewire.chat.chat-main');
    }
}
