<?php
use App\Models\ModAdmin;

function adminLoggedIn() {
    $session = \Config\Services::session();
    $checkLoggedIn = $session->get('aId');
    

    if ($checkLoggedIn) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function getAdminId() {
    $session = \Config\Services::session();
    $checkLoggedIn = $session->get('aId');
    
    if ($checkLoggedIn) {
        return $session->get('aId');
    } else {
        return FALSE;
    }
}

function userLoggedIn() {
    $session = \Config\Services::session();
    $checkLoggedIn = $session->get('uId');
    

    if ($checkLoggedIn) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function checkFlash() {
    $session = \Config\Services::session();
    $data['message'] = $session->get('message');
    $data['successMessage'] = $session->get('successMessage');
    
    echo view('/user/flashdata',$data);
}

function fetchCategories() {
    $categoriesDB = new ModAdmin();

    $data['getNumCategories'] = $categoriesDB->where('cstatus',1)->countAllResults();

    return $categoriesDB->getWhere(['cStatus'=>1],$data['getNumCategories'])->getResultArray();

}

?>