<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Helpers\GoogleReCaptchaHelper;

class V2_VendorController extends Controller
{
    /**
     * Get a paginated list of active vendors with their business details and total product orders.
     * The vendors are randomized on the first page load or explicit refresh, then paginated.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $perPage = 10;
            $currentPage = $request->get('page', 1);
            $cacheKey = 'randomized_vendor_ids';

            // On first visit or explicit refresh, generate a random order and cache vendor IDs
            // Use Cache instead of Session for API statelessness
            if ($currentPage == 1 || $request->has('refresh')) {
                $allVendorIds = Vendor::where('status', 1)->pluck('id')->toArray();
                shuffle($allVendorIds);
                Cache::put($cacheKey, $allVendorIds, now()->addMinutes(30)); // Cache for 30 minutes
            }

            // Get the stored vendor IDs from cache
            $vendorIds = Cache::get($cacheKey, []);

            // Calculate offset for current page
            $offset = ($currentPage - 1) * $perPage;

            // Get IDs for current page
            $pageVendorIds = array_slice($vendorIds, $offset, $perPage);

            // If no more vendors, return empty data
            if (empty($pageVendorIds) && $currentPage > 1) {
                return response()->json([
                    'success' => true,
                    'message' => 'No more vendors available.',
                    'data' => [],
                    'meta' => [
                        'currentPage' => $currentPage,
                        'perPage' => $perPage,
                        'total' => count($vendorIds),
                        'hasMore' => false,
                        'nextPage' => null,
                    ]
                ], 200);
            } elseif (empty($pageVendorIds) && $currentPage == 1) {
                 // If no vendors at all
                 return response()->json([
                    'success' => true,
                    'message' => 'No vendors found.',
                    'data' => [],
                    'meta' => [
                        'currentPage' => $currentPage,
                        'perPage' => $perPage,
                        'total' => 0,
                        'hasMore' => false,
                        'nextPage' => null,
                    ]
                ], 200);
            }

            // Get the vendors for this page, maintaining the randomized order
            $vendors = Vendor::whereIn('id', $pageVendorIds)
                ->with('vendorbusinessdetails')
                ->withSum('vendorProductOrders', 'product_qty')
                // Use case statements to maintain the same order as the pageVendorIds array
                ->orderByRaw("CASE id " .
                    implode(' ', array_map(function($i, $id) {
                        return "WHEN $id THEN $i";
                    }, array_keys($pageVendorIds), $pageVendorIds)) .
                    " END")
                ->get();

            // Format vendors for API response
            $formattedVendors = $vendors->map(function ($vendor) {
                return [
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'email' => $vendor->email,
                    'mobile' => $vendor->mobile,
                    'wdyfu' => $vendor->wdyfu,
                    'status' => $vendor->status, // 0 for inactive, 1 for active
                    'confirm' => $vendor->confirm,
                    'business_details' => $vendor->vendorbusinessdetails ? [
                        'shop_name' => $vendor->vendorbusinessdetails->shop_name,
                        'shop_mobile' => $vendor->vendorbusinessdetails->shop_mobile,
                        'shop_email' => $vendor->vendorbusinessdetails->shop_email,
                        'shop_address' => $vendor->vendorbusinessdetails->shop_address,
                        'shop_city' => $vendor->vendorbusinessdetails->shop_city,
                        'shop_state' => $vendor->vendorbusinessdetails->shop_state,
                        'shop_country' => $vendor->vendorbusinessdetails->shop_country,
                        'shop_pincode' => $vendor->vendorbusinessdetails->shop_pincode,
                        'shop_website' => $vendor->vendorbusinessdetails->shop_website,
                        'license_image' => $vendor->vendorbusinessdetails->license_image ? URL::to($vendor->vendorbusinessdetails->license_image) : null,
                        'business_proof_image' => $vendor->vendorbusinessdetails->business_proof_image ? URL::to($vendor->vendorbusinessdetails->business_proof_image) : null,
                    ] : null,
                    'total_products_sold' => (int) $vendor->vendor_product_orders_sum_product_qty,
                    'profile_image' => $vendor->profile_image ? URL::to('storage/profile_images/' . $vendor->profile_image) : null,
                ];
            });

            // Pagination meta info
            $totalVendors = count($vendorIds);
            $hasMore = ($offset + $perPage) < $totalVendors;
            $nextPage = $hasMore ? $currentPage + 1 : null;

            return response()->json([
                'success' => true,
                'message' => 'Vendors data fetched successfully.',
                'data' => $formattedVendors,
                'meta' => [
                    'currentPage' => $currentPage,
                    'perPage' => $perPage,
                    'total' => $totalVendors,
                    'hasMore' => $hasMore,
                    'nextPage' => $nextPage,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch vendors data: ' . $e->getMessage(),
                'error_code' => $e->getCode(), // Optionally include error code
                'trace' => $e->getTraceAsString(), // Only in development/debugging
            ], 500);
        }
    }

    /**
     * Get details for a single vendor by ID.
     *
     * @param int $id The ID of the vendor.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $vendor = Vendor::where('status', 1)
                            ->where('id', $id)
                            ->with('vendorbusinessdetails')
                            ->withSum('vendorProductOrders', 'product_qty')
                            ->first();

            if (!$vendor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vendor not found or is not active.'
                ], 404);
            }

            $formattedVendor = [
                'id' => $vendor->id,
                'name' => $vendor->name,
                'email' => $vendor->email,
                'mobile' => $vendor->mobile,
                'wdyfu' => $vendor->wdyfu,
                'status' => $vendor->status,
                'confirm' => $vendor->confirm,
                'business_details' => $vendor->vendorbusinessdetails ? [
                    'shop_name' => $vendor->vendorbusinessdetails->shop_name,
                    'shop_mobile' => $vendor->vendorbusinessdetails->shop_mobile,
                    'shop_email' => $vendor->vendorbusinessdetails->shop_email,
                    'shop_address' => $vendor->vendorbusinessdetails->shop_address,
                    'shop_city' => $vendor->vendorbusinessdetails->shop_city,
                    'shop_state' => $vendor->vendorbusinessdetails->shop_state,
                    'shop_country' => $vendor->vendorbusinessdetails->shop_country,
                    'shop_pincode' => $vendor->vendorbusinessdetails->shop_pincode,
                    'shop_website' => $vendor->vendorbusinessdetails->shop_website,
                    'license_image' => $vendor->vendorbusinessdetails->license_image ? URL::to($vendor->vendorbusinessdetails->license_image) : null,
                    'business_proof_image' => $vendor->vendorbusinessdetails->business_proof_image ? URL::to($vendor->vendorbusinessdetails->business_proof_image) : null,
                ] : null,
                'total_products_sold' => (int) $vendor->vendor_product_orders_sum_product_qty,
                'profile_image' => $vendor->profile_image ? URL::to('storage/profile_images/' . $vendor->profile_image) : null,
                // Add other relevant vendor data you want to expose
            ];

            return response()->json([
                'success' => true,
                'message' => 'Vendor data fetched successfully.',
                'data' => $formattedVendor
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch vendor data: ' . $e->getMessage(),
                'error_code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    public function register (Request $request)
    {
        $data = $request->all();
        $rules = [
            'firstname' => ['required', 'regex:/^[a-zA-Z\s\-]+$/'],
            'lastname' => ['required', 'regex:/^[a-zA-Z\s\-]+$/'],
            'email' => 'required|email|unique:admins|unique:vendors',
            'mobile' => 'required|min:10|numeric',
            'shop_name' => ['required','regex:/^[a-zA-Z\s\-]+$/','unique:vendors_business_details,shop_name'],
            'wdyfu' => 'required',
            'g-recaptcha-response' => 'required|string',
        ];

        $customMessages = [ 
            'name.required'             => 'Name is required',
            'email.required'            => 'Email is required',
            'email.unique'              => 'Email already exists',
            'mobile.required'           => 'Mobile is required',
            'mobile.unique'             => 'Mobile already exists',
            'shop_name.required'  => 'Business Shop Name is required.',
            'wdyfu' => 'Where did you find us?',
            'g-recaptcha-response.required' => 'reCaptcha is required.',
            'g-recaptcha-response.string' => 'reCaptcha is invalid.',
        ];

        $validator = Validator::make($data, $rules, $customMessages);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $gcsConfig = config('filesystems.disks.gcs');
        $grecaptcha = new GoogleReCaptchaHelper;
        $grecaptcha_resp = $grecaptcha->create_assessment(
            $gcsConfig['key_file'],
            $request->input('g-recaptcha-response'),
            'stone-semiotics-416509',
            'submit'
        );

        try {
            DB::beginTransaction();
                
            $vendor = new \App\Models\Vendor;

            $vendor->name   = $data['firstname'] . " " . $data['lastname'];
            $vendor->mobile = $data['mobile'];
            $vendor->email  = $data['email'];
            $vendor->status = 0; 
            $vendor->wdyfu = $data['wdyfu'];

            date_default_timezone_set('Asia/Manila');
            $vendor->created_at = date('Y-m-d H:i:s');
            $vendor->updated_at = date('Y-m-d H:i:s');

            // Save Vendor details
            $vendor->save();

            $vendor_id = DB::getPdo()->lastInsertId();

            // Save Vendor details as admin
            $admin = new \App\Models\Admin;

            $admin->type      = 'vendor';
            $admin->vendor_id = $vendor_id;
            $admin->name      = $data['firstname'] . " " . $data['lastname'];
            $admin->mobile    = $data['mobile'];
            $admin->email     = $data['email'];

            $initial_password = Str::random(12);
            $admin->password  = bcrypt($initial_password);
            $admin->status    = 0;

            date_default_timezone_set('Asia/Manila');
            $admin->created_at = date('Y-m-d H:i:s');
            $admin->updated_at = date('Y-m-d H:i:s');

            // Save Vendor details as admin
            $admin->save();
            
            $business_details = new \App\Models\VendorsBusinessDetail;

            $business_details->vendor_id = $vendor_id;
            $business_details->shop_name = $data['shop_name'];

            // Save Vendor business details 
            $business_details->save();

            // Send the Confirmation Email to the new vendor who has just registered    
            $email = $data['email']; // the vendor's email

            // The email message data/variables that will be passed in to the email view
            $messageData = [
                'email' => $data['email'],
                'name'  => $data['firstname'] . " " . $data['lastname'],
                'initial_password' => $initial_password,
                'code'  => base64_encode($data['email'])
            ];

            \Illuminate\Support\Facades\Mail::send('emails.vendor_confirmation', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.vendor_confirmation' is the vendor_confirmation.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that vendor_confirmation.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                $message->to($email)->subject('Confirm your Vendor Account');
            });

            DB::commit();

            $message = 'Thanks for registering as Vendor. Please confirm your email to have your account in-line for admin approval.';
            return response()->json([
                'success' => true,
                'message' => $message
            ], 200); // Not Implemented
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 402); // Not Implemented
        }
    }
}