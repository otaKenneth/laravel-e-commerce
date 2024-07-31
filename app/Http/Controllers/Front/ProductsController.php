<?php

namespace App\Http\Controllers\Front;

use App\Helpers\PaymongoAPIHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ProductsAttribute;
use App\Models\ProductsFilter;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Brand;
use App\Models\Wishlist;
use App\Helpers\LalamoveAPIBodyHelper;


class ProductsController extends Controller
{
    private $lalamoveAPI_Helper;
    // match() method is used for the HTTP 'GET' requests to render listing.blade.php page and the HTTP 'POST' method for the AJAX request of the Sorting Filter or the HTML Form submission and jQuery for the Sorting Filter WITHOUT AJAX, AND ALSO for submitting the Search Form in listing.blade.php    // e.g.    /men    or    /computers    
    public function listing(Request $request) { // using the Dynamic Routes with the foreach loop
        $type = $request->type;
        $name = $request->name;
        $pageTitle = $name;
        switch ($type) {
            case 'collection':
                $result = $this->getCollectionBySection($name, $request->all());
                break;
            case 'category':
                $result = $this->getCollectionByCategory($name, $request->all());
                break;
            case 'vendor':
                $vendor = Vendor::find($name);
                $pageTitle = "{$vendor->vendorbusinessdetails->shop_name} Shop";
                $result = $this->vendorListing($vendor, $request->all());
                break;
            case 'search':
                $result = $this->filter($request->all());
                break;
            
            default:
                # code...
                break;
        }

        // collection, filters, categoryDetails, meta_title, meta_description, meta_keywords
        if (is_array($result)) extract($result);
        else return redirect('/products/collection/all');

        $collection = $collection->paginate(12);
        // dd($filters);
        return view('front.products.collection_listings')->with(compact('pageTitle', 'categoryDetails', 'collection', 'type', 'filters', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function filter($data) {
        $search_product = $data['search'];

        // We join `products` table (at the `category_id` column) with `categoreis` table (becausee we're going to search `category_name` column in `categories` table)
        // Note: It's best practice to name table columns with more verbose descriptive names (e.g. if the table name is `products`, then you should have a column called `product_id`, NOT `id`), and also, don't have repeated column names THROUGHOUT/ACROSS the tables of a certain (one) database (i.e. make all your database tables column names (throughout your database) UNIQUE (even columns in different tables!)). That's because of that problem that emerges when you join (JOIN clause) two tables which have the same column names, when you join them, the column names of the second table overrides the column names of the first table (similar column names override each other), leading to many problems. There are TWO ways/workarounds to tackle this problem
        $collection = Product::with('brand', 'vendor')->join( // Joins: Inner Join Clause: https://laravel.com/docs/9.x/queries#inner-join-clause    // moving the paginate() method after checking for the sorting filter <form>    // Paginating Eloquent Results: https://laravel.com/docs/9.x/pagination#paginating-eloquent-results    // Displaying Pagination Results Using Bootstrap: https://laravel.com/docs/9.x/pagination#using-bootstrap        // https://laravel.com/docs/9.x/queries#additional-where-clauses    // using the brand() relationship method in Product.php model    // Eager Loading (using with() method): https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'brand' is the relationship method name in Product.php model
            'categories', // `categories` table
            'categories.id', '=', 'products.category_id' // JOIN both `products` and `categories` tables at    `categories`.`id` = `products`.`category_id`
        )->where(function($query) use ($search_product) { // Constraining Eager Loads: https://laravel.com/docs/9.x/eloquent-relationships#constraining-eager-loads    // Subquery Where Clauses: https://laravel.com/docs/9.x/queries#subquery-where-clauses    // Advanced Subqueries: https://laravel.com/docs/9.x/eloquent#advanced-subqueries    // Eager Loading (using with() method): https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'brand' is the relationship method name in Product.php model    // function () use ()     syntax: https://www.php.net/manual/en/functions.anonymous.php#:~:text=the%20use%20language%20construct
            // We'll search for the searched term by the user in the `product_name`, `product_code`, `product_color` and `description` columns in the `products` table and in the `category_name` column in the `categories` table
            $query->where('products.product_name',    'like', '%' . $search_product . '%')  // 'like' SQL operator    // '%' SQL Wildcard Character    // Basic Where Clauses: Where Clauses: https://laravel.com/docs/9.x/queries#where-clauses
                ->orWhere('products.product_code',    'like', '%' . $search_product . '%')  // 'like' SQL operator    // '%' SQL Wildcard Character    // Basic Where Clauses: Where Clauses: https://laravel.com/docs/9.x/queries#where-clauses
                ->orWhere('products.description',     'like', '%' . $search_product . '%')  // 'like' SQL operator    // '%' SQL Wildcard Character    // Basic Where Clauses: Where Clauses: https://laravel.com/docs/9.x/queries#where-clauses
                ->orWhere('categories.category_name', 'like', '%' . $search_product . '%'); // 'like' SQL operator    // '%' SQL Wildcard Character    // Basic Where Clauses: Where Clauses: https://laravel.com/docs/9.x/queries#where-clauses
        })->where('products.status', 1);

        $catIds = $collection->get()->pluck('category_id')->toArray();

        $sectionModel = new \App\Models\Section;
        $sectionIds = $collection->get()->pluck('section_id')->unique()->toArray();
        $sectionCategories = $sectionModel->whereIn('id', $sectionIds);
        $catDetails = $sectionCategories->with('categories')->get()->toArray();

        $categoryDetails = [
            'catIds' => $catIds,
            'categoryDetails' => $catDetails
        ];
        
        $meta_title       = "Search {$search_product}";
        
        $meta_descriptions = $collection->get()->pluck('meta_description');
        $meta_description = implode($meta_descriptions->toArray());

        $meta_keywordss = $collection->get()->pluck('meta_keywords');
        $meta_keywords    = implode($meta_keywordss->toArray());

        $filters = $this->getAvailableFilters($catDetails, $collection);
        $collection = $this->processFilters($collection, $data);

        return ["collection" => $collection, "filters" => $filters, "categoryDetails" => $categoryDetails, 
            "meta_title" => $meta_title, "meta_description" => $meta_description, "meta_keywords" => $meta_keywords,
        ];
    }



    // Render Single Product Detail Page in front/products/detail.blade.php    
    public function detail($id) { // Required Parameters: https://laravel.com/docs/9.x/routing#required-parameters
        $productDetails = \App\Models\Product::with([
            'section', 'category', 'brand', 'attributes' => function($query) { // Constraining Eager Loads: https://laravel.com/docs/9.x/eloquent-relationships#constraining-eager-loads    // Subquery Where Clauses: https://laravel.com/docs/9.x/queries#subquery-where-clauses    // Advanced Subqueries: https://laravel.com/docs/9.x/eloquent#advanced-subqueries    // 'section', 'category', 'brand', 'attributes', 'images', 'vendor' are the relationship method names in Product.php model which are being Eager Loaded (Eager Loading)
                $query->where('stock', '>', 0)->where('status', 1); // the 'attributes' relationship method in Product.php model     // Constraining Eager Loads to get the `products_attributes` of `stock` more than Zero 0 ONLY and `status` is 1 (active/enabled)
            }, 'images', 'vendor'
        ])->findOrFail($id)->toArray(); // Eager Loading (using with() method): https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // Eager Loading Multiple Relationships: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading-multiple-relationships


        $categoryDetails = \App\Models\Category::categoryDetails($productDetails['category']['url']); // to get the Breadcrumb links (which is HTML) to show them in front/products/detail.blade.php
        

        // Get similar products (or related products) (functionality) by getting other products from THE SAME CATEGORY    
        $similarProducts = \App\Models\Product::with('vendor','brand')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->where('admin_type', 'vendor')->limit(4)->inRandomOrder()->get()->toArray(); // where('id', '!=', $id)    means get all similar products (of the same category) EXCEPT (exclude) the currently viewed product (to not be repeated (to prevent repetition))    // limit(4)->inRandomOrder()    means show only 4 similar products but IN RANDOM ORDER


        // Recently Viewed Products (Items) functionality (we created `recently_viewed_products` table but we won't need to create a Model for it, because we won't do much work with it)
        // The idea of the Recently Viewed Products functionality is whenever a user views a product (i.e. opens detail.blade.php page via the detail() method here), we insert the viewed product id and the user's session id in the `recently_viewed_products` database table. At the same time, we retrieve/get/fetch the previously inserted recently viewed products (from `recently_viewed_products` table) to display them in detail.blade.php
        // Very Important Note: You'll need here Task Scheduling (Cron jobs) to clear the `recently_viewed_products` table from time to time because it will get very big and will make your database slow over time    // Task Scheduling (Laravel's Cron jobs): https://laravel.com/docs/9.x/scheduling
        // Set Session for the Recently Viewed Products
        if (empty(Session::get('session_id'))) { // if the session is empty (user is not logged in), create a random session id (for the 'Guest' user)    // https://laravel.com/docs/9.x/authentication#ecosystem-overview    // Determining If An Item Exists In The Session: https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session
            $session_id = md5(uniqid(rand(), true));
        } else { // if the session exists (user is logged in)    // https://laravel.com/docs/9.x/authentication#ecosystem-overview
            $session_id = Session::get('session_id');
        }

        // Store the $session_id in the Session
        Session::put('session_id', $session_id); // (!! this shouble be inside the last if statement case that the user is NOT logged in ONLY !!) $session_id comes from one of the two cases of the last if statement    // Storing Data: https://laravel.com/docs/9.x/session#storing-data

        // If they don't already exist, INSERT the currently viewed product `product_id` and `session_id` in `recently_viewed_products` table (ONE TIME ONLY)
        $countRecentlyViewedProducts = DB::table('recently_viewed_products')->where([ // Note: Here we use Laravel 'DB' facade because we didn't create a Model for the `recently_viewed_products` table, because we don't need it because we won't do much work with it. So we'll just ONLY DIRECTLY interact with the `recently_viewed_products` table using Laravel 'DB' facade
            'product_id' => $id,
            'session_id' => $session_id // comes from the two cases of the last if statement
        ])->count(); // get the count or the number of that currently Viewed Product through the same Product (through `product_id`) and Session (through `session_id`). This should not be more than ONE TIME ONLY!

        if ($countRecentlyViewedProducts == 0) { // if that currently Viewed Product doesn't already exist in the `recently_viewed_products` table, INSERT it in
            DB::table('recently_viewed_products')->INSERT([ // Note: Here we use Laravel 'DB' facade because we didn't create a Model for the `recently_viewed_products` table, because we don't need it because we won't do much work with it. So we'll just ONLY DIRECTLY interact with the `recently_viewed_products` table using Laravel 'DB' facade
                'product_id' => $id,
                'session_id' => $session_id // $session_id comes from one of the two cases of the last if statement
            ]);
        }

        // Get Recently Viewed Products (Items) IDs
        $recentProductsIds = DB::table('recently_viewed_products')->select('product_id')->where('product_id', '!=', $id)->where('session_id', $session_id)->inRandomOrder()->get()->take(4)->pluck('product_id'); // take() is identical to limit(): https://laravel.com/docs/9.x/queries#limit-and-offset    // where('product_id', '!=', $id)    means exclude (EXCEPT) the currently viewed product (to not be repeated (to prevent repetition))    // Note: Here we use Laravel 'DB' facade because we didn't create a Model for the `recently_viewed_products` table, because we don't need it because we won't do much work with it. So we'll just ONLY DIRECTLY interact with the `recently_viewed_products` table using Laravel 'DB' facade

        // Get Recently Viewed Products (Items)
        $recentlyViewedProducts = \App\Models\Product::with('brand')->whereIn('id', $recentProductsIds)->get()->toArray(); // https://laravel.com/docs/9.x/collections#method-wherein AND https://laravel.com/docs/9.x/queries#additional-where-clauses



        // Managing Product Colors (in front/products/detail.blade.php)    
        // Get Group Code Products `group_code` column in `products` table (get the `group_code` of the product, if exists (if any))
        $groupProducts = array();
        if (!empty($productDetails['group_code'])) { // if the product has a `group_code`
            // Get all other products who also have the same `group_code`
            $groupProducts = \App\Models\Product::select('id', 'product_image')->where('id', '!=', $id)->where([ // where('id', '!=', $id)    means exclude (EXCEPT) the currently viewed product (to not be repeated (to prevent repetition))
                'group_code' => $productDetails['group_code'],
                'status'     => 1
            ])->get()->toArray();
        }


        // Show Ratings & Reviews in front/products/detail.blade.php    
        $ratings = \App\Models\Rating::with('user')->where([ // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'user' is the relationship method name in Rating.php model
            'product_id' => $id,
            'status'     => 1
        ])->paginate(9);

        // Calculate Average Rating (for a product):
        $ratingSum = \App\Models\Rating::where([
            'product_id' => $id,
            'status'     => 1
        ])->sum('rating');

        // Number of times a product has been rated by users
        $ratingCount = \App\Models\Rating::where([
            'product_id' => $id,
            'status'     => 1
        ])->count();

        if ($ratingCount > 0) { // if there's at least one rating for a product (if a product has been rated at least once)
            $avgRating     = round($ratingSum / $ratingCount, 2);
            $avgStarRating = round($ratingSum / $ratingCount); // for showing the "Stars" in HTML
        } else {
            $avgRating     = 0;
            $avgStarRating = 0;
        }

        // Calculate the count of Star Ratings for 1 Star, 2 Stars, 3 Stars, 4 Stars, and 5 Stars ratings (Each on its own)
        $ratingOneStarCount = \App\Models\Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 1
        ])->count();

        $ratingTwoStarCount = \App\Models\Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 2
        ])->count();

        $ratingThreeStarCount = \App\Models\Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 3
        ])->count();

        $ratingFourStarCount = \App\Models\Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 4
        ])->count();

        $ratingFiveStarCount = \App\Models\Rating::where([
            'product_id' => $id,
            'status'     => 1,
            'rating'     => 5
        ])->count();


        $totalStock = \App\Models\ProductsAttribute::where('product_id', $id)->sum('stock'); // sum() the `stock` column of the `products_attributes` table    // sum(): https://laravel.com/docs/9.x/collections#method-sum


        // Dynamic SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in front/layout/layout.blade.php    
        $meta_title       = $productDetails['meta_title'];
        $meta_description = $productDetails['meta_description'];
        $meta_keywords    = $productDetails['meta_keywords'];

        // dd($productDetails);
        return view('front.products.detail')->with(compact('productDetails', 'categoryDetails', 'totalStock', 'similarProducts', 'recentlyViewedProducts', 'groupProducts', 'meta_title', 'meta_description', 'meta_keywords', 'ratings', 'avgRating', 'avgStarRating', 'ratingOneStarCount', 'ratingTwoStarCount', 'ratingThreeStarCount', 'ratingFourStarCount', 'ratingFiveStarCount'));
    }

    // The AJAX call from front/js/custom.js file, to show the the correct related `price` and `stock` depending on the selected `size` (from the `products_attributes` table)) by clicking the size <select> box in front/products/detail.blade.php    
    public function getProductPrice(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)
            
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'], $data['color'], $data['size']); // $data['product_id'] and $data['size'] come from the 'data' object inside the $.ajax() method in front/js/custom.js file


            return $getDiscountAttributePrice;
        }
    }

    // Show all Vendor products in front/products/vendor_listing.blade.php    // This route is accessed from the <a> HTML element in front/products/vendor_listing.blade.php    
    public function vendorListing(Vendor $vendor, $data) { // Required Parameters: https://laravel.com/docs/9.x/routing#required-parameters
        // Get vendor shop name
        $getVendorShop = Vendor::getVendorShop($vendor->id);

        // Get all vendor products
        // $collection = Product::with('brand', 'vendor', 'attributes')->where('vendor_id', $vendor->id)->where('status', 1); // Eager Loading (using with() method): https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'brand' is the relationship method name in Product.php model that is being Eager Loaded

        $collection = $vendor->products();
        
        $catIds = $vendor->products()->pluck('category_id');
        $catDetails = Category::whereIn('id', $catIds)->where([
            'parent_id' => 0,
            'status'    => 1
        ])->with('subCategories')->get();

        if ($catDetails->count() > 0) {
            $catDetails = $catDetails->first()->toArray();
        } else {
            $catDetails = $catDetails->toArray();
        }

        
        $categoryDetails = [
            'catIds' => $catIds,
            'categoryDetails' => $catDetails,
        ];
        
        // Dynamic SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in front/layout/layout.blade.php    
        $meta_title       = "Kapiton {$vendor->name} Products";
        $meta_descriptions = $collection->get()->pluck('meta_description');
        $meta_description = implode($meta_descriptions->toArray());

        $meta_keywordss = $collection->get()->pluck('meta_keywords');
        $meta_keywords    = implode($meta_keywordss->toArray());
        
        $filters = $this->getAvailableFilters($catDetails, $collection);
        $collection = $this->processFilters($collection, $data);        

        return ["collection" => $collection, "filters" => $filters, "categoryDetails" => $categoryDetails, 
            "meta_title" => $meta_title, "meta_description" => $meta_description, "meta_keywords" => $meta_keywords,
        ];
    }

    // Add to Cart <form> submission in front/products/detail.blade.php    
    public function cartAdd(Request $request) {
        if ($request->isMethod('post')) { // if the Add to Cart <form> is submitted
            $data = $request->all();

            // Correcting an issue with Coupon Codes when adding an item to the Cart which already has items in it (added before)
            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data


            // Prevent the ability to add an item to the Cart with 0 zero quantity
            if ($data['quantity'] <= 0) { // if the ordered quantity is 0, convert it to at least 1
                $data['quantity'] = 1;
            }

            if (!isset($data['variation'])) {
                $prod_attribute = ProductsAttribute::where('product_id', $data['product_id'])->first();
                $getProductStock = $prod_attribute->stock;
                
                $data['color'] = $prod_attribute->color;
                $data['size'] = $prod_attribute->size;
            } else {
                // Check if the selected product `product_id` with that selected `size` have available `stock` in `products_attributes` table
                $getProductStock = ProductsAttribute::find($data['variation'])->stock;
            }

            if ($getProductStock < $data['quantity']) { // if the `stock` available (in `products_attributes` table) is less than the ordered quantity by user (the quantity that the user desires)
                return redirect()->back()->with('error_message', 'Required Quantity is not available!');
            }


            // Note: If the user is not authenticated/logged in (guest), we'll use their `session_id` to enable users to Add to Cart (in `carts` table) WITHOUT LOGIN, then after that, once the user logins/gets authenticated, we'll use their `user_id` (NOT their #session_id) in `carts` table    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)    
            // More explanation: We'll use Laravel's default Authentication Guard 'web' Guard (check config/auth.php)
            // Generate a $session_id if it doesn't exist:
            // Generate a session
            $session_id = Session::get('session_id'); // if the $session_id already exists
            if (empty($session_id)) { // if the session is empty (user is not logged in), create a random session id (for the 'Guest' user)    // https://laravel.com/docs/9.x/authentication#ecosystem-overview    // Determining If An Item Exists In The Session: https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session
                $session_id = Session::getId(); // Get the current session ID    // https://laravel.com/api/9.x/Illuminate/Contracts/Session/Session.html
                Session::put('session_id', $session_id);  // Store the current $session_id in the Session of the user    // Storing Data: https://laravel.com/docs/9.x/session#storing-data    
            }

            // Get $user_id and $countProducts in two cases. Check if the same product `product_id` with the same `size` already exists (was ordered by the same user depending on `user_id` or `session_id`) in Cart `carts` table in TWO cases: firstly, the user is authenticated/logged in, and secondly, the user is NOT logged in i.e. guest
            // To prevent repetition of the ordered Cart products `product_id` with the same sizes `size` for a certain user (`session_id` or `user_id` depending on whether the user is authenticated/logged in or not) in the `carts` table
            if (Auth::check()) { // Here we're using the default 'web' Authentication Guard    // if the user is authenticated/logged in (using the default Laravel Authentication Guard 'web' Guard (check config/auth.php file) whose 'Provider' is the User.php Model i.e. `users` table)    // Determining If The Current User Is Authenticated: https://laravel.com/docs/9.x/authentication#determining-if-the-current-user-is-authenticated
                $user_id = Auth::user()->id; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user

                // Check if that authenticated/logged in user has already THE SAME product `product_id` with THE SAME `size` (in `carts` table) in the Cart i.e. the `carts` table
                $countProducts = \App\Models\Cart::where([
                    'user_id'    => $user_id, // THAT EXACT authenticated/logged in user (using their `user_id` because they're authenticated/logged in)
                    'product_id' => $data['product_id'],
                    'color'      => $data['color'],
                    'size'       => $data['size']
                ])->count();

            } else { // if the user is NOT logged in (guest)
                // Check if that guest or NOT logged in user has already THE SAME products `product_id` with THE SAME `size` (in `carts` table) in the Cart i.e. the `carts` table    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)
                $user_id = 0; // is the same as    $user_id = null;    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)    // this is because that the use is NOT authenticated / NOT logged in i.e. guest 
                $countProducts = \App\Models\Cart::where([ // We get the count (number) of that specific product `product_id` with that specific `size` to prevent repetition in the `carts` table 
                    'session_id' => $session_id, // THAT EXACT NON-authenticated/NOT logged or Guest user (using their `session_id` because they're NOT authenticated/NOT logged in or Guest)
                    'product_id' => $data['product_id'],
                    'color'       => $data['color'],
                    'size'       => $data['size']
                ])->count();
            }



            // To prevent repetition of the ordered products `product_id` with the same sizes `size` for a certain user (`session_id` or `user_id` depending on whether the user is authenticated/logged in or not) in the `carts` table:
            if ($countProducts > 0) { // if that specific user (`session_id` or `user_id` i.e. depending on the user is authenticated/logged or not (guest)) ALREADY ordered that specific product `product_id` with that same exact `size`, we're going to just UPDATE the `quantity` in the `carts` table to prevent repetition of the ordered products inside the table (and won't create a new record)    // In other words, if the same product with the same size ALREADY EXISTS (ordered with the SAME user) in the `carts` table
                \App\Models\Cart::where([
                    'session_id' => $session_id, // THAT EXACT NON-authenticated/NOT logged or Guest user (using their `session_id` because they're NOT authenticated/NOT logged in or Guest)
                    'user_id'    => $user_id ?? 0, // if the user is authenticated/logged in, take its $user_id. If not, make it zero 0    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)
                    'product_id' => $data['product_id'],
                    'color'       => $data['color'],
                    'size'       => $data['size']
                ])->increment('quantity', $data['quantity']); // Add the new added quantity (    $data['quantity']    ) to the already existing `quantity` in the `carts` table    // Update Statements: Increment & Decrement: https://laravel.com/docs/9.x/queries#increment-and-decrement
            } else { // if that `product_id` with that `size` was never ordered by that user `session_id` or `user_id` (i.e. that product with that size for that user doesn't exist in the `carts` table), INSERT it into the `carts` table for the first time
                // INSERT the ordered product `product_id`, the user's session ID `session_id`, `size` and `quantity` in the `carts` table
                $item = new \App\Models\Cart; // the `carts` table

                $item->session_id = $session_id; // $session_id will be stored whether the user is authenticated/logged in or NOT
                $item->user_id    = $user_id; // depending on the last if statement (whether user is authenticated/logged in or NOT (guest))    // $user_id will be always zero 0 if the user is NOT authenticated/logged in    // When user logins, their `user_id` gets updated (check userLogin() method in UserController.php)
                $item->product_id = $data['product_id'];
                $item->color      = $data['color'];
                $item->size       = $data['size'];
                $item->quantity   = $data['quantity'];

                $item->save();
            }

            $getCartItems = \App\Models\Cart::getCartItems();

            return response()->json([
                'success' => true,
                'message' => 'Product has been added in Cart! <a href="/cart" style="text-decoration: underline !important">View Cart</a>',
                'view' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')),
            ]);
            // return redirect()->back()->with('success_message', 'Product has been added in Cart! <a href="/cart" style="text-decoration: underline !important">View Cart</a>');
        }
    }

    // Render Cart page (front/products/cart.blade.php)    
    public function cart() {
        // Get the Cart Items of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))    
        $getCartItems = \App\Models\Cart::getCartItems();

        // Static SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in front/layout/layout.blade.php    
        $meta_title       = 'Shopping Cart - Kapiton';
        $meta_keywords    = 'shopping cart, kapiton cart, kapiton e-commerce';


        return view('front.products.cart')->with(compact('getCartItems', 'meta_title', /* 'meta_description', */ 'meta_keywords'));
    }

    // Update Cart Item Quantity AJAX call in front/products/cart_items.blade.php. Check front/js/custom.js
    public function cartUpdate(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)


            // Correcting an issue with Coupon Codes when adding an item to the Cart which already has items in it (added before)
            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
        


            // Apply some conditions (and showing them in the view!) before Update-ing the Cart Item Quantity (making sure that the desired quantity is not more than (doesn't exceed) the available `stock` in `products_attributes` table, and that the desired product `size` is not disabled/inactive (`status` is not zero 0) in `products_attributes` table)    
            // Get user's Cart details
            $cartDetails = \App\Models\Cart::find($data['cartid']); // $data['cartid'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file

            // The 1st condition: Make sure that the desired quantity is not more than (doesn't exceed) the available `stock` in `products_attributes` table
            // Get available product `stock` from `products_attributes` table
            $availableStock = \App\Models\ProductsAttribute::select('stock')->where([
                'product_id' => $cartDetails['product_id'],
                'size'       => $cartDetails['size']
            ])->first()->toArray();

            if ($data['qty'] > $availableStock['stock']) { // if the user's desired quantity exceeds the available `stack` in `products_attributes` table    // $data['cartid'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                // Get the Cart Items (after UPDATE-ing the Cart Item Quantity) of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))
                $getCartItems = \App\Models\Cart::getCartItems();

                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'status'     => false,
                    'message'    => 'Product Stock is not available',
                    // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                    'view'       => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    

                    // We added this view later (Mini Cart Widget) (separate file)
                    'headerview' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                ]);
            }

            // The 2nd condition: Make sure that the desired product `size` is not disabled/inactive (`status` is not zero 0) in `products_attributes` table)
            // Get product `status` from `products_attributes` table
            $availableSize =  \App\Models\ProductsAttribute::where([
                'product_id' => $cartDetails['product_id'],
                'size'       => $cartDetails['size'],
                'status'     => 1 // making sure that product size is active/enabled
            ])->count();

            if ($availableSize == 0) { // if the desired product's `status` in `products_attributes` table is zero 0 (inactive/disabled)
                // Get the Cart Items (after UPDATE-ing the Cart Item Quantity) of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))
                $getCartItems = \App\Models\Cart::getCartItems();


                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'status'  => false,
                    'message' => 'Product Size is not available. Please remove this Product and choose another one!', // that size's `status` is zero 0 (inactive/disabled)
                    // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                    'view'    => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                    'headerview' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                ]);
            }


            // Update the `quantity` in `carts` table (after passing the last conditions and checks)
            \App\Models\Cart::where('id', $data['cartid'])->update([ // $data['cartid'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                'quantity' => $data['qty'] // $data['qty'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
            ]);


            // Get the Cart Items (after UPDATE-ing the Cart Item Quantity) of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))
            $getCartItems = \App\Models\Cart::getCartItems();
            $totalCartItems = totalCartItems(); // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred



            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data



            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                'status'         => true,
                'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                'view'           => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                'headerview' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
            ]);
        }
    }

    // Delete a Cart Item AJAX call in front/products/cart_items.blade.php. Check front/js/custom.js    
    public function cartDelete(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data


            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)


            // Delete the Cart Item
            \App\Models\Cart::where('id', $data['cartid'])->delete(); // $data['cartid'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file


            // Get the Cart Items (after DELETE-ing the Cart Item Quantity) of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))
            $getCartItems = \App\Models\Cart::getCartItems();
            $totalCartItems = totalCartItems(); // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred


            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                // 'status' => true,
                'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                'view'   => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                'headerview' => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
            ]);
        }
    }



    // Note: For Coupons module, user must be logged in (authenticated) to be able to redeem them. Both 'admins' and 'vendors' can add Coupons. Coupons added by 'vendor' will be available for their products ONLY, but ones added by 'admins' will be available for ALL products.
    // Coupon Code redemption (Apply coupon) / Coupon Code HTML Form submission via AJAX in front/products/cart_items.blade.php, check front/js/custom.js    
    public function applyCoupon(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call) (through the 'data' object)


            // We need to remove/empty (forget) the 'couponAmount' and 'couponCode' Session Variables (reset the whole process of Applying the Coupon) whenever a user applies a new coupon, or updates Cart items (changes items quantity for example) or deletes items from the Cart or even Adds new items in the Cart    
            Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
            Session::forget('couponCode');   // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data


            $getCartItems = \App\Models\Cart::getCartItems();
            $totalCartItems = totalCartItems(); // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred


            // Check the validity of the Coupon Code
            $couponCount = \App\Models\Coupon::where('coupon_code', $data['code'])->count(); // $data['code'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file

            if ($couponCount == 0) { // if the submitted coupon is wrong, send error message
                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'status'         => false,
                    'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                    'message'        => 'The coupon is invalid!',
                    // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                    'view'           => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                    'headerview'     => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                ]);

            } else { // if the submitted coupon is valid, check some conditions (do some validation)
                // SUBMITTED COUPON CODE VALIDATION:

                // Get the coupon submitted (via AJAX) details
                $couponDetails = \App\Models\Coupon::where('coupon_code', $data['code'])->first(); // $data['code'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file


                // Check if the submitted coupon code is active/inactive (enabled/disabled/activated/deactivated)
                if ($couponDetails->status == 0) {
                    $message = 'The coupon is inactive!';
                }


                // Check if the submitted coupon code is expired
                $expiry_date  = $couponDetails->expiry_date;
                $current_date = date('Y-m-d'); // this date format is understandable by MySQL
                
                if ($expiry_date < $current_date) {
                    $message = 'The coupon is expired!';
                }


                // Managing coupon types in `coupons` table: 'Single Time' or 'Multiple Times'
                if ($couponDetails->coupon_type == 'Single Time') { // if the `coupon_type` in `coupons` table is 'Single Time'
                    // Check in the `orders` table if the currently authenticated/logged-in user really used this Coupon Code with their order
                    $couponCount = \App\Models\Order::where([
                        'coupon_code' => $data['code'],
                        'user_id'     => Auth::user()->id // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                    ])->count();

                    if ($couponCount >= 1) { // if this 'Single Time' coupon code has been used/redeemed more than one single time by this user (this authenticated/logged-in user) (i.e. meaning that if that coupon code is already existing in the `orders` table and has been used/redeemed by this authenticated/logged-in user)
                        $message = 'This coupon code is already availed by you!';
                    }
                }


                // Check if the submitted coupon code belongs to the correct relevant selected categories and subcategories of the coupon in the Admin Panel (for example, if the coupon is for Smartphones Category, user can't use it while buying T-shirts)
                // Get the coupon's categories and subcategories (if any)
                $catArr = explode(',', $couponDetails->categories);
                
                $total_amount = 0;

                foreach ($getCartItems as $key => $item) {
                    if (!in_array($item['product']['category_id'], $catArr)) { // if the category of one of the products in the Cart doesn't belong to the Coupon's categories (the categories of the coupon selected by 'vendor' or 'admin' in the Admin Panel for the coupon)
                        $message = 'This coupon code selected categories is not for one of the selected products category!';
                    }

                    
                    $attrPrice = Product::getDiscountAttributePrice($item['product_id'], $item['color'], $item['size']);
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                }


                // Check if the coupon code submitted by user is not available for that user (in case the coupon is already selected for certain specific users selected by 'admin' or 'vendor' in the Coupons tab in Admin Panel, and it's not available for all users)
                // Get the coupon's selected users
                if (isset($couponDetails->users) && !empty($couponDetails->users)) {
                    $usersArr = explode(',', $couponDetails->users);    
                    // Check if the submitted coupon code is available ONLY for some specific users (from the Coupons tab in Admin Panel in 'Select User (by email):') and check if the coupon is available or not for the user submitting the coupon code
                    if (count($usersArr)) { // if there's at least a one specific selected user for the coupon
                        // Get user ids of all the selected users that the coupon code are available for them
                        foreach ($usersArr as $key => $user) {
                            $getUserId = \App\Models\User::select('id')->where('email', $user)->first()->toArray();
                            $usersId[] = $getUserId['id'];
                        }
    
                        foreach ($getCartItems as $item) {
                            if (!in_array($item['user_id'], $usersId)) { // if the user id of one of the products in the Cart doesn't belong to the Coupon's specifically selected users (to check if the submitted coupon code is available to the user submitting it or not)
                                $message = 'This coupon code is not available for you! Try again with a valid coupon code! (The coupon code is available only for certain selected users!)';
                            }
                        }
                    }
                }


                // Check if the submitted Coupon code belongs to the Vendor of that product (in case that a vendor (not an 'admin') added that coupon code, because vendor coupon codes are available ONLY for the products of that vendor, and not available for all other products. In contrast, 'Admin' coupon codes are available for ALL products)
                // Vendor's Coupons are eligible only for that vendor's products
                if ($couponDetails->vendor_id > 0) { // Check if submitted coupon code belongs to a 'vendor' (becasue a vendor' coupon is available ONLY for that vendor's products (not all products), whereas admin's coupons are available for all products)
                    // Get all the products ids of that very vendor
                    $productIds = \App\Models\Product::select('id')->where('vendor_id', $couponDetails->vendor_id)->pluck('id')->toArray();

                    foreach ($getCartItems as $item) {
                        if (!in_array($item['product']['id'], $productIds)) { // if the user id of one of the products in the Cart doesn't belong to the products ids of that vendor (to check if the submitted coupon code pertains to that specific/very vendor or not)
                            $message = 'This coupon code is not available for you! Try again with a valid coupon code! (vendor validation)!. The coupon code exists but one of the products in the Cart doesn\'t belong to that specific vendor who created/owns that Coupon!';
                        }
                    }
                }


                // If there's an error message with the submitted coupon code, send this response to the AJAX call
                if (isset($message)) {
                    return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                        'status'         => false,
                        'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                        'message'        => $message,
                        // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                        'view'           => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                        
                        'headerview'     => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                    ]);

                } else { // if the submitted coupon code is correct and passes the previous coupon code validation and passes all the previous if conditions (free of errors)
                    

                    // Check if the submitted Coupon code Amount Type is 'Fixed' or 'Percentage'
                    if ($couponDetails->amount_type == 'Fixed') { // if the submitted coupon code Amount Type is 'Fixed'
                        $couponAmount = $couponDetails->amount; // As is
                    } else { // if the submitted coupon code Amount Type is 'Percentage'
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }


                    $grand_total = $total_amount - $couponAmount;


                    // Assign the Coupon Code and $couponAmount to Session Variables
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode'  , $data['code']); // $data['code'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file

                    $message = 'Coupon Code successfully applied. You are availing discount!';


                    return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                        'status'         => true,
                        'totalCartItems' => $totalCartItems, // totalCartItems() function is in our custom Helpers/Helper.php file that we have registered in 'composer.json' file    // We created the CSS class 'totalCartItems' in front/layout/header.blade.php to use it in front/js/custom.js to update the total cart items via AJAX, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred
                        'couponAmount'   => $couponAmount,
                        'grand_total'    => $grand_total,
                        'message'        => $message,
                        // We'll use that array key 'view' as a JavaScript 'response' property to render the view (    $('#appendCartItems').html(resp.view);    ). Check front/js/custom.js
                        'view'           => (String) \Illuminate\Support\Facades\View::make('front.products.cart_items')->with(compact('getCartItems')), // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                        'headerview'     => (String) \Illuminate\Support\Facades\View::make('front.layout.header_cart_items')->with(compact('getCartItems')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
                    ]);
                }
            }
        }
    }



    // Checkout page (using match() method for the 'GET' request for rendering the front/products/checkout.blade.php page or the 'POST' request for the HTML Form submission in the same page) (for submitting the user's Delivery Address and Payment Method))    
    public function checkout(Request $request) {
        $this->lalamoveAPI_Helper = new LalamoveAPIBodyHelper;
        $paymongo = new PaymongoAPIHelper;

        // Fetch all of the world countries from the database table `countries`
        $countries = \App\Models\Country::where('status', 1)->get()->toArray(); // get the countries which have status = 1 (to ignore the blacklisted countries, in case)
        
        // Get the Cart Items of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))    
        $getCartItems = \App\Models\Cart::getCartItems();

        // If the Cart is empty (If there're no Cart Items), don't allow opening/accessing the Checkout page (checkout.blade.php)    
        if (count($getCartItems) == 0) {
            $message = 'Shopping Cart is empty! Please add products to your Cart to checkout';

            return redirect('cart')->with('error_message', $message); // redirect user to the cart.blade.php page, and show an error message in cart.blade.php
        }

        $vendor_model = new Vendor;
        $pickupAddresses = [];
        $categories = [];
        // Calculate the total price    
        $total_price  = 0;
        $total_weight = 0;
        $total_qty = 0;

        foreach ($getCartItems as $item) {
            array_push($categories, Category::find($item['product']['category_id'])->category_name);
            $attrPrice = Product::getDiscountAttributePrice($item['product_id'], $item['color'], $item['size']);
            $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']);
            $total_qty += $item['quantity'];



            // Get Pickup Address
            array_push($pickupAddresses, $vendor_model->where('id', $item['product']['vendor_id'])->with(['vendorbusinessdetails' => function ($q) {
                $q->select('vendor_id', 'shop_name', 'shop_mobile', 'lat', 'long')->selectRaw("CONCAT(shop_address, ', ', shop_city, ', ', shop_state, ', ', shop_country, ', ', shop_pincode) AS shop_fulladdress");
            }])->first()->toArray()['vendorbusinessdetails']);
            
            $product_weight = $item['product']['product_weight'];
            $total_weight = $total_weight + ($product_weight * $item['quantity']);
        }

        $deliveryAddresses = \App\Models\DeliveryAddress::deliveryAddresses(); // the delivery addresses of the currently authenticated/logged in user

        if (count($deliveryAddresses) == 0) {
            return redirect('/user/delivery-addresses')->withErrors("Please add your first address.");
        }

        $deliveryAddresses_countries = array_unique(Arr::pluck($deliveryAddresses, 'country'));
        $delivery_shipping_charges = \App\Models\ShippingCharge::whereIn('country', $deliveryAddresses_countries)->count();
        if ($delivery_shipping_charges < count($deliveryAddresses_countries)) {
            return redirect('/user/delivery-addresses')->withErrors("One or more selected coutry from your delivery addresses is not yet available for shipping.");
        }

        $selectedDeliveryAddress = null; $shipping_charges = 0;
        // Calculating the Shipping Charges of every one of the user's Delivery Addresses (depending on the 'country' of the Delivery Address)    
        foreach ($deliveryAddresses as $key => $value) {
            $shippingCharges = \App\Models\ShippingCharge::getShippingCharges($total_weight, $value['country']);

            $selectedDeliveryAddress = $value;
            $this->lalamoveAPI_Helper->setQuoteData(compact("selectedDeliveryAddress", "pickupAddresses", "total_weight", "total_qty", "categories", "getCartItems"))->getTotal_PriceBreakdown();
            // Append/Add the Shipping Charge of every Delivery Address (depending on the 'country' of the Delivery Addresss) to the $deliveryAddresses array
            $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges + $this->lalamoveAPI_Helper->total_delivery_fee;
            if ($request->isMethod('post')) {
                if ($value['id'] == $request->address_id)
                    $shipping_charges = $this->lalamoveAPI_Helper->total_delivery_fee;
            } else {
                if ($key == 0) $shipping_charges = $this->lalamoveAPI_Helper->total_delivery_fee;
            }

            // Checking PIN code availability of BOTH COD and Prepaid PIN codes in BOTH `cod_pincodes` and `prepaid_pincodes` tables    
            // Check if the COD PIN code of that Delivery Address of the user exists in `cod_pincodes` table    
            $deliveryAddresses[$key]['codpincodeCount'] = DB::table('cod_pincodes')->where('pincode', $value['pincode'])->count(); // Note that    $value['pincode']    denotes the `pincode` of the `delivery_addresses` table

            // Check if the Prepaid PIN code of that Delivery Address of the user exists in `prepaid_pincodes` table    
            $deliveryAddresses[$key]['prepaidpincodeCount'] = DB::table('prepaid_pincodes')->where('pincode', $value['pincode'])->count(); // Note that    $value['pincode']    denotes the `pincode` of the `delivery_addresses` table
        }

        if ($request->isMethod('post')) { // if the <form> in front/products/checkout.blade.php is submitted (the HTML Form that the user submits to submit their Delivery Address and Payment Method)
            $data = $request->all();

            // Website Security
            // Note: We need to prevent orders (upon checkout and payment) of the 'disabled' products (`status` = 0), where the product ITSELF can be disabled in admin/products/products.blade.php (by checking the `products` database table) or a product's attribute (`stock`) can be disabled in 'admin/attributes/add_edit_attributes.blade.php' (by checking the `products_attributes` database table). We also prevent orders of the out of stock / sold-out products (by checking the `products_attributes` database table)
            foreach ($getCartItems as $item) {
                // Prevent 'disabled' (`status` = 0) products from being ordered (if it's disabled in admin/products/products.blade.php) by checking the `products` database table
                $product_status = Product::getProductStatus($item['product_id']);
                if ($product_status == 0) { // if the product is disabled (`status` = 0)
                    $message = $item['product']['product_name'] . ' with ' . $item['size'] . ' size is not available. Please remove it from the Cart and choose another product.';
                    return response()->json([
                        'success' => false,
                        'message' => $message,
                        'data' => [
                            'redirect' => true,
                            'url' => url('/cart')
                        ]
                    ]); // Redirect to the Cart page with an error message
                }
            }

            // Preventing out of stock / sold out products from being ordered (by checking the `products_attributes` database table)
            $getProductStock = ProductsAttribute::getProductStock($item['product_id'], $item['color'], $item['size']); // A product (`product_id`) with a certain `size`
            if ($getProductStock == 0) { // if the product's `stock` is 0 zero
                $message = $item['product']['product_name'] . ' with ' . $item['size'] . ' size is not available. Please remove it from the Cart and choose another product.';
                return response()->json([
                        'success' => false,
                        'message' => $message,
                        'data' => [
                            'redirect' => true,
                            'url' => url('/cart')
                        ]
                    ]); // Redirect to the Cart page with an error message
            }

            // Preventing the products with 'disabled' Product Attributes (in admin/attributes/add_edit_attributes.blade.php) from being ordered (by checking the `products_attributes` database table)
            $getAttributeStatus = ProductsAttribute::getAttributeStatus($item['product_id'], $item['size']); // A product (`product_id`) with a certain `size`
            if ($getAttributeStatus == 0) { // if the product's `stock` is 0 zero
                $message = $item['product']['product_name'] . ' with ' . $item['size'] . ' size is not available. Please remove it from the Cart and choose another product.';
                return response()->json([
                        'success' => false,
                        'message' => $message,
                        'data' => [
                            'redirect' => true,
                            'url' => url('/cart')
                        ]
                    ]); // Redirect to the Cart page with an error message
            }

            // Note: We also prevent making orders of the products of the Categories that are disabled (`status` = 0) (whether the Category is a Child Category or a Parent Category (Root Category) is disabled) in admin/categories/categories.blade.php
            $getCategoryStatus = Category::getCategoryStatus($item['product']['category_id']);
            if ($getCategoryStatus == 0) { // if the Category is disabled (`status` = 0)
                $message = $item['product']['product_name'] . ' with ' . $item['size'] . ' size is not available. Please remove it from the Cart and choose another product.';
                return response()->json([
                        'success' => false,
                        'message' => $message,
                        'data' => [
                            'redirect' => true,
                            'url' => url('/cart')
                        ]
                    ]); // Redirect to the Cart page with an error message
            }

            // Validation:
            // Delivery Address Validation
            if (empty($data['address_id'])) { // if the user doesn't select a Delivery Address
                $message = 'Please select Delivery Address!';

                // return redirect()->back()->with('error_message', $message);
                return response()->json([
                    'success' => false,
                    'message' => $message
                ]);
            }

            // Payment Method Validation
            if (empty($data['payment_gateway'])) { // if the user doesn't select a Delivery Address
                $message = 'Please select Payment Method!';

                // return redirect()->back()->with('error_message', $message);
                return response()->json([
                    'success' => false,
                    'message' => $message
                ]);
            }

            // Agree to T&C (Accept Terms and Conditions) Validation
            if (empty($data['accept'])) { // if the user doesn't select a Delivery Address
                $message = 'Please agree to T&C!';

                // return redirect()->back()->with('error_message', $message);
                return response()->json([
                    'success' => false,
                    'message' => $message
                ]);
            }


            // If user passes Validation, we start Placing Order:


            // Note: For the Orders module, we created two database tables: orders and orders_products tables. The first one holds/stores the main information about the orders of a user (e.g. delivery address, coupon code, shipping, payment method, ...etc), and the second one holds/stores the detailed information about the order (the items/products that are bought by the order and product name, code, color, size, price, ...etc). There is a one-to-many relationship between the two tables where one order can have many order products.


            // Now, we'll collect the necessary data to fill in the `orders` and `orders_products` database tables    

            // Get the Delivery Address from    $data['address_id']
            $deliveryAddress = \App\Models\DeliveryAddress::where('id', $data['address_id'])->first()->toArray();
            // dd($deliveryAddress);

            
            // If the selected `payment_gateway` is 'COD', set the `payment_method` as 'COD' too (and `order_status` is 'New'), otherwise it's always 'prepaid' (and `order_status` is 'Pending')
            if ($data['payment_gateway'] == 'COD') {
                $payment_method = 'COD';
                $order_status   = 'New';

            } else { // if the user selects any `payment_gateway` other than 'COD', this means that the `payment_method` is 'prepaid'  (and `order_status` is 'pending')
                $payment_method = 'Prepaid';
                $order_status   = 'Pending'; // And after payment confirmation, `order_status` becomes 'Payment Captured'. (We'll create the API that will convert this to either 'Payment Captured' or 'Canceled')
            }


            // Note: !!DATABASE TRANSACTION!! Firstly, we'll save the order in the `orders` table, then take the newly generated order `id` to use it to fill in the `order_id` column in the `orders_products` table, and fill in the `orders_products` table    
            // Database Transactions: https://laravel.com/docs/9.x/database#database-transactions
            DB::beginTransaction();

            // Calculate Subtotal, Grand Total `grand_total` and Coupon Discount `coupon_amount` (to fill in the `orders` table)
            // Calculate Grand Total `grand_total
            // Get the Total Price (the 'Subtotal')
            $total_price = 0;
            foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['color'], $item['size']); // from the `products_attributes` table, not the `products` table
                $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']);
            }

            // Calculate Shipping Charges `shipping_charges`
            // Get the Shipping Charge based on the chosen Delivery Address    
            $shipping_charges += \App\Models\ShippingCharge::getShippingCharges($total_weight, $deliveryAddress['country']);

            // Grand Total (`grand_total`)
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');

            // Store the $grand_total in Session to be able to use it wherever we need it later on (for example, it'll be used in front/paypal/paypal.blade.php and front/iyzipay/iyzipay.blade.php)
            Session::put('grand_total', $grand_total); // Storing Data: https://laravel.com/docs/10.x/session#storing-data


            // INSERT the data we collected INTO the `orders` database table
            $order = new \App\Models\Order; // Create a new Order.php model object (represents the `orders` table)

            // Assign the $order data to be INSERT-ed INTO the `orders` table
            $order->user_id          = Auth::user()->id; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
            $order->name             = $deliveryAddress['name'];
            $order->address          = $deliveryAddress['address'];
            $order->city             = $deliveryAddress['city'];
            $order->state            = $deliveryAddress['state'];
            $order->country          = $deliveryAddress['country'];
            $order->pincode          = $deliveryAddress['pincode'];
            $order->lat          = $deliveryAddress['lat'];
            $order->lng          = $deliveryAddress['lng'];
            $order->mobile           = $deliveryAddress['mobile'];
            $order->email            = Auth::user()->email; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
            $order->shipping_charges = $shipping_charges;
            $order->total_weight     = $total_weight;
            $order->coupon_code      = Session::get('couponCode');   // it was set inside applyCoupon() method
            $order->coupon_amount    = Session::get('couponAmount'); // it was set inside applyCoupon() method
            $order->order_status     = $order_status;
            $order->payment_method   = $payment_method;
            $order->payment_gateway  = $data['payment_gateway'];
            $order->grand_total      = $grand_total;

            $order->save(); // INSERT data INTO the `orders` table

            // Get the last generated `id` of the the last inserted order in the `orders` table (to be able to store it in the `order_id` column in the `orders_products` table)
            $order_id = DB::getPdo()->lastInsertId();


            // INSERT/Fill in the data of the order in the `orders_products` table (after filling in the `orders` table)
            foreach ($getCartItems as $cartKey => $item) {
                $cartItem = new \App\Models\OrdersProduct; // Create a new OrdersProduct.php model object (represents the `orders_products` table)

                // Assign the order product/item data to be INSERT-ed INTO the `orders_products` table
                $cartItem->order_id = $order_id;
                $cartItem->user_id  = Auth::user()->id; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user

                // Get some product details of the Cart Items from the `products` table (to be able to fill in data in the `orders_products` table)
                $getProductDetails = Product::select('product_code', 'product_name', 'admin_id', 'vendor_id')->where('id', $item['product_id'])->first()->toArray();

                // Continue filling in data into the `orders_products` table
                $cartItem->admin_id        = $getProductDetails['admin_id'];
                $cartItem->vendor_id       = $getProductDetails['vendor_id'];

                
                if ($getProductDetails['vendor_id'] > 0) { // if the order product's seller is a 'vendor'
                    $vendorCommission = Vendor::getVendorCommission($getProductDetails['vendor_id']);
                    $cartItem->commission  = $vendorCommission;
                }

                $cartItem->product_id      = $item['product_id'];
                $cartItem->product_code    = $getProductDetails['product_code'];
                $cartItem->product_name    = $getProductDetails['product_name'];
                $cartItem->product_color   = $item['color'];
                $cartItem->product_size    = $item['size'];
                $cartItem->item_status     = "New";

                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['color'], $item['size']); // from the `products_attributes` table, not the `products` table
                $cartItem->product_price   = $getDiscountAttributePrice['final_price'];
                $item['product']['product_price'] = $getDiscountAttributePrice['final_price'];


                
                $getProductStock = ProductsAttribute::getProductStock($item['product_id'], $item['color'], $item['size']);
                if ($item['quantity'] > $getProductStock) { // if the ordered quantity is greater than the existing stock, cancel the order/opertation
                    $message = $getProductDetails['product_name'] . ' with ' . $item['size'] . ' size stock is not available/enough for your order. Please reduce its quantity and try again!';

                    return redirect('/cart')->with('error_message', $message); // Redirect to the Cart page with an error message
                }


                $cartItem->product_qty     = $item['quantity'];

                $cartItem->save(); // INSERT data INTO the `orders_products` table


                // Inventory Management - Reduce inventory/stock when an order gets placed
                // We wrote the Inventory/Stock Management script in TWO places: in the checkout() method in Front/ProductsController.php and in the success() method in Front/PaypalController.php
                $getProductStock = ProductsAttribute::getProductStock($item['product_id'], $item['color'], $item['size']); // Get the `stock` of that product `product_id` with that specific `size` from `products_attributes` table
                $newStock = $getProductStock - $item['quantity']; // The new product `stock` is the original stock reduced by the order `quantity`
                ProductsAttribute::where([ // Update the new `quantity` in the `products_attributes` table
                    'product_id' => $item['product_id'],
                    'size'       => $item['size']
                ])->update(['stock' => $newStock]);
                $getCartItems[$cartKey] = $item;
            }


            // Store the `order_id` in Session so that we can use it in front/products/thanks.blade.php, thanks() method, paypal() method in Front/PayPalController.php and pay() method in Front/IyzipayController.php
            Session::put('order_id', $order_id); // Storing Data: https://laravel.com/docs/9.x/session#storing-data


            DB::commit(); // commit the Database Transaction

            // Send placing an order confirmation email to the user    
            // Note: We send placing an order confirmation email and SMS to the user right away (immediately) if the order is "COD", but if the order payment method is like PayPal or any other payment gateway, we send the order confirmation email and SMS after the user makes the payment
            $orderDetails = \App\Models\Order::with('orders_products')->where('id', $order_id)->first()->toArray(); // Eager Loading: https://laravel.com/docs/9.x/eloquent-relationships#eager-loading    // 'orders_products' is the relationship method name in Order.php model
            
            if ($data['payment_gateway'] == 'COD') { // if the `payment_gateway` selected by the user is 'COD' (in front/products/checkout.blade.php), we send the placing the order confirmation email and SMS immediately
                // Sending the Order confirmation email
                $email = Auth::user()->email; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'        => $email,
                    'name'         => Auth::user()->name, // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                    'order_id'     => $order_id,
                    'orderDetails' => $orderDetails
                ];

                \Illuminate\Support\Facades\Mail::send('emails.order', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.order' is the order.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that order.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Order Placed - Kapiton Store');
                });

                /*
                // Sending the Order confirmation SMS
                // Send an SMS using an SMS API and cURL    
                $message = 'Dear Customer, your order ' . $order_id . ' has been placed successfully with MultiVendorEcommerceApplication.com.eg. We will inform you once your order is shipped';
                // $mobile = $data['mobile']; // the user's mobile that they entered while submitting the registration form
                $mobile = Auth::user()->moblie; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                \App\Models\Sms::sendSms($message, $mobile); // Send the SMS
                */


                // PayPal payment gateway integration in Laravel
            } elseif ($data['payment_gateway'] == 'paymongo') {
                $resp = $paymongo->setItems($getCartItems)
                    ->setDeliveryFee($shipping_charges)->computeTransactionFee()
                    ->set("description", "Kapiton Store - " . Auth::user()->email . " bought items with a total of {$grand_total}.")
                    ->set("payment_method_types", ["card", "brankas_bdo", "gcash", "grab_pay", "paymaya"])
                    ->set("billing", [
                        'address' => [
                            'line 1' => $deliveryAddress['address'],
                            'line 2' => "",
                            "city" => $deliveryAddress['city'],
                            "state" => $deliveryAddress['state'],
                            "postal_code" => $deliveryAddress['country'],
                            "country" => "PH",
                        ],
                        'name' => $deliveryAddress['name'],
                        "email" => Auth::user()->email,
                        "phone" => $deliveryAddress['mobile']
                    ])
                    ->createSession();
                
                // create response for frontend
                $return_respose = [
                    'success' => false,
                    'message' => $resp['message']
                ];

                if ($resp['success'] === true) {
                    // Process the payment status here
                    $payment = new \App\Models\Payment;

                    $payment->order_id       = $order->id; // 'user_id' was stored in Session inside checkout() method in Front/ProductsController.php    // Interacting With The Session: Retrieving Data: https://laravel.com/docs/9.x/session#retrieving-data    // Comes from our website
                    $payment->user_id        = $order->user_id; // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user    // Comes from our website
                    $payment->payment_id     = $resp['data']['reference_number']; // Comes from Paymongo Checkout Session API (i.e. API / backend)    // Comes from PayPal website (i.e. API / backend)
                    $payment->payer_email    = $order->email;  
                    $payment->amount         = $order->grand_total; 
                    $payment->currency       = "PHP";
                    $payment->payment_status = "chargeable";

                    $payment->save();
                    // ...
                    
                    $return_respose['status'] = "success";
                    $return_respose['data'] = $resp['data'];
                } else {
                    $order->delete();
                    $return_respose['status'] = "failed";
                }

                return response()->json($return_respose);

                // iyzico Payment Gateway integration in/with Laravel    
            } else { // if the `payment_gateway` selected by the user is not 'COD', meaning it's like PayPal, Prepaid, ... (in front/products/checkout.blade.php), we send the placing the order confirmation email and SMS after the user makes the payment
                echo 'Other Prepaid payment methods coming soon';
            }


            return [
                'success' => true
            ]; // redirect to front/products/thanks.blade.php page
        }

        $sub_total = number_format($total_price, 2);
        $delivery_fee = $shipping_charges;
        $total_price += $delivery_fee;
        $est_transaction_fee = $total_price * 0.05;
        $total_price += $est_transaction_fee;
        $total_price = number_format($total_price, 2);
        
        return view('front.products.checkout')->with(compact('deliveryAddresses', 'countries', 'getCartItems', 'sub_total', 'delivery_fee', 'total_price', 'est_transaction_fee'));
    }

    // Rendering Thanks page (after placing an order)    
    public function thanks() {
        if (Session::has('order_id')) { // if there's an order has been placed, empty the Cart (remove the order (the cart items/products) from `carts`table)    // 'user_id' was stored in Session inside checkout() method in Front/ProductsController.php
            // We empty the Cart after placing the order
            \App\Models\Cart::where('user_id', Auth::user()->id)->delete(); // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user


            return view('front.products.thanks');
        } else { // if there's no order has been placed
            return redirect('cart'); // redirect user to cart.blade.php page
        }
    }



    // PIN code Availability Check: check if the PIN code of the user's Delivery Address exists in our database (in both `cod_pincodes` and `prepaid_pincodes`) or not in front/products/detail.blade.php via AJAX. Check front/js/custom.js    
    public function checkPincode(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)


            // Checking PIN code availability of BOTH COD and Prepaid PIN codes in BOTH `cod_pincodes` and `prepaid_pincodes` tables    
            // Check if the COD PIN code of that Delivery Address of the user exists in `cod_pincodes` table    
            $codPincodeCount = DB::table('cod_pincodes')->where('pincode', $data['pincode'])->count(); // $data['pincode'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
    
            // Check if the Prepaid PIN code of that Delivery Address of the user exists in `prepaid_pincodes` table    
            $prepaidPincodeCount = DB::table('prepaid_pincodes')->where('pincode', $data['pincode'])->count(); // $data['pincode'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file

            // Check if the entered PIN code exists in BOTH `cod_pincodes` and `prepaid_pincodes` tables
            if ($codPincodeCount == 0 && $prepaidPincodeCount == 0) {
                echo 'This pincode is not available for delivery';
            } else {
                echo 'This pincode is available for delivery';
            }
        }
    }

    private function getCollectionBySection($section, $data) {
        $sectionModel = new \App\Models\Section;
        if ($section !== "all") {
            $sectionCategories = $sectionModel->whereRaw('LOWER(name) = ?', [strtolower($section)])->where('status', 1);
            
            $collection = Product::getProductsBySectionName($section);
        } else {
            $sectionCategories = $sectionModel->where('status', 1);

            $collection = Product::where('status', 1)->with('vendor');
        }

        if ($sectionCategories->count() > 0) {
            $catIds = Category::whereIn('id', $sectionCategories->get()->pluck('id')->toArray())->get()->pluck('id')->toArray();
            $catDetails = $sectionCategories->with('categories')->get()->toArray();
            
            $categoryDetails = [
                'catIds' => $catIds,
                'categoryDetails' => $catDetails
            ];
        } else {
            return false;
        }

        $meta_title       = "Kapiton $section Collection";
        
        $meta_descriptions = $collection->get()->pluck('meta_description');
        $meta_description = implode($meta_descriptions->toArray());

        $meta_keywordss = $collection->get()->pluck('meta_keywords');
        $meta_keywords    = implode($meta_keywordss->toArray());

        $filters = $this->getAvailableFilters($catDetails, $collection);

        $collection = $this->processFilters($collection, $data);

        return ["collection" => $collection, "filters" => $filters, "categoryDetails" => $categoryDetails, 
            "meta_title" => $meta_title, "meta_description" => $meta_description, "meta_keywords" => $meta_keywords,
        ];
    }

    private function getCollectionByCategory($category, $data) {
        // $_GET['sort'] = $data['sort'];
        // dd($url);
        $categoryCount = Category::where([
            'url'    => $category,
            'status' => 1
        ])->count();
        // dd($categoryCount);

        if ($categoryCount > 0) { // if the category entered as a URL in the browser address bar exists
            // Get the entered URL in the browser address bar category details
            $categoryDetails = Category::categoryDetails($category); // get the categories of the opened $url (get categories depending on the $url)

            $collection = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1); // moving the paginate() method after checking for the sorting filter <form>    // Paginating Eloquent Results: https://laravel.com/docs/9.x/pagination#paginating-eloquent-results    // Displaying Pagination Results Using Bootstrap: https://laravel.com/docs/9.x/pagination#using-bootstrap        // https://laravel.com/docs/9.x/queries#additional-where-clauses    // using the brand() relationship method in Product.php

            // Sorting Filter WITHOUT AJAX (using HTML <form> and jQuery) in front/products/listing.blade.php
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {// if the URL query string parameters contain '&sort=someValue'    // 'sort' is the 'name' HTML attribute of the <select> box
                if ($_GET['sort'] == 'product_latest') {
                    $collection->orderBy('products.id', 'Desc');
                } elseif ($_GET['sort'] == 'price_lowest') {
                    $collection->orderBy('products.product_price', 'Asc');
                } elseif ($_GET['sort'] == 'price_highest') {
                    $collection->orderBy('products.product_price', 'Desc');
                } elseif ($_GET['sort'] == 'name_z_a') {
                    $collection->orderBy('products.product_name', 'Desc');
                } elseif ($_GET['sort'] == 'name_a_z') {
                    $collection->orderBy('products.product_name', 'Asc');
                }
            }

            $filters = $this->getAvailableFilters($categoryDetails['categoryDetails'], $collection);
            $collection = $this->processFilters($collection, $data);

            // Dynamic SEO (HTML meta tags): Check the HTML <meta> tags and <title> tag in front/layout/layout.blade.php    
            $meta_title       = $categoryDetails['categoryDetails']['meta_title'];
            $meta_description = $categoryDetails['categoryDetails']['meta_description'];
            $meta_keywords    = $categoryDetails['categoryDetails']['meta_keywords'];

            return ["collection" => $collection, "filters" => $filters, "categoryDetails" => $categoryDetails, 
                "meta_title" => $meta_title, "meta_description" => $meta_description, "meta_keywords" => $meta_keywords,
            ];

        } else {
            abort(404); // we will create the 404 page later on    // https://laravel.com/docs/9.x/helpers#method-abort
        }
    }

    /**
     * Get Available Filters
     * will return available filters depending on section/category/vendor
     * 
     * @return array $filters
     */
    private function getAvailableFilters($categoryDetails, $products) {
        
        $selection = $products->select('*')->with(['brand', 'attributes' => function($query) {
            return $query->select('product_id','size');
        }, 'vendor'])->get()->toArray();
        
        $filters = [];

        if (isset($categoryDetails['categories']))
            // check for categories
            $filters['categories'] = $categoryDetails['categories'];
        elseif (isset($categoryDetails['category_name'])) 
            $filters['categories'] = [$categoryDetails];
        else {
            $temp = collect($categoryDetails)->pluck('categories')->toArray();
            $filters['categories'] = array_merge(...$temp);
        }

        // dd($filters);
        // check for brands
        $filters['brands'] = collect($selection)->pluck('brand.name')->unique()->toArray();
        
        // check for sizes
        $filters['sizes'] = collect($selection)->pluck('attributes.*.size')->flatten()->unique()->toArray();

        // check for color
        $filters['color'] = collect($selection)->pluck('product_color')->unique()->toArray();
        

        return $filters;
    }

    private function old_processFilters($categoryProducts, $data) {
        // We used TWO ways to OPERATE the Dynamic Filters (on the left side of the listing.blade.php page): statically for every filter using jQuery and dynamically from Admin Panel. Here we use the first way (for the 'fabric' filter only):    // Check front/js/custom.js    
            // Note: the checked checkboxes <input> fields will be submitted as an ARRAY because we used SQUARE BRACKETS [] with the "name" HTML attribute in the checkbox <input> field in filters.blade.php e.g.    'fabric' => ['cotton', 'polyester']    , or else, AJAX is used to send the <input> values WITHOUT submitting the <form> at all    // Sidenote: There are TWO ways to submit a <form> to the backed: firstly, the regular one using the <button type="submit">, secondly, using AJAX by sending the "value" attributes of the <input> fields

            // The second way to operate the Dynamic Filters    
            // Note: the checked checkboxes <input> fields will be submitted as an ARRAY because we used SQUARE BRACKETS [] with the "name" HTML attribute in the checkbox <input> field in filters.blade.php e.g.    'fabric' => ['cotton', 'polyester']    , or else, AJAX is used to send the <input> values WITHOUT submitting the <form> at all    // Sidenote: There are TWO ways to submit a <form> to the backed: firstly, the regular one using the <button type="submit">, secondly, using AJAX by sending the "value" attributes of the <input> fields
            $productFilters = \App\Models\ProductsFilter::productFilters(); // Get all the (enabled/active) Filters    // (Another way to go is using an AJAX call to get the $productFilters!)
            foreach ($productFilters as $key => $filter) {
                if (isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])) {
                    $categoryProducts->whereIn($filter['filter_column'], $data[$filter['filter_column']]); // `products.fabric` means the `fabric` column in the `products` table    // $data['fabric'] is an ARRAY like    $data['fabric'] = ['cotton', 'polyester'] (because the checked checkboxes <input> fields will be submitted as an ARRAY because we used SQUARE BRACKETS [] with the "name" HTML attribute in the checkbox <input> field in filters.blade.php, or else, AJAX is used to send the <input> values WITHOUT submitting the <form> at all)    // https://laravel.com/docs/9.x/queries#additional-where-clauses
                }
            }

            // Size, price, color, brand, … are also Dynamic Filters, but won't be managed like the other Dynamic Filters, but we will manage every filter of them from the suitable respective database table, like the 'size' Filter from the `products_attributes` database table, 'color' Filter and `price` Filter from `products` table, 'brand' Filter from `brands` table
            // First: the 'size' filter (from `products_attributes` database table)
            if (isset($data['size']) && !empty($data['size'])) { // coming from the AJAX call in front/js/custom.js    // example:    $data['size'] = 'Large'
                $productIds = \App\Models\ProductsAttribute::select('product_id')->whereIn('size', $data['size'])->pluck('product_id')->toArray(); // fetch the products ids of the $data['size'] from the `products_attributes` table

                $categoryProducts->whereIn('products.id', $productIds); // `products.id` means that `products` is the table name (means grab the `id` column of the `products` table)
            }

            
            // Size, price, color, brand, … are also Dynamic Filters, but won't be managed like the other Dynamic Filters, but we will manage every filter of them from the suitable respective database table, like the 'size' Filter from the `products_attributes` database table, 'color' Filter and `price` Filter from `products` table, 'brand' Filter from `brands` table
            // Second: the 'color' filter (from `products` database table)
            if (isset($data['color']) && !empty($data['color'])) { // coming from the AJAX call in front/js/custom.js    // example:    $data['color'] = 'Large'
                $productIds = \App\Models\Product::select('id')->whereIn('product_color', $data['color'])->pluck('id')->toArray(); // fetch the products ids of the $data['color'] from the `products` table

                $categoryProducts->whereIn('products.id', $productIds); // `products.id` means that `products` is the table name (means grab the `id` column of the `products` table)
            }

            // Size, price, color, brand, … are also Dynamic Filters, but won't be managed like the other Dynamic Filters, but we will manage every filter of them from the suitable respective database table, like the 'size' Filter from the `products_attributes` database table, 'color' Filter and `price` Filter from `products` table, 'brand' Filter from `brands` table
            // Third: the 'price' filter (from `products` database table)
            // checking for Price
            $productIds = array();

            if (isset($data['price']) && !empty($data['price'])) {
                foreach($data['price'] as $key => $price){
                    $priceArr = explode('-', $price); // Example: First loop iteration: 0, 1000    then Second loop iteration: 1000, 2000, ...etc
                    if (isset($priceArr[0]) && isset($priceArr[1])) { // Example: First loop iteration: 0, 1000    then Second loop iteration: 1000, 2000, ...etc
                        $productIds[] = \App\Models\Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray(); // fetch the products ids of the range $priceArr[0] and $priceArr[1] (whereBetween() method) from the `products` table    // whereBetween(): https://laravel.com/docs/9.x/queries#additional-where-clauses    // e.g.    [    [2], [4, 5], [6]    ]
                    }
                }

                $productIds = array_unique(\Illuminate\Support\Arr::flatten($productIds)); // Arr::flatten(): https://laravel.com/docs/9.x/helpers#method-array-flatten    // We use array_unique() function to eliminate any repeated product ids
                $categoryProducts->whereIn('products.id', $productIds);
            }                    



            
            // Size, price, color, brand, … are also Dynamic Filters, but won't be managed like the other Dynamic Filters, but we will manage every filter of them from the suitable respective database table, like the 'size' Filter from the `products_attributes` database table, 'color' Filter and `price` Filter from `products` table, 'brand' Filter from `brands` table
            // Fourth: the 'brand' filter (from `products` and `brands` database table)
            if (isset($data['brand']) && !empty($data['brand'])) { // coming from the AJAX call in front/js/custom.js    // example:    $data['brand'] = 'Large'
                $productIds = \App\Models\Product::select('id')->whereIn('brand_id', $data['brand'])->pluck('id')->toArray(); // fetch the products ids with `brand_id` of $data['brand'] from the `products` table

                $categoryProducts->whereIn('products.id', $productIds); // `products.id` means that `products` is the table name (means grab the `id` column of the `products` table)
            }
    }

    private function processFilters($collection, $data) {
        if ($data !== null) {
            if (isset($data['color'])) {
                $collection->orWhereIn('product_color', $data['color']);
            }
    
            if (isset($data['brands'])) {
                $brandModel = new Brand;
                $brandIds = $brandModel->select('id')->whereIn('name', $data['brands'])->get()->pluck('id')->toArray();
                $collection->orWhereIn('brand_id', $brandIds);
            }
    
            if (isset($data['sizes'])) {
                $prodAttributeModel = new ProductsAttribute;
                $attributeIds = $prodAttributeModel->whereIn('size', $data['sizes'])->get()->pluck('product_id')->toArray();
                $collection->orWhereIn('id', $attributeIds);
            }
    
            // features
            $productFilters = ProductsFilter::productFilters(); // Get all the (enabled/active) Filters    // (Another way to go is using an AJAX call to get the $productFilters!)
            foreach ($productFilters as $key => $filter) {
                if (isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])) {
                    $collection->whereJsonContains("features->".$filter['filter_column'], $data[$filter['filter_column']]);
                }
            }

            if (isset($data['sortby'])) {
                // sorts
                switch ($data['sortby']) {
                    case 'date-1':
                        $collection->orderBy('created_at');
                        break;
                    case 'date-2':
                        $collection->orderByDesc('created_at');
                        break;
                    case 'price-1':
                        $collection->orderBy('product_price');
                        break;
                    case 'price-2':
                        $collection->orderByDesc('product_price');
                        break;
                    case 'alphabetically-A':
                        $collection->orderBy('product_name');
                        break;
                    case 'alphabetically-Z':
                        $collection->orderByDesc('product_name');
                        break;
                    case 'rating':
                        $collection->orderBy('ratings');
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
        }

        return $collection;
    }

    public function wishlistAdd(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            
            $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);

            if (Auth::check()) {
                $wishlist = Wishlist::where([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id
                ])->count();

                if ($wishlist == 0) {
                    $wishlist = Wishlist::create([
                        'user_id' => Auth::id(),
                        'product_id' => $request->product_id,
                    ]);
                }

            }

            return response()->json([
                'success' => true,
                'message' => 'Product has been added to Wishlist! <a href="/wishlist" style="text-decoration: underline !important">View Wishlist</a>',
            ]);
    
        }
    }
}