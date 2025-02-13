<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
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
        $view = (isset($this->activeChat->user->first_name)) ? 'livewire.admin.chat-box' : 'livewire.empty-chat-box';
        return view($view);
    }

    public function navigationChatClicked($chat_id)
    {
        $chatRecord = Auth::guard('admin')->user()->chats()->with(['user'])->where('chats.id', $chat_id)->first(); 
        $this->activeChat = $chatRecord;
    }

    public function sendMessage()
    {
        if (!empty($this->message)) {
            $this->activeChat->messages()->create([
                'message' => $this->message,
                'admin_id' => Auth::guard('admin')->user()->id,
                'user_id' => $this->activeChat->user->id,
                'from' => \App\Models\Admin::class
            ]);

            $lastMessage = $this->activeChat->messages()->latest()->first();
            $now = Carbon::now();
            $differenceInMinutes = $lastMessage->created_at->diffInMinutes($now);
    
            // Send email notification to the user
            if ($this->activeChat->user && $this->activeChat->user->email && $lastMessage->from == "\App\Models\User" && $differenceInMinutes > 180) {
                $messageData = [
                    'name' => $this->activeChat->admin->name,
                    'messageContent' => $this->message,
                    'chatUrl' => url(env('APP_URL') . "/user/chats")
                ];
                $email = $this->activeChat->user->email;

                Mail::send('emails.new-chat-notif', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject("New Message from a " . Auth::guard('admin')->user()->vendorBusiness->shop_name);
                });
            }
    
            $this->message = "";
            $this->activeChat->refresh();
        }
    }

    public function refreshMessages()
    {
        $this->activeChat->refresh();
        $this->chats = Auth::user()->chats;
    }
}
