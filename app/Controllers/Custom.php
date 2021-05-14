<?php
namespace App\Controllers;

use App\Models\ModUsers;

use App\Models\ModAdmin;

use App\Models\ModProducts;

use CodeIgniter\Controller;

class Custom extends BaseController
{
    public function index($page = 'custom-order') 
    {
        $data['title'] = 'Kurz Welding & Metal Art | Home';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

		echo view('user/header', $data);
		echo view('user/css', $data);
		echo view('user/navbar', $data);
		echo view('custom/index', $data);
		echo view('user/footer', $data);
    }


} //End of controller