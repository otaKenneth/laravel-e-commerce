<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        try {
            // Get all active (enabled) banners
            $sliderBanners = \App\Models\Banner::where('type', 'Slider')->where('status', 1)->get()->toArray(); 
            $fixBanners    = \App\Models\Banner::where('type', 'Fix')->where('status', 1)->get()->toArray(); 
            $categories    = \App\Models\Category::where([['parent_id', 0],['status', 1]])->get()->toArray();
            $newProducts   = \App\Models\Product::orderBy('id', 'Desc')->where('status', 1)->with('vendor')->limit(10)->get()->toArray();
            $bestSellers   = \App\Models\Product::where([
                'is_bestseller' => 'Yes',
                'status'        => 1
            ])->limit(5)->inRandomOrder()->get()->toArray();
            $discountedProducts = \App\Models\Product::where('product_discount', '>' , 0)->where('status', 1)->limit(6)->inRandomOrder()->get()->toArray();
            $featuredProducts   = \App\Models\Product::where([
                'is_featured' => 'Yes',
                'status'      => 1
            ])->limit(6)->get()->toArray();

            // Static SEO (HTML meta tags)
            $meta_title       = 'Kapiton - Philippines';
            $meta_description = 'Online Shopping Website which deals in Clothing, Electronics & Appliances Products';
            $meta_keywords    = 'eshop website, online shopping, kapiton e-commerce';

            // Return structured response
            return response()->json([
                'success' => true,
                'message' => 'Data fetched successfully',
                'data' => [
                    'sliderBanners' => $sliderBanners,
                    'fixBanners' => $fixBanners,
                    'newProducts' => $newProducts,
                    'bestSellers' => $bestSellers,
                    'discountedProducts' => $discountedProducts,
                    'featuredProducts' => $featuredProducts,
                    'categories' => $categories,
                    'meta' => [
                        'title' => $meta_title,
                        'description' => $meta_description,
                        'keywords' => $meta_keywords,
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}