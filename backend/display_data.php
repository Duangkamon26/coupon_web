<?php
// ในไฟล์ display_data.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "coupon_sql";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM couponadmin";
$result = $conn->query($sql);

// สร้าง array เพื่อเก็บข้อมูลที่ได้จากฐานข้อมูล
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // $data[] = 1;
        if(json_encode($row)) $data[] = $row;
    }
}

// ส่งข้อมูลในรูปแบบ JSON
// echo json_encode($data);
echo json_encode($data);

$conn->close();

?>
