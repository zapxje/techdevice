<?php
/*======================================== ADMIN ======================================== */
switch ($_REQUEST["act"]) {
    case 'filterProducts':
        //Trường hợp không truyên vào filter nào cả thì xử lí luôn
        if ($_REQUEST['idFilterCategory'] == 0 && $_REQUEST['idFilterBrand'] == 0) {
            $listProducts = getAllProducts();
            return;
        }
        //Trường hợp chỉ truyền vào filter category
        if ($_REQUEST['idFilterCategory'] != 0 && $_REQUEST['idFilterBrand'] == 0) {
            $id = $_REQUEST['idFilterCategory'];
            $listProducts = getProductByCategory($id);
        } else if ($_REQUEST['idFilterCategory'] == 0 && $_REQUEST['idFilterBrand'] != 0) {
            //Trường hợp chỉ truyền vào filter brand
            $id = $_REQUEST['idFilterBrand'];
            $listProducts = getProductByBrand($id);
        } else {
            //Trường hợp truyền vào cả hai filter
            $idCategory = $_REQUEST['idFilterCategory'];
            $idBrand = $_REQUEST['idFilterBrand'];
            $listProducts = getProductByBoth($idCategory, $idBrand);
        }
        break;

    case 'addProduct':
        if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
            $idCategory = $_REQUEST['idCategory'];
            $idBrand = $_REQUEST['idBrand'];
            $name = $_REQUEST['name'];
            $price = $_REQUEST['price'];
            $price_sale = $_REQUEST['price_sale'];
            $quantity = $_REQUEST['quantity'];
            $description = $_REQUEST['description'];
            //Lấy tên file
            $image = $_FILES['image']['name'];
            //Lấy định dạnh file
            $extension = pathinfo($image, PATHINFO_EXTENSION);
            //Kiểm tra định dạnh file ảnh
            if (!in_array($extension, ['png', 'jpg', 'jpeg', 'svg', 'gif'])) {
                $notification = 'failedFormat';
                return;
            }
            // Nếu định dạng ảnh đúng thì tạo đường dẫn lưu ảnh
            $dir = '../view/assets/img/brand_image';
            //Tạo đường dẫn đầy đủ bao gồm tên ảnh
            $new_image_path = $dir . '/' . $image;
            // Nếu file ảnh tồn tại, thì thông báo 
            if (file_exists($new_image_path)) {
                $notification = "failedAdd";
                return;
            }
            //Nếu chưa thì upload ảnh mới 
            move_uploaded_file($_FILES['image']['tmp_name'], $new_image_path);
        }
        break;
}
/*======================================== ADMIN END======================================== */