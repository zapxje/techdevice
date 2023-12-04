<?php
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $idProduct = $_REQUEST['id'];
    $product = getOneProduct($idProduct);
    if ($product) {
        // Xử lí xóa ảnh
        if (isset($_REQUEST['del']) && isset($_REQUEST['idImage'])) {
            $idImage = $_REQUEST['idImage'];
            $image = getOneImage($idImage);
            if ($image) {
                delImage($idImage);
                unlink('../view/assets/img/product/' . $image['name']);
                $notification = 'successDel';
            } else {
                $notification = 'notExist';
            }
        }
        // Xử lí thêm ảnh
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_image = $_FILES['new_image']['name'];
            $extension = pathinfo($new_image, PATHINFO_EXTENSION);
            //Kiểm tra định dạnh file ảnh
            if (!in_array($extension, ['png', 'jpg', 'jpeg', 'svg', 'gif'])) {
                $notification = "failedFormat";
                $listImagesProduct = getImageByProduct($idProduct);
                include_once("view/imagesProductAd.php");
                return;
            }
            $dir = '../view/assets/img/product';
            $new_image_path = $dir . '/' . $new_image;
            //Kiểm tra tồn tại
            if (file_exists($new_image_path)) {
                $notification = "alreadyExist";
            } else {
                move_uploaded_file($_FILES['new_image']['tmp_name'], $new_image_path);
                addImage($product['id'], $new_image);
                $notification = 'successAdd';
            }
        }
        $listImagesProduct = getImageByProduct($idProduct);
        include_once("view/imagesProductAd.php");
    } else {
        $listCategories = getAllCategories();
        $listBrands = getAllBrands();
        $listProducts = getAllProducts();
        include_once("view/productsAd.php");
    }
}
