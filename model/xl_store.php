<?php
// ==================== Xử Lí Paging ==================== //


//Số sản phẩm trên 1 trang
$itemsPerPage = 9;

// Trang hiện tại (mặc định là trang 1)
$current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

// Tính OFFSET(Tức là vị trí bắt đầu lấy sp trong products) cho truy vấn
$offset = ($current_page - 1) * $itemsPerPage;
//Ví dụ ở trang 1 thì (1-1) * 9 = 0 tức vị trí bd lấy là 0

$currentURL = "index.php?act=store";

// ==================== Xử Lí Lọc Theo CheckBox ==================== //
if (isset($_REQUEST['attributes_category']) || isset($_REQUEST['attributes_brand'])) {
    $idCategory = 0;
    $idBrand = 0;
    //Trường hợp chỉ lọc danh mục (category)
    if (isset($_REQUEST['attributes_category'])) {
        $idCategory = $_REQUEST['attributes_category'];
        $listProducts = getProductByCategoryFilter($idCategory, $itemsPerPage, $offset);
        $totalItems = count(getTotalProductByCategoryFilter($idCategory)); //Lấy tổng sản phẩm trong products
        $currentURL = "index.php?act=store&attributes_category=" . $_REQUEST['attributes_category'];
    }
    //Trường hợp chỉ lọc thương hiệu (brand)
    if (isset($_REQUEST['attributes_brand'])) {
        $idBrand = $_REQUEST['attributes_brand'];
        $listProducts = getProductByBrandFilter($idBrand, $itemsPerPage, $offset);
        $totalItems = count(getTotalProductByBrandFilter($idBrand)); //Lấy tổng sản phẩm trong products
        $currentURL = "index.php?act=store&attributes_brand=" . $_REQUEST['attributes_brand'];
    }
    //Trường hợp lọc cả hai (brand & category)
    if (isset($_REQUEST['attributes_category']) && isset($_REQUEST['attributes_brand'])) {
        $idCategory = $_REQUEST['attributes_category'];
        $idBrand = $_REQUEST['attributes_brand'];
        $listProducts = getProductByBothFilter($idCategory, $idBrand, $itemsPerPage, $offset);
        $totalItems = count(getTotalProductByBothFilter($idCategory, $idBrand)); //Lấy tổng sản phẩm trong products
        $currentURL = "index.php?act=store&attributes_category=" . $_REQUEST['attributes_brand'] . "&attributes_brand=" . $_REQUEST['attributes_brand'];
    }
    //Trường hợp lọc và kết quả rỗng thì thông báo và xuất ra lại toàn bộ sản phẩm
    if (empty($listProducts)) {
        $messageStore = "Không tìm thấy kết quả phù hợp !";
        $listProducts = getProductByPaging($itemsPerPage, $offset);
        $totalItems = count(getAllProducts()); //Lấy tổng sản phẩm trong products
    }
    // ==================== Xử Lí Lọc Theo CheckBox ==================== //
} else {
    //Nếu không truyền sự kiện Search thì lấy AllProducts
    $listProducts = getProductByPaging($itemsPerPage, $offset);
    $totalItems = count(getAllProducts()); //Lấy tổng sản phẩm trong products
    // ======= Xử lí lọc theo giá ======= //
    $minPriceProduct = min(array_column(getAllProducts(), 'price'));
    $maxPriceProduct = max(array_column(getAllProducts(), 'price'));
    if (isset($_REQUEST['filterPrice']) && isset($_REQUEST['from']) && isset($_REQUEST['to'])) {
        $price_from = isset($_REQUEST['from']) ? $_REQUEST['from'] : '';
        $price_to = isset($_REQUEST['to']) ? $_REQUEST['to'] : '';
        $listProducts = getProductByPaging($itemsPerPage, $offset, $price_from, $price_to);
        $totalItems = count(getTotalProductByFilterPrice($price_from, $price_to)); //Lấy tổng sản phẩm trong products
        $currentURL = "index.php?act=store&filterPrice&from=" . $price_from . "&to=" . $price_to;
    }
}

if (isset($_REQUEST['act'])) {
    switch ($_GET['act']) {
        case 'store':
            if (isset($_GET['search'])) {
                $keyword = $_GET['search'];
                $messageStore = 'Kết quả tìm kiếm "' . $keyword . '"';
                $listProducts = getProductBySearch($keyword, $itemsPerPage, $offset);
                $totalItems = count(getTotalProductBySearch($keyword));
                $minPriceProduct = '';
                $maxPriceProduct = '';
                $currentURL = "index.php?act=store&search=" . $keyword;
                if ($totalItems <= 0) {
                    $messageStore = "Không tìm thấy kết quả phù hợp !";
                    $listProducts = getProductByPaging($itemsPerPage, $offset);
                    $totalItems = count(getAllProducts()); //Lấy tổng sản phẩm trong products
                    $currentURL = "index.php?act=store";
                }
            }
            break;
    }
}

// Tính tổng số trang
$totalPages = ceil($totalItems / $itemsPerPage);
