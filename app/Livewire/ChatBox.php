<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    public $chats;
    public $activeChat;
    public $message;

    public function mount()
    {
        $this->chats = Auth::user()->chats;

        $this->activeChat = Auth::user()->chats()->latest()->first();
    }
    public function render()
    {
        return view('livewire.chat-box');
    }

    public function navigationChatClicked($chat_id)
    {
        $chatRecord = Auth::user()->chats()->where('chats.id', $chat_id)->first(); 
        $this->activeChat = $chatRecord;
    }

    public function sendMessage()
    {
        if ($this->message !== "") {
            $this->activeChat->messages()->create([
                'message' => $this->message,
                'user_id' => Auth::user()->id,
                'vendor_id' => $this->activeChat->vendor->id,
                'from' => "\App\Models\User"
            ]);
    
            $this->message = "";
        }
        $this->activeChat->refresh();
    }
}
