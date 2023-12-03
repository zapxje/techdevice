<?php
$message = '';
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
    case empty($_REQUEST['argree']):
        $message = '<div class="alert alert-danger" role="alert">
                        Hãy chắc chắn bạn đã rõ điều khoản và điều kiện
                    </div>';
        break;
}
include 'view/checkout.php';
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
        $redirectUrl = "http://localhost/pro1014/index.php?act=thankyou";
        $ipnUrl = "http://localhost/pro1014/index.php?act=thankyou";
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
        $redirectUrl = "http://localhost/pro1014/index.php?act=thankyou";
        $ipnUrl = "http://localhost/pro1014/index.php?act=thankyou";
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
