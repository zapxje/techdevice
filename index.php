<?php
session_start();

// include the header file
include 'view/header.php';

// include model file

// include the content file
if (isset($_REQUEST['act'])) {
    switch ($_GET['act']) {
        case 'products':
            include 'view/products.php';
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
