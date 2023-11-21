<?php
// LOGIN
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
// REGISTER
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
        $_SESSION['register']['username'] = ($_POST['username']);
        $_SESSION['register']['password'] = ($_POST['password']);
        $message = '<div class="alert alert-success" role="alert">
                    Bạn đã đăng kí thành công
                    </div>';
    }
}
