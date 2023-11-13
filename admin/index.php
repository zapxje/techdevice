<?php
//include the model file
include_once("../model/connectDB.php");
include_once("../model/categories.php");
include_once("../model/products.php");

//include the header file
include_once("view/header.php");
include_once("view/sidebar.php");


//include the content file
if (isset($_REQUEST["act"])) {
    switch ($_REQUEST["act"]) {
        case 'categories':
            $listCategories = getAllCategories();
            include_once("view/categoriesAd.php");
            break;
        case 'addCategory':
            include_once("../model/xl_categories.php");
            $listCategories = getAllCategories();
            include_once("view/categoriesAd.php");
            break;
        case 'delCategory':
            include_once("../model/xl_categories.php");
            $listCategories = getAllCategories();
            include_once("view/categoriesAd.php");
            break;
        case 'updateCategory':
            include_once("../model/xl_categories.php");
            break;
        default:
            include_once("view/main.php");
            break;
    }
} else {
    include_once("view/main.php");
}

//include the footer file
include_once("view/footer.php");
