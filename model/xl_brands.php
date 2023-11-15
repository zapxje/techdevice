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
}
