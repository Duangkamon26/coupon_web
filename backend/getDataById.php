<?php

// เชื่อมต่อฐานข้อมูล
// $conn = new PDO('mysql:host=localhost;dbname=coupon_sql', 'root', '');
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "coupon_sql";

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

$id = $_GET['id'];
$user = "SELECT * FROM couponadmin WHERE id = " . $id . " ";
$user = $conn->query($user);
$res = mysqli_fetch_assoc($user);

echo json_encode(["data" => $res]);
?>

