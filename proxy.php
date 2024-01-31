<?php
// Proxy Server เพื่อทำ CORS request
$url = $_GET['url'];
echo file_get_contents($url);
?>