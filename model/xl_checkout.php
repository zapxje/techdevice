<?php
if (isset($_REQUEST['act'])) {
    switch ($_GET['act']) {
        case 'checkout':
            $message = '';
            if (isset($_POST['submit-checkout'])) {
                if (
                    empty($_POST['name']) ||
                    empty($_POST['email']) ||
                    empty($_POST['address']) ||
                    empty($_POST['city']) ||
                    empty($_POST['phone'])
                ) {
                    if (empty($_POST['name'])) {
                        $message = '<div class="alert alert-danger" role="alert">
                Hãy nhập tên người nhận
                </div>';
                    } elseif (empty($_POST['email'])) {
                        $message = '<div class="alert alert-danger" role="alert">
                Hãy nhập email
                </div>';
                    } elseif (empty($_POST['address'])) {
                        $message = '<div class="alert alert-danger" role="alert">
                Hãy nhập địa chỉ
                </div>';
                    } elseif (empty($_POST['city'])) {
                        $message = '<div class="alert alert-danger" role="alert">
                Hãy nhập thành phố
                </div>';
                    } else {
                        $message = '<div class="alert alert-danger" role="alert">
                Hãy nhập số điện thoại
                </div>';
                    }
                }
                if (empty($_POST['payment'])) {
                    $message = '<div class="alert alert-danger" role="alert">
								Hãy chọn phương thức thanh toán
							</div>';
                } else {
                    addOrder(
                        $_POST['id_user'],
                        $_POST['name'],
                        $_POST['email'],
                        $_POST['address'],
                        $_POST['city'],
                        $_POST['phone'],
                        $_POST['note'],
                        $_POST['payment'],
                        $_POST['total-order']
                    );
                    
                    $list_cart = array();
                    //thêm object cart vào list cart
                    foreach ($_POST['products'] as $product) {
                        $cart = (object)[
                            "id"=>$product['id'],
                            "name" => $product['name'],
                            "quantity" => $product['quantity'],
                            "price" => $product['price'],
                        ];
                        $list_cart[] = $cart;
                    }
                    $order= getOneOrderLimit();
                    var_dump($order);
                    if (is_array($list_cart)) {
                        for ($i = 0; $i < count($list_cart); $i++) {
                            // Kiểm tra xem $list_cart[$i] có phải là đối tượng không
                            if (is_object($list_cart[$i])) {
                                // Truy cập thuộc tính của đối tượng
                                $productName = $list_cart[$i]->name;
                                $productPrice = $list_cart[$i]->price;
                                $productQuantity = $list_cart[$i]->quantity;
                    
                                $product = getOneProduct($list_cart[$i]->id);
                                var_dump($product);
                                // Kiểm tra xem $product có phải là mảng không
                                if (is_array($product) && isset($product["id"])) {
                                    addCart(
                                        $product["id"],
                                        $order[0],
                                        $productPrice,
                                        $productQuantity,
                                        $productName
                                    );
                                } else {
                                    // Xử lý khi $product không phải là mảng hoặc key "id" không tồn tại
                                    echo "Không thể truy cập key 'id' vì biến không phải là mảng hoặc key không tồn tại.";
                                }
                            } else {
                                // Xử lý khi $list_cart[$i] không phải là đối tượng
                                echo "Lỗi: $list_cart[$i] không phải là đối tượng.";
                            }
                        }
                    } else {
                        // Xử lý khi $list_cart không phải là mảng
                        echo "Lỗi: không phải là mảng.";
                    }
                }
            }


            break;
    }
}
