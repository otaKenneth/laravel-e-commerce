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
                ->where('category_discount', '>', 0)
                ->get()->toArray();

            $categoryDetails = [
                'category_discount' => $category_discounts,
                'category_details' => $catDetails
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
            case "collection":
                $collection = $this->getCollectionBySection($name);
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
}
