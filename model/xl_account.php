<?php
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $listOrders = getOrderByUser($_SESSION['user']['id']);
}
//Lấy danh sách đơn hàng của user
