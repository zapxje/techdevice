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
                if(isset($_POST['submit-login'])){
                    
                    $login=getOneUser($_POST['username'],$_POST['password']);
                    
                
                    if($login){
                        $_SESSION['user']=$login;
                    }
                    header('location: index.php');
                }

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
