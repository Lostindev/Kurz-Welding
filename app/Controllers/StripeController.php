<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use Stripe;
 
class StripeController extends BaseController
{
    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        helper(["url"]);
        require '/var/www/html/public/vendor/init.php';
        \Stripe\Stripe::setApiKey('sk_test_hI7hDHpEKvi0AxBTs76xQIFg');
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function stripe()
    {
        return view("stripe");
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function payment(){

        Stripe\Stripe::setApiKey(STRIPE_SECRET);
      
        $stripe = Stripe\Charge::create ([
                "amount" => 70 * 100,
                "currency" => "usd",
                "source" => $_REQUEST["stripeToken"],
                "description" => "Test payment via Stripe From onlinewebtutorblog.com" 
        ]);

        // after successfull payment, you can store payment related information into 
        // your database

        //$data = array('success' => true, 'data' => $stripe);
        //echo json_encode($data);
        
        session()->setFlashdata("message", "Payment done successfully");

        return redirect('stripe');
    }
}