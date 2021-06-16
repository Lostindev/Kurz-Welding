<?php
namespace App\Controllers;

use App\Models\ModUsers;

use App\Models\ModAdmin;

use App\Models\ModProducts;

use App\Models\ModSub;

use App\Models\ModSpec;

use App\Models\ModSpecValues;

use CodeIgniter\Controller;


class Shop extends BaseController
{
    public function index($page = 'index') {
    $session = \Config\Services::session();
    $request = \Config\Services::request();
    
	$data['title'] = 'Kurz Metal Art | Shop';
	$data['metaData'] = "";
	$data['page'] = $page;
	$data['cssFile'] = $page;
	$uri = $request->uri;
    $data['uri'] = $uri->getSegment(1);
    $data['catId'] = $uri->getSegment(2);
    $data['uri2'] = '';
        
    //Fetch number of categories from database
    $categoriesDB = new ModAdmin();
	$data['getNumCategories'] = $categoriesDB->where('cstatus',1)->countAllResults();
	$data['allCategories'] = $categoriesDB->getWhere(['cStatus'=>1],$data['getNumCategories'])->getResultArray();


	echo view('user/header', $data);
	echo view('user/css', $data);
	echo view('user/navbar', $data);
	echo view('shop/index', $data);
	echo view('user/footer', $data);
    }

    public function productLookup($id) {
    $session = \Config\Services::session();
    $request = \Config\Services::request();
	$data['title'] = 'Kurz Metal Art | Shop';
	$data['metaData'] = "";
	$data['page'] = 'product';
	$data['cssFile'] = 'product';

    $uri = $request->uri;
    $data['uri'] = $uri->getSegment(1);
    $data['catId'] = $uri->getSegment(2);
    $data['uri2'] = '';

    //Fetch number of categories from database
    $categoriesDB = new ModAdmin();
	$data['getNumCategories'] = $categoriesDB->where('cstatus',1)->countAllResults();
	$data['allCategories'] = $categoriesDB->getWhere(['cStatus'=>1],$data['getNumCategories'])->getResultArray();

	//Get all Products
    $productsDB = new ModProducts();
 
	$data['allProducts'] = $productsDB->where('pStatus',1)->findAll();

    if (!empty($id)) {
        $name = (str_replace('-', ' ', strtolower($id)));
        $data['product'] = $productsDB->getWhere(['pStatus'=>1,'pName'=>$name],)->getResultArray();
        if (count($data['product']) > 0) {

            //Get all Products
		    $productsDB = new ModProducts();
		    $data['allProducts'] = $productsDB->where('pStatus',1)
				->orderBy('pId', 'RANDOM')
				->findAll();
            echo view('user/header', $data);
            echo view('user/css', $data);
            echo view('user/navbar', $data);
            echo view('products/index', $data);
            echo view('user/footer', $data);
        } else {
            echo 'data is not found in database';
        }
    }

    else {
        echo 'error';
    }
    }


    public function cart($page = 'cart') {
            $session = \Config\Services::session();
            $request = \Config\Services::request();
        
            $data['title'] = 'Kurz Metal Art | Shop';
            $data['metaData'] = "";
            $data['page'] = $page;
            $data['cssFile'] = $page;
            $uri = $this->request->uri;
            $data['uri'] = $uri->getSegment(1);

            $data['uri2'] = '';
                
            //Fetch number of categories from database
            $categoriesDB = new ModAdmin();
            $data['getNumCategories'] = $categoriesDB->where('cstatus',1)->countAllResults();
            $data['allCategories'] = $categoriesDB->getWhere(['cStatus'=>1],$data['getNumCategories'])->getResultArray();
        
            echo view('user/header', $data);
            echo view('user/css', $data);
            echo view('user/navbar', $data);
            echo view('shop/cart', $data);
            echo view('user/footer', $data);
    }

    public function add_to_cart($pId = NULL) {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
       
        if (!empty($pId) && isset($pId)) { 
            if (empty($_SESSION['cart'])) {
                //Create Array
                $_SESSION['cart'] = array();
                $_SESSION['varPrice'] = array();
                $_SESSION['varColor'] = array();
                $_SESSION['varDimensions'] = array();
            } 

            $specDB = new ModSpec();
            $valuesDB = new ModSpecValues();

            //Set new price
            $prePrice = $request->getPost('var-price');
            $varPrice = str_replace("$","", $prePrice);

            //Get the color selection
            $varColor = $request->getPost('color');

            //Get Dimensions
            $varSize = $request->getPost('sizeSelect');

            //Add to cart
            array_push($_SESSION['cart'], $pId);

            //Add Price Variation
            array_push($_SESSION['varPrice'], $varPrice);

            //Add Color to Cart
            array_push($_SESSION['varColor'], $varColor);

            //Add Dimensions to cart
            $getSpec = $specDB->getWhere(['productId'=>$pId])->getResultArray();

            $newSize = $valuesDB->getWhere(['specId'=>$getSpec[0]['spId'],'spvPrice'=>$varSize])->getResultArray();

            array_push($_SESSION['varDimensions'], $newSize[0]['spvName']);

            //Redirect to cart
            $session->setFlashdata('successMessage','Product successfully added to cart!');
			return redirect()->to(site_url('/shop/cart'));
        } 


        else {
            //Redirect to cart
            $session->setFlashdata('message','Product not found.');
            return redirect()->to(site_url('/shop/cart'));
        }
    }

    
        public function checkout($page = 'checkout') {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        
        $data['title'] = 'Kurz Metal Art | Shop';
        $data['metaData'] = "";
        $data['page'] = $page;
        $data['cssFile'] = $page;
        $uri = $request->uri;
        $data['uri'] = $uri->getSegment(1);
        $data['catId'] = $uri->getSegment(2);
        $data['uri2'] = '';
            
        //Fetch number of categories from database
        $categoriesDB = new ModAdmin();
        $data['getNumCategories'] = $categoriesDB->where('cstatus',1)->countAllResults();
        $data['allCategories'] = $categoriesDB->getWhere(['cStatus'=>1],$data['getNumCategories'])->getResultArray();
    
    
        echo view('user/header', $data);
        echo view('user/css', $data);
        echo view('user/navbar', $data);
        echo view('shop/checkout', $data);
        echo view('user/footer', $data);
        }

        public function checkout_submit($page = 'checkout') {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        helper('text');

        //get billing info
        $billingFirst = $request->getPost('first-name');
        $billingLast = $request->getPost('last-name');
        $billingCompany = $request->getPost('company');
        $billingCountry = $request->getPost('country');
        $billingAddress = $request->getPost('address1');
        $billingApt = $request->getPost('address2');
        $billingCity = $request->getPost('city');
        $billingState = $request->getPost('state'); 
        $billingZip = $request->getPost('zip'); 
        $billingPhone = $request->getPost('phone');
        $billingEmail = $request->getPost('email-address'); 
        $billingNotes = $request->getPost('order-notes'); 
        //$token = $request->getPost('stripeToken'); 


        //get shipping info if different from billing
        if (isset($_POST['different-address'])) {
            $shippingFirst = $request->getPost('shipping-first');
            $shippingLast = $request->getPost('shipping-last');
            $shippingCompany = $request->getPost('shipping-company');
            $shippingCountry = $request->getPost('shipping-country');
            $shippingAddress = $request->getPost('shipping-address1');
            $shippingApt = $request->getPost('shipping-address2');
            $shippingCity = $request->getPost('shipping-city');
            $shippingState = $request->getPost('shipping-state'); 
            $shippingZip = $request->getPost('shipping-zip'); 
            $shippingPhone = $request->getPost('shipping-phone');
        } else { //set shipping address to same as billing 
            $shippingFirst = $request->getPost('billing-first');
            $shippingLast = $request->getPost('billing-last');
            $shippingCompany = $request->getPost('billing-company');
            $shippingCountry = $request->getPost('billing-country');
            $shippingAddress = $request->getPost('billing-address1');
            $shippingApt = $request->getPost('billing-address2');
            $shippingCity = $request->getPost('billing-city');
            $shippingState = $request->getPost('billing-state'); 
            $shippingZip = $request->getPost('billing-zip'); 
            $shippingPhone = $request->getPost('billing-phone');
        }

        $status = 'unpaid'; //set the unpaid status until we get stripe webhook
        $tempId = random_string('alnum', 21); //generate a random id for temporary reference

        //insert into database here:


        //push the temp id to array so we can find the order in database to update payment status
        //array_push($_SESSION['checkoutId'], $tempId);

        

        require '/var/www/html/public/vendor/init.php';
        
        die(); 
        return view('stripe');
        }

        public function addOrderDb() {
            $session = \Config\Services::session();
            $request = \Config\Services::request();
            //$orderDb = new OrdersDb();

            require_once '/var/www/html/public/vendor/init.php';
            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            \Stripe\Stripe::setApiKey('sk_test_51J0Z2pGou0fkx6yrG69qBHLG7NeP7Sa0wTBZrosjFvX4cSsr7NHAJWk9992PQqNe8tqkXwg4j6y857BOZesTGPEy00uhyVVe2i');

            // If you are testing your webhook locally with the Stripe CLI you
            // can find the endpoint's secret by running `stripe listen`
            // Otherwise, find your endpoint's secret in your webhook settings in the Developer Dashboard
            $endpoint_secret = 'whsec_6ULwftIRzfFmRxNBfZhiwYnFXp8CGCjw';

            $payload = @file_get_contents('php://input');
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
            $event = null;

            try {
                $event = \Stripe\Webhook::constructEvent(
                    $payload, $sig_header, $endpoint_secret
                );
            } catch(\UnexpectedValueException $e) {
                // Invalid payload
                http_response_code(400);
                exit();
            } catch(\Stripe\Exception\SignatureVerificationException $e) {
                // Invalid signature
                http_response_code(400);
                exit();
            }

            $id = $event->data->object->id;
            $amount = $event->data->object->amount_captured;
            $currency = $event->data->object->currency;
            $cus_email = $event->data->object->receipt_email;
            $status = $event->data->object->status;

            // Handle the event
            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                    handlePaymentIntentSucceeded($paymentIntent);
                    break;

                    case 'charge.succeeded':
                        unset(
                            $_SESSION['cart'],
                            $_SESSION['varDimensions'],
                            $_SESSION['varPrice'],
                            $_SESSION['varColor']
                    );
                        break;

                    case 'charge.failed':
                        $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                        handlePaymentIntentSucceeded($paymentIntent);
                    break;




                case 'payment_method.attached':
                    $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
                    handlePaymentMethodAttached($paymentMethod);
                    break;
                // ... handle other event types
                default:
                    echo 'Received unknown event type ' . $event->type;
            }

            http_response_code(200);
        }



}//end of controller