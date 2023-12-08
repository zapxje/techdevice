<?php
/*======================================== ADMIN ======================================== */
if (isset($_REQUEST['act']) && !empty($_REQUEST['act'])) {
    switch ($_REQUEST['act']) {
        case 'ordersWait':
            if (isset($_REQUEST['idOrder']) && !empty($_REQUEST['idOrder'])) {
                $idOrder = $_REQUEST['idOrder'];
                $order = getOneOrder($idOrder);
                if ($order) {
                    if (isset($_REQUEST['orderDetail'])) {
                        $listCarts = getCartByOrder($idOrder);
                        include_once("view/orderDetailAd.php");
                        return;
                    }
                    if (isset($_REQUEST['confirmOrder'])) {
                        confirmOrder($idOrder);
                        $notification = 'successAdd';
                    }
                } else {
                    $notification = 'notExist';
                }
            }
            $listOrders = getAllOrdersWait();
            include_once("view/ordersWait.php");
            break;
        case 'ordersHandle':
            $listOrders = getAllOrdersHandle();
            include_once("view/ordersWait.php");
            break;
    }
}

/*======================================== /ADMIN ======================================= */
