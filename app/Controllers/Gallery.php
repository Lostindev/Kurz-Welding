<?php
namespace App\Controllers;

use App\Models\ModUsers;

use App\Models\ModAdmin;

use App\Models\ModProducts;

use CodeIgniter\Controller;

use App\Models\ModSub;
use App\Models\ModGallery;

class Gallery extends BaseController
{
    public function index($page = 'index') {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
    
        $data['title'] = 'Kurz Metal Art | Gallery';
        $data['metaData'] = "";
        $data['page'] = $page;
        $data['cssFile'] = $page;
        $uri = $this->request->uri;
		$data['uri'] = $uri->getSegment(1);

        if (!empty($uri->getSegment(2))) {
			$data['uri2'] = $uri->getSegment(2);
		} else {
			$data['uri2'] = "";
		}

        echo view('user/header', $data);
        echo view('user/css', $data);
        echo view('user/navbar', $data);
        echo view('gallery/index', $data);
        echo view('user/footer', $data);
    }
}