<?php
namespace App\Controllers;

use App\Models\ModUsers;

use App\Models\ModAdmin;

use App\Models\ModProducts;

use CodeIgniter\Controller;

use App\Models\ModSub;

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
            } 

            $prePrice = $request->getPost('var-price');

            $varPrice = str_replace("$","", $prePrice);
            

            //Add to cart
            array_push($_SESSION['cart'], $pId);

            //Add Price Variation
            array_push($_SESSION['varPrice'], $varPrice);

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

        $billingFirst = $request->getPost('first-name');
        $billingFirst = $request->getPost('last-name');
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
        $token = $request->getPost('stripeToken'); 

        require '/var/www/html/public/vendor/init.php';
            
        return view('stripe');

        }

        public function addOrderDb() {

            $orderDb = new OrdersDb();

            require_once '/var/www/html/public/vendor/init.php';
            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            \Stripe\Stripe::setApiKey('sk_test_hI7hDHpEKvi0AxBTs76xQIFg');

            // If you are testing your webhook locally with the Stripe CLI you
            // can find the endpoint's secret by running `stripe listen`
            // Otherwise, find your endpoint's secret in your webhook settings in the Developer Dashboard
            $endpoint_secret = 'whsec_...';

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

            // Handle the event
            switch ($event->type) {
                case 'payment_intent.succeeded':
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