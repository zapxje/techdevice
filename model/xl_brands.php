<?php
/*======================================== ADMIN ======================================== */
switch ($_REQUEST["act"]) {
    case "addBrand":
        if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
            $name = $_REQUEST['name'];
            //Lấy tên file
            $image = $_FILES['image']['name'];
            // Lấy định dạng file
            $extension = pathinfo($image, PATHINFO_EXTENSION);
            //Kiểm tra định dạnh file ảnh
            if (!in_array($extension, ['png', 'jpg', 'jpeg', 'svg', 'gif'])) {
                $notification = "failedFormat";
                return;
            }
            // Nếu định dạng ảnh đúng thì tạo đường dẫn lưu ảnh
            $dir = '../view/assets/img/brand_image';
            //Tạo đường dẫn đầy đủ bao gồm tên ảnh
            $new_image_path = $dir . '/' . $image;
            // Nếu file ảnh tồn tại, thì thông báo 
            if (file_exists($new_image_path)) {
                $notification = "alreadyExist";
                return;
            }
            //Nếu chưa thì upload ảnh mới 
            move_uploaded_file($_FILES['image']['tmp_name'], $new_image_path);
            addBrand($name, $image);
            $notification = "successAdd";
        }
        break;
    case "delBrand":
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $brand = getOneBrand($id);
            if ($brand) {
                $listProductByBrand = getProductByBrand($id);
                if (empty($listProductByBrand)) {
                    delBrand($id);
                    unlink('../view/assets/img/brand_image/' . $brand['image']);
                    $notification = "successDel";
                } else {
                    $notification = "failedDel";
                }
            } else {
                $notification = "notExist";
            }
        }
        break;
    case "updateBrand":
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $brand = getOneBrand($id);
            if ($brand) {
                if (!isset($_REQUEST['update'])) {
                    include_once("../admin/view/brandsUpAd.php");
                } else {
                    if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
                        $name = $_REQUEST['name'];
                        $old_image = $_REQUEST['old_image'];
                        // Kiểm tra có tồn tại ảnh mới không
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
                                $notification = "alreadyExist";
                            } else {
                                move_uploaded_file($_FILES['new_image']['tmp_name'], $new_image_path);
                                unlink('../view/assets/img/brand_image/' . $old_image);
                                updateBrand($id, $name, $new_image);
                                $notification = "successUpdate";
                            }
                        }
                        $listBrands = getAllBrands();
                        include_once("../admin/view/brandsAd.php");
                    }
                }
            } else {
                $notification = "notExist";
                $listBrands = getAllBrands();
                include_once("../admin/view/brandsAd.php");
            }
        } else {
            $listBrands = getAllBrands();
            include_once("../admin/view/brandsAd.php");
        }
        break;
}
/*======================================== ADMIN END ======================================== */
