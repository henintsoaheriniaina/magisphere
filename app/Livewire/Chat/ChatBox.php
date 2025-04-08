<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    public $selectedConversation;
    public $body = "";
    public $paginate_var = 10;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Message[]
     */
    public $loadedMessages;

    protected $listeners = [
        'loadMore'
    ];

    public function loadMore()
    {
        $this->paginate_var += 10;
        $this->loadMessages();
        $this->dispatch('update-chat-height');
    }
    public function loadMessages()
    {
        $count = Message::where('conversation_id', $this->selectedConversation->id)->count();

        $this->loadedMessages = Message::where('conversation_id', $this->selectedConversation->id)->skip($count - $this->paginate_var)->take($this->paginate_var)->get();
    }
    public function sendMessage()
    {
        $this->validate(['body' => 'required|string'], [
            'body.required' => 'Le message est requis.',
            'body.string' => 'Le message doit être une chaîne de caractères.',
        ]);
        $createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedConversation->getReceiver()->id,
            'body' => $this->body
        ]);
        $this->reset('body');

        #scroll to bottom
        $this->dispatch('scroll-bottom');

        #push the message
        $this->loadedMessages->push($createdMessage);

        #update conversation model
        $this->selectedConversation->updated_at = now();
        $this->selectedConversation->save();

        #refresh chatlist
        $this->dispatch('refresh')->to('chat.chat-list');
        #broadcast

        // $this->selectedConversation->getReceiver()
        //     ->notify(new MessageSent(
        //         Auth()->User(),
        //         $createdMessage,
        //         $this->selectedConversation,
        //         $this->selectedConversation->getReceiver()->id

        //     ));
    }
    public function mount()
    {
        $this->loadMessages();
    }
    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
