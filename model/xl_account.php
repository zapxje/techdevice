<?php
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $listOrders = getOrderByUser($_SESSION['user']['id']);
}
//Lấy danh sách đơn hàng của user
if (isset($_REQUEST['idOrder']) && !empty($_REQUEST['idOrder'])) {
    $listCarts = getCartByOrder($_REQUEST['idOrder']);
    $orderAlone = getOneOrder($_REQUEST['idOrder']);
    $totalPrice = 0;
}
