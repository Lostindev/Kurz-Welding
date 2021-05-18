<?php
namespace App\Controllers;

use App\Models\ModUsers;
use App\Models\ModBilling;

class Users extends BaseController
{
	public function index($page = 'index')
	{
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $data['title'] = 'Kurz Welding & Metal Art | Home';
        $data['metaData'] = "";
        $data['page'] = $page;
        $data['cssFile'] = $page;
        $data['uri'] = $this->request->uri;
        

        if (userLoggedIn()) {
            $data['email'] = $session->get('email');
        
            echo view('user/header', $data);
            echo view('user/css', $data);
            echo view('user/navbar', $data);
            echo view('user/my-account', $data);
            echo view('user/footer', $data);
        } else {
            $session->setFlashdata('message','You must be logged in to access this page.');
            return redirect()->to(site_url('/'));
        }
    }
   
    public function check_user($page = 'check-user') 
    {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $data['title'] = 'Kurz Welding & Metal Art | Home';
        $data['metaData'] = "";
        $data['page'] = $page;
        $data['cssFile'] = $page;
        $data['uri'] = $this->request->uri;

        //Connect to Users database
        $userDB = new ModUsers();

        //Get User Information from POST
        $data['email'] = $request->getPost('email');
        $data['password'] = $request->getPost('password');

        //Check User
        $checkUser = $userDB->where('email',$data['email'])->findAll() ;

        $user = $checkUser;

        if (count($user) == 1) {

            //check if user is activated
            switch ($user[0]['status']) {
                case 0:
                //User isn't activated
                $session->setFlashdata('message','Your account has not been activated. Please click the activation link in your email.');
                $session->keepFlashdata('item');
				return redirect()->to(site_url('/'));
                break;

                case 1:
                //Check if user password is correct
                    if ($user[0]['password'] == $data['password']) {
                        $activeUser = array(
                            'uId'=>$user[0]['uId'],
                            'email'=>$user[0]['email'],
                            'date'=>$user[0]['date']
                        );
                        //Create Session
                        $session->set($activeUser);
                            if ($session->get('uId')) {
                                return redirect()->to('/users');
                            } else {
                                $session->setFlashdata('message','Something went wrong, please try again.');
                                return redirect()->to(site_url('/'));
                            }

                    } else {
                        //Password is not correct
                        $session->setFlashdata('message','Please check your password and try again.');
                        return redirect()->to(site_url('/'));
                    }

                
                break;

                case 2:
                //User Doesn't Exist
                $session->setFlashdata('message','This account has been disabled.');
				return redirect()->to(site_url('/'));
                break;
            }

        } 

        else {
            $session->setFlashdata('message','This email doesn\'t exist in our system!');
            return redirect()->to(site_url('/'));
        }
        
    }   

    public function update_user() {
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $userDB = new ModUsers();
        $checkLoggedIn = $session->get('uId');

        $data['email'] = $request->getPost('email');
        $data['firstName'] = $request->getPost('first_name');
        $data['lastName'] = $request->getPost('last_name');
        $old = $request->getPost('current_password');
		$data['password'] = $request->getPost('new_password');
        $confirm = $request->getPost('confirm_password');

        //Check to see if user is updating password
        if (!empty($old) && !empty($data['password'])) {

            //Make sure they entered the correct password
            $checkPass =  $userDB->getWhere(['uId'=>$checkLoggedIn,'password'=>$old])->getResultArray();

            if (count($checkPass) == 1) {
                //Password is right

                //Verify Password Inputs
                if ($data['password'] == $confirm) {
                //Password Matches Correctly
                
                //Update Password
                $userDB->set('password',$data['password']);
                $userDB->set('firstName',$data['firstName']);
                $userDB->set('lastName',$data['lastName']);
				$userDB->where('uId',$checkLoggedIn);
				$activateUser = $userDB->update();

                $session->setFlashdata('message','Password successfully updated.');
                return redirect()->to(site_url('/users')); 
                }
                else {
                $session->setFlashdata('message','Please confirm the new password correctly.');
                return redirect()->to(site_url('/users'));
                }
            }

            else {
                //Password is wrong
                $session->setFlashdata('message',' Password is wrong, please try again.');
                return redirect()->to(site_url('/users'));
            }
        }


        else {
            //Update just user info
            $userDB->set('firstName',$data['firstName']);
            $userDB->set('lastName',$data['lastName']);
            $userDB->set('email',$data['email']);
            $userDB->where('uId',$checkLoggedIn);
            $activateUser = $userDB->update();

            if ($activateUser) {
                $session->setFlashdata('message','Profile successfully updated.');
                return redirect()->to(site_url('/users')); 
            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(site_url('/users')); 
            }
        }
        
    }

    public function edit_billing() {
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $userDB = new ModUsers();
        $billDB = new ModBilling();
        $checkLoggedIn = $session->get('uId');

        $data['bFirstName'] = $request->getPost('billing_first');
        $data['bLastName'] = $request->getPost('billing_last');
        $data['bCompany'] = $request->getPost('billing_company');
        $data['bAddress'] = $request->getPost('billing_address');
        $data['bApt'] = $request->getPost('billing_apt');
        $data['bZip'] = $request->getPost('billing_zip');
        $data['bCity'] = $request->getPost('billing_city');
        $data['bCountry'] = $request->getPost('billing_country');
        $data['bState'] = $request->getPost('billing_state');
        $data['userId'] = $checkLoggedIn;

        //Make sure we are getting the data
        if (!empty($data)) {

            $checkBilling =  $billDB->where('userId',$checkLoggedIn)->findAll();

            if (count($checkBilling) == 1) {
                //Update Billing Info
                $billDB->set('bFirstName',$data['bFirstName']);
                $billDB->set('bLastName',$data['bLastName']);
                $billDB->set('bCompany',$data['bCompany']);
                $billDB->set('bAddress',$data['bAddress']);
                $billDB->set('bApt',$data['bApt']);
                $billDB->set('bZip',$data['bZip']);
                $billDB->set('bCity',$data['bCity']);
                $billDB->set('bCountry',$data['bCountry']);
                $billDB->set('bState',$data['bState']);

				$billDB->where('userId',$checkLoggedIn);
				$updateBilling = $billDB->update();
                $session->setFlashdata('message','Billing address successfully updated.');
                return redirect()->to(site_url('/users#address')); 
            }
    
            else {
                //Create Billing Info
                $addUser = $billDB->insert($data);
    
                if ($addUser) {
                    $session->setFlashdata('fetchData',$data);
                    $session->setFlashdata('SuccessMessage','Your account was succesfully created! Check your email when your ready to activate your account.');
                    return redirect()->to(site_url('/users#address'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    return redirect()->to(site_url('/users#address'));
                }
            }

        }

        else {
            //Didn't get any data
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(site_url('/users')); 

        }
        
    }

    public function log_out() {
        $session = \Config\Services::session();
        $session->destroy();
        $session->setFlashData('successMessage','You have successfully logged out.');
        $session->keepFlashdata('successMessage');
        return redirect()->to(site_url('/'));
    }




}//end of controller