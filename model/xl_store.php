<?php
// ==================== Xử Lí Paging ==================== //

//Số sản phẩm trên 1 trang
$itemsPerPage = 9;

// Trang hiện tại (mặc định là trang 1)
$current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

// Tính OFFSET(Tức là vị trí bắt đầu lấy sp trong products) cho truy vấn
$offset = ($current_page - 1) * $itemsPerPage;
//Ví dụ ở trang 1 thì (1-1) * 9 = 0 tức vị trí bd lấy là 0

//Có sự kiện tìm kiếm hay không ?

//Nếu không truyền sự kiện Search thì lấy AllProducts
$listProducts = getProductByPaging($itemsPerPage, $offset);
// Tính tổng số trang
$totalItems = count(getAllProducts()); //Lấy tổng sản phẩm trong products
$totalPages = ceil($totalItems / $itemsPerPage);

// Thêm giá trị tìm kiếm vào URL khi chuyển trang
// $searchParam = isset($keyWord) ? "&search=" . urlencode($keyWord) : "";
// ==================== Xử Lí Paging ==================== //

// ==================== Xử Lí Lọc Theo Giá ==================== //
$minPriceProduct = min(array_column($listProducts, 'price'));
$maxPriceProduct = max(array_column($listProducts, 'price'));
// ==================== Xử Lí Lọc Theo Giá ==================== //
