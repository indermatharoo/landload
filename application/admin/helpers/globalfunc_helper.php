<?php

function getSAD() {
    $CI = & get_instance();
    $session = $CI->session->all_userdata();
    return $session;
}

function e($params, $exit = 1) {
    echo "<pre>";
    print_r($params);
    echo "</pre>";
    if ($exit)
        exit;
}

function isAdmin() {
    $session = getSAD();
    if (isset($session['ADMIN_USER_ID']) && $session['ADMIN_USER_ID'] == 1 && isset($session['ADMIN_USER_ROLE']) && $session['ADMIN_USER_ROLE'] == 1) {
        return true;
    } else {
        return false;
    }
}

function isSubAdmin() {
    $session = getSAD();
    if (isset($session['ADMIN_USER_ID']) && isset($session['ADMIN_USER_ROLE']) && $session['ADMIN_USER_ROLE'] == 2) {
        return true;
    } else {
        return false;
    }
}

function isComp() {
    $session = getSAD();
    if (isset($session['COMPANY_ID'])) {
        return true;
    } else {
        return false;
    }
}

function isBranch() {
    $session = getSAD();
    if (isset($session['BRANCH_ID'])) {
        return true;
    } else {
        return false;
    }
}

