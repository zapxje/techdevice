<?php
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $listOrders = getOrderByUser($_SESSION['user']['id']);
}
//Lấy danh sách đơn hàng của user
if (isset($_REQUEST['idOrder']) && !empty($_REQUEST['idOrder']) && !isset($_REQUEST['cancel']) && !isset($_REQUEST['confirm'])) {
    $listCarts = getCartByOrder($_REQUEST['idOrder']);
    $orderAlone = getOneOrder($_REQUEST['idOrder']);
    $totalPrice = 0;
}
if (isset($_REQUEST['idOrder']) && !empty($_REQUEST['idOrder']) && isset($_REQUEST['cancel'])) {
    $openCancel = true;
    $idOrder = $_REQUEST['idOrder'];
    if (isset($_REQUEST['reason']) && !empty($_REQUEST['reason'])) {
        $note = $_REQUEST['reason'];
        cancelOrder($idOrder, $note);
        header('location: index.php?act=account');
    }
}
if (isset($_REQUEST['idOrder']) && !empty($_REQUEST['idOrder']) && isset($_REQUEST['confirm'])) {
    $idOrder = $_REQUEST['idOrder'];
    confirmOrderDone($idOrder);
    header('location: index.php?act=account');
}
