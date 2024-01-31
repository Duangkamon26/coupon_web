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

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM coupon";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <!-- <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        
    </style> -->
</head>
<body>

<div class="content">
      <!-- เนื้อหาหลักของเว็บไซต์ -->
      <form class="row g-3">
          <div class="message-box row">
            <h4>ข้อมูลส่วนลด</h4>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="index.html"><button class="btn btn-primary btn-rounded btn-warning" type="button">เพิ่มข้อมูลคูปอง</button></a>
            </div>
            <p></p>
            <nav class="gap-2 d-md-flex me-auto justify-content-md-end">
              <form class="d-flex gap-2 me-auto">
                <input class="form-control-right" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </nav>
            
            <div class="scroll-container">
                <table class="table">
                    <!-- เนื้อหาที่ต้องการเลื่อน -->
                    <p>แสดง  
                      <select name="table-data-length" aria-controls="table-data" class="custom-select-sm form-control-sm">
                        <option value="10">10</option>
                        <option value="10">25</option>
                        <option value="10">50</option>
                        <option value="10">100</option>
                      </select> รายการ
                    </p>
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">พื้นที่</th>
                        <th scope="col">Code</th>
                        <th scope="col">ประเภทคูปอง</th>
                        <th scope="col">มูลค่าส่วนลด</th>
                        <th scope="col">จำนวนที่ใช้</th>
                        <th scope="col">วันที่สร้าง</th>
                        <th scope="col">วันหมดอายุ</th>
                        <th scope="col">ร้านที่ใช้</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">เครื่องมือ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              echo "
                              <tr>
                                  <td>".$row['id']."</td>
                                  <td>".$row['county']."</td>
                                  <td>".$row['coupon_code']."</td>
                                  <td>".$row['couponType']."</td>
                                  <td>".$row['discount_value']."</td>
                                  <td>".$row['couponNumber']."</td>
                                  <td>".$row['creation_date']."</td>
                                  <td>".$row['expiration_date']."</td>
                                  <td>".$row['store']."</td>
                                  <td>".$row['usage_status']."</td>
                              </tr>";
                          }
                      } else {
                          echo "<tr><td colspan='10'>No data found.</td></tr>";
                      }
                      ?>
                    </tbody>
                </table>
              </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">ถัดไป</a>
                    </li>
                </ul>
            </nav>
          </div>
      </form>
    </div>
</body>
</html>
