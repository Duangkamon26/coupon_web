<?php

include 'connDB.php'; // เชื่อมต่อฐานข้อมูล

// ตั้งค่า LINE Notify Token
$token = "0oknYox2vo0m0bSRqt8buJFNhiNKjnNzxSZdKkDcPMK";

// ดึงข้อมูลที่บันทึกใหม่
// $data = query("SELECT * FROM couponadmin WHERE id = $last_inserted_id");

// กำหนดข้อความแจ้งเตือน
$message = "เพิ่มคูปอง " . $data["county"] . " (" . $data["coupon_code"] . ") เรียบร้อยแล้ว";

// ตั้งค่า headers
$headers = array(
  'Authorization: Bearer ' . $token,
  'Content-Type: application/x-www-form-urlencoded',
);

// ส่งข้อความแจ้งเตือน
$ch = curl_init("https://notify-api.line.me/api/notify");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . $message);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

// ตรวจสอบผลลัพธ์
if ($result === false) {
  echo "Error: " . curl_error($ch);
} else {
  echo "ข้อความแจ้งเตือนถูกส่งเรียบร้อยแล้ว";
}

?>
