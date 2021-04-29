<?php namespace App\Controllers;
use App\Models\ModAdmin;

use App\Models\ModLogin;

use App\Models\ModSub;

use App\Models\ModProducts;

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

            if (!empty($dataUpload['pName']) ) {

                if ($dataUpload['categoryId'] != '0') {
                    $config['allows_type'] = 'gif|png|jpg|jpeg';

                    $file = $request->getFile('pDp');
                    if (!empty($file) && $file->getSize() > 0) {
                        $fileName = $file->getName();
                        $file->move('/var/www/html/public/img/products/', $fileName);
                        $dataUpload['pDp'] = $fileName;
                        $dataUpload['pDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    } else {
                        $dataUpload['pDate'] = date('Y-m-d H:i:s');
                        $dataUpload['adminId'] = $session->get('aId');
                    }
                    $arrayCheck = ['pName' => $dataUpload['pName'], 'categoryId' => $dataUpload['categoryId']];
                    $checkAlreadyThere = $adminDB->where($arrayCheck)->findAll();
                    if (count($checkAlreadyThere) > 0 ){
                        $session->setFlashdata('message','This product already exists in this category.');
                        return redirect()->to(base_url('/admin/newProduct'));
                    } else {
                    $addData = $adminDB->insert($dataUpload);
                        if ($addData) {
                            $session->setFlashdata('successMessage','You have successfully added a product.');
                            return redirect()->to(base_url('/admin/newProduct'));
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
}
