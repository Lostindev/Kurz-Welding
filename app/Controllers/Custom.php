<?php
namespace App\Controllers;

use App\Models\ModUsers;

use App\Models\ModAdmin;

use App\Models\ModProducts;

use CodeIgniter\Controller;

use App\Models\ModCustomOrders;

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

	public function send_custom_order() {
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $userDB = new ModUsers();
        $coDB = new ModCustomOrders();
        $checkLoggedIn = $session->get('uId');

        $data['coFirst'] = $request->getPost('co_first');
        $data['coLast'] = $request->getPost('co_last');
        $data['coPhone'] = $request->getPost('co_phone');
        $data['coEmail'] = $request->getPost('co_email');
        $data['coMessage'] = $request->getPost('co_message');
        $data['coSize'] = $request->getPost('co_size');
        $data['coUser'] = userLoggedIn();

        //Make sure we are getting the data
        if (!empty($data)) {

            $config['allows_type'] = 'gif|png|jpg|jpeg';

            $file = $request->getFile('userFile');
            if (!empty($file) && $file->getSize() > 0) {
                $fileName = $file->getName();
                $file->move('/var/www/html/public/img/custom_orders/', $fileName);
                $data['coDp'] = $fileName;

                //Create Custom Order
                $addOrder = $coDB->insert($data);
    
                if ($addOrder) {
                    $session->setFlashdata('message','Custom Order Started! Check your email to create an account and manage your orders!');
                    return redirect()->to(site_url('/custom'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    return redirect()->to(site_url('/custom'));
                }
            } else {
                $file = $request->getFile('userFile');
                $fileName = $file->getName();
                $file->move('/var/www/html/public/img/custom_orders/', $fileName);
                $data['coDp'] = $fileName;

                //Create Custom Order
                $addOrder = $coDB->insert($data);
    
                if ($addOrder) {
                    $session->setFlashdata('message','Custom Order Started! Check your email to create an account and manage your orders!');
                    return redirect()->to(site_url('/custom'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    return redirect()->to(site_url('/custom'));
                }
                $session->setFlashdata('message','You need to upload at least one image.');
                return redirect()->to(site_url('/custom'));
            }

            
        }

        else {
            //Didn't get any data
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(site_url('/custom')); 

        }
        
    }


} //End of controller