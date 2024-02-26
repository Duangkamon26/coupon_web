<?php

// เชื่อมต่อฐานข้อมูล
$db = new PDO('mysql:host=localhost;dbname=coupon_sql', 'root', '');

// ตรวจสอบ id ที่ส่งมา
if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  // แสดงข้อความแจ้งเตือน
  echo json_encode(['message' => 'ไม่พบค่า id']);
  exit;
}

// ดึงข้อมูลสถานะปุ่ม
$sql = 'SELECT status FROM buttons WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $id]);
$status = $stmt->fetchColumn();

// ตรวจสอบ id อีกครั้ง (ถ้าจำเป็น)
if (!isset($status)) {
  // แสดงข้อความแจ้งเตือน
  echo json_encode(['message' => 'ไม่พบข้อมูลสถานะปุ่ม']);
} else {
  // ส่งข้อมูลสถานะปุ่มในรูปแบบ JSON
  echo json_encode(['status' => $status]);
}

?>

