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
        require '/var/www/html/public/vendor/init.php';
    
        \Stripe\Stripe::setApiKey('sk_test_hI7hDHpEKvi0AxBTs76xQIFg');

        $stripe = new \Stripe\StripeClient(
            'sk_test_hI7hDHpEKvi0AxBTs76xQIFg'
          );

          $YOUR_DOMAIN = 'https://3.15.181.4/';

          $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'usd',
                'unit_amount' => 2000,
                'product_data' => [
                  'name' => 'Stubborn Attachments',
                  'images' => ["https://i.imgur.com/EHyR2nP.png"],
                ],
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
          ]);

          $data['stripeId'] = json_encode(['id' => $checkout_session->id]);


          
        
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

        require_once('/var/www/html/public/vendor/init.php');


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

        $stripe = new \Stripe\StripeClient(
            'sk_test_hI7hDHpEKvi0AxBTs76xQIFg'
          );


        
        $data['title'] = 'Kurz Metal Art | Shop';
        $data['metaData'] = "";
        $data['page'] = $page;
        $data['cssFile'] = $page;
        $uri = $request->uri;
        $data['uri'] = $uri->getSegment(1);
        $data['catId'] = $uri->getSegment(2);
        $data['uri2'] = '';

        var_dump($_POST);
        echo "submitted";

        }



        public function create_checkout_session() {
            $session = \Config\Services::session();
            $request = \Config\Services::request();
            checkoutSesh();
        }


}//end of controller