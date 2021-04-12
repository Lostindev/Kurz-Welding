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
		echo view('welcome_message');
	}
}
