<?php

$token = "0oknYox2vo0m0bSRqt8buJFNhiNKjnNzxSZdKkDcPMK"; // ใส่ Token ของคุณที่นี่

include 'connDB.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $entityBody = file_get_contents('php://input');
    $entityBody = json_decode($entityBody);

    $county = isset($entityBody->county) ? $entityBody->county : '';
    $coupon_code = isset($entityBody->coupon_code) ? $entityBody->coupon_code : '';
    $couponType = isset($entityBody->couponType) ? $entityBody->couponType : '';
    $discount_value = isset($entityBody->discount_value) ? $entityBody->discount_value : '';
    $couponNumber = isset($entityBody->couponNumber) ? $entityBody->couponNumber : '';
    $creation_date = isset($entityBody->creation_date) ? $entityBody->creation_date : '';
    $expiration_date = isset($entityBody->expiration_date) ? $entityBody->expiration_date : '';
    $creation_date1 = isset($entityBody->creation_date1) ? $entityBody->creation_date1 : '';
    $expiration_date1 = isset($entityBody->expiration_date1) ? $entityBody->expiration_date1: '';
    $store = isset($entityBody->store) ? $entityBody->store : '';
    $usage_status = isset($entityBody->usage_status) ? $entityBody->usage_status : '';
    $displayType = isset($entityBody->displayType) ? $entityBody->displayType : '';
    $details1 = isset($entityBody->details1) ? $entityBody->details1 : '';
    $details2 = isset($entityBody->details2) ? $entityBody->details2 : '';
    $formFile = isset($entityBody->formFile) ? $entityBody->formFile : '';
    $startTime = isset($entityBody->startTime) ? $entityBody->startTime : '';
    $endTime = isset($entityBody->endTime) ? $entityBody->endTime : '';
    $defaultCheck = isset($entityBody->defaultCheck) ? $entityBody->defaultCheck : '';
    $startDistance = isset($entityBody->startDistance) ? $entityBody->startDistance : '';
    $endDistance = isset($entityBody->endDistance) ? $entityBody->endDistance : '';
    $couponType1 = isset($entityBody->couponType1) ? $entityBody->couponType1 : '';
    $valueType = isset($entityBody->valueType) ? $entityBody->valueType : '';
    $calculateDiscount1 = isset($entityBody->calculateDiscount1) ? $entityBody->calculateDiscount1 : '';
    $calculateDiscount2 = isset($entityBody->calculateDiscount2) ? $entityBody->calculateDiscount2 : '';
    $calculateDiscount3 = isset($entityBody->calculateDiscount3) ? $entityBody->calculateDiscount3 : '';
    $minimumValue = isset($entityBody->minimumValue) ? $entityBody->minimumValue : '';
    $discountType = isset($entityBody->discountType) ? $entityBody->discountType : '';
    $maximumDiscount = isset($entityBody->maximumDiscount) ? $entityBody->maximumDiscount : '';
    $repeatCoupons = isset($entityBody->repeatCoupons) ? $entityBody->repeatCoupons : '';
    $storeType = isset($entityBody->storeType) ? $entityBody->storeType : '';
    $couponAutomatic = isset($entityBody->couponAutomatic) ? $entityBody->couponAutomatic : '';
    $customer = isset($entityBody->customer) ? $entityBody->customer : '';

    // สร้างคำสั่ง SQL เพื่อบันทึกข้อมูล
    $column = "(`county`,`coupon_code`,`couponType`,`discount_value`,`couponNumber`,`creation_date`,`expiration_date`,`creation_date1`,`expiration_date1`,`store`,`usage_status`,`displayType`,`details1`,`details2`,`formFile`,`startTime`,`endTime`,`defaultCheck`,`startDistance`,`endDistance`,`couponType1`,`valueType`,`calculateDiscount1`,`calculateDiscount2`,`calculateDiscount3`,`minimumValue`,`discountType`,`maximumDiscount`,`repeatCoupons`,`storeType`,`couponAutomatic`,`customer`)";

    $value = "(";
    $value .= "'" . $county . "', ";
    $value .= "'" . $coupon_code . "', ";
    $value .= "'" . $couponType . "', ";
    $value .= "'" . $discount_value . "', ";
    $value .= "'" . $couponNumber . "', ";
    $value .= "'" . $creation_date . "', ";
    $value .= "'" . $expiration_date . "', ";
    $value .= "'" . $creation_date1 . "', ";
    $value .= "'" . $expiration_date1 . "', ";
    $value .= "'" . $store . "', ";
    $value .= "'" . $usage_status . "', ";
    $value .= "'" . $displayType . "', ";
    $value .= "'" . $details1 . "', ";
    $value .= "'" . $details2 . "', ";
    $value .= "'" . $formFile . "', ";
    $value .= "'" . $startTime . "', ";
    $value .= "'" . $endTime . "', ";
    $value .= "'" . $defaultCheck . "', ";
    $value .= "'" . $startDistance . "', ";
    $value .= "'" . $endDistance . "', ";
    $value .= "'" . $couponType1 . "', ";
    $value .= "'" . $valueType . "', ";
    $value .= "'" . $calculateDiscount1 . "', ";
    $value .= "'" . $calculateDiscount2 . "', ";
    $value .= "'" . $calculateDiscount3 . "', ";
    $value .= "'" . $minimumValue . "', ";
    $value .= "'" . $discountType . "', ";
    $value .= "'" . $maximumDiscount . "', ";
    $value .= "'" . $repeatCoupons . "', ";
    $value .= "'" . $storeType . "', ";
    $value .= "'" . $couponAutomatic . "', ";
    $value .= "'" . $customer . "' ";
    $value .= ")";

    $sql = "INSERT INTO couponadmin " . $column . "  VALUES " . $value;

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error()); // Handle connection error
    }

    $result = $conn->query($sql);


    if ($result === TRUE) {
        // แปลงข้อความเป็น JSON
        $response_data = ["status" => true, "res" => null, "msg" => "บันทึกข้อมูลสำเร็จ !", "dev_log" => ''];
        $json_response = json_encode($response_data);
        
        // เรียกใช้ฟังก์ชันส่ง Line Notify
        sendLineNotify($conn, $token);
    } else {
        // แปลงข้อความเป็น JSON
        $response_data = ["status" => false, "res" => null, "msg" => "บันทึกข้อมูลไม่สำเร็จ !", "dev_log" => $sql];
        $json_response = json_encode($response_data);
    }
    
}

function sendLineNotify($conn, $token) {
    if (is_object($conn) && method_exists($conn, 'query')) {
        // Fetch the latest coupon data
        $result = $conn->query("SELECT coupon_code, creation_date, expiration_date FROM couponadmin ORDER BY id DESC LIMIT 1");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $coupon_code = $row['coupon_code'];
            $creation_date = $row['creation_date'];
            $expiration_date = $row['expiration_date'];

            // Prepare message for Line Notify
            $message = "รหัสคูปอง $coupon_code คูปองถูกสร้างเมื่อ $creation_date และหมดอายุเมื่อ $expiration_date";

            // Send Line Notify
            sendLineNotifyMessage($message, $token);
        } else {
            // If no coupon data is found, handle the error
            sendLineNotifyMessage("ไม่พบข้อมูลคูปอง", $token);
        }
    } else {
        // Handle the case when $conn is not a valid database connection object
        sendLineNotifyMessage("ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้", $token);
    }
}





function sendLineNotifyMessage($message, $token) {
    $message = json_decode('"' . $message . '"');
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://notify-api.line.me/api/notify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "message=$message",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded",
        ],
    ]);
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

// Close the database connection
$conn->close();

?>
