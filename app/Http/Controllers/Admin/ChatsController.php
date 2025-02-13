<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\ChatMessages;
use App\Models\Chats;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function index ()
    {
        Session::put('page', 'Chats');
        return view('admin.chats.chats');
    }

    public function orderChat (Request $request)
    {
        $input = $request->all();

        $user = User::where('id', $input['customer_id'])->first();
        $hasChat = ChatMessages::where('admin_id', Auth::guard('admin')->user()->id)
            ->where('user_id', $user->id)
            ->first();

        if (empty($hasChat)) {
            $chat = Chats::create();
            $chat->chatUser()->create([
                'user_id' => $user->id
            ]);
            $chat->chatAdmin()->create([
                'admin_id' => Auth::guard('admin')->user()->id
            ]);
            $chat->messages()->create([
                'user_id' => $user->id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'from' => '\App\Models\Admin',
                'message' => $input['message']
            ]);
        } else {
            $chat = Chats::find($hasChat->chat_id);
            $chat->messages()->create([
                'user_id' => $user->id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'from' => '\App\Models\Admin',
                'message' => $input['message']
            ]);
        }

        $messageData = [
            'name' => $user->name,
            'messageContent' => $input['message'],
            'chatUrl' => url(env('APP_URL') . "/user/chats")
        ];
        $email = $user->email;

        Mail::send('emails.new-chat-notif', $messageData, function ($message) use ($email) {
            $message->to($email)->subject("New Message from a " . Auth::guard('admin')->user()->vendorBusiness->shop_name);
        });

        return response()->json([
            'success' => true,
            'message' => "Your message has been sent to {$user->first_name} {$user->last_name}. Visit the Chat Page to continue the conversation with this customer."
        ]);
    }
}
