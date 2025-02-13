<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Mail;
use App\Models\Chats;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    public $chats;
    public $activeChat;
    public $message;

    public function mount()
    {
        $user = Auth::user();
        $vendor_id = request()->query('vendor_id');
        $product_id = request()->query('product_id');
        
        // Load existing chats
        $this->chats = $user->chats;

        if ($vendor_id) {
            $admin = Admin::where('vendor_id', $vendor_id)->first();
            $this->activeChat = $user->chats()
                ->with(['admin'])
                ->latest()
                ->first();

            if (!$this->activeChat) {
                // Create a new chat if none exists
                $this->activeChat = new Chats([
                    'user_id' => $user->id,
                    'admin_id' => $admin->id,
                    'messages' => []
                ]);
                $this->activeChat->save();
            }
        } else {
            // Load last active chat
            $this->activeChat = $user->chats()->with(['admin'])->latest()->first();
        }

        if (is_null($this->activeChat)) {
            $this->activeChat = new Chats;
            $this->activeChat->setAttribute('messages', []);
        }

        if ($product_id) {
            $this->sendMessage("Check this product: " . route('product_detail.show', ['id' => $product_id]));
        }
    }
    public function render()
    {
        $view = (isset($this->activeChat->admin->vendorBusiness)) ? 'livewire.chat-box' : 'livewire.empty-chat-box';
        return view($view);
    }

    public function navigationChatClicked($chat_id)
    {
        $chatRecord = Auth::user()->chats()->with(['admin'])->where('chats.id', $chat_id)->first(); 
        $this->activeChat = $chatRecord;
    }

    public function sendMessage($content = null)
    {
        $messageText = $content ?? $this->message;

        $lastMessage = $this->activeChat->messages()->latest()->first();

        if (str_contains($lastMessage?->message, "Check this product")) {
            if (str_contains($messageText, "Check this product")) {
                return;
            }
        } else {
            if (str_contains($messageText, "Check this product")) {
                $messageData = [
                    'name' => $this->activeChat->admin->name,
                    'messageContent' => "$messageText",
                    'chatUrl' => url(env('APP_SELLER_URL') . "/admin/chats")
                ];
                $email = [
                    $this->activeChat->admin->vendorBusiness->shop_email,
                    $this->activeChat->admin->email
                ];
                
                Mail::send('emails.new-chat-notif', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject("New Message from a " . Auth::user()->first_name . " " . Auth::user()->last_name);
                });
            }
        }

        if (!empty($messageText) && $this->activeChat) {
            $this->activeChat->messages()->create([
                'message' => $messageText,
                'admin_id' => $this->activeChat->admin->id,
                'user_id' => Auth::id(),
                'from' => \App\Models\User::class
            ]);

            $this->message = ""; // Clear input after sending
            $this->activeChat->refresh(); // Refresh chat messages
        }
    }

    public function refreshMessages()
    {
        $this->activeChat->refresh();
        $this->chats = Auth::user()->chats;
    }
}
