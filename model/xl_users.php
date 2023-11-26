<?php
if (isset($_GET['act']) && !empty($_GET['act'])) {
    switch ($_GET['act']) {
        case 'updateUser':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $old_image = $_POST['old_image'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                // Kiểm tra dữ liệu
                if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] != UPLOAD_ERR_OK) {
                    // Nếu không tồn tại ảnh mới thì vẫn update và lấy ảnh cũ
                    updateUser($id, $username, $email, $phone, $old_image);
                } else {
                    $dir = 'view/assets/img/avatar';
                    // Lấy tên file mới
                    $avatar = $dir . '/' . $_FILES['avatar']['name'];
                    // Tạo một thư mục để lưu ảnh

                    // Kiểm tra đã tồn tại chưa
                    if (file_exists($avatar)) {
                        // Thực hiện hàm thêm dtb nhưng không thêm ảnh
                        updateUser($id, $username, $email, $phone, $avatar);
                    } else {
                        // Kiểm tra và tạo thư mục nếu nó không tồn tại
                        if (!is_dir($dir)) {
                            mkdir($dir, 0777, true);
                        }

                        // Thêm file ảnh vào thư mục
                        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar)) {
                            // Xóa ảnh cũ nếu tồn tại
                            if (file_exists($old_image)) {
                                unlink($old_image);
                            }

                            // Thực hiện thêm dtb
                            updateUser($id, $username, $email, $phone, $avatar);
                        } else {
                            echo 'Lỗi khi di chuyển tệp tin.';
                        }
                    }
                }
            }
            $_SESSION['user'] = getOneUserById($id);
            header('location:  index.php?act=account');
            break;
        case 'login':
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
            break;
        case 'loginPageAdmin':
            if (isset($_REQUEST['submit-loginPageAdmin'])) {
                $login = getOneUser($_POST['username'], $_POST['password']);
                if ($login) {
                    $_SESSION['user'] = $login;
                    if ($_SESSION['user']['is_admin'] == 0) {
                        header('location: index.php');
                    } else {
                        $message = '<div class="alert alert-danger" role="alert">
                                        Bạn không phải admin!
                                    </div>';
                    }
                } else {
                    $message = '<div class="alert alert-danger" role="alert">
                                    Thông tin đăng nhập không chính xác!
                                </div>';
                }
            }
            break;
        case 'register':
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
            break;
    }
}
