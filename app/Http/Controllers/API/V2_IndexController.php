<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class V2_IndexController extends Controller
{
    public function index()
    {
        try {
            $sliderBannersData = Banner::where('type', 'Slider')->where('status', 1)->get();
            $categoriesData = Category::where([['parent_id', 0], ['status', 1]])->get();
            $newProductsData = Product::orderBy('id', 'Desc')->where('status', 1)->limit(10)->get();
            $bestSellersData = Product::where(['is_bestseller' => 'Yes', 'status' => 1])->limit(5)->inRandomOrder()->get();

            // Format Slider Banners
            $sliderBanners = $sliderBannersData->map(function ($banner) {
                return [
                    'image' => $banner->image ? URL::to('storage/images/banners/' . $banner->image) : null,
                    'link' => $banner->link,
                    'title' => $banner->title,
                ];
            });

            // Format Categories
            $topCategories = $categoriesData->map(function ($category) {
                return [
                    'title' => $category->category_name,
                    'link' => '/products/category/' . urlencode($category->category_name),
                ];
            });
            
            // Reusable function to format any product collection
            $formatProducts = function ($products) {
                return $products->map(function ($product) {
                    $discountedPrice = null;
                    if ($product->product_discount > 0) {
                        $discountedPrice = $product->product_price - ($product->product_price * $product->product_discount / 100);
                    }

                    return [
                        'id' => $product->id,
                        'name' => $product->product_name,
                        'image' => $product->product_image ? URL::to('storage/images/products/' . $product->product_image) : null,
                        'price' => (float) $product->product_price,
                        'discountedPrice' => $discountedPrice ? (float) round($discountedPrice, 2) : null,
                        'reviews' => null, // Placeholder for average review rating
                    ];
                });
            };

            // Format Product Lists
            $topProducts = $formatProducts($bestSellersData);
            $recentlyAddedProducts = $formatProducts($newProductsData);

            return response()->json([
                'success' => true,
                'message' => 'Data fetched successfully',
                'data' => [
                    'sliderBanners' => $sliderBanners,
                    'topCategories' => $topCategories,
                    'topProducts' => $topProducts,
                    'recentlyAddedProducts' => $recentlyAddedProducts,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data: ' . $e->getMessage(),
            ], 500);
        }
    }
}