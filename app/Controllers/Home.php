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
}
