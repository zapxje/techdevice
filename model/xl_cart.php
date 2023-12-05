<?php
function checkIndex($newItem)
{
    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][0] == $newItem[0]) {
            //Trả về vị trí của newItem luôn
            return $i;
        }
    }
    //Trả về -1 tức là chưa tồn tại sp trên trong session
    return -1;
}

if (isset($_REQUEST['act']) && !empty($_REQUEST['act'])) {
    switch ($_REQUEST['act']) {
        case 'addToCart':
            if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
                $idProduct = $_REQUEST['id'];
                $product = getOneProduct($idProduct);
                $price = $product['price_sale'] > 0 ? $product['price_sale'] : $product['price'];
                $count = isset($_REQUEST['count']) ? $_REQUEST['count'] : 1;
                //Sản phẩm mới 
                $newItem = [$product['id'], $product['name'], $price, $product['image'], $count];
                //Check vị trị sản phẩm mới trong Session
                $index = checkIndex($newItem);
                $index == -1 ? $_SESSION['cart'][] = $newItem : $_SESSION['cart'][$index][4] += $count;
            }
            break;
        case 'addToCartSingle':
            if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
                $idProduct = $_REQUEST['id'];
                $product = getOneProduct($idProduct);
                $price = $product['price_sale'] > 0 ? $product['price_sale'] : $product['price'];
                $count = isset($_REQUEST['count']) ? $_REQUEST['count'] : 1;
                //Sản phẩm mới 
                $newItem = [$product['id'], $product['name'], $price, $product['image'], $count];
                //Check vị trị sản phẩm mới trong Session
                $index = checkIndex($newItem);
                $index == -1 ? $_SESSION['cart'][] = $newItem : $_SESSION['cart'][$index][4] += $count;
                header('location: index.php?act=viewCart');
            }
            break;
        case 'delToCart':
            if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
                $index = checkIndex([$_REQUEST['id']]);
                array_splice($_SESSION['cart'], $index, 1);
            }
            break;
        case 'delToViewCart':
            if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
                $index = checkIndex([$_REQUEST['id']]);
                array_splice($_SESSION['cart'], $index, 1);
                header('location: index.php?act=viewCart');
            }
            break;
    }
}
//Tổng sản phẩm trong giỏ hàng
// $quantities = array_column($_SESSION['cart'], 4);
$quantities = array();
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item[4])) {
            $quantities[] = $item[4];
        }
    }
}
$totalQuantity = array_sum($quantities);
//Tổng giá trong giỏ hàng
$subtotal = 0;
