<?php
switch ($_REQUEST["act"]) {
    case "addCategory":
        if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
            $name = $_REQUEST['name'];
            $_REQUEST['ordinal_number'] ? $ordinal_number = $_REQUEST['ordinal_number'] : $ordinal_number = 1;
            $_REQUEST['description'] ? $description = $_REQUEST['description'] : $description = "";
            addCategory($name, $ordinal_number, $description);
            $notification = "successAdd";
        }
        break;
    case "delCategory":
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $listProductByCategory = getProductByCatagory($id);
            if (empty($listProductByCategory)) {
                delCategory($id);
                $notification = "successDel";
            } else {
                $notification = "failedDel";
            }
        }
        break;
    case "updateCategory":
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            if (isset($_REQUEST['status']) && ($_REQUEST['status']) == 1) {
                if (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) {
                    $name = $_REQUEST['name'];
                    $ordinal_number = $_REQUEST['ordinal_number'];
                    $description = $_REQUEST['description'];
                    updateCategory($id, $name, $ordinal_number, $description);
                    $notification = "successUpdate";
                }
                $listCategories = getAllCategories();
                include_once("../admin/view/categoriesAd.php");
            } else {
                $category = getOneCategory($id);
                include_once("../admin/view/categoriesUpAd.php");
            }
        } else {
            $listCategories = getAllCategories();
            include_once("../admin/view/categoriesAd.php");
        }
        break;
}
