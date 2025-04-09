<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use App\Notifications\MessageRead;
use App\Notifications\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\On;
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

    public function getListeners()
    {
        $auth_id = Auth::user()->id;
        return [
            'loadMore',
            "echo-private:users.{$auth_id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'broadcastedNotifications'
        ];
    }

    public function broadcastedNotifications($event)
    {
        if ($event['type'] == MessageSent::class) {

            if ($event['conversation_id'] == $this->selectedConversation->id) {

                $this->dispatch('scroll-bottom');
                $newMessage = Message::find($event['message_id']);

                #push message
                $this->loadedMessages->push($newMessage);

                #mark as read
                $newMessage->read_at = now();
                $newMessage->save();

                #broadcast
                $this->selectedConversation->getReceiver()
                    ->notify(new MessageRead($this->selectedConversation->id));
            }
        }
    }

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
        $this->selectedConversation->getReceiver()
            ->notify(new MessageSent(
                Auth::user(),
                $createdMessage,
                $this->selectedConversation,
                $this->selectedConversation->getReceiver()->id
            ));
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
