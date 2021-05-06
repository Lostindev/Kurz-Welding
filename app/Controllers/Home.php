<?php

namespace App\Controllers;

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
