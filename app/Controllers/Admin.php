<?php namespace App\Controllers;

use App\Models\ModAdmin;
use App\Models\ModLogin;
use App\Models\ModSub;
use App\Models\ModProducts;
use App\Models\ModSpec;
use App\Models\ModSpecValues;
use App\Models\ModGallery;

use App\Models\ModCustomOrders;
use App\Models\ModOrders;

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
            $adminDB = new ModLogin();

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
            $adminDB = new ModLogin();

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
                    $dataUpload['cDate'] = date('Y-m-d H:i:s');
                    $dataUpload['adminId'] = $session->get('aId');
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
                $session->setFlashdata('message','You need a category name.');
                return redirect()->to(base_url('/admin/newCategory'));
            }

        } else {
            $session->setFlashdata('message','Please login to add a category.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function viewCategories($page = 'viewCategories') {
        $session = \Config\Services::session();
		$data['title'] = 'Admin - View Categories';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;
    


        if (adminLoggedIn()) {
            $adminDB = new ModAdmin();
            $data = [
                'results' => $adminDB->paginate(20),
                'pager' => $adminDB->pager];

                $data['message'] = $session->getFlashdata('message');
                $data['successMessage'] = $session->getFlashdata('successMessage');
            
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/viewCategories', $data);
            echo view('admin/header/footer', $data);

            
        } else {
            $session->setFlashdata('message','Please login to view all categories.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function editCategory($cId = NULL, $page = 'editCategory') {
        $session = \Config\Services::session();
        $data['message'] = $session->getFlashdata('message');
        $data['successMessage'] = $session->getFlashdata('successMessage');

        if (adminLoggedIn()) {
            if (!empty($cId) && isset($cId)) {
                $adminDB = new ModAdmin();
                $checkCategoryById = $adminDB->where('cId',$cId)->findAll();
                $data['category'] = $checkCategoryById;
                if (count($data['category']) == 1) {
                    echo view('admin/header/header', $data);
                    echo view('admin/header/css', $data);
                    echo view('admin/header/navtop', $data);
                    echo view('admin/header/navleft', $data);
                    echo view('admin/home/editCategory', $data);
                    echo view('admin/header/footer', $data);
                } else {
                    $session->setFlashdata('message','Category not found.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewCategories'));
                }
                


            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(base_url('/admin/viewCategories'));
            }
            
        } 
        
        
        
        else {
            $session->setFlashdata('message','Please login to edit categories.');
            return redirect()->to(base_url('/admin/login'));
        }

    }

    public function updateCategory($page = 'updateCategory') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModAdmin();

        if (adminLoggedIn()) {
            $data['cName'] = $request->getPost('categoryName');
            $data['cId'] = $request->getPost('id');
            $data['cDate'] = date('Y-m-d H:i:s');
            $data['adminId'] = $session->get('aId');

            if (!empty($data['cName']) && isset($data['cName'])) {

                $file = $request->getFile('cDp');
                if (!empty($file) && $file->getSize() > 0) {
                    $fileName = $file->getName();
                    $file->move('/var/www/html/public/img/categories/', $fileName);
                    $data['cDp'] = $fileName;
                    $oldImg = $request->getPost('old');
                    if (file_exists('/var/www/html/public/img/categories/'.$oldImg)) {
                        unlink('/var/www/html/public/img/categories/'.$oldImg);
                    } else {

                    }


                } else {
                    $cId = $request->getPost('id');
                    $getCategory = $adminDB->where('cId',$cId)->findAll();
                    $data['cDp'] = $getCategory[0]['cDp'];
                }

                $adminDB->where('cName',$data['cId'])->findAll();
                $updateData = $adminDB->replace($data);

                if ($updateData) {
                    $session->setFlashdata('successMessage','You have successfully updated the category.');
                    return redirect()->to(base_url('/admin/viewCategories'));
                } else{
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    return redirect()->to(base_url('/admin/viewCategories'));
                }

            } else {
                $session->setFlashdata('message','Category name is required.');
                return redirect()->to(base_url('/admin/viewCategories'));
            }

        }

        else {
            $session->setFlashdata('message','Please login to update categories.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function deleteCategory($cId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        
        if (adminLoggedIn()) {

            if (!empty($cId) && isset($cId)) {
                $adminDB = new ModAdmin();
                $result = $adminDB->where('cId',$cId)->delete();

                if ($result) {
  
                    $session->setFlashdata('successMessage','Category successfully deleted.');
                    $session->keepFlashdata('sucessMessage');
                    return redirect()->to(base_url('/admin/viewCategories'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewCategories'));
                }
                
            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                $session->keepFlashdata('message');
                return redirect()->to(base_url('/admin/viewCategories'));
            }

        } else {
            $session->setFlashdata('message','Please login to delete categories.');
            $session->keepFlashdata('message');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function viewSubCategories($page = 'viewSubCategories') {
        $session = \Config\Services::session();
		$data['title'] = 'Admin - View Categories';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;
    
        $data['message'] = $session->getFlashdata('message');
        $data['successMessage'] = $session->getFlashdata('successMessage');

        if (adminLoggedIn()) {
            $adminDB = new ModSub();
            $catDB = new ModAdmin();
            $data = [
                'results' => $adminDB->paginate(20),
                'pager' => $adminDB->pager,
                'categories' => $catDB->findAll()];

                $data['message'] = $session->getFlashdata('message');
                $data['successMessage'] = $session->getFlashdata('successMessage');
            
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/viewSubCategories', $data);
            echo view('admin/header/footer', $data);

            
        } else {
            $session->setFlashdata('message','Please login to view all categories.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function newSubCategory($page = 'newSubCategory')
    {
		$data['title'] = 'Admin - New Sub Category';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

        $session = \Config\Services::session();
        $data['message'] = $session->getFlashdata('message');
        $data['successMessage'] = $session->getFlashdata('successMessage');
        
        if (adminLoggedIn()) {
            $adminDB = new ModAdmin();
            $data['categories'] = $adminDB->findAll();
            
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/newSubCategory', $data);
            echo view('admin/header/footer', $data);
        } else {
            $session->setFlashdata('message','Please login to add a sub category.');
            return redirect()->to(base_url('/admin/login'));
            
            
        }
    }

    public function addSubCategory($page = 'addSubCategory') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModSub();
        

        if (adminLoggedIn()) {
            $dataUpload['scName'] = $request->getPost('subCategoryName');
            $dataUpload['categoryId'] = $request->getPost('categoryId');

            if (!empty($dataUpload['scName']) ) {

                if ($dataUpload['categoryId'] != '0') {
                    $config['allows_type'] = 'gif|png|jpg|jpeg';

                    $file = $request->getFile('scDp');
                    if (!empty($file) && $file->getSize() > 0) {
                        $fileName = $file->getName();
                        $file->move('/var/www/html/public/img/sub_categories/', $fileName);
                        $dataUpload['scDp'] = $fileName;
                        $dataUpload['scDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    } else {
                        $dataUpload['scDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    }
                    $arrayCheck = ['scName' => $dataUpload['scName'], 'categoryId' => $dataUpload['categoryId']];
                    $checkAlreadyThere = $adminDB->where($arrayCheck)->findAll();
                    if (count($checkAlreadyThere) > 0 ){
                        $session->setFlashdata('message','This Sub Category already exists!');
                        return redirect()->to(base_url('/admin/newSubCategory'));
                    } else {
                        $addData = $adminDB->insert($dataUpload);
                        if ($addData) {
                            $session->setFlashdata('successMessage','You have successfully added a sub category.');
                            return redirect()->to(base_url('/admin/newSubCategory'));
                        } else {
                            $session->setFlashdata('message','Something went wrong, please try again.');
                            return redirect()->to(base_url('/admin/newSubCategory'));
                        }
                    }
                } else {
                    $session->setFlashdata('message','Please select a main category.');
                    return redirect()->to(base_url('/admin/newSubCategory'));
                }


            } else {
                $session->setFlashdata('message','You need a Sub Category name.');
                return redirect()->to(base_url('/admin/newSubCategory'));
            }

        } else {
            $session->setFlashdata('message','Please login to add a Sub Category.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function editSubCategory($scId, $page = 'editSubCategory') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        if (adminLoggedIn()) {
            if (!empty($scId) && isset($scId)) {

                $builder = new ModSub();
            
                $checkSubById = $builder->where('scId',$scId)->findAll();
                $data['subCategory'] = $checkSubById;
                if (count($data['subCategory']) == 1) {
                    $adminDB = new ModAdmin();
                    $data['categories'] = $adminDB->findAll();
                    
                    echo view('admin/header/header', $data);
                    echo view('admin/header/css', $data);
                    echo view('admin/header/navtop', $data);
                    echo view('admin/header/navleft', $data);
                    echo view('admin/home/editSubCategory', $data);
                    echo view('admin/header/footer', $data);
                } else {
                    $session->setFlashdata('message','Sub category not found.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewSubCategories'));
                }
                


            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(base_url('/admin/viewSubCategories'));
            }
            
        }   
        
        else {
            $session->setFlashdata('message','Please login to edit sub categories.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function updateSubCategory($scId = NULL,$page = 'updateSubCategory') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModSub();
        

        if (adminLoggedIn()) {
            $dataUpload['scName'] = $request->getPost('subCategoryName');
            $dataUpload['categoryId'] = $request->getPost('categoryId');
            $dataUpload['scId'] = $request->getPost('id');//sub category ID
            $oldImg = $request->getPost('old');

            if (!empty($dataUpload['scName']) ) {

                if ($dataUpload['categoryId'] != '0') {
                    $config['allows_type'] = 'gif|png|jpg|jpeg';

                    $file = $request->getFile('scDp');
                    if (!empty($file) && $file->getSize() > 0) {
                        if (file_exists('/var/www/html/public/img/sub_categories/'.$oldImg)) {
                            unlink('/var/www/html/public/img/sub_categories/'.$oldImg);
                        } else {
                        }
                        $fileName = $file->getName();
                        $file->move('/var/www/html/public/img/sub_categories/', $fileName);
                        $dataUpload['scDp'] = $fileName;
                        $dataUpload['scDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');

                    } else {
                        $dataUpload['scDp'] = $oldImg;
                        $dataUpload['scDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    }
                    $arrayCheck = ['scName' => $dataUpload['scName'], 'categoryId' => $dataUpload['categoryId']];
                    $checkAlreadyThere = $adminDB->where($arrayCheck)->findAll();

                        $adminDB->where('scId',$dataUpload['scId'])->findAll();
                        $addData = $adminDB->replace($dataUpload);
                        if ($addData) {
                            $session->setFlashdata('successMessage','You have successfully updated your category.');
                            return redirect()->to(base_url('/admin/viewSubCategories'));
                        } else {
                            $session->setFlashdata('message','Something went wrong, please try again.');
                            return redirect()->to(base_url('/admin/viewSubCategories'));
                        }
                    
                } else {
                    $session->setFlashdata('message','Please select a main category.');
                    return redirect()->to(base_url('/admin/viewSubCategories'));
                }


            } else {
                $session->setFlashdata('message','You need a Sub Category name.');
                return redirect()->to(base_url('/admin/viewSubCategories'));
            }

        } else {
            $session->setFlashdata('message','Please login to add a Sub Category.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function deleteSubCategory($scId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        
        if (adminLoggedIn()) {

            if (!empty($scId) && isset($scId)) {
                $adminDB = new ModSub();
                $result = $adminDB->where('scId',$scId)->delete();

                if ($result) {
  
                    $session->setFlashdata('successMessage','Category successfully deleted.');
                    $session->keepFlashdata('sucessMessage');
                    return redirect()->to(base_url('/admin/viewSubCategories'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewSubCategories'));
                }
                
            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                $session->keepFlashdata('message');
                return redirect()->to(base_url('/admin/viewSubCategories'));
            }

        } else {
            $session->setFlashdata('message','Please login to delete categories.');
            $session->keepFlashdata('message');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function newProduct($page = 'newProduct')
    {
		$data['title'] = 'Admin - New Product';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

        $session = \Config\Services::session();
        $data['message'] = $session->getFlashdata('message');
        $data['successMessage'] = $session->getFlashdata('successMessage');
        
        if (adminLoggedIn()) {
            $adminDB = new ModAdmin();
            $data['categories'] = $adminDB->findAll();
            
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/newProduct', $data);
            echo view('admin/header/footer', $data);
        } else {
            $session->setFlashdata('message','Please login to add a sub category.');
            return redirect()->to(base_url('/admin/login'));
            
            
        }
    }

    public function action() { //AJAX POPULATE DROPDOWNS ON PRODUCT PAGE
        if($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if($action == 'get_sub_cat')
            {
                $subDB = new ModSub();

                $subCatData = $subDB->where('categoryId', $this->request->getVar('category_id'))->findAll();

                echo json_encode($subCatData);
            }
        }

        else {

        }
    }

    public function addProduct($page = 'addProduct') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModProducts();
        
        if (adminLoggedIn()) {
            $dataUpload['pName'] = $request->getPost('productName');
            $dataUpload['pDescription'] = $request->getPost('productDescription');
            $dataUpload['categoryId'] = $request->getPost('categoryId');
            $dataUpload['subCatId'] = $request->getPost('subCategory');
            $dataUpload['pPrice'] = $request->getPost('pPrice');

            if (!empty($dataUpload['pName']) ) {

                if ($dataUpload['categoryId'] != '0') {
                    $config['allows_type'] = 'gif|png|jpg|jpeg';

                    $file = $request->getFile('pDp');
                    if (!empty($file) && $file->getSize() > 0) {
                        $fileName = $file->getName();
                        $file->move('/var/www/html/public/img/products/', $fileName);
                        $dataUpload['pDp'] = $fileName;

                    } 

                    $file2 = $request->getFile('pDp2');
                    if (!empty($file2) && $file2->getSize() > 0) {
                        $file2Name = $file2->getName();
                        $file2->move('/var/www/html/public/img/products/', $file2Name);
                        $dataUpload['pDp2'] = $file2Name;

                    }

                    $file3 = $request->getFile('pDp3');
                    if (!empty($file3) && $file3->getSize() > 0) {
                        $file3Name = $file3->getName();
                        $file3->move('/var/www/html/public/img/products/', $file3Name);
                        $dataUpload['pDp3'] = $file3Name;
                    }

                    $file4 = $request->getFile('pDp4');
                    if (!empty($file4) && $file4->getSize() > 0) {
                        $file4Name = $file4->getName();
                        $file4->move('/var/www/html/public/img/products/', $file4Name);
                        $dataUpload['pDp4'] = $file3Name;
                    } 

                    $dataUpload['pDate'] = date('Y-m-d H:i:s');
                    $dataUpload['adminId'] = $session->get('aId');
 

                    $arrayCheck = ['pName' => $dataUpload['pName'], 'categoryId' => $dataUpload['categoryId']];
                    $checkAlreadyThere = $adminDB->where($arrayCheck)->findAll();
                    if (count($checkAlreadyThere) > 0 ){
                        $session->setFlashdata('message','This product already exists in this category.');
                        return redirect()->to(base_url('/admin/newProduct'));
                    } else {
                    $addData = $adminDB->insert($dataUpload);
                        if ($addData) {
                            $session->setFlashdata('successMessage','You have successfully added a product.');
                            return redirect()->to(base_url('/admin/ViewProducts'));
                        } else {
                            $session->setFlashdata('message','Something went wrong, please try again.');
                            return redirect()->to(base_url('/admin/newProduct'));
                        }
                    }
                } else {
                    $session->setFlashdata('message','Please select a main category.');
                    return redirect()->to(base_url('/admin/newProduct'));
                }


            } else {
                $session->setFlashdata('message','You need a product name.');
                return redirect()->to(base_url('/admin/newProduct'));
            }

        } else {
            $session->setFlashdata('message','Please login to add a product.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

   public function viewProducts($page = 'viewProducts') 
   {
        $session = \Config\Services::session();
		$data['title'] = 'Admin - View Products';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;
    
        $data['message'] = $session->getFlashdata('message');
        $data['successMessage'] = $session->getFlashdata('successMessage');

        if (adminLoggedIn()) {
            $adminDB = new ModProducts();
            $subCatDB = new ModSub();
            $data = [
                'results' => $adminDB->paginate(20),
                'pager' => $adminDB->pager,
                'categories' => $subCatDB->findAll()];

                $data['message'] = $session->getFlashdata('message');
                $data['successMessage'] = $session->getFlashdata('successMessage');
            
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/viewProducts', $data);
            echo view('admin/header/footer', $data);

            
        } else {
            $session->setFlashdata('message','Please login to view all categories.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function deleteProduct($pId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        
        if (adminLoggedIn()) {

            if (!empty($pId) && isset($pId)) {
                $adminDB = new ModProducts();
                $result = $adminDB->where('pId',$pId)->delete();

                if ($result) {
  
                    $session->setFlashdata('successMessage','Product successfully deleted.');
                    $session->keepFlashdata('sucessMessage');
                    return redirect()->to(base_url('/admin/viewProducts'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewProducts'));
                }
                
            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                $session->keepFlashdata('message');
                return redirect()->to(base_url('/admin/viewProducts'));
            }

        } else {
            $session->setFlashdata('message','Please login to delete products.');
            $session->keepFlashdata('message');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function editProduct($pId, $page = 'editProduct') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        if (adminLoggedIn()) {
            if (!empty($pId) && isset($pId)) {

                $builder = new ModProducts();
            
                $checkProductById = $builder->where('pId',$pId)->findAll();
                $data['product'] = $checkProductById;
                if (count($data['product']) == 1) {
                    $adminDB = new ModAdmin();
                    $data['categories'] = $adminDB->findAll();
                    
                    echo view('admin/header/header', $data);
                    echo view('admin/header/css', $data);
                    echo view('admin/header/navtop', $data);
                    echo view('admin/header/navleft', $data);
                    echo view('admin/home/editProduct', $data);
                    echo view('admin/header/footer', $data);

                } else {
                    $session->setFlashdata('message','Product not found.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewProducts'));
                }
                


            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(base_url('/admin/viewProducts'));
            }
            
        }   
        
        else {
            $session->setFlashdata('message','Please login to edit products.');
            return redirect()->to(base_url('/admin/login'));
        }
    }


    public function updateProduct($page = 'updateProduct') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModProducts();
        

        if (adminLoggedIn()) {
            $dataUpload['pName'] = $request->getPost('productName');
            $dataUpload['pDescription'] = $request->getPost('productDescription');
            $dataUpload['categoryId'] = $request->getPost('categoryId');
            $dataUpload['subCatId'] = $request->getPost('subCategory');
            $dataUpload['pId'] = $request->getPost('pId');
            $dataUpload['pPrice'] = $request->getPost('pPrice');

            if (!empty($dataUpload['pName']) ) {

                if ($dataUpload['categoryId'] != '0') {
                    $config['allows_type'] = 'gif|png|jpg|jpeg';

                    $file = $request->getFile('pDp');
                    if (!empty($file) && $file->getSize() > 0) {
                        $oldImg = $request->getPost('oldImg');
                        if (file_exists('/var/www/html/public/img/products/'.$oldImg)) {
                            unlink('/var/www/html/public/img/products/'.$oldImg);
                        } else {
                        }
                        $fileName = $file->getName();
                        $file->move('/var/www/html/public/img/products/', $fileName);
                        $dataUpload['pDp'] = $fileName;
                        $dataUpload['pDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    } else {
                        $dataUpload['pDp'] = $request->getPost('oldImg');
                        $dataUpload['pDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    }

                    $file2 = $request->getFile('pDp2');
                    if (!empty($file2) && $file2->getSize() > 0) {
                        $file2Name = $file2->getName();
                        $file2->move('/var/www/html/public/img/products/', $file2Name);
                        $dataUpload['pDp2'] = $file2Name;
                    } else {
                        $dataUpload['pDp2'] = $request->getPost('oldImg2');
                    }

                    $file3 = $request->getFile('pDp3');
                    if (!empty($file3) && $file3->getSize() > 0) {
                        $file3Name = $file3->getName();
                        $file3->move('/var/www/html/public/img/products/', $file3Name);
                        $dataUpload['pDp3'] = $file3Name;
                    } else {
                        $dataUpload['pDp3'] = $request->getPost('oldImg3');
                    }

                    $file4 = $request->getFile('pDp4');
                    if (!empty($file4) && $file4->getSize() > 0) {
                        $file4Name = $file4->getName();
                        $file4->move('/var/www/html/public/img/products/', $file4Name);
                        $dataUpload['pDp4'] = $file4Name;
                    } else {
                        $dataUpload['pDp4'] = $request->getPost('oldImg4');
                    }

                    $arrayCheck = ['pName' => $dataUpload['pName'], 'categoryId' => $dataUpload['categoryId']];
                    $checkAlreadyThere = $adminDB->where($arrayCheck)->findAll();

                    $adminDB->where('pId',$dataUpload['pId'])->findAll();

                    $addData = $adminDB->replace($dataUpload);
                        if ($addData) {
                            $session->setFlashdata('successMessage','You have successfully updated your product.');
                            return redirect()->to(base_url('/admin/viewProducts'));
                        } else {
                            $session->setFlashdata('message','Something went wrong, please try again.');
                            return redirect()->to(base_url('/admin/viewProducts'));
                        }
                    
                } else {
                    $session->setFlashdata('message','Please select a main category.');
                    return redirect()->to(base_url('/admin/viewProducts'));
                }


            } else {
                $session->setFlashdata('message','You need a product name.');
                return redirect()->to(base_url('/admin/newProduct'));
            }

        } else {
            $session->setFlashdata('message','Please login to edit products.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function newSpec($page = 'newSpec')
    {
		$data['title'] = 'Admin - Create New Spec';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

        $session = \Config\Services::session();
        $data['message'] = $session->getFlashdata('message');
        $data['successMessage'] = $session->getFlashdata('successMessage');
        
        if (adminLoggedIn()) {
            $adminDB = new ModProducts();
            $data['products'] = $adminDB->findAll();
            
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/newSpec', $data);
            echo view('admin/header/footer', $data);
        } else {
            $session->setFlashdata('message','Please login to add new specs.');
            return redirect()->to(base_url('/admin/login'));
            
            
        }
    }

    public function addSpecs($page = 'addSpecs') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModProducts();
        $specDB = new ModSpec();
        
        

        if (adminLoggedIn()) {
            $dataUpload['spName'] = $request->getPost('sp_name');
            $specValues = $request->getPost('sp_val');//array
            $specValues = array_filter($specValues);

            $specPrices = $request->getPost('sp_p'); //array
            $specPrices = array_filter($specPrices);

            $dataUpload['productId'] = $request->getPost('productId');
            
            if (!empty($dataUpload['spName']) && !empty($specValues) ) {

                if ($dataUpload['productId'] != '0') {

                    $arrayCheck = ['spName' => $dataUpload['spName'], 'productId' => $dataUpload['productId']];
                    $checkAlreadyThere = $specDB->where($arrayCheck)->findAll();

                    $dataUpload['adminId'] = getAdminId();
                    $dataUpload['spDate'] = date('Y-m-d H:i:s');

                    if (count($checkAlreadyThere) > 0 ){
                        $session->setFlashdata('message','These specs already exist for this product.');
                        return redirect()->to(base_url('/admin/newSpec'));
                    } else {

                        $checkSpecName = $specDB->insert($dataUpload);
                        $specId = $specDB->insertID();
             
                        if ($checkSpecName && is_numeric($specId)) {
                            $specValueDB = new ModSpecValues();
                            $spec_values = array();
                            foreach ($specValues as $specVal => $price) {
                                $spec_values[] = array(
                                    'specId'=>$specId,
                                    'adminId'=>$dataUpload['adminId'],
                                    'spvDate'=>date('Y-m-d H:i:s'),
                                    'spvName'=>$price,
                                    'spvPrice'=>$specPrices[$specVal]
                                );
                            } 
                
                            $specValStatus = $specValueDB->insertBatch($spec_values);

                            if ($specValStatus) {
                                $session->setFlashdata('successMessage','You have successfully added a new spec.');
                                return redirect()->to(base_url('/admin/newSpec'));
                            } else {
                                $session->setFlashdata('message','Something went wrong, please try again.');
                                return redirect()->to(base_url('/admin/newSpec'));
                            }
                        }
                    }

                } else {
                    $session->setFlashdata('message','Please select a product.');
                    return redirect()->to(base_url('/admin/newSpec'));
                }


            } else {
                $session->setFlashdata('message','You need a spec name.');
                return redirect()->to(base_url('/admin/newSpec'));
            }

        } else {
            $session->setFlashdata('message','Please login to add a product.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function viewSpecs($page = 'viewSpecs') 
    {
         $session = \Config\Services::session();
         $data['title'] = 'Admin - View all Specs';
         $data['metaData'] = "";
         $data['page'] = $page;
         $data['cssFile'] = $page;
         $data['uri'] = $this->request->uri;
     
         $data['message'] = $session->getFlashdata('message');
         $data['successMessage'] = $session->getFlashdata('successMessage');
 
         if (adminLoggedIn()) {
             $adminDB = new ModSpec();
             $productDB = new ModProducts();

             $data = [
                 'results' => $adminDB->paginate(20),
                 'pager' => $adminDB->pager,
                 'products' => $productDB->findAll()
                ];
 
                 $data['message'] = $session->getFlashdata('message');
                 $data['successMessage'] = $session->getFlashdata('successMessage');
             
             echo view('admin/header/header', $data);
             echo view('admin/header/css', $data);
             echo view('admin/header/navtop', $data);
             echo view('admin/header/navleft', $data);
             echo view('admin/home/viewSpecs', $data);
             echo view('admin/header/footer', $data);
 
             
         } else {
             $session->setFlashdata('message','Please login to view all categories.');
             return redirect()->to(base_url('/admin/login'));
         }
     }

     public function deleteSpec($spId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        
        if (adminLoggedIn()) {

            if (!empty($spId) && isset($spId)) {
                $adminDB = new ModSpec();
                $result = $adminDB->where('spId',$spId)->delete();

                if ($result) {
  
                    $session->setFlashdata('successMessage','Specs successfully deleted.');
                    $session->keepFlashdata('sucessMessage');
                    return redirect()->to(base_url('/admin/viewSpecs'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewSpecs'));
                }
                
            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                $session->keepFlashdata('message');
                return redirect()->to(base_url('/admin/viewSpecs'));
            }

        } else {
            $session->setFlashdata('message','Please login to delete specs.');
            $session->keepFlashdata('message');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function editSpec($spId, $page = 'editSpec') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        if (adminLoggedIn()) {
            if (!empty($spId) && isset($spId)) {

                $builder = new ModSpec();
            
                $checkSpecById = $builder->where('spId',$spId)->findAll();
                $data['spec'] = $checkSpecById;
                if (count($data['spec']) == 1) {
                    $adminDB = new ModProducts();
                    $data['products'] = $adminDB->findAll();
                    
                    echo view('admin/header/header', $data);
                    echo view('admin/header/css', $data);
                    echo view('admin/header/navtop', $data);
                    echo view('admin/header/navleft', $data);
                    echo view('admin/home/editSpec', $data);
                    echo view('admin/header/footer', $data);
                } else {
                    $session->setFlashdata('message','Sub category not found.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewSubCategories'));
                }
                


            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(base_url('/admin/viewSubCategories'));
            }
            
        }   
         
        else {
            $session->setFlashdata('message','Please login to edit sub categories.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function updateSpec($page = 'updateSpec') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModProducts();
        $specDB = new ModSpec();
        
        

        if (adminLoggedIn()) {
            $dataUpload['spName'] = $request->getPost('sp_name');
            $dataUpload['productId'] = $request->getPost('productId');
            $dataUpload['adminId'] = getAdminId();
            $specId = $request->getPost('specId');
            $dataUpload['spId'] = $specId;

            if (!empty($dataUpload['spName']) && !empty($specId) ) {

                if ($dataUpload['productId'] != '0') {

                    $arrayCheck = ['spName' => $dataUpload['spName'], 'productId' => $dataUpload['productId']];
                    $checkAlreadyThere = $specDB->where($arrayCheck)->findAll();



                    if (count($checkAlreadyThere) > 0 ){
                        $session->setFlashdata('message','These specs already exist for this product.');
                        return redirect()->to(base_url('/admin/viewSpecs'));
                    } else {
                        $specDB->getWhere(['spId'=>$specId]);
                        //var_dump($dataUpload);
                        $updateSpec = $specDB->replace($dataUpload);

                        if ($updateSpec) {
                            //$specValueDB = new ModSpecValues();

                            $session->setFlashdata('successMessage','Spec successfully updated.');
                            return redirect()->to(base_url('/admin/viewSpecs'));
                
                        } else {
                            $session->setFlashdata('message','You can\'t add your spec name right now.');
                            return redirect()->to(base_url('/admin/viewSpecs'));
                        }
                        
                    }

                } else {
                    $session->setFlashdata('message','Please select a product.');
                    return redirect()->to(base_url('/admin/viewSpecs'));
                }


            } else {
                $session->setFlashdata('message','You need a spec name.');
                return redirect()->to(base_url('/admin/viewSpecs'));
            }

        } else {
            $session->setFlashdata('message','Please login to add a product.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function newGallery($page = 'newGallery')
    {
		$data['title'] = 'Admin - New Gallery Entry';
		$data['metaData'] = "";
		$data['page'] = $page;
		$data['cssFile'] = $page;
		$data['uri'] = $this->request->uri;

        $session = \Config\Services::session();
        $data['message'] = $session->getFlashdata('message');
        $data['successMessage'] = $session->getFlashdata('successMessage');
        
        if (adminLoggedIn()) {
            $adminDB = new ModAdmin();
            $data['categories'] = $adminDB->findAll();
            
            echo view('admin/header/header', $data);
            echo view('admin/header/css', $data);
            echo view('admin/header/navtop', $data);
            echo view('admin/header/navleft', $data);
            echo view('admin/home/newGallery', $data);
            echo view('admin/header/footer', $data);
        } else {
            $session->setFlashdata('message','Please login to add a sub category.');
            return redirect()->to(base_url('/admin/login'));
            
            
        }
    }

    public function addGallery($page = 'addGallery') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModGallery();
        

        if (adminLoggedIn()) {
            $dataUpload['gName'] = $request->getPost('galleryName');
            $dataUpload['gDescription'] = $request->getPost('galleryDescription');
            $dataUpload['categoryName'] = $request->getPost('categoryName');
            $dataUpload['gDp'] = $request->getPost('gDp');
            $dataUpload['gDp2'] = $request->getPost('gDp2');
            $dataUpload['gDp3'] = $request->getPost('gDp3');
            $dataUpload['gDp4'] = $request->getPost('gDp4');

            if (!empty($dataUpload['gName']) ) {

                if ($dataUpload['categoryName'] != '0') {
                    $config['allows_type'] = 'gif|png|jpg|jpeg';

                    $file = $request->getFile('gDp');
                    if (!empty($file) && $file->getSize() > 0) {
                        //upload first image
                        $fileName = $file->getName();
                        $file->move('/var/www/html/public/img/gallery/', $fileName);

                        //check for image 2
                        $file2 = $request->getFile('gDp2');
                        if (!empty($file2) && $file2->getSize() > 0) {
                            $fileName2 = $file2->getName();
                            $file2->move('/var/www/html/public/img/gallery/', $fileName2);
                            $dataUpload['gDp2'] = $fileName2;
                        } 
                        
                        //check for image 3
                        $file3 = $request->getFile('gDp3');
                        if (!empty($file3) && $file3->getSize() > 0) {
                            $fileName3 = $file3->getName();
                            $file3->move('/var/www/html/public/img/gallery/', $fileName3);
                            $dataUpload['gDp3'] = $fileName3;
                        } 

                        //check for image 4
                        $file4 = $request->getFile('gDp4');
                        if (!empty($file4) && $file4->getSize() > 0) {
                            $fileName4 = $file4->getName();
                            $file4->move('/var/www/html/public/img/gallery/', $fileName4);
                            $dataUpload['gDp4'] = $fileName4;
                        } 
                        

                        $dataUpload['gDp'] = $fileName;
                        $dataUpload['gDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    } else {
                        $dataUpload['gDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    }
                    $arrayCheck = ['gName' => $dataUpload['gName'], 'categoryName' => $dataUpload['categoryName']];
                    $checkAlreadyThere = $adminDB->where($arrayCheck)->findAll();
                    if (count($checkAlreadyThere) > 0 ){
                        $session->setFlashdata('message','This product already exists in this category.');
                        return redirect()->to(base_url('/admin/newGallery'));
                    } else {
                    $addData = $adminDB->insert($dataUpload);
                        if ($addData) {
                            $session->setFlashdata('successMessage','You have successfully added an entry.');
                            return redirect()->to(base_url('/admin/viewGallery'));
                        } else {
                            $session->setFlashdata('message','Something went wrong, please try again.');
                            return redirect()->to(base_url('/admin/newGallery'));
                        }
                    }
                } else {
                    $session->setFlashdata('message','Please select a main category.');
                    return redirect()->to(base_url('/admin/newGallery'));
                }


            } else {
                $session->setFlashdata('message','You need to enter a name.');
                return redirect()->to(base_url('/admin/newGallery'));
            }

        } else {
            $session->setFlashdata('message','Please login to add a gallery entry.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function viewGallery($page = 'viewGallery') 
    {
         $session = \Config\Services::session();
         $data['title'] = 'Admin - View Gallery';
         $data['metaData'] = "";
         $data['page'] = $page;
         $data['cssFile'] = $page;
         $data['uri'] = $this->request->uri;
     
         $data['message'] = $session->getFlashdata('message');
         $data['successMessage'] = $session->getFlashdata('successMessage');
 
         if (adminLoggedIn()) {
             $adminDB = new ModGallery();
             $subCatDB = new ModSub();
             $data = [
                 'results' => $adminDB->paginate(20),
                 'pager' => $adminDB->pager,
                 'categories' => $subCatDB->findAll()];
 
                 $data['message'] = $session->getFlashdata('message');
                 $data['successMessage'] = $session->getFlashdata('successMessage');
             
             echo view('admin/header/header', $data);
             echo view('admin/header/css', $data);
             echo view('admin/header/navtop', $data);
             echo view('admin/header/navleft', $data);
             echo view('admin/home/viewGallery', $data);
             echo view('admin/header/footer', $data);
 
             
         } else {
             $session->setFlashdata('message','Please login to view all gallery entries.');
             return redirect()->to(base_url('/admin/login'));
         }
     }

     public function editGallery($gId, $page = 'editGallery') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        if (adminLoggedIn()) {
            if (!empty($gId) && isset($gId)) {

                $builder = new ModGallery();
            
                $checkGalleryById = $builder->where('gId',$gId)->findAll();
                $data['gallery'] = $checkGalleryById;
                if (count($data['gallery']) == 1) {
                    $adminDB = new ModAdmin();
                    $data['categories'] = $adminDB->findAll();
                    
                    echo view('admin/header/header', $data);
                    echo view('admin/header/css', $data);
                    echo view('admin/header/navtop', $data);
                    echo view('admin/header/navleft', $data);
                    echo view('admin/home/editGallery', $data);
                    echo view('admin/header/footer', $data);

                } else {
                    $session->setFlashdata('message','Item not found.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewGallery'));
                }
                


            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(base_url('/admin/viewGallery'));
            }
            
        }   
        
        else {
            $session->setFlashdata('message','Please login to edit gallery items.');
            return redirect()->to(base_url('/admin/login'));
        }
    }



    public function viewCustomOrders($page = 'viewCustomOrders') 
    {
         $session = \Config\Services::session();
         $data['title'] = 'Admin - View Gallery';
         $data['metaData'] = "";
         $data['page'] = $page;
         $data['cssFile'] = $page;
         $data['uri'] = $this->request->uri;
     
         $data['message'] = $session->getFlashdata('message');
         $data['successMessage'] = $session->getFlashdata('successMessage');
 
         if (adminLoggedIn()) {
             $adminDB = new ModCustomOrders();
             $subCatDB = new ModSub();
             $data = [
                 'results' => $adminDB->paginate(20),
                 'pager' => $adminDB->pager,
                 'categories' => $subCatDB->findAll()];
 
                 $data['message'] = $session->getFlashdata('message');
                 $data['successMessage'] = $session->getFlashdata('successMessage');
             
             echo view('admin/header/header', $data);
             echo view('admin/header/css', $data);
             echo view('admin/header/navtop', $data);
             echo view('admin/header/navleft', $data);
             echo view('admin/home/viewCustomOrders', $data);
             echo view('admin/header/footer', $data);
 
             
         } else {
             $session->setFlashdata('message','Please login to view all gallery entries.');
             return redirect()->to(base_url('/admin/login'));
         }
     }

     public function editCustomOrder($coId, $page = 'editOrder') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        if (adminLoggedIn()) {
            if (!empty($coId) && isset($coId)) {

                $builder = new ModCustomOrders();
            
                $checkProductById = $builder->where('coId',$coId)->findAll();
                $data['product'] = $checkProductById;
                if (count($data['product']) == 1) {
                    $adminDB = new ModAdmin();
                    $data['categories'] = $adminDB->findAll();
                    
                    echo view('admin/header/header', $data);
                    echo view('admin/header/css', $data);
                    echo view('admin/header/navtop', $data);
                    echo view('admin/header/navleft', $data);
                    echo view('admin/home/editCustomOrder', $data);
                    echo view('admin/header/footer', $data);

                } else {
                    $session->setFlashdata('message','Order not found.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewCustomOrders'));
                }
                


            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(base_url('/admin/viewProducts'));
            }
            
        }   
        
        else {
            $session->setFlashdata('message','Please login to edit products.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function updateCustomOrder($coId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModCustomOrders();
        

        if (adminLoggedIn()) {
            $data['coId'] = $request->getPost('coId');
            $data['coStatus'] = $request->getPost('statusSelect');
            $data['coFirst'] = $request->getPost('co_first');
            $data['coLast'] = $request->getPost('co_last');
            $data['coPhone'] = $request->getPost('co_phone');
            $data['coEmail'] = $request->getPost('co_email');
            $data['coMessage'] = $request->getPost('co_message');
            $data['coSize'] = $request->getPost('co_size');
            $data['coDp'] = $request->getPost('oldImg');
            $data['coDp2'] = $request->getPost('co_dp2');
            $data['coTracking'] = $request->getPost('co_tracking');

                    $adminDB->where('coId',$coId);

                    $addData = $adminDB->replace($data);
                        if ($addData) {
                            $session->setFlashdata('successMessage','You have successfully updated the custom order.');
                            return redirect()->to(base_url('/admin/viewCustomOrders'));
                        } else {
                            $session->setFlashdata('message','Something went wrong, please try again.');
                            return redirect()->to(base_url('/admin/viewCustomOrders'));
                        }
                    


        } else {
            $session->setFlashdata('message','Please login to edit products.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function deleteCustomOrder($coId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        
        if (adminLoggedIn()) {

            if (!empty($coId) && isset($coId)) {
                $adminDB = new ModCustomOrders();
                $result = $adminDB->where('coId',$coId)->delete();

                if ($result) {
  
                    $session->setFlashdata('successMessage','Custom order successfully deleted.');
                    $session->keepFlashdata('sucessMessage');
                    return redirect()->to(base_url('/admin/viewCustomOrders'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewCustomOrders'));
                }
                
            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                $session->keepFlashdata('message');
                return redirect()->to(base_url('/admin/viewCustomOrders'));
            }

        } else {
            $session->setFlashdata('message','Please login to delete custom orders.');
            $session->keepFlashdata('message');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function deleteGallery($gId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        
        if (adminLoggedIn()) {

            if (!empty($gId) && isset($gId)) {
                $adminDB = new ModGallery();
                $result = $adminDB->where('gId',$gId)->delete();

                if ($result) {
  
                    $session->setFlashdata('successMessage','Gallery item successfully deleted.');
                    $session->keepFlashdata('sucessMessage');
                    return redirect()->to(base_url('/admin/viewGallery'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewGallery'));
                }
                
            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                $session->keepFlashdata('message');
                return redirect()->to(base_url('/admin/viewGallery'));
            }

        } else {
            $session->setFlashdata('message','Please login to delete gallery items.');
            $session->keepFlashdata('message');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function viewOrders($page = 'viewOrders') 
    {
         $session = \Config\Services::session();
         $data['title'] = 'Admin - View Gallery';
         $data['metaData'] = "";
         $data['page'] = $page;
         $data['cssFile'] = $page;
         $data['uri'] = $this->request->uri;
     
         $data['message'] = $session->getFlashdata('message');
         $data['successMessage'] = $session->getFlashdata('successMessage');
 
         if (adminLoggedIn()) {
             $adminDB = new ModOrders();
             $subCatDB = new ModSub();
             $data = [
                 'results' => $adminDB->orderBy('oId', 'DESC')->paginate(20),
                 'pager' => $adminDB->pager,
                 'categories' => $subCatDB->findAll()];
 
                 $data['message'] = $session->getFlashdata('message');
                 $data['successMessage'] = $session->getFlashdata('successMessage');
             
             echo view('admin/header/header', $data);
             echo view('admin/header/css', $data);
             echo view('admin/header/navtop', $data);
             echo view('admin/header/navleft', $data);
             echo view('admin/home/ViewOrders', $data);
             echo view('admin/header/footer', $data);
 
             
         } else {
             $session->setFlashdata('message','Please login to view all gallery entries.');
             return redirect()->to(base_url('/admin/login'));
         }
     }

     public function deleteOrder($oId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        
        if (adminLoggedIn()) {

            if (!empty($oId) && isset($oId)) {
                $adminDB = new ModOrders();
                $result = $adminDB->where('oId',$oId)->delete();

                if ($result) {
  
                    $session->setFlashdata('successMessage','Order successfully deleted.');
                    $session->keepFlashdata('sucessMessage');
                    return redirect()->to(base_url('/admin/viewOrders'));
                } else {
                    $session->setFlashdata('message','Something went wrong, please try again.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewOrders'));
                }
                
            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                $session->keepFlashdata('message');
                return redirect()->to(base_url('/admin/viewOrders'));
            }

        } else {
            $session->setFlashdata('message','Please login to delete orders.');
            $session->keepFlashdata('message');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function editOrder($oId, $page = 'editOrder') {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        if (adminLoggedIn()) {
            if (!empty($oId) && isset($oId)) {

                $builder = new ModOrders();
            
                $checkProductById = $builder->where('oId',$oId)->findAll();
                $data['product'] = $checkProductById;
                if (count($data['product']) == 1) {
                    $adminDB = new ModOrders();
                    $data['categories'] = $adminDB->findAll();
                    
                    echo view('admin/header/header', $data);
                    echo view('admin/header/css', $data);
                    echo view('admin/header/navtop', $data);
                    echo view('admin/header/navleft', $data);
                    echo view('admin/home/editOrder', $data);
                    echo view('admin/header/footer', $data);

                } else {
                    $session->setFlashdata('message','Order not found.');
                    $session->keepFlashdata('message');
                    return redirect()->to(base_url('/admin/viewOrders'));
                }
                


            } else {
                $session->setFlashdata('message','Something went wrong, please try again.');
                return redirect()->to(base_url('/admin/viewProducts'));
            }
            
        }   
        
        else {
            $session->setFlashdata('message','Please login to edit products.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

    public function updateOrder($oId) {
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $adminDB = new ModOrders();
        

        if (adminLoggedIn()) {
            $data['oId'] = $request->getPost('oId');
            $data['tempId'] = $request->getPost('tempId');
            $data['oDate'] = $request->getPost('oDate');
            $data['userId'] = $request->getPost('userId');
            $data['oStatus'] = $request->getPost('statusSelect');
            $data['oProducts'] = $request->getPost('oProducts');
            $data['oPrice'] = $request->getPost('oPrice');
            $data['oCustom'] = $request->getPost('oCustom');
            $data['oTracking'] = $request->getPost('o_tracking');

            $data['billingEmail'] = $request->getPost('billingEmail');
            $data['billingCompany'] = $request->getPost('billingCompany');
            $data['billingFirst'] = $request->getPost('billingFirst');
            $data['billingLast'] = $request->getPost('billingLast');
            $data['billingAddress'] = $request->getPost('billingAddress');
            $data['billingApt'] = $request->getPost('billingApt');
            $data['billingCity'] = $request->getPost('billingCity');
            $data['billingCountry'] = $request->getPost('billingCountry');
            $data['billingZip'] = $request->getPost('billingZip');
            $data['billingState'] = $request->getPost('billingState');
            $data['billingPhone'] = $request->getPost('billingPhone');
            $data['billingNotes'] = $request->getPost('billingNotes');

            $data['shippingCompany'] = $request->getPost('shippingCompany');
            $data['shippingFirst'] = $request->getPost('shippingFirst');
            $data['shippingLast'] = $request->getPost('shippingLast');
            $data['shippingAddress'] = $request->getPost('shippingAddress');
            $data['shippingApt'] = $request->getPost('shippingApt');
            $data['shippingCity'] = $request->getPost('shippingCity');
            $data['shippingCountry'] = $request->getPost('shippingCountry');
            $data['shippingZip'] = $request->getPost('shippingZip');
            $data['shippingState'] = $request->getPost('shippingState');

                    $adminDB->where('oId',$oId);

                    $addData = $adminDB->replace($data);
                        if ($addData) {
                            $session->setFlashdata('successMessage','You have successfully updated the order status.');
                            return redirect()->to(base_url('/admin/viewOrders'));
                        } else {
                            $session->setFlashdata('message','Something went wrong, please try again.');
                            return redirect()->to(base_url('/admin/viewOrders'));
                        }
                    


        } else {
            $session->setFlashdata('message','Please login to edit orders.');
            return redirect()->to(base_url('/admin/login'));
        }
    }

} //end of controller
