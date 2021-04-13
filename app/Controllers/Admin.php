<?php namespace App\Controllers;
use App\Models\ModAdmin;
use CodeIgniter\Controller;

class Admin extends BaseController
{
	public function index($page = 'index')
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

    public function login($page = 'login')
    {
        $session = \Config\Services::session();
        echo view('admin/login');
    }

    public function auth($page ="auth")
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();

        if (!empty($data['aEmail']) && !empty($data['aPassword'])) {
            $adminDB = new ModAdmin();

            $data['aEmail'] = $request->getPost('email');
            $data['aPassword'] = $request->getPost('password');

            $allUsers = $adminDB->where('aEmail',$data['aEmail'])->findAll();
            if (count($allUsers) > 0) {
                if ($data['aPassword'] == $allUsers[0]['aPassword']) {

                    echo 'valid user';
                } else {
                    echo 'error';
                }

            } else {
                echo 'error';
            }

        } else {
            $adminDB = new ModAdmin();

            $data['aEmail'] = $request->getPost('email');
            $data['aPassword'] = $request->getPost('password');

            $allUsers = $adminDB->where('aEmail',$data['aEmail'])->findAll();
            if (count($allUsers) > 0) {
                if ($data['aPassword'] == $allUsers[0]['aPassword']) {

                    echo 'valid user';
                } else {
                    echo 'error';
                }

            } else {
                echo 'error';
            }
        }
    }
}
