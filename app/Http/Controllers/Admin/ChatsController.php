<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                'admin_id' => Auth::guard('admin')->user()->id
            ]);
            $chat->chatAdmin()->create([
                'user_id' => $user->id
            ]);
            $chat->messages()->create([
                'user_id' => $user->id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'from' => '\App\Models\Admin',
                'message' => $input['message']
            ]);
            return response()->json([
                'success' => true,
                'message' => "Your message has been sent to {$user->first_name} {$user->last_name}. Visit the Chat Page to continue the conversation with this customer."
            ]);
        } else {
            $chat = Chats::find($hasChat->chat_id);
            $chat->messages()->create([
                'user_id' => $user->id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'from' => '\App\Models\Admin',
                'message' => $input['message']
            ]);
            return response()->json([
                'success' => true,
                'message' => "Your message has been sent to {$user->first_name} {$user->last_name}. Visit the Chat Page to continue the conversation with this customer."
            ]);
        }
        
        return response()->json([
            'success' => true,
            'chat' => $chat
        ]);
    }
}
