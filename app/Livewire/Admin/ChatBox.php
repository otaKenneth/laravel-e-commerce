<?php

namespace App\Livewire\Admin;

use App\Models\Chats;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    public $message, $activeChat, $chats;

    public function mount()
    {
        $this->chats = Auth::guard('admin')->user()->chats;

        $this->activeChat = Auth::guard('admin')->user()->chats()->with(['user'])->latest()->first();

        if (is_null($this->activeChat)) {
            $this->activeChat = new Chats;
            $this->activeChat->setAttribute('messages', []);
        }
    }

    public function render()
    {
        return view('livewire.admin.chat-box');
    }

    public function navigationChatClicked($chat_id)
    {
        $chatRecord = Auth::guard('admin')->user()->chats()->with(['user'])->where('chats.id', $chat_id)->first(); 
        $this->activeChat = $chatRecord;
    }
}
