<?php
namespace App\Controllers;

use App\Models\ModUsers;

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
        echo 'working';
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
                echo 'Not activated';
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
                                echo 'ession is created';
                            } else {
                                echo 'session failed to create';
                            }

                    } else {
                        //Password is not correct
                    }

                
                break;

                case 2:
                //User Doesn't Exist
                echo 'user doesnt exist';
                break;
            }

        } 

        else {
            echo 'the email doesn\'t exist';
        }
        
    }   


}//end of controller