<?php
// TRANG NÀY LÀ XỬ LÝ KHI THANH TOÁN BẰNG VÍ ĐIỆN TỰ SẼ TRẢ VỀ LÀ THÀNH CÔNG HAY THẤT BẠI, RỒI LƯU LẠI 
// CÁC MÃ GIAO DỊCH CỦA NÓ.

if (isset($_REQUEST['partnerCode']) || isset($_REQUEST['vnp_TmnCode'])) {
    if (isset($_REQUEST['message']) && $_REQUEST['message'] == "Successful." || isset($_REQUEST['vnp_TransactionStatus']) && $_REQUEST['vnp_TransactionStatus'] == 00) {
        //Nếu thanh toán thành công thì tạo Order//
        addOrder(
            $_SESSION['orderTemp']['id_user'],
            $_SESSION['orderTemp']['code_order'],
            $_SESSION['orderTemp']['name'],
            $_SESSION['orderTemp']['email'],
            $_SESSION['orderTemp']['address'],
            $_SESSION['orderTemp']['city'],
            $_SESSION['orderTemp']['phone'],
            $_SESSION['orderTemp']['note'],
            $_SESSION['orderTemp']['payment_method'],
            $_SESSION['orderTemp']['total_order'],
        );
        unset($_SESSION['orderTemp']);
        //Sau đó thêm Carts dựa trên idOrder Mới nhất//
        $newOrder = getOneOrderLimit();
        foreach ($_SESSION['cartsTemp'] as $cart) {
            addCart($cart['id'], $newOrder['id'], $cart['price'], $cart['quantity']);
        }
        unset($_SESSION['cartsTemp']);
        header("location: index.php?act=thankyou");
    } else {
        header("location: index.php?act=sorry");
    }
} else {
    include 'view/home.php';
}

// ================== THÊM ORDER VS CART ================== //
// $permitted_chars = '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
// addOrder(
//     $_POST['id_user'],
//     substr(str_shuffle($permitted_chars), 0, 10),
//     $_POST['name'],
//     $_POST['email'],
//     $_POST['address'],
//     $_POST['city'],
//     $_POST['phone'],
//     $_POST['note'],
//     $_POST['payment'],
//     $_POST['total-order']
// );
// $list_cart = array();
// //thêm object cart vào list cart
// if ($_POST['products']) {
//     foreach ($_POST['products'] as $product) {
//         $cart = (object)[
//             "id" => $product['id'],
//             "name" => $product['name'],
//             "quantity" => $product['quantity'],
//             "price" => $product['price'],
//         ];
//         $list_cart[] = $cart;
//     }
// }
// $order = getOneOrderLimit();
// if (is_array($list_cart)) {
//     for ($i = 0; $i < count($list_cart); $i++) {
//         // Kiểm tra xem $list_cart[$i] có phải là đối tượng không
//         if (is_object($list_cart[$i])) {
//             // Truy cập thuộc tính của đối tượng
//             $productName = $list_cart[$i]->name;
//             $productPrice = $list_cart[$i]->price;
//             $productQuantity = $list_cart[$i]->quantity;

//             $product = getOneProduct($list_cart[$i]->id);
//             // Kiểm tra xem $product có phải là mảng không
//             if (is_array($product) && isset($product["id"])) {
//                 addCart(
//                     $product["id"],
//                     $order[0],
//                     $productPrice,
//                     $productQuantity,
//                 );
//                 header('location: index.php?act=thankyou');
//             } else {
//                 // Xử lý khi $product không phải là mảng hoặc key "id" không tồn tại
//                 echo "Không thể truy cập key 'id' vì biến không phải là mảng hoặc key không tồn tại.";
//             }
//         } else {
//             // Xử lý khi $list_cart[$i] không phải là đối tượng
//             echo "Lỗi: $list_cart[$i] không phải là đối tượng.";
//         }
//     }
// } else {
//     // Xử lý khi $list_cart không phải là mảng
//     echo "Lỗi: không phải là mảng.";
// }
