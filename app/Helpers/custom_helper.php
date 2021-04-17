<?php

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