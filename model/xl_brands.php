<?php
/*======================================== ADMIN ======================================== */
switch ($_REQUEST["act"]) {
    case "addBrand":
        if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
            $name = $_REQUEST['name'];
            // Lấy tên file gốc
            $filename = $_FILES['image']['name'];
            // Lấy định dạng file
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "svg" || $extension == "gif") {
                // Tạo một thư mục để lưu ảnh
                $dir = '../view/assets/img/brand_image';
                // Kiểm tra đã tồn tại chưa
                if (file_exists($dir . '/' . $filename)) {
                    // File ảnh đã tồn tại
                    $notification = "failedAdd";
                    return;
                }
                // Di chuyển file ảnh sang thư mục mới
                move_uploaded_file($_FILES['image']['tmp_name'], $dir . '/' . $filename);
                // Thực hiện hàm thêm thương hiệu
                addBrand($name, $filename);
                $notification = "successAdd";
            } else {
                $notification = "failedFormat";
            }
        }
        break;
    case "delBrand":
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $listProductByBrand = getProductByBrand($id);
            if (empty($listProductByBrand)) {
                $brand = getOneBrand($id);
                delBrand($id);
                unlink('../view/assets/img/brand_image/' . $brand['image']);
                $notification = "successDel";
            } else {
                $notification = "failedDel";
            }
        }
        break;
    case "updateBrand":
        if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {
            $listBrands = getAllBrands();
            include_once("../admin/view/brandsAd.php");
            return; // Dừng xử lý ngay tại đây nếu không có ID
        }

        $id = $_REQUEST['id'];

        if (isset($_REQUEST['status']) && $_REQUEST['status'] == 1) {
            $name = $_REQUEST['name'];
            $old_image = $_REQUEST['old_image'];

            // Kiểm tra dữ liệu
            if (!isset($_FILES['new_image']) || $_FILES['new_image']['error'] != UPLOAD_ERR_OK) {
                // Nếu không tồn tại ảnh mới thì vẫn update và lấy ảnh cũ
                updateBrand($id, $name, $old_image);
                $notification = "successUpdate";
            } else {
                $new_image = $_FILES['new_image']['name'];
                $extension = pathinfo($new_image, PATHINFO_EXTENSION);

                if (!in_array($extension, ['png', 'jpg', 'jpeg', 'svg', 'gif'])) {
                    $notification = "failedFormat";
                    $listBrands = getAllBrands();
                    include_once("../admin/view/brandsAd.php");
                    return;
                }

                $dir = '../view/assets/img/brand_image';
                $new_image_path = $dir . '/' . $new_image;
                if (file_exists($new_image_path)) {
                    //Thông báo logo đã tồn tại
                    $notification = "failedAdd";
                } else {
                    move_uploaded_file($_FILES['new_image']['tmp_name'], $new_image_path);
                    unlink('../view/assets/img/brand_image/' . $old_image);
                    updateBrand($id, $name, $new_image);
                    $notification = "successUpdate";
                }
            }
            $listBrands = getAllBrands();
            include_once("../admin/view/brandsAd.php");
        } else {
            $brand = getOneBrand($id);
            include_once("../admin/view/brandsUpAd.php");
        }
        break;
}
/*======================================== ADMIN END ======================================== */
