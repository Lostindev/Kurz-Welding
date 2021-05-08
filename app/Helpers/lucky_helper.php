<?php
use App\Models\ModAdmin;

use App\Models\ModProducts;

use App\Models\ModSpec;

use App\Models\ModSpecValues;

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

    $data['getNumCategories'] = $categoriesDB->where('cStatus',1)->countAllResults();

    return $categoriesDB->getWhere(['cStatus'=>1],$data['getNumCategories'])->getResultArray();

}

function fetchCategoriesTwo() {

    $categoriesDB = new ModAdmin();

    $data['getNumCategories'] = $categoriesDB->where('cStatus',1)->countAllResults();

    return $categoriesDB->getWhere(['cStatus'=>1], 14, 7)->getResultArray();
}

function getDimensions($productId) {
    $session = \Config\Services::session();

    $specDB = new ModSpec();
    return $specDB->getWhere(['spStatus'=>1,'productId'=>$productId])->getResultArray();
}

function getDimensionValues($specId) {
    $session = \Config\Services::session();

    $specValueDB = new ModSpecValues();
    return $specValueDB->getWhere(['spvStatus'=>1,'specId'=>$specId])->getResultArray();
}

?>