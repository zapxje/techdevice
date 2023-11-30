<?php
// ==================== Xử Lí Paging ==================== //

//Số sản phẩm trên 1 trang
$itemsPerPage = 9;

// Trang hiện tại (mặc định là trang 1)
$current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

// Tính OFFSET(Tức là vị trí bắt đầu lấy sp trong products) cho truy vấn
$offset = ($current_page - 1) * $itemsPerPage;
//Ví dụ ở trang 1 thì (1-1) * 9 = 0 tức vị trí bd lấy là 0

//Lấy danh sách sản phẩm sau khi Paging
$listProducts = getProductByPaging($itemsPerPage, $offset);

// Tính tổng số trang
$totalItems = count(getAllProducts()); //Lấy tổng sản phẩm trong products
$totalPages = ceil($totalItems / $itemsPerPage);


