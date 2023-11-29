    <?php
    session_start();
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    // include model file
    include 'model/connectDB.php';
    include 'model/categories.php';
    include 'model/brands.php';
    include 'model/products.php';
    include 'model/images.php';
    include 'model/properties.php';
    include 'model/users.php';
    include 'model/orders.php';
    include_once 'model/xl_cart.php';
    $listCategories = getAllCategories();
    $listBrands = getAllBrands();
    $listProducts = getAllProducts();
    $jsonProducts = json_encode($listProducts);

    // include the header file
    $active = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
    include 'view/header.php';


    // include the content file
    if (isset($_REQUEST['act'])) {
        switch ($_GET['act']) {
            case 'store':
                include 'view/store.php';
                break;

            case 'singleProduct':
                include 'model/xl_products.php';
                break;

            case 'about':
                include 'view/about.php';
                break;

            case 'contact':
                include 'view/contact.php';
                break;

            case 'login':
                include 'model/xl_users.php';
                include 'view/login.php';
                break;

            case 'register':
                include 'model/xl_users.php';
                include 'view/register.php';
                break;

            case 'viewCart':
                include 'view/viewCart.php';
                break;

            case 'checkout':
                //bắt buộc phải đăng nhập session['user'] mới được vào
                if (!$_SESSION['user']) {
                    header('location: index.php?act=login');
                }
                include_once 'model/xl_checkout.php';
                include 'view/checkout.php';
                break;

            case 'logout':
                // Xoá  tất cả session 
                session_destroy();
                header('location: index.php');
                // Xoá 1 session
                //unset($_SESSION['user']);
                break;

            case 'updateUser':
                include_once 'model/xl_users.php';
                break;

            case 'account':
                //bắt buộc phải đăng nhập session['user'] mới được vào
                if (!$_SESSION['user']) {
                    header('location: index.php');
                }
                include_once 'view/account.php';
                break;

            case 'topsel':
                include 'view/checkout.php';

                break;
            case 'order':

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
