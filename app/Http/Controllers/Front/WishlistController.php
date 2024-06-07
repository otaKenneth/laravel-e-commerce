<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    
    public function wishlist() {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->with('product')->paginate(10);
        return view('front.users.wishlist')->with(compact('wishlist'));
    }

}
