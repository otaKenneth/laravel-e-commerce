<?php

namespace App\Http\Controllers\API;

use App\Helpers\PaymongoAPIHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Helpers\GoogleReCaptchaHelper;
use App\Models\ProductsAttribute;
use App\Models\ProductsFilter;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Brand;
use App\Models\Wishlist;
use App\Helpers\LalamoveAPIBodyHelper;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

use function Clue\StreamFilter\append;

class V2_ProductsController extends Controller
{
    public function image(Request $request) {
        $imageName = $request->filename;
        $filepath = "front/images/product_images/medium";
        // Retrieve the Google Cloud Storage configuration from the filesystems.php config file
        $gcsConfig = config('filesystems.disks.gcs');

        // Create a StorageClient instance using the configuration
        $storage = new StorageClient([
            'projectId' => $gcsConfig['project_id'],
            'keyFilePath' => $gcsConfig['key_file'],
            'credentials' => CredentialsLoader::makeCredentials(['https://www.googleapis.com/auth/cloud-platform'], json_decode(file_get_contents($gcsConfig['key_file']), true))
        ]);

        // Specify your bucket name from the configuration
        $bucketName = $gcsConfig['bucket'];
        $bucket = $storage->bucket($bucketName);

        try {
            if (env('APP_ENV') == "development") {
                if (!empty($imageName) && file_exists($filepath . $imageName)) {
                    $object = asset($filepath . $imageName);
                } else {
                    $object = asset('front/images/product/no-available-image.jpg');
                }
            } else {
                if (empty($imageName)) {
                    $object = $bucket->object('front/images/product/no-available-image.jpg')->signedUrl(new \DateTime('+1 hour'));
        
                } else {
                    $gg = new GoogleReCaptchaHelper;
                    $object = $gg->getSignedUrl($bucket, $filepath . $imageName, '+1 hour');
                }
        
                $stream = $object->downloadAsStream();
                $content = $stream->getContents();
                $mimeType = $object->info()['contentType'];
        
                return response($content, 200)
                    ->header('Content-Type', $mimeType)
                    ->header('Content-Disposition', 'inline');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 402);
        }
    }

    public function availableFilters (Request $request) {
        $section = $request->section;
        $sectionModel = new \App\Models\Section;

        $sectionCategories = $sectionModel->where('status', 1);
        if ($section !== "all") {
            $sectionCategories = $sectionCategories->whereRaw('LOWER(name) = ?', [strtolower($section)]);
        }

        $categoryDetails = [];
        if ($sectionCategories->count() > 0) {
            $baseQuery = clone $sectionCategories;
            $catDetails = $sectionCategories->with(['categories' => function ($query) {
                return $query->select(['id', 'section_id', 'parent_id', 'category_name', 'url']);
            }])->get()->toArray();

            $section_ids = $baseQuery->get()->pluck('id')->toArray();
            $category_discounts = Category::select(['id', 'category_discount'])
                ->whereIn('section_id', $section_ids)
                ->where('status', 1);

            $other_filters = [];
            $productFilters = ProductsFilter::productFilters();
            $catIds = $category_discounts->get()->pluck('id')->toArray();
            foreach ($productFilters as $key => $filter) {
                $filterAvailable = ProductsFilter::filterAvailable($filter['id'], $catIds);
                if ($filterAvailable == "Yes") {
                    $other_filters[] = $filter;
                }
            }
            
            $categoryDetails = [
                'category_discount' => $category_discounts->where('category_discount', '>', 0)->get()->toArray(),
                'category_details' => $catDetails,
                'other_filters' => $other_filters
            ];
        }


        $max_price = Product::selectRaw('MAX(product_price) as max_prod_price')->first();

        return response()->json([
            'data' => array_merge($categoryDetails, ['max_price' => $max_price->max_prod_price])
        ]);
    }

    public function listing(Request $request) {
        $type = $request->type;
        $name = $request->any; // sections
        $pageTitle = $name;

        switch ($type) {
            case "collections":
                $collection = $this->getCollectionBySection($name);
                break;
            case 'category':
                $collection = $this->getCollectionByCategory($name, $request->all());
                break;
            default:
                break;
        }

        $products = $collection->paginate(12)->toArray();

        return response()->json([
            "success" => true,
            "message" => "Successfully fetched products.",
            ...$products
        ]);
    } 

    private function getCollectionBySection($section)
    {
        $sectionModel = new \App\Models\Section;
        $collection = Product::query(); // Initialize as a query builder

        if ($section !== "all") {
            $sectionCategories = $sectionModel->whereRaw('LOWER(name) = ?', [strtolower($section)])->where('status', 1);

            // Assuming getProductsBySectionName also returns a query builder
            $collection = Product::getProductsBySectionName($section);
        } else {
            $sectionCategories = $sectionModel->where('status', 1);

            $collection = Product::getProducts();
        }

        return $collection;
    }

    private function getCollectionByCategory($category, $data)
    {
        $categoryCount = Category::where([
            'url'    => $category,
            'status' => 1
        ])->count();

        if ($categoryCount > 0) {
            $categoryDetails = Category::categoryDetails($category);

            $collection = Product::with('vendor')->where('status', 1)
                ->select(['id', 'product_name', 'product_price', 'product_image', 'vendor_id', 'section_id', 'category_id', 'product_discount'])
                ->whereIn('category_id', $categoryDetails['catIds'])
                ->whereHas('vendor', function ($query) {
                    $query->where('status', 1);
                });

            // Sorting Filter WITHOUT AJAX - KEEP THIS PART
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
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

            return $collection; // This should be a Query Builder;
        }
    }

    public function detail(Request $request, Product $product) {
        $product->load(['vendor' => function ($query) {
            return $query->select(['id', 'name', 'email', 'mobile']);
        }, 'category' => function ($query) {
            return $query->select(['category_discount', 'category_name', 'url', 'id']);
        }, 'section' => function ($query) {
            return $query->select(['id', 'name']);
        }, 'attributes' => function ($query) {
            return $query->select(['products_attributes.id', 'product_id', 'color', 'size', 'sku', 'stock', 'price']);
        }, 'variants' => function ($query) {
            return $query->select(['products_variants.id', 'variant_name', 'product_id']);
        }]);

        $product_attributes = [];
        $attributes = ProductsAttribute::where('product_id', $product->id)->get();
        $variants = ["color", "size"];
        foreach ($product->variants as $key => $variant) {
            $color = $attributes->pluck($variants[$key])->unique()->toArray();
            $product->variants[$key]->attributes = array_values($color);
        }

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function relatedProducts(Request $request, Product $product) {
        $title = "Related Products";
        $relatedProducts = Product::with('vendor', 'vendor.vendorbusinessdetails')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->select(['id', 'product_name', 'product_price', 'product_image', 'vendor_id', 'section_id', 'category_id'])
            ->take(10)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $title = "Products from Same Vendor";
            $relatedProducts = Product::with('vendor', 'vendor.vendorbusinessdetails')
                ->where('vendor_id', $product->vendor_id)
                ->where('id', '!=', $product->id)
                ->where('status', 1)
                ->select(['id', 'product_name', 'product_price', 'product_image', 'vendor_id', 'section_id', 'category_id'])
                ->take(10)
                ->get();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'title' => $title,
                'products' => $relatedProducts
            ]
        ]);
    }

    public function reviews(Request $request, Product $product) {
        $reviews = $product->ratings()->with('user')
            ->select(['id', 'product_id', 'user_id', 'rating', 'review', 'created_at'])
            ->where('status', 1)
            ->orderBy('created_at', 'desc');
        $baseQuery = clone $reviews;
        $sum_ratings = $baseQuery->sum('rating');
        $reviews_count = $baseQuery->count();

        if ($reviews_count > 0) { // if there's at least one rating for a product (if a product has been rated at least once)
            $avgRating     = round($sum_ratings / $reviews_count, 2);
            $avgStarRating = round($sum_ratings / $reviews_count); // for showing the "Stars" in HTML
        } else {
            $avgRating     = 0;
            $avgStarRating = 0;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'reviews' => $reviews->get()->toArray(),
                'avg_rating' => $avgRating,
                'avg_star_rating' => $avgStarRating,
                'total_reviews' => $reviews_count
            ]
        ]);
    }
}
