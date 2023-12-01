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

//Có sự kiện filter hay không ?
if (isset($_REQUEST['attributes_category']) || isset($_REQUEST['attributes_brand'])) {
    $idCategory = 0;
    $idBrand = 0;
    //Trường hợp chỉ lọc danh mục (category)
    if (isset($_REQUEST['attributes_category'])) {
        $currentURL = "index.php?act=store&attributes_category=" . $_REQUEST['attributes_category'];
        $idCategory = $_REQUEST['attributes_category'];
        $listProducts = getProductByCategoryFilter($idCategory, $itemsPerPage, $offset);
        $totalItems = count(getTotalProductByCategoryFilter($idCategory)); //Lấy tổng sản phẩm trong products
    }
    //Trường hợp chỉ lọc thương hiệu (brand)
    if (isset($_REQUEST['attributes_brand'])) {
        $currentURL = "index.php?act=store&attributes_brand=" . $_REQUEST['attributes_brand'];
        $idBrand = $_REQUEST['attributes_brand'];
        $listProducts = getProductByBrandFilter($idBrand, $itemsPerPage, $offset);
        $totalItems = count(getTotalProductByBrandFilter($idBrand)); //Lấy tổng sản phẩm trong products
    }
    //Trường hợp lọc cả hai (brand & category)
    if (isset($_REQUEST['attributes_category']) && isset($_REQUEST['attributes_brand'])) {
        $currentURL = "index.php?act=store&attributes_category=" . $_REQUEST['attributes_brand'] . "&attributes_brand=" . $_REQUEST['attributes_brand'];
        $idCategory = $_REQUEST['attributes_category'];
        $idBrand = $_REQUEST['attributes_brand'];
        $listProducts = getProductByBothFilter($idCategory, $idBrand, $itemsPerPage, $offset);
        $totalItems = count(getTotalProductByBothFilter($idCategory, $idBrand)); //Lấy tổng sản phẩm trong products
    }
    //Trường hợp lọc và kết quả rỗng thì thông báo và xuất ra lại toàn bộ sản phẩm
    if (empty($listProducts)) {
        $messageFilter = "Không tìm thấy kết quả phù hợp !";
        $listProducts = getProductByPaging($itemsPerPage, $offset);
        $totalItems = count(getAllProducts()); //Lấy tổng sản phẩm trong products
        $currentURL = "index.php?act=store";
    }
} else {
    //Nếu không truyền sự kiện Search thì lấy AllProducts
    $listProducts = getProductByPaging($itemsPerPage, $offset);
    $totalItems = count(getAllProducts()); //Lấy tổng sản phẩm trong products
}


// Tính tổng số trang
$totalPages = ceil($totalItems / $itemsPerPage);

// Thêm giá trị tìm kiếm vào URL khi chuyển trang
// $searchParam = isset($keyWord) ? "&search=" . urlencode($keyWord) : "";
// ==================== Xử Lí Paging ==================== //

// ==================== Xử Lí Lọc Theo Giá ==================== //
$minPriceProduct = min(array_column($listProducts, 'price'));
$maxPriceProduct = max(array_column($listProducts, 'price'));
// ==================== Xử Lí Lọc Theo Giá ==================== //
