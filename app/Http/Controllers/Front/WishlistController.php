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

    public function wishlistItemDelete(Request $request, $item) {
        try {
            $wishlist_item = Wishlist::where('id', $item)->firstOrFail();
            $wishlist_item->delete();
    
            $wishlist = Wishlist::where('user_id', Auth::user()->id)
                ->with('product')
                ->paginate(10);
            
            return response()->json([
                'message' => "Item from wishlist successfully removed.",
                'view' => (string) \Illuminate\Support\Facades\View::make('front.users.wishlist_table')
                    ->with(compact('wishlist'))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

}
