<?php namespace App\Controllers;
use App\Models\ModAdmin;
use CodeIgniter\Controller;

class Admin extends BaseController
{
	public function index($page = 'index')
	{
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        
        
		$data['title'] = 'Kurz Welding & Metal Art | Home';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

        $checkUser = $session->get('aId');

        if ($checkUser) {
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/index', $data);
            echo view('admin/header/footer', $data);
        }
        else {
            $session->setFlashdata('message','Please login first to access admin panel.');
            return redirect()->to(site_url('/admin/login'));
        }

	}

    public function login($page = 'login')
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        $data['message'] = $session->getFlashdata('message');
        helper('form');
        echo view('admin/login', $data);
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
                    $sessionData['aId'] = $allUsers[0]['aId'];
                    $sessionData['aName'] = $allUsers[0]['aName'];
                    $sessionData['aDate'] = $allUsers[0]['aDate'];
                    $sessionData['aEmail'] = $allUsers[0]['Email'];

                    $session->set($sessionData);
                    if ($session->get('aId')) {
                        redirect()->to(site_url('/admin'));
                    } 
                    else {
                        $session->setFlashdata('message','Unable to login, please try again.');
                        return redirect()->to(site_url('/admin/login',$data));
                    }


                } else {
                    $session->setFlashdata('message','Please check your information and try again.');
                    return redirect()->to(site_url('/admin/login',$data));
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

                    $sessionData['aId'] = $allUsers[0]['aId'];
                    $sessionData['aName'] = $allUsers[0]['aName'];
                    $sessionData['aDate'] = $allUsers[0]['aDate'];
                    $sessionData['aEmail'] = $allUsers[0]['aEmail'];

                    $session->set($sessionData);
                    if ($session->get('aId')) {
                        return redirect()->to(base_url('/admin'));
                    } 
                    else {
                        $session->setFlashdata('message','Unable to login, please try again.');
                        return redirect()->to(base_url('/admin/login',$data));
                    }
                    
                } else {
                    $session->setFlashdata('message','Please check your information and try again.');
                    return redirect()->to(base_url('/admin/login'));
                }

            } else {
                $session->setFlashdata('message','Please check your information and try again.');
                return redirect()->to(base_url('/admin/login'));
            }
        }
    }
}
