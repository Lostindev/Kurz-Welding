<?php
namespace App\Controllers;

use App\Models\ModUsers;

class Home extends BaseController
{
	public function index($page = 'index')
	{
		$data['title'] = 'Kurz Welding & Metal Art | Home';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

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

		$data['title'] = 'Signup | Kurz Welding & Metal Art ';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

		$data['email'] = $request->getPost('register-email');
		$data['password'] = $request->getPost('register-password');
		$data['date'] = date('Y-m-d H:i:s');
		$data['link'] = random_string('alnum','20');;
		$data['password'] = $request->getPost('register-password');

		$checkEmail =  $usersDB->where('email',$data['email'])->findAll();

		if (count($checkEmail) == 1) {
			echo 'user already exists';
		}

		else {
			$addUser = $usersDB->insert($data);

			if ($addUser) {
				$session->setFlashdata('fetchData',$data);
				return redirect()->to(site_url('/home/activationEmail'));
			} else {
				echo 'failed';
			}
		}

	}

	public function activationEmail() {
		$request = \Config\Services::request();
        $session = \Config\Services::session();
		$data = $session->getFlashdata('fetchData');


		$userLink = site_url('home/activate-account/'.$data['link']);
		$emailMessage = '<p>Hi! We\'re glad to have to join the community, get started by clicking the link below to activate your account:<br><br>
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
			echo TRUE;
		} else {
			echo FALSE;
		}
	}

		public function login($page = 'login')
		{
			$request = \Config\Services::request();
			$session = \Config\Services::session();
			$data['title'] = 'Kurz Welding & Metal Art | Home';
			$data['metaData'] = "";
			$data['page'] = $page;
			$data['cssFile'] = $page;
			$data['uri'] = $this->request->uri;
			echo 'working';
		}
}
