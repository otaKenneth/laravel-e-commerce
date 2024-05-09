<?php

namespace App\Livewire;

use App\Models\Chats;
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

        $this->activeChat = Auth::user()->chats()->with(['admin'])->latest()->first();

        if (is_null($this->activeChat)) {
            $this->activeChat = new Chats;
            $this->activeChat->setAttribute('messages', []);
        }
    }
    public function render()
    {
        return view('livewire.chat-box');
    }

    public function navigationChatClicked($chat_id)
    {
        $chatRecord = Auth::user()->chats()->with(['admin'])->where('chats.id', $chat_id)->first(); 
        $this->activeChat = $chatRecord;
    }

    public function sendMessage()
    {
        if ($this->message !== "") {
            $this->activeChat->messages()->create([
                'message' => $this->message,
                'admin_id' => $this->activeChat->admin->id,
                'user_id' => Auth::user()->id,
                'from' => "\App\Models\User"
            ]);
    
            $this->message = "";
        }
        $this->activeChat->refresh();
    }
}
