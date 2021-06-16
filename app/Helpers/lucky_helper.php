<?php
use App\Models\ModAdmin;
use App\Models\ModProducts;
use App\Models\ModSpec;
use App\Models\ModGallery;
use App\Models\ModSpecValues;
use App\Models\ModSub;
use App\Models\ModUsers;
use App\Models\ModOrders;
use App\Models\ModBilling;
use App\Models\ModShipping;

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

function getCountries() {
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    return $countries;
}

function getUserInfo() {
    $session = \Config\Services::session();
    $userDB = new ModUsers();
    $checkLoggedIn = $session->get('uId');
    
    return $userDB->getWhere(['uId'=>$checkLoggedIn,])->getResultArray();
}

function updateBillingAddress() {
    $session = \Config\Services::session();
    $userDB = new ModUsers();
    $uId = $session->get('uId');
}

function getBillingAddress() {
    $session = \Config\Services::session();
    $billDB = new ModBilling();
    $uId = $session->get('uId');
    
    return $billDB->getWhere(['userId'=>$uId,])->getResultArray();
}

function getShippingAddress() {
    $session = \Config\Services::session();
    $shipDB = new ModShipping();
    $uId = $session->get('uId');
    
    return $shipDB->getWhere(['userId'=>$uId,])->getResultArray();
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

function fetchSubCategories($categoryId) {
    $subDB = new ModSub();
    return $subDB->getWhere(['categoryId'=>$categoryId,'scId >' => 0],)->getResultArray();

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

function loadStoreProducts($categoryId) {
    $session = \Config\Services::session();
    $request = \Config\Services::request();
    $uri = $request->uri;
    $productDB = new ModProducts();
    if (!empty($categoryId)) {

        //Check for Sub Category
        $subCatId = $uri->getSegment(4);

        if (!empty($subCatId)) {
            //Find all products for sub category and main
            return $productDB->getWhere(['categoryId'=>$categoryId,'subCatId'=>$subCatId])->getResultArray();
        } else {
            //Find all products for category
            return $productDB->getWhere(['categoryId'=>$categoryId])->getResultArray();
        }
        
    } else {
        //Show all products in database
        return $productDB->getWhere(['pStatus'=>1])->getResultArray();
    }
}

function getGallery() {
    $session = \Config\Services::session();

    $galleryDB = new ModGallery();
    return $galleryDB->getWhere(['gStatus'=>1])->getResultArray();
}

function loadCart() {
    $session = \Config\Services::session();
    $request = \Config\Services::request();

    $productsDB = new ModProducts;
    
    if (!empty($_SESSION['cart'])) {
        $whereIn = implode(',',$_SESSION['cart']);


        $sql = "SELECT * FROM products WHERE pId IN ($whereIn)";

        $result = $productsDB->query($sql);
        return $result;
    }

    else {
        echo 'You haven\'t added any products to your cart.<br><br>'; 
    }
}

function loadCartPrices() {
    $session = \Config\Services::session();
    $request = \Config\Services::request();

    if (!empty($_SESSION['varPrice'])) {
        $result = $_SESSION['varPrice'];

        foreach ($result as $price) {
            return $price;
        }
        
    }
}


function loadCart2() {
    $session = \Config\Services::session();
    $request = \Config\Services::request();

    $productsDB = new ModProducts;

        $cart = loadCart()->getResult() ;
        
        $loadCart = json_decode(json_encode($cart), true);

        $price = $_SESSION['varPrice'];

        $loadCart['pPrice'] = $price;
        $loadCart = [$loadCart];
 
        return $loadCart;
     
    
}


function getOrderDetails($tempId) {
    $session = \Config\Services::session();

    $ordersDB = new ModOrders();
    return $ordersDB->getWhere(['tempId'=>$tempId])->getResultArray();
}
