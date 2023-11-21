    <?php
    session_start();
    // include model file
    include 'model/connectDB.php';
    include 'model/categories.php';
    include 'model/products.php';
    include 'model/users.php';
    $listCategories = getAllCategories();
    //cái nào danh sách thì mình để là list + với cái đó cho dể nhớ khoa ơi
    $listProducts = getAllProducts();

    $jsonProducts = json_encode($listProducts);


    // include the header file
    include 'view/header.php';


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
                $message = '';
                if (isset($_POST['submit-login'])) {
                    $login = getOneUser($_POST['username'], $_POST['password']);
                    if ($login) {
                        $_SESSION['user'] = $login;
                        header('location: index.php');
                    } else {
                        $message = '<div class="alert alert-danger" role="alert">
                        Thông tin đăng nhập không chính xác!
                    </div>';
                    }
                }

                include 'view/login.php';
                break;

            case 'register':
                $message = '';
                if (isset($_POST['submit-register'])) {
                    if (
                        empty($_POST['full-name']) ||
                        empty($_POST['username']) ||
                        empty($_POST['password']) ||
                        empty($_POST['email']) ||
                        empty($_POST['phone'])
                    ) {
                        if (empty($_POST['full-name'])) {
                            $message = '<div class="alert alert-danger" role="alert">
                                Hãy nhập họ và tên
                                </div>';
                        } elseif (empty($_POST['username'])) {
                            $message = '<div class="alert alert-danger" role="alert">
                                Hãy nhập tên đăng nhập
                                </div>';
                        } elseif (empty($_POST['password'])) {
                            $message = '<div class="alert alert-danger" role="alert">
                                Hãy nhập mật khẩu
                                </div>';
                        } elseif (empty($_POST['email'])) {
                            $message = '<div class="alert alert-danger" role="alert">
                                Hãy nhập email
                                </div>';
                        } else {
                            $message = '<div class="alert alert-danger" role="alert">
                                Hãy nhập số điện thoại
                                </div>';
                        }
                    } else {
                        // $register = 
                        // Chỗ này không cần $register = đâu khoa ơi 
                        addUser(
                            $_POST['full-name'],
                            $_POST['username'],
                            $_POST['password'],
                            $_POST['email'],
                            $_POST['phone']
                        );
                        $message = '<div class="alert alert-success" role="alert">
                                    Bạn đã đăng kí thành công
                                    </div>';
                    }
                }

                include 'view/register.php';
                break;

            case 'viewCart':
                include 'view/viewCart.php';
                break;

            case 'checkout':
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
                include_once 'controller/xl_user.php';
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
