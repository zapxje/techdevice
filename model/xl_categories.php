<?php
/*======================================== ADMIN ======================================== */
switch ($_REQUEST["act"]) {
    case "addCategory":
        if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
            $name = $_REQUEST['name'];
            //Kiểm tra danh mục đã tồn tại chưa
            if (validateNameCategory($name)) {
                $notification = 'nameExist';
            } else {
                //Nếu không truyền vào thứ tự thì mặc đinh là một
                $_REQUEST['ordinal_number'] ? $ordinal_number = $_REQUEST['ordinal_number'] : $ordinal_number = 1;
                //Nếu không truyền vào mô tả thì mặc đinh là rỗng
                $_REQUEST['description'] ? $description = $_REQUEST['description'] : $description = '';
                //Gọi hàm thêm danh mục
                addCategory($name, $ordinal_number, $description);
                $notification = "successAdd";
            }
        }
        break;
    case "delCategory":
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            //Kiểm tra xem danh mục có tồn tại hay không
            $category = getOneCategory($id);
            if ($category) {
                //Lấy danh sách sản phẩm của danh mục muốn xóa
                $listProductByCategory = getProductByCategory($id);
                if (empty($listProductByCategory)) {
                    //Nếu danh sách sản phẩm rỗng thì gọi hàm xóa
                    delCategory($id);
                    //Thông báo xóa thành công
                    $notification = "successDel";
                } else {
                    //Ngược lại thì thông báo xóa thất bại
                    $notification = "failedDel";
                }
            } else {
                //Thông báo danh mục không tồn tại
                $notification = "notExist";
            }
        }
        break;
    case "updateCategory":
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            //Kiểm tra xem danh mục có tồn tại hay không
            $category = getOneCategory($id);
            if ($category) {
                if (!isset($_REQUEST['update'])) {
                    //Tải lên form update
                    $category = getOneCategory($id);
                    include_once("../admin/view/categoriesUpAd.php");
                } else {
                    if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
                        $name = $_REQUEST['name'];
                        $ordinal_number = $_REQUEST['ordinal_number'];
                        $description = $_REQUEST['description'];
                        updateCategory($id, $name, $ordinal_number, $description);
                    }
                    $notification = "successUpdate";
                    //Sau khi update thì về trang danh mục
                    $listCategories = getAllCategories();
                    include_once("../admin/view/categoriesAd.php");
                }
            } else {
                //Thông báo danh mục không tồn tại
                $notification = "notExist";
                $listCategories = getAllCategories();
                include_once("../admin/view/categoriesAd.php");
            }
        } else {
            $listCategories = getAllCategories();
            include_once("../admin/view/categoriesAd.php");
        }
        break;
}
/*======================================== ADMIN END ======================================== */