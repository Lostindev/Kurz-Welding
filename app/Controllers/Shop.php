<?php

namespace App\Controllers;

use App\Models\ModUsers;

use App\Models\ModAdmin;

use App\Models\ModProducts;

use App\Models\ModSub;

use App\Models\ModSpec;

use App\Models\ModSpecValues;

use App\Models\ModOrders;

use CodeIgniter\Controller;


class Shop extends BaseController
{
    public function index($page = 'index')
    {
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
        $data['getNumCategories'] = $categoriesDB->where('cstatus', 1)->countAllResults();
        $data['allCategories'] = $categoriesDB->getWhere(['cStatus' => 1], $data['getNumCategories'])->getResultArray();


        echo view('user/header', $data);
        echo view('user/css', $data);
        echo view('user/navbar', $data);
        echo view('shop/index', $data);
        echo view('user/footer', $data);
    }

    public function productLookup($id)
    {
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
        $data['getNumCategories'] = $categoriesDB->where('cstatus', 1)->countAllResults();
        $data['allCategories'] = $categoriesDB->getWhere(['cStatus' => 1], $data['getNumCategories'])->getResultArray();

        //Get all Products
        $productsDB = new ModProducts();

        $data['allProducts'] = $productsDB->where('pStatus', 1)->findAll();

        if (!empty($id)) {
            $name = (str_replace('-', ' ', strtolower($id)));
            $data['product'] = $productsDB->getWhere(['pStatus' => 1, 'pName' => $name],)->getResultArray();
            if (count($data['product']) > 0) {

                //Get all Products
                $productsDB = new ModProducts();
                $data['allProducts'] = $productsDB->where('pStatus', 1)
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
        } else {
            echo 'error';
        }
    }


    public function cart($page = 'cart')
    {
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
        $data['getNumCategories'] = $categoriesDB->where('cstatus', 1)->countAllResults();
        $data['allCategories'] = $categoriesDB->getWhere(['cStatus' => 1], $data['getNumCategories'])->getResultArray();

        echo view('user/header', $data);
        echo view('user/css', $data);
        echo view('user/navbar', $data);
        echo view('shop/cart', $data);
        echo view('user/footer', $data);
    }

    public function add_to_cart($pId = NULL)
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();

        if (!empty($pId) && isset($pId)) {
            if (empty($_SESSION['cart'])) {
                //Create Array
                $_SESSION['cart'] = array();
                $_SESSION['varPrice'] = array();
                $_SESSION['varColor'] = array();
                $_SESSION['varDimensions'] = array();
                $_SESSION['varCustom'] = array();
            }
            if (!isset($_SESSION["quantity"][$pId])) {
                $_SESSION["quantity"][$pId] = 0;
            }

            $specDB = new ModSpec();
            $valuesDB = new ModSpecValues();

            //Set new price
            $prePrice = $request->getPost('var-price');
            $varPrice = str_replace("$", "", $prePrice);

            //Get the color selection
            $varColor = $request->getPost('color');

            //Get Dimensions
            $varSize = $request->getPost('sizeSelect');

            //Get Custom Field input
            $oCustom = $request->getPost('oCustom'); 
            array_push($_SESSION['varCustom'], $oCustom);

            //Add to cart
            array_push($_SESSION['cart'], $pId);
            if (in_array($pId, $_SESSION['cart'])) {
                $_SESSION["quantity"][$pId] += 1;
            } else {
                $_SESSION["quantity"][$pId] = 1;
            }

            //Add Price Variation
            $_SESSION['varPrice'][$pId] = $varPrice;
            $_SESSION['varColor'][$pId] = $varColor;
            $_SESSION['varDimensions'][$pId] = $varSize;


            //Add Dimensions to cart
            $getSpec = $specDB->getWhere(['productId' => $pId])->getResultArray();
            if (!empty($getSpec)) {
                $newSize = $valuesDB->getWhere(['specId' => $pId, 'spvPrice' => $varSize])->getResultArray();
                if (!empty($newSize)) {

                    // array_push($_SESSION['varDimensions'], $newSize[0]['spvName']);
                    $_SESSION['varDimensions'][$pId] = $newSize[0]['spvName'];
                }
            }



            //             print_r($_SESSION['varPrice']);
            // die();

            //Redirect to cart
            $session->setFlashdata('successMessage', 'Product successfully added to cart!');
            return redirect()->to(site_url('/shop/cart'));
        } else {
            //Redirect to cart
            $session->setFlashdata('message', 'Product not found.');
            return redirect()->to(site_url('/shop/cart'));
        }
    }

    public function rest()
    {
        unset($_SESSION["cart"]);
        unset($_SESSION["varPrice"]);
        unset($_SESSION["varCustom"]);
        unset($_SESSION["varColor"]);
        unset($_SESSION["varDimensions"]);
        unset($_SESSION["quantity"]);
    }
    public function removeProduct($id)
    {
        $session = \Config\Services::session();
        if (isset($id)) {
            if (in_array($id, $_SESSION['cart'])) {
                foreach ($_SESSION["cart"] as $k => $c) {
                    if ($id == $c) {


                        unset($_SESSION["cart"][$k]);
                        unset($_SESSION["varPrice"][$c]);
                        unset($_SESSION["varCustom"]);
                        unset($_SESSION["varColor"][$c]);
                        unset($_SESSION["varDimensions"][$c]);
                        unset($_SESSION["quantity"][$c]);
                    }
                }
                // echo array_search($pId,$_SESSION['cart']);

                $session->setFlashdata('message', 'Product Remove From Cart.');
                return redirect()->to(site_url('/shop/cart'));
            }
        }
    }

    public function addQuantity($id)
    {
        if (isset($id)) {
            if (in_array($id, $_SESSION['cart'])) {

                $_SESSION["quantity"][$id] += 1;
                // echo array_search($pId,$_SESSION['cart']);
                echo json_encode($_SESSION["quantity"][$id]);
            }
        }
    }

    public function minusQuantity($id)
    {
        if (isset($id)) {
            if (in_array($id, $_SESSION['cart'])) {

                $_SESSION["quantity"][$id] -= 1;
                // echo array_search($pId,$_SESSION['cart']);
                echo json_encode($_SESSION["quantity"][$id]);
            }
        }
    }


    public function checkout($page = 'checkout')
    {
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
        $data['getNumCategories'] = $categoriesDB->where('cstatus', 1)->countAllResults();
        $data['allCategories'] = $categoriesDB->getWhere(['cStatus' => 1], $data['getNumCategories'])->getResultArray();

        echo view('user/header', $data);
        echo view('user/css', $data);
        echo view('user/navbar', $data);
        echo view('shop/checkout', $data);
        echo view('user/footer', $data);
    }

    public function checkout_submit($page = 'checkout')
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        helper('text');
        $ordersDB = new ModOrders();

        //get billing info
        $dataUpload['billingFirst'] = $request->getPost('first-name');
        $dataUpload['billingLast'] = $request->getPost('last-name');
        $dataUpload['billingCompany'] = $request->getPost('company');
        $dataUpload['billingCountry'] = $request->getPost('country');
        $dataUpload['billingAddress'] = $request->getPost('address1');
        $dataUpload['billingApt'] = $request->getPost('address2');
        $dataUpload['billingCity'] = $request->getPost('city');
        $dataUpload['billingState'] = $request->getPost('state');
        $dataUpload['billingZip'] = $request->getPost('zip');
        $dataUpload['billingPhone'] = $request->getPost('phone');
        $dataUpload['billingEmail'] = $request->getPost('email-address');
        $dataUpload['billingNotes'] = $request->getPost('order-notes');
        //$token = $request->getPost('stripeToken');


        //get shipping info if different from billing
        if (isset($_POST['different-address'])) {
            $dataUpload['shippingFirst'] = $request->getPost('shipping-first');
            $dataUpload['shippingLast'] = $request->getPost('shipping-last');
            $dataUpload['shippingCompany'] = $request->getPost('company-name');
            $dataUpload['shippingCountry'] = $request->getPost('shipping-country');
            $dataUpload['shippingAddress'] = $request->getPost('shipping-address1');
            $dataUpload['shippingApt'] = $request->getPost('shipping-address2');
            $dataUpload['shippingCity'] = $request->getPost('shipping-city');
            $dataUpload['shippingState'] = $request->getPost('shipping-state');
            $dataUpload['shippingZip'] = $request->getPost('shipping-zip');
            $dataUpload['shippingPhone'] = $request->getPost('shipping-phone');
        } else { //set shipping address to same as billing 
            $dataUpload['shippingFirst'] = $dataUpload['billingFirst'];
            $dataUpload['shippingLast'] = $dataUpload['billingLast'];
            $dataUpload['shippingCompany'] = $dataUpload['billingCompany'];
            $dataUpload['shippingCountry'] = $request->getPost('country');
            $dataUpload['shippingAddress'] = $request->getPost('address1');
            $dataUpload['shippingApt'] = $request->getPost('address2');
            $dataUpload['shippingCity'] = $request->getPost('city');
            $dataUpload['shippingState'] = $request->getPost('state');
            $dataUpload['shippingZip'] = $request->getPost('zip');
            $dataUpload['shippingPhone'] = $request->getPost('phone');
        }

        //Big code to get all products (Up to 10)
        if (isset($_POST['pHidden0'])) {
            $hidden0 = $_POST['pHidden0'];
            $custom0 = $_POST['cHidden0'];
            if (isset($_POST['pHidden1'])) { //check if item 2 exists
                $hidden1 = $_POST['pHidden1'];
                $custom1 = $_POST['cHidden1'];
                if (isset($_POST['pHidden2'])) { //check if item 3 exits
                    $hidden2 = $_POST['pHidden2'];
                    $custom2 = $_POST['cHidden2'];
                    if (isset($_POST['pHidden3'])) { //check if item 4 exits
                        $hidden3 = $_POST['pHidden3'];
                        $custom3 = $_POST['cHidden3'];
                        if (isset($_POST['pHidden4'])) { //check if item 5 exits
                            $hidden4 = $_POST['pHidden4'];
                            $custom4 = $_POST['cHidden4'];
                            if (isset($_POST['pHidden5'])) { //check if item 6 exits
                                $hidden5 = $_POST['pHidden5'];
                                $custom5 = $_POST['cHidden5'];
                                if (isset($_POST['pHidden6'])) { //check if item 7 exits
                                    $hidden6 = $_POST['pHidden6'];
                                    $custom6 = $_POST['cHidden6'];
                                    if (isset($_POST['pHidden7'])) { //check if item 8 exits
                                        $hidden7 = $_POST['pHidden7'];
                                        $custom7 = $_POST['cHidden7'];
                                        if (isset($_POST['pHidden8'])) { //check if item 9 exits
                                            $hidden8 = $_POST['pHidden8'];
                                            $custom8 = $_POST['cHidden8'];
                                            if (isset($_POST['pHidden9'])) { //check if item 10 exits
                                                $hidden9 = $_POST['pHidden9'];
                                                $custom9 = $_POST['cHidden9'];
                                                $dataUpload['oProducts'] = $hidden0 .= $hidden1 .= $hidden2 .= $hidden3 .= $hidden4 .= $hidden5 .= $hidden6 .= $hidden7 .= $hidden8 .= $hidden9;
                                                $dataUpload['oCustom'] = $custom0 .= $custom1 .= $custom2 .= $custom3 .= $custom4 .= $custom5 .= $custom6 .= $custom7 .= $custom8 .= $custom9;
                                            } else { //Only nine products.
                                                $dataUpload['oProducts'] = $hidden0 .= $hidden1 .= $hidden2 .= $hidden3 .= $hidden4 .= $hidden5 .= $hidden6 .= $hidden7 .= $hidden8;
                                                $dataUpload['oCustom'] = $custom0 .= $custom1 .= $custom2 .= $custom3 .= $custom4 .= $custom5 .= $custom6 .= $custom7 .= $custom8;
                                            }
                                        } else { //Only eight products.
                                            $dataUpload['oProducts'] = $hidden0 .= $hidden1 .= $hidden2 .= $hidden3 .= $hidden4 .= $hidden5 .= $hidden6 .= $hidden7;
                                            $dataUpload['oCustom'] = $custom0 .= $custom1 .= $custom2 .= $custom3 .= $custom4 .= $custom5 .= $custom6 .= $custom7;
                                        }
                                    } else { //Only seven products.
                                        $dataUpload['oProducts'] = $hidden0 .= $hidden1 .= $hidden2 .= $hidden3 .= $hidden4 .= $hidden5 .= $hidden6;
                                        $dataUpload['oCustom'] = $custom0 .= $custom1 .= $custom2 .= $custom3 .= $custom4 .= $custom5 .= $custom6;
                                    }
                                } else { //Only six products.
                                    $dataUpload['oProducts'] = $hidden0 .= $hidden1 .= $hidden2 .= $hidden3 .= $hidden4 .= $hidden5;
                                    $dataUpload['oCustom'] = $custom0 .= $custom1 .= $custom2 .= $custom3 .= $custom4 .= $custom5;
                                }
                            } else { //Only five products.
                                $dataUpload['oProducts'] = $hidden0 .= $hidden1 .= $hidden2 .= $hidden3 .= $hidden4;
                                $dataUpload['oCustom'] = $custom0 .= $custom1 .= $custom2 .= $custom3 .= $custom4;
                            }
                        } else { //Only four products.
                            $dataUpload['oProducts'] = $hidden0 .= $hidden1 .= $hidden2 .= $hidden3;
                            $dataUpload['oCustom'] = $custom0 .= $custom1 .= $custom2 .= $custom3;
                        }
                    } else { //Only three products.
                        $dataUpload['oProducts'] = $hidden0 .= $hidden1 .= $hidden2;
                        $dataUpload['oCustom'] = $custom0 .= $custom1 .= $custom2;
                    }
                } else { //Only two products.
                    $dataUpload['oProducts'] = $hidden0 .= $hidden1;
                    $dataUpload['oCustom'] = $custom0 .= $custom1;
                }
            } else { //Only one product.
                $dataUpload['oProducts'] = $hidden0;
                $dataUpload['oCustom'] = $custom0;
            }
        }
        $dataUpload['oDate'] = date('Y-m-d'); //Set Current date
        $dataUpload['oStatus'] = 'Processing'; //set the processing status until they are done with stripe
        $dataUpload['tempId'] = random_string('numeric', '9'); //generate a random id for temporary reference
        $dataUpload['oPrice'] = array_sum($_SESSION['varPrice']);

        if (userLoggedIn()) {
            $b = $session->get('uId');
            $dataUpload['userId'] = $b; //Set User Id
        } else {
            $dataUpload['userId'] = '0'; //Set Guest Order
        }

        //insert into database here:
        $addData = $ordersDB->insert($dataUpload);
        if ($addData) {
            //push the temp id to array so we can find the order in database to update payment status
            $_SESSION['checkoutId'] = array();
            array_push($_SESSION['checkoutId'], $dataUpload['tempId']);

            //push products to temp array for order page
            $_SESSION['tempOrder'] = array();
            array_push($_SESSION['tempOrder'], $dataUpload['oProducts']);

            //push date to temp array for order page
            $_SESSION['tempDate'] = array();
            array_push($_SESSION['tempDate'], $dataUpload['oDate']);

            //push billing email to temp array for order page
            $_SESSION['tempEmail'] = array();
            array_push($_SESSION['tempEmail'], $dataUpload['billingEmail']);

            //push total price to temp array for order page 
            $_SESSION['tempPrice'] = array();
            array_push($_SESSION['tempPrice'], array_sum($_SESSION['varPrice']));

            //Run stripe checkout Page
            require '../public/vendor/init.php';
            return view('stripe');
        } else {
            echo 'yes';
            $session->setFlashdata('message', 'Something went wrong, please try again.');
            return redirect()->to(base_url('/'));
        }
    }

    public function addOrderDb()
    { //Stripe Webhook
        $request = \Config\Services::request();

        require_once '/var/www/html/public/vendor/init.php';
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('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');

        // If you are testing your webhook locally with the Stripe CLI you
        // can find the endpoint's secret by running `stripe listen`
        // Otherwise, find your endpoint's secret in your webhook settings in the Developer Dashboard
        $endpoint_secret = 'whsec_VZNN4TnuByR9FxZmWSGX0ek5MOeaaZFb';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        $id = $event->data->object->id;
        $amount = $event->data->object->amount_captured;
        $currency = $event->data->object->currency;
        $cus_email = $event->data->object->billing_details->email;
        $status = $event->data->object->status;

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                handlePaymentIntentSucceeded($paymentIntent);
                break;

            case 'charge.succeeded':
                $ordersDB = new ModOrders();
                $session = \Config\Services::session();


                $dataUpload['stripeId'] = $id;
                $dataUpload['stripeAmount'] = $amount;
                $dataUpload['stripeCurrency'] = $currency;
                $dataUpload['stripeEmail'] = $cus_email;
                $dataUpload['stripeStatus'] = $status;

                $ordersDB->insert($dataUpload);
                break;

            case 'charge.failed':
                $ordersDB = new ModOrders();
                $session = \Config\Services::session();


                $dataUpload['stripeId'] = $id;
                $dataUpload['stripeAmount'] = $amount;
                $dataUpload['stripeCurrency'] = $currency;
                $dataUpload['stripeEmail'] = $cus_email;
                $dataUpload['stripeStatus'] = $status;

                $ordersDB->insert($dataUpload);
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



    public function order_success($page = 'checkout')
    { // Order Complete Page
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
        $data['getNumCategories'] = $categoriesDB->where('cstatus', 1)->countAllResults();
        $data['allCategories'] = $categoriesDB->getWhere(['cStatus' => 1], $data['getNumCategories'])->getResultArray();


        $session->remove('cart');
        $session->remove('varPrice');
        $session->remove('varColor');
        $session->remove('varDimensions');
        $session->remove('varCustom');


        echo view('user/header', $data);
        echo view('user/css', $data);
        echo view('user/navbar', $data);
        echo view('shop/order', $data);
        echo view('user/footer', $data);
    }

}//end of controller