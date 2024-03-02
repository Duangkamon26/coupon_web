<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "coupon_sql";

    // ตรวจสอบว่าตัวแปร $host ถูกกำหนดค่าหรือไม่
    if (!isset($host)) {
        // หากไม่ได้กำหนดค่าให้ $host ให้กำหนดค่าใหม่
        $host = $servername;
    }

    try {
        $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>