<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AddressController extends Controller
{
    // Checkout page Delivery Addresses Controller



    // Edit Delivery Addresses via AJAX (Page refresh and fill in the <input> fields with the authenticated/logged in user Delivery Addresses from the `delivery_addresses` database table when clicking on the Edit button) in front/products/delivery_addresses.blade.php (which is 'include'-ed in front/products/checkout.blade.php) via AJAX, check front/js/custom.js    
    public function getDeliveryAddress(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)
            // dd($data);


            // Get the Delivery Address of the currently authenticated/logged-in user
            $deliveryAddress = \App\Models\DeliveryAddress::where('id', $data['addressid'])->first()->toArray(); // Get all the delivery addresses of the currently authenticated/logged-in user    


            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                'address' => $deliveryAddress
            ]);
        }
    }

    // Save Delivery Addresses via AJAX (save the delivery addresses of the authenticated/logged-in user in `delivery_addresses` database table when submitting the HTML Form) in front/products/delivery_addresses.blade.php (which is 'include'-ed in front/products/checkout.blade.php) via AJAX, check front/js/custom.js    
    public function saveDeliveryAddress(Request $request) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name'    => 'required|string|max:100',   
            'address' => 'required|string|max:100',   
            'city'    => 'required|string|max:100',   
            'state'   => 'required|string|max:100',   
            'country' => 'required|string|max:100',   
            'pincode' => 'required|min_digits:4|max_digits:6',         
            'mobile'  => [
                'required',
                'numeric',
                function($attribute, $value, $fail) {
                    if (strlen($value) > 11) {
                        $fail('Invalid mobile number format.');
                    } else if (strlen($value) < 9) {
                        $fail('Invalid mobile number format.');
                    } else if (strlen($value) == 11) {
                        if (substr($value, 0, 1) !== '0') {
                            $fail('Invalid mobile number format.');
                        }
                    } else if (strlen($value) == 10) {
                        if (substr($value, 0, 1) !== '9') {
                            $fail('Invalid mobile number format.');
                        }
                    }
                }
            ],
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        if ($validator->passes()) {
            $data = $request->all();

            $address = array();

            $mobile = $data['mobile'];
            // Accept 10 digits (no leading 0) or 11 digits (leading 0)
            if (preg_match('/^0\d{10}$/', $data['mobile'])) {
                // 11 digits, starts with 0, remove leading 0
                $mobile = substr($mobile, 1);
            }

            $address['user_id'] = Auth::user()->id;
            $address['name']    = $data['name'];
            $address['address'] = $data['address'];
            $address['city']    = $data['city'];
            $address['state']   = $data['state'];
            $address['country'] = $data['country'];
            $address['pincode'] = $data['pincode'];
            $address['lat'] = floatval($data['lat']);
            $address['lng'] = floatval($data['lng']);
            $address['mobile']  = "+63".$mobile;

            if (!empty($data['delivery_id'])) { 
                \App\Models\DeliveryAddress::where('id', $data['id'])->update($address);
            } else { 
                $user = User::find(Auth::user()->id);
                $user_addresses = \App\Models\DeliveryAddress::where('user_id', Auth::user()->id)->count();
                \App\Models\DeliveryAddress::create($address);
                
                if ($user_addresses == 0) {
                    $user->address = $address['address'];
                    $user->city = $address['city'];
                    $user->state = $address['state'];
                    $user->country = $address['country'];
                    $user->pincode = $address['pincode'];

                    $user->update();
                } else if (is_null($user->pincode) || is_null($user->country) || is_null($user->state) || is_null($user->city) || is_null($user->address)) {
                    $user->address = $address['address'];
                    $user->city = $address['city'];
                    $user->state = $address['state'];
                    $user->country = $address['country'];
                    $user->pincode = $address['pincode'];

                    $user->update();
                }
            }

            return response()->json([
                'success' => true
            ]);

        } else { // if the user fails validation, return an error message
            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                'type'   => 'error',
                'errors' => $validator->messages() // we'll loop over the Validation Errors Messages array using jQuery to show them in the frontend (Check    $(document).on('submit', '#addressAddEditForm')    in front/js/custom.js)    // Working With Error Messages: https://laravel.com/docs/9.x/validation#working-with-error-messages    
            ], 405);
        }
    }

    // Remove Delivery Addresse via AJAX (Page refresh and fill in the <input> fields with the authenticated/logged-in user Delivery Addresses details from the `delivery_addresses` database table when clicking on the Remove button) in front/products/delivery_addresses.blade.php (which is 'include'-ed in front/products/checkout.blade.php) via AJAX, check front/js/custom.js    
    public function removeDeliveryAddress(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)
            // dd($data);


            // DELETE the delivery address from the `delivery_addresses` database table
            \App\Models\DeliveryAddress::where('id', $data['addressid'])->delete(); // $data['addressid'] comes from the 'data' object inside the $.ajax() method. Check front/js/custom.js
            // exit;


            // Note: You must pass in to view the SAME variables ($deliveryAddresses and $countries) that were passed in to it in checkout() method in Front/ProductsController.php
            $deliveryAddresses = \App\Models\DeliveryAddress::deliveryAddresses(); // Get all the delivery addresses of the currently authenticated/logged-in user   

            // Fetch all of the world countries from the database table `countries`
            $countries = \App\Models\Country::where('status', 1)->get()->toArray(); // get the countries which have status = 1 (to ignore the blacklisted countries, in case)
            // dd($countries);


            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                // Note: You must pass in to view the SAME variables ($deliveryAddresses and $countries) that were passed in to it in checkout() method in Front/ProductsController.php
                'view' => (string) \Illuminate\Support\Facades\View::make('front.products.delivery_addresses')->with(compact('deliveryAddresses', 'countries')) // View Responses: https://laravel.com/docs/9.x/responses#view-responses    // Creating & Rendering Views: https://laravel.com/docs/9.x/views#creating-and-rendering-views    // Passing Data To Views: https://laravel.com/docs/9.x/views#passing-data-to-views
            ]);
        }
    }
}