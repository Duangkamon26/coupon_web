<?php

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

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => true, "res" => null, "msg" => "บันทึกข้อมูลสำเร็จ !", "dev_log"=>'']);
    } else {
        echo json_encode(["status" => false, "res" => null, "msg" => "บันทึกข้อมูลไม่สำเร็จ !", "dev_log"=> $sql]);
    }

    return;

}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
