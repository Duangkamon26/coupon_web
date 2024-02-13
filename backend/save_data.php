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
    $store = isset($entityBody->store) ? $entityBody->store : '';
    $usage_status = isset($entityBody->usage_status) ? $entityBody->usage_status : '';

    // สร้างคำสั่ง SQL เพื่อบันทึกข้อมูล
    $column = "(`county`,`coupon_code`,`couponType`,`discount_value`,`couponNumber`,`creation_date`,`expiration_date`,`store`,`usage_status`)";
    
    $value = "(";
    $value .= "'" . $county . "', ";
    $value .= "'" . $coupon_code . "', ";
    $value .= "'" . $couponType . "', ";
    $value .= "'" . $discount_value . "', ";
    $value .= "'" . $couponNumber . "', ";
    $value .= "'" . $creation_date . "', ";
    $value .= "'" . $expiration_date . "', ";
    $value .= "'" . $store . "', ";
    $value .= "'" . $usage_status . "'";
    $value .= ")";

    $sql = "INSERT INTO admincoupon " . $column . "  VALUES " . $value;

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => true, "res" => null, "msg" => "บันทึกข้อมูลสำเร็จ !"]);
    } else {
        echo json_encode(["status" => false, "res" => null, "msg" => "บันทึกข้อมูลไม่สำเร็จ !"]);
    }

    return;

}

// ปิดการเชื่อมต่อฐานข้อมูล
// $conn->close();
?>
