<?php
namespace App\Controllers;

use App\Models\ModUsers;

use App\Models\ModAdmin;

use App\Models\ModProducts;

use CodeIgniter\Controller;

use App\Models\ModSub;

class Gallery extends BaseController
{
    public function index($page = 'index') {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
    
        $data['title'] = 'Kurz Metal Art | Gallery';
        $data['metaData'] = "";
        $data['page'] = $page;
        $data['cssFile'] = $page;
        $data['uri'] = $request->uri;
        

        echo view('user/header', $data);
        echo view('user/css', $data);
        echo view('user/navbar', $data);
        echo view('gallery/index', $data);
        echo view('user/footer', $data);
    }
}