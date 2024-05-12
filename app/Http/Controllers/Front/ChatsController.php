<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function index(Vendor $vendor) {
        return view('front.chats.chat');
    }
}
