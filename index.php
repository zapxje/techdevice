<?php
session_start();
// include model file
include 'model/connectDB.php';
include 'model/categories.php';
$listCategories = getAllCategories();

// include the header file
include 'view/header.php';


// include the content file
if (isset($_REQUEST['act'])) {
    switch ($_GET['act']) {
        case 'store':
            include_once 'model/products.php';
            //cái nào danh sách thì mình để là list + với cái đó cho dể nhớ khoa ơi
            $listProducts = getAllProducts();
            $jsonProducts = json_encode($listProducts);
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

        case 'register':
            include 'view/register.php';
            break;

        case 'viewCart':
            include 'view/viewCart.php';
            break;

        case 'checkout':
            include 'view/checkout.php';
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
