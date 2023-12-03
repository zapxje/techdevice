<?php
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_REQUEST['name']) || empty($_REQUEST['email']) || empty($_REQUEST['phone']) || empty($_REQUEST['address']) || empty($_REQUEST['city']) || empty($_REQUEST['payment']) || empty($_REQUEST['agree'])) {
        switch (true) {
            case empty($_REQUEST['name']):
                $message = '<div class="alert alert-danger" role="alert">
                            Hãy nhập tên người nhận
                        </div>';
                break;
            case empty($_REQUEST['email']):
                $message = '<div class="alert alert-danger" role="alert">
                            Hãy nhập email
                        </div>';
                break;
            case empty($_REQUEST['phone']):
                $message = '<div class="alert alert-danger" role="alert">
                            Hãy nhập số điện thoại
                        </div>';
                break;
            case empty($_REQUEST['address']):
                $message = '<div class="alert alert-danger" role="alert">
                            Hãy nhập địa chỉ
                        </div>';
                break;
            case empty($_REQUEST['city']):
                $message = '<div class="alert alert-danger" role="alert">
                            Hãy nhập thành phố
                        </div>';
                break;
            case empty($_REQUEST['payment']):
                $message = '<div class="alert alert-danger" role="alert">
                            Hãy nhập chọn phương thức thanh toán
                        </div>';
                break;
            case empty($_REQUEST['agree']):
                $message = '<div class="alert alert-danger" role="alert">
                            Hãy chắc chắn bạn đã rõ điều khoản và điều kiện
                        </div>';
                break;
        }
        return;
    }

    // Tạo SESSTION Chứa Tạm Order //
    $permitted_chars = '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $orderTemp = array(
        'id_user' => $_POST['id_user'],
        'code_order' => substr(str_shuffle($permitted_chars), 0, 10),
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'city' => $_POST['city'],
        'phone' => $_POST['phone'],
        'note' => $_POST['note'],
        'payment_method' => $_POST['payment'],
        'total_order' => $_POST['total-order']
    );
    $_SESSION['orderTemp'][] = $orderTemp;

    // Tạo SESSTION Chứa Tạm Carts //
    $listCarts = array();
    if (isset($_REQUEST['products'])) {
        foreach ($_REQUEST['products'] as $product) {
            $cartTemp = array(
                'id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            );
            $listCarts[] = $cartTemp;
        }
    } else {
        include 'view/home.php';
        return;
    }
    $_SESSION['cartsTemp'] = $listCarts;
    // Xử lí các trường hợp thanh toán//
    if (isset($_REQUEST['payment'])) {
        if ($_REQUEST['payment'] == 'momoAtm') {
            header('Content-type: text/html; charset=utf-8');
            function execPostRequest($url, $data)
            {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data)
                    )
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                //execute post
                $result = curl_exec($ch);
                //close connection
                curl_close($ch);
                return $result;
            }
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo ATM";
            $amount = "10000";
            $orderId = time() . "";
            $redirectUrl = "http://localhost/pro1014/index.php?act=redirectCheckout";
            $ipnUrl = "http://localhost/pro1014/index.php?act=redirectCheckout";
            $extraData = "";
            $requestId = time() . "";
            $requestType = "payWithATM";
            $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); // decode json
            //Just a example, please check more in there
            header('Location: ' . $jsonResult['payUrl']);
        } else if ($_REQUEST['payment'] == 'momoQrcode') {
            header('Content-type: text/html; charset=utf-8');
            function execPostRequest($url, $data)
            {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data)
                    )
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                //execute post
                $result = curl_exec($ch);
                //close connection
                curl_close($ch);
                return $result;
            }
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = "10000";
            $orderId = time() . "";
            $redirectUrl = "http://localhost/pro1014/index.php?act=redirectCheckout";
            $ipnUrl = "http://localhost/pro1014/index.php?act=redirectCheckout";
            $extraData = "";
            $requestId = time() . "";
            $requestType = "captureWallet";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); // decode json
            //Just a example, please check more in there
            header('Location: ' . $jsonResult['payUrl']);
        }
    }
}
