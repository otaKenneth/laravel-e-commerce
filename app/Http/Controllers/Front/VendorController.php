<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    public function loginRegister() { // render vendor login_register.blade.php page    
        return view('front.vendors.login_register');
    }

    public function create() {
        $countries = \App\Models\Country::where('status', 1)->get()->toArray();
        return view('front.vendors.vendor_register')->with(compact('countries'));
    }

    public function vendorList() {
        $vendors = Vendor::where('status', 1)
            ->with('vendorbusinessdetails')
            ->withSum('vendorProductOrders', 'product_qty')
            ->paginate(9);
        // dd($vendors);
        return view('front.pages.merchants')->with(compact('vendors'));
    }

    public function vendorRegister(Request $request) { // the register HTML form submission in vendor login_register.blade.php page    
        if ($request->isMethod('post')) { // if the register form is submitted
            $data = $request->all();
            
            // dd($data);
            // Validation (Validation of vendor registration form)    // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators    
            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|unique:admins|unique:vendors',
                'mobile' => 'required|min:10|numeric|unique:admins|unique:vendors',
                // 'personal.address' => 'required',
                // 'personal.city' => 'required',
                // 'personal.state' => 'required',
                // 'personal.country' => 'required',
                // 'personal.postal' => 'required|numeric|min:3|max_digits:6',
                'business.shop_name' => 'required|unique:vendors_business_details,shop_name',
                // 'business.shop_email' => 'required|email|unique:vendors_business_details,shop_email',
                // 'business.shop_mobile' => 'required|min:10|numeric',
                // 'business.address' => 'required',
                // 'business.city' => 'required',
                // 'business.state' => 'required',
                // 'business.country' => 'required',
                // 'business.postal' => 'required|numeric|min_digits:3|max_digits:6',
                // 'business.website' => '', // No specific validation for optional field,
                'business.wdyfu' => 'required'
            ];

            // validating file if any
            // if ($request->hasFile('business_license')) {
            //     $rules['business_license'] = [
            //         'required',
            //         File::types(['pdf','jpg','jpeg','png'])->min(100)->max('100mb'),
            //     ];
            // }

            // if ($request->hasFile('business_proof')) {
            //     $rules['business_proof'] = [
            //         'required',
            //         File::types(['pdf','jpg','jpeg','png'])->min(100)->max('100mb')
            //     ];
            // }
                
            $customMessages = [ // Specifying A Custom Message For A Given Attribute: https://laravel.com/docs/9.x/validation#specifying-a-custom-message-for-a-given-attribute
                // <input> "name" attribute.validation rule => validation rule message
                'name.required'             => 'Name is required',
                'email.required'            => 'Email is required',
                'email.unique'              => 'Email already exists',
                'mobile.required'           => 'Mobile is required',
                'mobile.unique'             => 'Mobile already exists',
                // personal address
                // 'personal.address.required' => 'Address is required.',
                // 'personal.city.required' => 'Address City is required.',
                // 'personal.state.required' => 'Address Province/State is required.',
                // 'personal.country.required' => 'Address Country is required.',
                // 'personal.postal.required' => 'Address Postal Code is required.',
                // business
                'business.shop_name.required'  => 'Business Shop Name is required.',
                // 'business.shop_email.required' => 'Business Shop Email is required.',
                // 'business.shop_email.unique' => 'Business Shop Email already exists.',
                // 'business.shop_mobile.required' => 'Business Shop Mobile is required.',
                // 'business.shop_mobile.unique' => 'Business Shop Mobile already exists.',
                // 'business.shop_mobile.numeric' => 'Business Shop Mobile must be numeric',
                // business address
                // 'business.address.required' => 'Business Address is required.',
                // 'business.city.required' => 'Business Address City is required.',
                // 'business.state.required' => 'Business Address Province/State is required.',
                // 'business.country.required' => 'Business Address Country is required.',
                // 'business.postal.required' => 'Business Address Code is required.',
                // 'business.website.required' => '', // No specific validation for optional field,
                'business.wdyfu' => 'This field is required.'
            ];

            $validator = Validator::make($data, $rules, $customMessages); // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators
            if ($validator->fails()) { // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators
                return \Illuminate\Support\Facades\Redirect::back()->withErrors($validator); // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators
            }

            // Create Vendor Account (Save the submitted data in BOTH `vendors` and `admins` tables)

            // Note: !!DATABASE TRANSACTION!! Firstly, we'll save the vendor in the `vendors` table, then take the newly generated vendor `id` to use it as a `vendor_id` column value to save the vendor in `admins` table, then we send the Confirmation Mail to the vendor using Mailtrap    
            // Database Transactions: https://laravel.com/docs/9.x/database#database-transactions
            DB::beginTransaction();

            
            $vendor = new \App\Models\Vendor; // Vendor.php model which models (represents) the `vendors` database table

            $vendor->name   = $data['firstname'] . " " . $data['lastname'];
            $vendor->mobile = $data['mobile'];
            $vendor->email  = $data['email'];
            $vendor->status = 0; // Note: After a new vendor registers a new account, they will remain inactive/disabled (`status` is 0), untill the confirmation email arrives for them and they click the link, and they complete filling their vendor details, then the admin APPROVES them (then status becomes 1)
            // $vendor->address = $data['business']['address'];
            // $vendor->city = $data['personal']['city'];
            // $vendor->state = $data['personal']['state'];
            // $vendor->country = $data['personal']['country'];
            // $vendor->pincode = $data['personal']['postal'];
            $vendor->wdyfu = $data['business']['wdyfu'];

            // Set Laravel's default timezone to Manila's (to enter correct `created_at` and `updated_at` records in the database tables) instead of UTC
            date_default_timezone_set('Asia/Manila'); // https://www.php.net/manual/en/timezones.php and https://www.php.net/manual/en/timezones.africa.php
            $vendor->created_at = date('Y-m-d H:i:s'); // enter `created_at` MANUALLY!    // Formatting the date for MySQL: https://www.php.net/manual/en/function.date.php
            $vendor->updated_at = date('Y-m-d H:i:s'); // enter `updated_at` MANUALLY!

            $vendor->save();

            // Get the `id` of the new vendor that we have just saved in the `vendors` table to use it as a value for the `vendor_id` column of the `admins` table to store the new vendor in the `admins` table too
            $vendor_id = DB::getPdo()->lastInsertId(); // get the vendor `id` of the `vendors` table (which has just been inserted) to insert it in the `vendor_id` column of the `admins` table    

            // Secondly, use the vendor `id` of the `vendors` table to serve a value of the `vendor_id` column in the `admins` table and save the new vendor in the `admins` table
            $admin = new \App\Models\Admin; // Admin.php model which models (represents) the `admins` database table

            $admin->type      = 'vendor';
            $admin->vendor_id = $vendor_id; // take the generated `id` of the `vendors` table to store it a `vendor_id` in the `admins` table
            $admin->name      = $data['firstname'] . " " . $data['lastname'];
            $admin->mobile    = $data['mobile'];
            $admin->email     = $data['email'];

            $initial_password = Str::random(12);
            $admin->password  = bcrypt($initial_password); // hashing the password to store the hashed password in the table (NOT THE PASSWORD ITSELF!!)
            $admin->status    = 0; // Note: After a new vendor registers a new account, they will remain inactive/disabled (`status` is 0), untill the confirmation email arrives for them and they click the link, and they complete filling their vendor details, then the admin APPROVES them (then status becomes 1)

            // Set Laravel's default timezone to Manila's (to enter correct `created_at` and `updated_at` records in the database tables) instead of UTC
            date_default_timezone_set('Asia/Manila'); // https://www.php.net/manual/en/timezones.php and https://www.php.net/manual/en/timezones.africa.php
            $admin->created_at = date('Y-m-d H:i:s'); // enter `created_at` MANUALLY!    // Formatting the date for MySQL: https://www.php.net/manual/en/function.date.php
            $admin->updated_at = date('Y-m-d H:i:s'); // enter `updated_at` MANUALLY!

            $admin->save();
            
            $business_details = new \App\Models\VendorsBusinessDetail;

            $business_details->vendor_id = $vendor_id;
            $business_details->shop_name = $data['business']['shop_name'];
            // $business_details->shop_mobile = $data['business']['shop_mobile'];
            // $business_details->shop_email = $data['business']['shop_email'];
            // $business_details->shop_address = $data['business']['address'];
            // $business_details->shop_city = $data['business']['city'];
            // $business_details->shop_state = $data['business']['state'];
            // $business_details->shop_country = $data['business']['country'];
            // $business_details->shop_pincode = $data['business']['postal'];
            
            // $business_details->shop_website = $data['business']['website'];

            // $license_filepath = null; $business_proof_filepath = null;
            // if ($request->hasFile('business_license')) {
            //     if ($request->file('business_license')->isValid()) {
            //         $license_filepath = $request->file('business_license')->store('public/images');
            //         $business_details->license_image = Storage::url($license_filepath);
            //     }
            // }
            
            // if ($request->hasFile('business_proof')) {
            //     if ($request->file('business_proof')->isValid()) {
            //         $business_proof_filepath = $request->file('business_proof')->store('public/images');
            //         $business_details->business_proof_image = Storage::url($business_proof_filepath);
            //     }
            // }

            $business_details->save();

            // Send the Confirmation Email to the new vendor who has just registered    
            $email = $data['email']; // the vendor's email

            // The email message data/variables that will be passed in to the email view
            $messageData = [
                'email' => $data['email'],
                'name'  => $data['firstname'] . " " . $data['lastname'],
                'initial_password' => $initial_password,
                'code'  => base64_encode($data['email']) // We base64 code the vendor $email and send it as a Route Parameter from vendor_confirmation.blade.php to the 'vendor/confirm/{code}' route in web.php, then it gets base64 decoded again in confirmVendor() method in Front/VendorController.php    // we will use the opposite: base64_decode() in the confirmVendor() method (encode X decode)
            ];

            \Illuminate\Support\Facades\Mail::send('emails.vendor_confirmation', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.vendor_confirmation' is the vendor_confirmation.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that vendor_confirmation.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                $message->to($email)->subject('Confirm your Vendor Account');
            });

            DB::commit(); // commit the Database Transaction

            // if (is_null($license_filepath) || is_null($business_proof_filepath)) {
            //     DB::rollback();
            //     return redirect()->back()->with('success_message', "Changes did not saved because of some error.");
            // }

            // Redirect the vendor back with a success message
            $message = 'Thanks for registering as Vendor. Please confirm your email to have your account in-line for admin approval.';
            return redirect()->back()->with('success_message', $message);
        }
    }

    public function confirmVendor($email) { // Confirm Vendor Account (the confirmation mail sent from 'vendor_confirmation.blade.php) from the mail by Mailtrap         // {code} $code is the base64 encoded vendor email with which they have registered which is a Route Parameters/URL Paramters which we received from the route: https://laravel.com/docs/9.x/routing#required-parameters    // this route is requested (accessed/opened) from inside the mail sent to vendor (vendor_confirmation.blade.php)
        // Note: Vendor CONFIRMATION occurs automatically through vendor clicking on the confirmation link sent in the email, but vendor ACTIVATION (active/inactive/disabled) occurs manually where 'superadmin' or 'admin' activates the `status` from the Admin Panel in 'Admin Management' tab, then clicks Status. Also, Vendor CONFIRMATION is related to the `confirm` columns in BOTH `admins` and `vendors` tables, but vendor ACTIVATION (active/inactive/disabled) is related to the `status` columns in BOTH `admins` and `vendors` tables!
        // Note: Vendor receives THREE emails: the first one when they register (please click on the confirmation link mail (in emails/vendor_confirmation.blade.php)), the second one when they click on the confirmation link sent in the first email (telling them that they have been confirmed and asking them to complete filling in their personal, business and bank details to get ACTIVATED/APPROVED (`status gets 1) (in emails/vendor_confirmed.blade.php)), the third email when the 'admin' or 'superadmin' manually activates (`status` becomes 1) the vendor from the Admin Panel from 'Admin Management' tab, then clicks Status (the email tells them they have been approved (activated and `status` became 1) and asks them to add their products on the website (in emails/vendor_approved.blade.php))

        $email = base64_decode($email); // we use the opposite (decode()) of what we used in the vendorRegister() (encode) 

        // For Security Reasons, check if the vendor email exists first (after the vendor has entered their mail while registering)
        $vendorCount = \App\Models\Vendor::where('email', $email)->count();
        if ($vendorCount > 0) { // if the vendor email exists
            // Check if the vendor is already active
            $vendorDetails = \App\Models\Vendor::where('email', $email)->first();
            if ($vendorDetails->confirm == 'Yes') { // if the vendor is already confirmed

                // Redirect vendor to vendor Login/Register page with an 'error' message
                $message = 'Your Vendor Account is already confirmed. An admin from Kapiton Store is processing your details and will contact you soon. Please wait for their confirmation.';
                return redirect()->route('vendor.email_confirmed')->with('error_message', $message);

            } else { // (!! DATABASE TRANSACTION !!) if the vendor account is not confirmed, then confirm it (by updating the `confirm` column to 'Yes' in BOTH `vendors` and `admins` tables) (!! DATABASE TRANSACTION !!)
                // Note: Vendor CONFIRMATION occurs automatically through vendor clicking on the confirmation link sent in the email, but vendor ACTIVATION (active/inactive/disabled) occurs manually where 'superadmin' or 'admin' activates the `status` from the Admin Panel in 'Admin Management' tab, then clicks Status. Also, Vendor CONFIRMATION is related to the `confirm` columns in BOTH `admins` and `vendors` tables, but vendor ACTIVATION (active/inactive/disabled) is related to the `status` columns in BOTH `admins` and `vendors` tables!
                // Note: Vendor receives THREE emails: the first one when they register (please click on the confirmation link mail (in emails/vendor_confirmation.blade.php)), the second one when they click on the confirmation link sent in the first email (telling them that they have been confirmed and asking them to complete filling in their personal, business and bank details to get ACTIVATED/APPROVED (`status gets 1) (in emails/vendor_confirmed.blade.php)), the third email when the 'admin' or 'superadmin' manually activates (`status` becomes 1) the vendor from the Admin Panel from 'Admin Management' tab, then clicks Status (the email tells them they have been approved (activated and `status` became 1) and asks them to add their products on the website (in emails/vendor_approved.blade.php))

                $initial_password = Str::random(12);
                $password  = bcrypt($initial_password);

                \App\Models\Admin::where( 'email', $email)->update(['confirm' => 'Yes', 'password' => $password]);
                \App\Models\Vendor::where('email', $email)->update(['confirm' => 'Yes']);


                // Send ANOTHER email to the vendor (The Registration Success email)
                // Send the Registration Success Email to the new vendor who has just registered    

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'  => $email,
                    'name'   => $vendorDetails->name,
                    'mobile' => $vendorDetails->mobile
                ];
                \Illuminate\Support\Facades\Mail::send('emails.vendor_confirmed', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.vendor_confirmed' is the vendor_confirmed.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that vendor_confirmed.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('You Vendor Account Confirmed');
                });

                $admin_emails = \App\Models\Admin::where('type', 'superadmin')->orWhere('type', 'admin')->where('vendor_id', 0)->get()->pluck('email')->toArray();
                $messageData = [
                    'email' => $vendorDetails->email,
                    'initial_password' => $initial_password,
                    'name'   => $vendorDetails->name,
                    'mobile' => $vendorDetails->mobile,
                ];

                \Illuminate\Support\Facades\Mail::send('emails.vendor_for_review', $messageData, function ($message) use ($admin_emails) {
                    $message->to($admin_emails)->subject('A New Vendor Account is UP For Review');
                });

                // Redirect vendor to vendor Login/Register page with a 'success' message
                $message = 'Your Vendor Email account is confirmed. An admin from Kapiton Store will contact you directly for more details.';
                return redirect()->route('vendor.email_confirmed')->with('success_message', $message);
            }
        } else { // if the vendor email doesn't exist (hacking or cyber attack!!)
            abort(404);
        }
    }

    public function vendorEmailConfirmed() {
        return view('front.vendors.email-confirmed')->with('error_message', 'Please check your email for a confirmation mail to proceed.');
    }


    public function becomeMerchant() {
        return view('front.vendors.become-merchant');
    }
}