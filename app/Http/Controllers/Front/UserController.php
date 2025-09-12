<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    // Render User Login/Register page (front/users/login_register.blade.php)    
    public function loginRegister() {
        return view('front.users.login_register');
    }

    // User Registration (in front/users/login_register.blade.php) <form> submission using an AJAX request. Check front/js/custom.js    
    public function userRegister(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)

            // Validation    // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators    
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                // the 'name' HTML attribute of the request (the array key of the $request array) (ATTRIBUTE) => Validation Rules
                'first_name'     => 'required|string|max:100',
                'last_name'     => 'required|string|max:100',
                'mobile'   => 'required|numeric|digits:11',
                'email'    => 'required|email|max:150|unique:users', // 'unique:users'    means it's unique in the `users` table
                'password' => 'required|min:6|confirmed',
                'accept'   => 'required'

            ], [ // Customizing The Error Messages: https://laravel.com/docs/9.x/validation#manual-customizing-the-error-messages
                // the 'name' HTML attribute of the request (the array key of the $request array) (ATTRIBUTE) => Custom Messages
                'accept.required' => 'Please accept our Terms & Conditions'
            ]);

            if ($validator->passes()) { // if validation passes (is successful), register (INSERT) the new user into the database `users` table, and log the user in IMMEDIATELY and AUTOMATICALLY and DIRECTLY, and redirect them to the Cart cart.blade.php page
                // Register the new user
                $user = new \App\Models\User;

                $user->first_name     = $data['first_name'];   // $data['name']   comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->last_name     = $data['last_name'];   // $data['name']   comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->mobile   = $data['mobile']; // $data['mobile'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->email    = $data['email'];  // $data['email']  comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->password = bcrypt($data['password']); // storing the HASH-ed password (not the original password) in the database    // bcrypt(): https://laravel.com/docs/9.x/helpers#method-bcrypt    // $data['password'] comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->status   = 0; // 0 means that the user is inactive/disabled/deactivated. After they click on the link in the 'Confirmation Email' sent to them, they become active/enabled/activated i.e. `status` is one 1    

                $user->save();



                // ACTIVATE USER AFTER SENDING A CONFIRMATION E-MAIL AND USER CLICKS ON LINK INSIDE THAT E-MAIL
                $email = $data['email']; // the user's email that they entered while submitting the registration form

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'name'   => $data['first_name']. ' ' . $data['last_name'],   // the user's name that they entered while submitting the registration form
                    'email'  => $data['email'],  // the user's email that they entered while submitting the registration form
                    'code'   => base64_encode($data['email']) // We base64 code the user's $email and send it as a Route Parameter from resources/views/emails/confirmation.blade.php to the 'user/confirm/{code}' route in web.php, then it gets base64 de-coded again in confirmUser() method in Front/UserController.php    // We will use the opposite: base64_decode() in the confirmUser() method to decode the encoded string (encode X decode)
                ];
                \Illuminate\Support\Facades\Mail::send('emails.confirmation', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.confirmation' is the resources/views/emails/confirmation.blade.php file that will be sent as an email    // We pass in all the variables that confirmation.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Confirm your Kapiton Account');
                });

                // Redirect user back with a success message
                $redirectTo = url('user/login-register'); // redirect user to the front/users/login_register.blade.php    // Check that route in web.php

                // Here, we return a JSON response because the request is ORIGINALLY submitting an HTML <form> data using an AJAX request
                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'type'    => 'success',
                    'url'     => $redirectTo, // redirect user to the Cart cart.blade.php page
                    'message' => 'Please confirm your email to activate your account!'
                ]);


                /*
                // Send an SMS using an SMS API and cURL    
                $message = 'Dear customer, you have successfully registered with Multi-vendor E-commerce Application. Login to your account to access orders, addresses and available offers';
                $mobile = $data['mobile']; // the user's mobile that they entered while submitting the registration form
                \App\Models\Sms::sendSms($message, $mobile); // Send the SMS
                */

            } else { // if validation fails (is unsuccessful), send the Validation Error Messages
                // Here, we return a JSON response because the request is ORIGINALLY submitting an HTML <form> data using an AJAX request
                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'type'   => 'error',
                    'errors' => $validator->messages() // we'll loop over the Validation Errors Messages array using jQuery to show them in the frontend (check front/js/custom.js)    // Working With Error Messages: https://laravel.com/docs/9.x/validation#working-with-error-messages    
                ]);
            }
        } else { // if the 'GET' request is coming from the <a> tag in front/users/login_register.blade.php, render the front/users/register.blade.php page
            if (Auth::check()) {
                return redirect('/');
            } else {
                return view('front.users.register');
            }
        }
    }

    public function userLogin(Request $request) {
        $data = $request->all(); 

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email'    => 'required|email|max:150|exists:users',
            'password' => 'required|min:6'
        ]);


        if ($validator->passes()) {
            if (Auth::attempt([ 
                'email'    => $data['email'],   
                'password' => $data['password'] 
            ])) {
                $user = Auth::user();
                if ($user->status == 0) {
                    Auth::logout();

                    return response()->json([ 
                        'type'    => 'inactive',
                        'message' => 'Your account is not activated! Please confirm your account (by clicking on the Activation Link in the Confirmation Mail) to activate your account.'
                    ]);
                }

                if (!empty(Session::get('session_id'))) {
                    $user_id    = $user->id;
                    $session_id = Session::get('session_id');

                    \App\Models\Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                }

                // Using Laravel Passport create Token
                $tokenResult = $user->createToken($user->id);
                $accessToken = $tokenResult->accessToken;
                $redirectTo = config('frontend_url');

                return response()->json([
                    'type' => 'success',
                    'data' => [
                        'url'  => $redirectTo,
                        'token' => $accessToken,
                        'user' => $user
                    ]
                ], 200);

            } else { 
                return response()->json([
                    'type'    => 'incorrect',
                    'message' => 'Incorrect Email or Password. Please try again.'
                ], 400);
            }

        } else { 
            return response()->json([ 
                'type'   => 'error',
                'errors' => $validator->messages()
            ], 500);
        }
    }

    // User logout (This route is accessed from Logout tab in the drop-down menu in the header (in front/layout/header.blade.php))    
    public function userLogout(Request $request) {
        $request->user()->token()->revoke(); // Revoke the current token
        Session::flush();
        return response()->json(['message' => 'Logged out successfully']);
    }



    // User account Confirmation E-mail which contains the 'Activation Link' to activate the user account (in resources/views/emails/confirmation.blade.php, using Mailtrap)    
    public function confirmAccount($code) { // {code} is the base64 encoded user's 'Activation Code' sent to the user in the Confirmation E-mail with which they have registered, which is received as a Route Parameters/URL Paramters in the 'Activation Link': https://laravel.com/docs/9.x/routing#required-parameters    // this route is requested (accessed/opened) from inside the mail sent to user (in resources/views/emails/confirmation.blade.php)
        $email = base64_decode($code); // $code is the encoded $email (check userRegister() method in UserController.php)    // we use the opposite (base64_decode()) of what we used in the userRegister() (base_64encode) 
        // dd($email);

        // For Security Reasons, check if that decoded user's $email exists in the `users` database table
        $userCount = \App\Models\User::where('email', $email)->count();
        if ($userCount > 0) { // if the user's email exists in `users` table
            // Check if the user is already active
            $userDetails = \App\Models\User::where('email', $email)->first();
            if ($userDetails->status == 1) { // if the user's account is already activated
                // Redirect the user to the User Login/Register page with an 'error' message
                return redirect('user/login-register')->with('error_message', 'Your account is already activated. You can login now.');
            } else { // if the user's account is not yet activated, activate it (update `status` to 1) and send a 'Welcome' Email
                \App\Models\User::where('email', $email)->update([
                    'status' => 1
                ]);

                // Send a Welcome Email to user after confirmation (clicking on the 'Activation Link' inside the Confirmation Email)    // HELO / Mailtrap / MailHog: https://laravel.com/docs/9.x/mail#mailtrap    

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'name'   => $userDetails->first_name . " " . $userDetails->last_name, // the user's name that they entered while submitting the registration form
                    'mobile' => $userDetails->mobile, // the user's mobile that they entered while submitting the registration form
                    'email'  => $email // the user's email that they entered while submitting the registration form
                    // 'code'   => base64_encode($data['email']) // We base64 code the user's $email and send it as a Route Parameter from user_confirmation.blade.php to the 'user/confirm/{code}' route in web.php, then it gets base64 decoded again in confirmUser() method in Front/UserController.php    // we will use the opposite: base64_decode() in the confirmAccount() method (encode X decode)
                ];
                \Illuminate\Support\Facades\Mail::send('emails.register', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.register' is the register.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that register.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Welcome to Kapiton');
                });

                // Note: Here, we have TWO options, either redirect user with a success message or Log the user In IMMDEIATELY, AUTOMATICALLY and DIRECTLY

                // Redirect the user to the User Login/Register page with a 'success' message
                return redirect('user/login-register')->with('success_message', 'Your account is activated. You can login now.');
            }

        } else { // if the user's email doesn't exist (hacking or cyber attack!!)
            abort(404);
        }
    }



    // User Forgot Password Functionality (this route is accessed from the <a> tag in front/users/login_register.blade.php through a 'GET' request, and through a 'POST' request when the HTML Form is submitted in front/users/forgot_password.blade.php))    
    public function forgotPassword(Request $request) {
        $data = $request->all(); 
        // dd($data);

        // Validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email'    => 'required|email|max:150|exists:users',
        ], [
            'email.exists' => 'Email does not exist'
        ]);        
        
        if ($validator->passes()) { 
            $new_password = \Illuminate\Support\Str::random(16);

            // Generate a new password
            \App\Models\User::where('email', $data['email'])->update([
                'password' => bcrypt($new_password) 
            ]);

            // Get user details
            $userDetails = \App\Models\User::where('email', $data['email'])->first()->toArray();

            $email = $data['email'];

            $messageData = [
                'name'     => $userDetails['first_name'] . " " . $userDetails['last_name'],
                'email'    => $email,
                'password' => $new_password
            ];
            \Illuminate\Support\Facades\Mail::send('emails.user_forgot_password', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.user_forgot_password' is the resources/views/emails/user_forgot_password.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that the user_forgot_password.blade.php file will use    // https://www.php.net/manual/en/functions.anonymous.php
                $message->to($email)->subject('New Password - Kapiton');
            });

            // Redirect user with a success message
            return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                'type'    => 'success',
                'message' => 'New Password sent to your registered email.'
            ], 200);

        } else { // if validation fails (is unsuccessful), send the Validation Error Messages
            return response()->json([ 
                'type'   => 'error',
                'errors' => $validator->messages()
            ], 400);
        }

    }

    public function userAccount(Request $request) {
        $data = $request->all();

            $user_id = $request->user()->id;
            // Validation    // Manually Creating Validators: https://laravel.com/docs/9.x/validation#manually-creating-validators    
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                // the 'name' HTML attribute of the request (the array key of the $request array) (ATTRIBUTE) => Validation Rules
                'first_name'    => 'required|string|max:100',
                'last_name'    => 'required|string|max:100',
                'email'   => "required|email|max:150|unique:users,email,{$user_id}",
                'city'    => 'required|string|max:100',
                'state'   => 'required|string|max:100',
                'address' => 'required|string|max:100',
                'country' => 'required|string|max:100',
                'mobile'  => 'required|numeric|digits:11',
                'pincode' => 'required|min_digits:4|max_digits:6',

            ]);

            if ($validator->passes()) {
                $countries = \App\Models\Country::where('status', 1)->get()->toArray(); // get the countries which have status = 1 (to ignore the blacklisted countries, in case)
                // Retrieving The Authenticated User: https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user
                $user = \App\Models\User::where('id', Auth::user()->id)->first();
                $user->update([
                    'first_name'    => $data['first_name'],
                    'last_name'    => $data['last_name'],
                    'email'  => $data['email'],
                    'mobile'  => $data['mobile'],
                    'city'    => $data['city'],
                    'state'   => $data['state'],
                    'country' => $data['country'],
                    'pincode' => $data['pincode'],
                    'address' => $data['address'],
                ]);

                if (isset($data['address_as'])) {

                    if ($data['address_as'] == "new") {
                        $user->userDeliveryAddresses->create([
                            'name' => $data['first_name'] . " " . $data['last_name'] . " - " . $data['city'] . ", " . $data['state'],
                            'address' => $data['address'],
                            'city'    => $data['city'],
                            'state'   => $data['state'],
                            'country' => $data['country'],
                            'pincode' => $data['pincode'],
                            'mobile'  => $data['mobile'],
                            'lat' => null,
                            'lng' => null
                        ]);
                    } else if ($data['address_as'] == "default") {
                        $user->deliveryAddress->update([
                            'name' => "Default",
                            'address' => $data['address'],
                            'city'    => $data['city'],
                            'state'   => $data['state'],
                            'country' => $data['country'],
                            'pincode' => $data['pincode'],
                            'mobile'  => $data['mobile'],
                            'lat' => null,
                            'lng' => null
                        ]);
                    }
                }

                // Here, we return a JSON response because the request is ORIGINALLY submitting an HTML <form> data using an AJAX request
                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'success'    => true,
                    'message' => 'Your contact/billing details successfully updated!'
                ], 200);

            } else { // if validation fails (is unsuccessful), send the Validation Error Messages
                // Here, we return a JSON response because the request is ORIGINALLY submitting an HTML <form> data using an AJAX request
                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'success'   => false,
                    'message' => "You've inputed an invalid value. Check for errors.",
                    'errors' => $validator->messages() // we'll loop over the Validation Errors Messages array using jQuery to show them in the frontend (Check    $('#accountForm').submit();    in front/js/custom.js)    // Working With Error Messages: https://laravel.com/docs/9.x/validation#working-with-error-messages    
                ], 403);
            }
    }



    // User Account Update Password HTML Form submission via AJAX. Check front/js/custom.js    
    public function userUpdatePassword(Request $request) {
        $data = $request->all();

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'current_password'  => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password'
        ]);

        if ($validator->passes()) {
            $current_password = $data['current_password'];
            $checkPassword    = \App\Models\User::where('id', Auth::user()->id)->first();

            if (Hash::check($current_password, $checkPassword->password)) {
                $user = \App\Models\User::find(Auth::user()->id);
                $user->password = bcrypt($data['new_password']); // $data['new_password']    comes from the 'data' object sent from inside the $.ajax() method in front/js/custom.js file
                $user->save();

                return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
                    'success'    => true,
                    'message' => 'Account password successfully updated!'
                ]);

            } else {
                return response()->json([
                    'success'    => false,
                    'message' => 'Your current password is incorrect!'
                ], 400);
            }
        } else {
            return response()->json([
                'success'   => 'error',
                'message' => "You've inputed an invalid value. Check for errors.",
                'errors' => $validator->messages()
            ], 400);
        }
    }

    public function showSecurity() {
        return view('front.users.reset_password');
    }

    public function showDeliveryAddresses() {
        $delivery_addresses = Auth::user()->userDeliveryAddresses;
        // dd($delivery_addresses);
        // return view('front.users.delivery_addresses', compact('delivery_addresses', 'countries'));
        return response()->json([
            'success' => true,
            'data' => $delivery_addresses
        ], 200);
    }

}