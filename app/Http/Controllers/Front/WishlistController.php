<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    
    public function wishlist() {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)
            ->with(['product' => function ($query) {
                $query->select('id','product_name', 'product_image', 'description', 'product_price');
            }, 'product.attributes' => function ($query) {
                $query->select('product_id', 'color', 'size', 'price');
            }])
            ->paginate(10);

        $mapped_wishlists = $wishlist->map(function ($item, $key) {
            $temp_price = $item->product->attributes->where('color', $item->attribute_one)->where('size', $item->attribute_two)->first();
            $item->price = empty($temp_price) ? $item->product->product_price:$temp_price->price;
            return $item;
        });

        return view('front.users.wishlist')->with(compact('mapped_wishlists'));
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
