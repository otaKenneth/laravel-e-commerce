<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    // https://www.youtube.com/watch?v=XUxWmZOjZR0&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=215



    // Add a Newsletter Subscriber email HTML Form Submission in front/layout/footer.blade.php when clicking on the Submit button (using an AJAX Request/Call)    // https://www.youtube.com/watch?v=XUxWmZOjZR0&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=215
    public function addSubscriber(Request $request) {
        if ($request->ajax()) { // if the request is coming via an AJAX call
            $data = $request->all(); // Getting the name/value pairs array that are sent from the AJAX request (AJAX call)
            // dd($data); // dd() method DOESN'T WORK WITH AJAX! - SHOWS AN ERROR!! USE var_dump() and exit; INSTEAD!
            // echo '<pre>', var_dump($data), '</pre>';
            // exit;


            $subscriberCount = \App\Models\NewsletterSubscriber::where('email', $data['subscriber_email'])->count(); //    $data['subscriber_email']    comes from the 'data' object inside the $.ajax() method

            if ($subscriberCount > 0) { 
                return 'Email already exists';
            } else {
                // INSERT the email in the `newsletter_subscribers` table
                $subscriber = new \App\Models\NewsletterSubscriber;

                $subscriber->email = $data['subscriber_email'];
                $subscriber->status = 1; // 1 by default

                $subscriber->save();


                return 'Email saved in our database';
            }


            // \App\Models\NewsletterSubscriber::where('id', $data['subscriber_id'])->update(['status' => $status]); // $data['subscriber_id'] comes from the 'data' object inside the $.ajax() method
            // // echo '<pre>', var_dump($data), '</pre>';

            // return response()->json([ // JSON Responses: https://laravel.com/docs/9.x/responses#json-responses
            //     'status'        => $status,
            //     'subscriber_id' => $data['subscriber_id']
            // ]);
        }
    }

}
