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
$creation_date1 = isset($_POST['creation_date1']) ? $_POST['creation_date1'] : '';
$expiration_date1 = isset($_POST['expiration_date1']) ? $_POST['expiration_date1'] : '';
$store = isset($_POST['store']) ? $_POST['store'] : '';
$usage_status = isset($_POST['usage_status']) ? $_POST['usage_status'] : '';
$displayType = isset($_POST['displayType']) ? $_POST['displayType'] : '';
$details1 = isset($_POST['details1']) ? $_POST['details1'] : '';
$details2 = isset($_POST['details2']) ? $_POST['details2'] : '';
$formFile = isset($_POST['formFile']) ? $_POST['formFile'] : '';
$startTime = isset($_POST['startTime']) ? $_POST['startTime'] : '';
$defaultCheck = isset($_POST['defaultCheck']) ? $_POST['defaultCheck'] : '';
$startDistance = isset($_POST['startDistance']) ? $_POST['startDistance'] : '';
$endDistance = isset($_POST['endDistance']) ? $_POST['endDistance'] : '';
$couponType1 = isset($_POST['couponType1']) ? $_POST['couponType1'] : '';
$valueType = isset($_POST['valueType']) ? $_POST['valueType'] : '';
$calculateDiscount1 = isset($_POST['calculateDiscount1']) ? $_POST['calculateDiscount1'] : '';
$calculateDiscount2 = isset($_POST['calculateDiscount2']) ? $_POST['calculateDiscount2'] : '';
$calculateDiscount3 = isset($_POST['calculateDiscount3']) ? $_POST['calculateDiscount3'] : '';
$minimumValue = isset($_POST['minimumValue']) ? $_POST['minimumValue'] : '';
$discountType = isset($_POST['discountType']) ? $_POST['discountType'] : '';
$maximumDiscount = isset($_POST['maximumDiscount']) ? $_POST['maximumDiscount'] : '';
$repeatCoupons = isset($_POST['repeatCoupons']) ? $_POST['repeatCoupons'] : '';
$storeType = isset($_POST['storeType']) ? $_POST['storeType'] : '';
$couponAutomatic = isset($_POST['couponAutomatic']) ? $_POST['couponAutomatic'] : '';
$customer = isset($_POST['customer']) ? $_POST['customer'] : '';

// สร้างคำสั่ง SQL เพื่อบันทึกข้อมูล
$sql = "INSERT INTO couponadmin (`county`,`coupon_code`,`couponType`,`discount_value`,`couponNumber`,`creation_date`,`expiration_date`,`creation_date1`,`expiration_date1`,`store`,`usage_status`,`displayType`,`details1`,`details2`,`formFile`,`startTime`,`endTime`,`defaultCheck`,`startDistance`,`endDistance`,`couponType1`,`valueType`,`calculateDiscount1`,`calculateDiscount2`,`calculateDiscount3`,`minimumValue`,`discountType`,`maximumDiscount`,`repeatCoupons`,`storeType`,`couponAutomatic`,`customer`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssssssssssssssss", $county, $coupon_code, $couponType, $discount_value, $couponNumber, $creation_date, $expiration_date, $creation_date1, $expiration_date1, $store, $usage_status , $displayType , $details1 , $details2 , $formFile , $startTime , $endTime , $defaultCheck , $startDistance , $endDistance , $couponType1 , $valueType  , $calculateDiscount1 , $calculateDiscount2 , $calculateDiscount3 , $minimumValue , $discountType , $maximumDiscount , $repeatCoupons , $storeType , $couponAutomatic , $customer);

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
