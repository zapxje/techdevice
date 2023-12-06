<?php
ob_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="view/assets/img/logo/logo_y.png">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Tech Device</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="view/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="view/assets/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="view/assets/css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="view/assets/css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="view/assets/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="view/assets/css/style.css" />

    <!-- Thêm SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.css ">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>

    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="tel:+05890000111"><i class="fa fa-phone"></i> +066-666-6666</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> infor@techdevice.shop</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> Công Viên Phâm Mềm Quang Trung</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
                        <li><a href="javascript:void(0)"><i class="fa fa-user-o"></i> Chào <?= $_SESSION['user']['username'] ?> !</a></li>
                        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['is_admin'] == 0) : ?>
                            <li><a href="admin"><button class="btn btn-primary btn-sm">Trang quản trị</button></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3 col-sm-12">
                        <div class="header-logo">
                            <a href="index.php" class="logo">
                                <img src="view/assets/img/logo/logo_x.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form action="index.php?act=store" method="POST">
                                <input id="live-search" name="keyword" class="input" placeholder="Tìm kiếm sản phẩm" name="search">
                                <button type="submit" name="submit-search" class="search-btn"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <?php if (isset($_SESSION['user'])) : ?>
                                <!-- Login -->
                                <div class="dropdown">
                                    <a href="index.php?act=account" class="user-login">
                                        <?php if ($_SESSION['user']['avatar'] && !empty($_SESSION['user']['avatar'])) : ?>
                                            <div><img src="<?= $_SESSION['user']['avatar'] ?>" alt=""></div>
                                            <span>Tài khoản</span>
                                        <?php else : ?>
                                            <i class="fa fa-user-circle"></i>
                                            <span>Tài khoản</span>
                                        <?php endif; ?>
                                    </a>
                                    <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="index.php?act=account">Thông tin</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="?act=logout">Đăng xuất</a></li>
                                    </ul> -->
                                </div>
                            <?php else : ?>
                                <div>
                                    <a href="index.php?act=login">
                                        <i class="fa fa-user-circle"></i>
                                        <span>Đăng Nhập</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <!-- /Login -->

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ Hàng</span>
                                    <div class="qty">0</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list" id="cart-list">
                                    </div>
                                    <div class="cart-summary">
                                        <small></small>
                                        <h5></h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="index.php?act=viewCart">Xem Giỏ Hàng</a>
                                        <!-- <a href="index.php?act=checkout">Checkout <i class="fa fa-arrow-circle-right"></i></a> -->
                                    </div>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="<?= empty($active) ? 'active' : '' ?>"><a href="index.php">Trang Chủ</a></li>
                    <li class="<?= $active == 'store' ? 'active' : '' ?>"><a href="?act=store">Sản Phẩm</a></li>
                    <li class="<?= $active == 'about' ? 'active' : '' ?>"><a href="?act=about">Thông Tin</a></li>
                    <li class="<?= $active == 'contact' ? 'active' : '' ?>"><a href="?act=contact">Liên Hệ</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->