<?php
session_start();

// include the header file
include 'view/header.php';

// include model file

// include the content file
if (isset($_REQUEST['act'])) {
    switch ($_GET['act']) {
        case 'store':
            include 'view/store.php';
            break;

        case 'singleProduct':
            include 'view/singleProduct.php';
            break;

        case 'about':
            include 'view/about.php';
            break;

        case 'contact':
            include 'view/contact.php';
            break;

        case 'login':
            include 'view/login.php';
            break;

        default:
            include 'view/home.php';
            break;
    }
} else {
    include 'view/home.php';
}

// include the footer file
include 'view/footer.php';
