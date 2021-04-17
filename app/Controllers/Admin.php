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
            return redirect()->to(base_url('/admin/login'));
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

    public function newCategory($page = 'newCategory')
    {
		$data['title'] = 'Admin - Add Category';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

        $session = \Config\Services::session();
        $data['message'] = $session->getFlashdata('message');
        $data['successMessage'] = $session->getFlashdata('successMessage');
        
        if (adminLoggedIn()) {
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/newCategory', $data);
            echo view('admin/header/footer', $data);
        } else {
            $session->setFlashdata('message','Please login to add a category.');
            return redirect()->to(base_url('/admin/login'));
            
            
        }
    }

    public function addCategory($page = 'addCategory')
    {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModAdmin();
        

        if (adminLoggedIn()) {
            $dataUpload['cName'] = $request->getPost('categoryName');

            if (!empty($dataUpload['cName'])) {
                $path = realpath(APPPATH.'/img/categories/');
                $config['upload_path'] = $path;
                $config['allows_type'] = 'gif|png|jpg|jpeg';

                $file = $request->getFile('cDp');
                if (!empty($file) && $file->getSize() > 0) {
                    $fileName = $file->getName();
                    $file->move('/var/www/html/public/img/categories/', $fileName);
                    $dataUpload['cDp'] = $fileName;
                    $dataUpload['cDate'] = date('Y-m-d H:i:s');
                    $dataUpload['adminId'] = $session->get('aId');
                } else {
                    echo 'failed';
                }

                $checkAlreadyThere = $adminDB->where('cName', $dataUpload['cName'])->findAll();
                if (count($checkAlreadyThere) > 0 ){
                    $session->setFlashdata('message','This Category already exists!');
                    return redirect()->to(base_url('/admin/newCategory'));
                } else {
                    $addData = $adminDB->insert($dataUpload);
                    if ($addData) {
                        $session->setFlashdata('successMessage','You have successfully added a category.');
                        return redirect()->to(base_url('/admin/newCategory'));
                    } else {
                        $session->setFlashdata('message','Something went wrong, please try again.');
                        return redirect()->to(base_url('/admin/newCategory'));
                    }
                }


            } else {
                $session->setFlashdata('message','You need a title');
                return redirect()->to(base_url('/admin/newCategory'));
            }

        } else {
            $session->setFlashdata('message','Please login to add a category.');
            return redirect()->to(base_url('/admin/login'));
        }
    }
}
