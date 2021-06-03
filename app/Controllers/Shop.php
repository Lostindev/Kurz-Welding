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
        
        $data['title'] = 'Kurz Metal Art | Shop';
        $data['metaData'] = "";
        $data['page'] = $page;
        $data['cssFile'] = $page;
        $uri = $request->uri;
        $data['uri'] = $uri->getSegment(1);
        $data['catId'] = $uri->getSegment(2);
        $data['uri2'] = '';

        echo 'yes';
        }


}//end of controller