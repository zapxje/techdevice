<?php
switch ($_REQUEST["act"]) {
    case "addBrand":
        if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
            $name = $_REQUEST['name'];
            // Kiểm tra dữ liệu
            if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
                $notification = "failedAdd";
                return;
            }
            // Lấy tên file gốc
            $filename = $_FILES['image']['name'];
            // Lấy định dạng file
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            // Tạo một thư mục để lưu ảnh
            $dir = '../view/assets/img/brand_image';
            // Kiểm tra đã tồn tại chưa
            if (file_exists($dir . '/' . $filename)) {
                // File ảnh đã tồn tại
                $notification = "is_file_true";
                return;
            }
            // Di chuyển file ảnh sang thư mục mới
            move_uploaded_file($_FILES['image']['tmp_name'], $dir . '/' . $filename);
            // Thực hiện hàm thêm thương hiệu
            addBrand($name, $filename);
            $notification = "successAdd";
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
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            if (isset($_REQUEST['status']) && ($_REQUEST['status']) == 1) {
                if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
                    $name = $_REQUEST['name'];
                    $old_image = $_REQUEST['old_image'];
                    // Kiểm tra dữ liệu
                    if (!isset($_FILES['new_image']) || $_FILES['new_image']['error'] != UPLOAD_ERR_OK) {
                        // Nếu không tồn tại ảnh mới thì vẫn update và lấy ảnh cũ
                        updateBrand($id, $name, $old_image);
                    } else {
                        // Lấy tên file mới
                        $new_image = $_FILES['new_image']['name'];
                        // Tạo một thư mục để lưu ảnh
                        $dir = '../view/assets/img/brand_image';
                        // Kiểm tra đã tồn tại chưa
                        if (file_exists($dir . '/' . $new_image)) {
                            // Thực hiện hàm thêm dtb nhưng không thêm ảnh
                            updateBrand($id, $name, $new_image);
                        } else {
                            // Thêm file ảnh vào thư mục
                            move_uploaded_file($_FILES['new_image']['tmp_name'], $dir . '/' . $new_image);
                            // Xóa ảnh cũ
                            unlink('../view/assets/img/brand_image/' . $old_image);
                            // Thực hiện thêm dtb
                            updateBrand($id, $name, $new_image);
                        }
                    }
                    $notification = "successUpdate";
                }
                $listBrands = getAllBrands();
                include_once("../admin/view/brandsAd.php");
            } else {
                $brand = getOneBrand($id);
                include_once("../admin/view/brandsUpAd.php");
            }
        } else {
            $listBrands = getAllBrands();
            include_once("../admin/view/brandsAd.php");
        }
        break;
}
