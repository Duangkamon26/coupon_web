<?php

include 'connDB.php';

// รับข้อมูลจากฟอร์ม
$county = isset($_POST['county']) ? $_POST['county'] : '';
$coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';
$couponType = isset($_POST['couponType']) ? $_POST['couponType'] : '';
$discount_value = isset($_POST['discount_value']) ? $_POST['discount_value'] : '';
$couponNumber = isset($_POST['couponNumber']) ? $_POST['couponNumber'] : '';
$creation_date = isset($_POST['creation_date']) ? $_POST['creation_date'] : '';
$expiration_date = isset($_POST['expiration_date']) ? $_POST['expiration_date'] : '';
$store = isset($_POST['store']) ? $_POST['store'] : '';
$usage_status = isset($_POST['usage_status']) ? $_POST['usage_status'] : '';

// สร้างคำสั่ง SQL เพื่อบันทึกข้อมูล
$sql = "INSERT INTO admincoupon (`county`,`coupon_code`,`couponType`,`discount_value`,`couponNumber`,`creation_date`,`expiration_date`,`store`,`usage_status`) VALUES (?,?,?,?,?,?,?,?,?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $county, $coupon_code, $couponType, $discount_value, $couponNumber, $creation_date, $expiration_date, $store, $usage_status);

// Debug: แสดงข้อมูลที่ถูกส่งมาจากฟอร์ม
var_dump($_POST);

// Execute SQL statement
if ($stmt->execute()) {
    echo "บันทึกข้อมูลเรียบร้อย";
} else {
    // Debug: แสดงข้อผิดพลาดที่เกิดขึ้นในการ execute SQL statement
    var_dump($stmt->error);
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิด statement
$stmt->close();

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
