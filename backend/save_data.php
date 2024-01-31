<?php
include 'server.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $sql = "INSERT INTO coupon (`county`,`coupon_code`,`couponType`,`discount_value`,`couponNumber`,`creation_date`,`expiration_date`,`store`,`usage_status`) VALUES (?,?,?,?,?,?,?,?,?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $county, $coupon_code, $couponType, $discount_value, $couponNumber, $creation_date, $expiration_date, $store, $usage_status);

    // Execute SQL statement
    if ($stmt->execute()) {
        // ส่งค่ากลับในรูปแบบ JSON
        echo json_encode(array("status" => "success", "message" => "บันทึกข้อมูลเรียบร้อย"));
    } else {
        // ส่งค่ากลับในรูปแบบ JSON พร้อมกับข้อความผิดพลาด
        http_response_code(500); // Internal Server Error
        echo json_encode(array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error));
    }



    // ปิด statement
    $stmt->close();
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
