<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <img width="350px" class="align-content" src="assets/images/logo/logo_x.png" alt="">
                </a>
            </div>
            <div class="login-form">
                <form action="index.php?act=loginPageAdmin" method="post">
                    <?= isset($message) ? $message : '' ?>
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="username" id="firstInput" class="form-control" placeholder="Tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label>Mặt khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Nhớ mặt khẩu
                        </label>
                        <label class="pull-right">
                            <a href="#">Quên mật khẩu?</a>
                        </label>

                    </div>
                    <button type="submit" name="submit-loginPageAdmin" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    <div class="social-login-content">
                        <!-- <div class="social-button">
                            <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                            <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                        </div> -->
                    </div>
                    <div class="register-link m-t-15 text-center">
                        <a class="text-primary" href="../index.php"> Quay về trang chủ <i class="fa-solid fa-right-to-bracket"></i></a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>