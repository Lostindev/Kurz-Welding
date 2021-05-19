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
        $cOrderDB = new ModCustomOrders();
        $checkLoggedIn = $session->get('uId');

        $data['coFirst'] = $request->getPost('co_first');
        $data['coLast'] = $request->getPost('billing_last');
        $data['coEmail'] = $request->getPost('billing_company');
        $data['coPhone'] = $request->getPost('billing_address');
        $data['coMessage'] = $request->getPost('billing_apt');
        $data['userId'] = $checkLoggedIn;

        //Make sure we are getting the data
        if (!empty($data)) {

                //Create Custom Order
                $addOrder = $cOrderDB->insert($data);
    
                if ($addOrder) {
                    $session->setFlashdata('message','Your account was succesfully created! Check your email when your ready to activate your account.');
                    return redirect()->to(site_url('/users'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    return redirect()->to(site_url('/users'));
                }
            
        }

        else {
            //Didn't get any data
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(site_url('/users')); 

        }
        
    }


} //End of controller