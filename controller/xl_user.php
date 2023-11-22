<?php

include_once 'model/users.php';
if($_GET['act']){
	switch($_GET['act']){


		case 'updateUser':
			if(isset($_GET['id'])){
				$id=$_GET['id'];
				$old_image = $_POST['old_image'];
				$username=$_POST['username'];
				$email=$_POST['email'];
				$phone=$_POST['phone'];
				 // Kiểm tra dữ liệu
				 if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] != UPLOAD_ERR_OK) {
					// Nếu không tồn tại ảnh mới thì vẫn update và lấy ảnh cũ
					updateUser($id,$username,$email,$phone, $old_image);
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
			$_SESSION['user']=getOneUserById($id);
			header('location:  index.php');
		break;
		
	}
} 

?>