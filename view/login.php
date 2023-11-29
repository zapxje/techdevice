<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Đăng Nhập</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-6 py-2">
                <img width="100%" src="view/assets/img/banner/banner_login.png" alt="">
            </div>
            <form class="col-md-6" method="POST" action="">
                <!-- <div class="alert alert-success" role="alert">
                    This is a success alert—check it out!
                </div> -->
                <?= isset($message) ? $message : '' ?>
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" name="username" id="firstInput" placeholder="Tên đăng nhập" value="<?= isset($_SESSION['register']) ? $_SESSION['register']['username'] : '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Mật khẩu" value="<?= isset($_SESSION['register']) ? $_SESSION['register']['password'] : '' ?>" required>
                </div>
                <p class="text-left">Chưa có tài khoản?<a class="text-primary" href="index.php?act=register">Đăng ký</a></p>
                <button type="submit" class="btn btn-main" name="submit-login">Đăng Nhập</button>
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->