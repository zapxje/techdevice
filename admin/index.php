<?php
//include the model file
include_once("../model/connectDB.php");
include_once("../model/categories.php");
include_once("../model/brands.php");
include_once("../model/products.php");
include_once("../model/images.php");

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

        case 'brands':
            $listBrands = getAllBrands();
            include_once("view/brandsAd.php");
            break;

        case 'addBrand':
            include_once("../model/xl_brands.php");
            $listBrands = getAllBrands();
            include_once("view/brandsAd.php");
            break;

        case 'delBrand':
            include_once("../model/xl_brands.php");
            $listBrands = getAllBrands();
            include_once("view/brandsAd.php");
            break;

        case 'updateBrand':
            include_once("../model/xl_brands.php");
            break;

        case 'products':
            $listCategories = getAllCategories();
            $listBrands = getAllBrands();
            $listProducts = getAllProducts();
            include_once("view/productsAd.php");
            break;

        case 'filterProducts':
            include_once("../model/xl_products.php");
            $listCategories = getAllCategories();
            $listBrands = getAllBrands();
            include_once("view/productsAd.php");
            break;

        case 'addProduct':
            include_once("../model/xl_products.php");
            $listCategories = getAllCategories();
            $listBrands = getAllBrands();
            $listProducts = getAllProducts();
            include_once("view/productsAd.php");
            break;

        case 'delProduct':
            include_once("../model/xl_products.php");
            $listCategories = getAllCategories();
            $listBrands = getAllBrands();
            $listProducts = getAllProducts();
            include_once("view/productsAd.php");
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
