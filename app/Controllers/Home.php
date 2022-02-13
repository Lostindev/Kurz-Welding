<?php
namespace App\Controllers;

use App\Models\ModUsers;

use App\Models\ModAdmin;

use App\Models\ModProducts;

use App\Models\ModContact;

use App\Models\ModGallery;

use App\Models\ModReviews;

use App\Models\ModNewsletter;

use CodeIgniter\Controller;

class Home extends BaseController
{
	public function index($page = 'index')
	{
		$data['title'] = 'Kurz Welding & Metal Art | Home';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$uri = $this->request->uri;
		$data['uri'] = $uri->getSegment(1);
		$data['uri2'] = '';        
		
		$reviewDB = new ModReviews();

		$data['reviews'] = $reviewDB->where('rStatus',1)
		->orderBy('rId DESC')
		->paginate(3); 
		$data['pager'] = $reviewDB->pager;
	
		//Fetch number of categories from database
		$categoriesDB = new ModAdmin();
		$data['getNumCategories'] = $categoriesDB->where('cstatus',1)->countAllResults();
		$data['allCategories'] = $categoriesDB->getWhere(['cStatus'=>1],$data['getNumCategories'])->getResultArray();

		//Get all Products
		$productsDB = new ModProducts();
		$data['allProducts'] = $productsDB->where('pStatus',1)
								->orderBy('pId', 'RANDOM')
								->findAll();

		$data['popularProducts'] = $productsDB->where('categoryId',1)
								->orderBy('pId', 'DESC')
								->findAll();								

		//Fetch total number of products & gallery items
		$galleryDB = new ModGallery();
		$data['productAmt'] = $productsDB->countAll();
		$data['galleryAmt'] = $galleryDB->countAll();

		echo view('user/header', $data);
		echo view('user/css', $data);
		echo view('user/navbar', $data);
		echo view('home/index', $data);
		echo view('user/footer', $data);
	}

	public function admin($page = 'admin')
	{
		$data['title'] = 'Kurz Welding & Metal Art | Home';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

        echo view('admin/header/header', $data);
        echo view('admin/header/css', $data);
        echo view('admin/header/navtop', $data);
        echo view('admin/header/navleft', $data);
		echo view('admin/home/index', $data);
		echo view('admin/header/footer', $data);
	}

	public function register($page = 'register')
	{
		$request = \Config\Services::request();
        $session = \Config\Services::session();
		helper('text');

		$usersDB = new ModUsers();

		//Dynamic Page Info
		$data['title'] = 'Register | Kurz Welding & Metal Art ';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

		$data['email'] = $request->getPost('register-email');
		$data['password'] = $request->getPost('register-password');
		$data['date'] = date('Y-m-d H:i:s');
		$data['link'] = random_string('alnum','20');
		$data['password'] = $request->getPost('register-password');

		$checkEmail =  $usersDB->where('email',$data['email'])->findAll();

		if (count($checkEmail) == 1) {
			//Email is already registered.
			$session->setFlashdata('message',$data['email'].' is already registered. Click forgot login to recover your acount.');
			return redirect()->to(site_url('/'));
		}

		else {
			$addUser = $usersDB->insert($data);

			if ($addUser) {
				$session->setFlashdata('fetchData',$data);
				$session->setFlashdata('SuccessMessage','Your account was succesfully created! Check your email when your ready to activate your account.');
				return redirect()->to(site_url('/home/activationEmail'));
			} else {
				$session->setFlashdata('message','Something went wrong, please try again.');
				return redirect()->to(site_url('/'));
			}
		}

	}

	
	public function activationEmail() 
	{ 
		//Create email with activation and send, 
		//DEV -need to make pretty | create account created check email popup.
		$request = \Config\Services::request();
        $session = \Config\Services::session();
		$data = $session->getFlashdata('fetchData');


		$userLink = site_url('home/activate-account/'.$data['link']);
		$emailMessage = '<p>Hi! We\'re glad to have you join the community, get started by clicking the link below to activate your account:<br><br>
		<a href="'.$userLink.'">Activate Account</a> ';

		$to = $data['email'];
		$subject = 'Kurz Metal Art - Account Activation';

		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('kurzweldingec2@gmail.com','Info');
		//$email->setBCC('admin@pivotgrowth.io');
		$email->setSubject($subject);
		$email->setMessage($emailMessage);

		if ($email->send()) {
			$session->setFlashdata('successMessage','Your account was succesfully created! Check your email when your ready to activate your account.');
			return redirect()->to(site_url('/'));
		} else {
			$session->setFlashdata('message','Something went wrong, please try again.');
			return redirect()->to(site_url('/'));
		}
	}

	public function activate_account($page = 'activate-account' )
	{
		$request = \Config\Services::request();
		$session = \Config\Services::session();

		//Dynamic Page Info
		$data['title'] = 'Signup | Kurz Welding & Metal Art ';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;
		$link = $data['uri']->getSegment(3);

		if (!empty($link) && isset($link)) {
			$usersDB = new ModUsers();

			$checkLink = $usersDB->where('link',$link)->findAll();
			$user = $checkLink;

			if (count($user) == 1) {
				$userData['link'] = $user[0]['link'].'ok';
				$userData['status'] = 1;
				$uId = $user[0]['uId'];

				$usersDB->set('status',$userData['status']);
				$usersDB->where('uId',$uId);
				$activateUser = $usersDB->update();

				if ($activateUser) {
					$session->setFlashdata('successMessage','Your account was succesfully activated, we\'re glad you\'re here!');
					return redirect()->to(site_url('/'));
				} else {
					$session->setFlashdata('message','Something went wrong, please try again or request a new link.');
					return redirect()->to(site_url('/'));
				}

			} else {
				$session->setFlashdata('message','This account doesn\'t exist!');
				return redirect()->to(site_url('/'));
			}
		}

		else {
			$session->setFlashdata('message','Please check your email and try again.');
			return redirect()->to(site_url('/'));
		}
	}

	public function newsletter($page = 'register')
	{
		$request = \Config\Services::request();
        $session = \Config\Services::session();
		helper('text');

		$usersDB = new ModNewsletter();

		//Dynamic Page Info
		$data['title'] = 'Newsletter Signup | Kurz Welding & Metal Art ';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

		$data['nEmail'] = $request->getPost('email-news');
		$data['nDate'] = date('Y-m-d');

		$checkEmail =  $usersDB->where('nEmail',$data['nEmail'])->findAll();

		if (count($checkEmail) == 1) {
			//Email is already registered.
			$session->setFlashdata('message',$data['nEmail'].' is already on the newsletter list.');
			return redirect()->to(site_url('/'));
		}

		else {
			$addUser = $usersDB->insert($data);

			if ($addUser) {
				$session->setFlashdata('successMessage','You have sucessfully joined our newsletter! Thanks for your interest in Kurz Metal Art');
				return redirect()->to(site_url('/'));
			} else {
				$session->setFlashdata('message','Something went wrong, please try again.');
				return redirect()->to(site_url('/'));
			}
		}

	}

	public function about_us($page = 'about-us')
	{
		$data['title'] = 'Kurz Welding & Metal Art | Home';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;

		$uri = $this->request->uri;
		$data['uri'] = 'no'; //this is to prevent 'Home Nav' showing as active

		$data['uri2'] = $uri->getSegment(2);

		echo view('user/header', $data);
		echo view('user/css', $data);
		echo view('user/navbar', $data);
		echo view('home/about-us', $data);
		echo view('user/footer', $data);
	}

	public function contact_us($page = 'contact-us') //Contact Us Page
	{
		$data['title'] = 'Kurz Welding & Metal Art | Home';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		
		$uri = $this->request->uri;
		$data['uri'] = 'no'; //this is to prevent the 'Home Nav' from being active


		$data['uri2'] = $uri->getSegment(2);

		echo view('user/header', $data);
		echo view('user/css', $data);
		echo view('user/navbar', $data);
		echo view('home/contact-us', $data);
		echo view('user/footer', $data);
	}

	public function connect($page = 'index')
    {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $contactDB = new ModContact();
        

		$dataUpload['contactDate'] = date('Y-m-d H:i:s');
		$dataUpload['contactName'] = $request->getPost('contactName');
		$dataUpload['contactEmail'] = $request->getPost('contactEmail');
		$dataUpload['contactComment'] = $request->getPost('contactMessage');

		$checkAlreadyThere = $contactDB->where('contactEmail', $dataUpload['contactEmail'])->findAll();

		if (count($checkAlreadyThere) > 0 ){
			$session->setFlashdata('message','A message was already submitted with this email.');
			return redirect()->to(base_url('/home/contact-us'));
		} 
		
		else {
			$addData = $contactDB->insert($dataUpload);
			if ($addData) {
				$session->setFlashdata('successMessage','Thanks for reaching out to us! We appreciate your feedback.');
				return redirect()->to(base_url('/home/contact-us'));
			} else {
				$session->setFlashdata('message','Something went wrong, please try again.');
				return redirect()->to(base_url('/home/contact-us'));
			}
		}

    }

	public function frequently_asked_questions($page = 'faq')
	{
		$data['title'] = 'Kurz Welding & Metal Art | Home';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		
		$uri = $this->request->uri;
		$data['uri'] = $uri->getSegment(1);


		$data['uri2'] = $uri->getSegment(2);

		echo view('user/header', $data);
		echo view('user/css', $data);
		echo view('user/navbar', $data);
		echo view('home/faq', $data);
		echo view('user/footer', $data);
	}

	public function terms_and_conditions($page = 'terms')
	{
		$data['title'] = 'Kurz Welding & Metal Art | Terms & Conditions';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$uri = $this->request->uri;
		$data['uri'] = $uri->getSegment(1);
		$data['uri2'] = $uri->getSegment(2);

		echo view('user/header', $data);
		echo view('user/css', $data);
		echo view('user/navbar', $data);
		echo view('home/terms', $data);
		echo view('user/footer', $data);
	}

	public function returns($page = 'returns')
	{
		$data['title'] = 'Kurz Welding & Metal Art | Terms & Conditions';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$uri = $this->request->uri;
		$data['uri'] = $uri->getSegment(1);
		$data['uri2'] = $uri->getSegment(2);

		echo view('user/header', $data);
		echo view('user/css', $data);
		echo view('user/navbar', $data);
		echo view('home/returns', $data);
		echo view('user/footer', $data);
	}

	public function send_review() {
		$session = \Config\Services::session();
		$request = \Config\Services::request();

		$data['rFirstName'] = $request->getPost('r_first');
        $data['rLastName'] = $request->getPost('r_last');
        $data['rEmail'] = $request->getPost('r_email');
        $data['rMessage'] = $request->getPost('r_message');
        $data['rDate'] = date('Y-m-d');

		$reviewDB = new ModReviews();

		$addComment = $reviewDB->insert($data);

		if ($addComment) {
			$session->setFlashdata('successMessage','Your review was submitted for approval.');
			return redirect()->to(site_url('/#comments'));
		} else {
			$session->setFlashdata('message','Something went wrong, please try again.');
			return redirect()->to(site_url('/#comments'));
		}



		//$checkUser = $commentDB->getWhere(['cEmail'=>'','c'],)->getResultArray();
	}
}
