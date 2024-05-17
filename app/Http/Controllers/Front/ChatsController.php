<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ChatMessages;
use App\Models\Chats;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatsController extends Controller
{
    public function index(Vendor $vendor) {
        return view('front.chats.chat');
    }

    public function store(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'vendor_id' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error_message' => $validator->errors()
            ]);
        }

        $admin = Admin::where('vendor_id', $input['vendor_id'])->first();
        $hasChat = ChatMessages::where('user_id', Auth::user()->id)->where('admin_id', $admin->id)->first();

        if (empty($hasChat)) {
            $chat = Chats::create();
            $chat->chatUser()->create([
                'user_id' => Auth::user()->id
            ]);
            $chat->chatAdmin()->create([
                'admin_id' => $admin->id
            ]);
            $chat->messages()->create([
                'admin_id' => $admin->id,
                'user_id' => Auth::user()->id,
                'from' => '\App\Models\User',
                'message' => $input['message']
            ]);
        } else {
            $chat = Chats::find($hasChat->chat_id);
            $chat->messages()->create([
                'admin_id' => $admin->id,
                'user_id' => Auth::user()->id,
                'from' => '\App\Models\User',
                'message' => $input['message']
            ]);
            return response()->json([
                'success' => true,
                'redirect' => '/user/chats'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'chat' => $chat
        ]);
    }
}
