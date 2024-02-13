<?php
   // เรียกใช้ไฟล์ connDB.php ที่มีการเชื่อมต่อกับฐานข้อมูล
  require_once('../../backend/connDB.php');

  // ตรวจสอบว่ามีการส่งค่า delete_id มาหรือไม่
  if (isset($_GET['delete_id'])) {
      $delete_id = $_GET['delete_id'];

      try {
          // ทำการเตรียมคำสั่ง SQL สำหรับลบข้อมูล
          $delete_stmt = $db->prepare("DELETE FROM admincoupon WHERE id = :delete_id");

          // ผูกค่าพารามิเตอร์
          $delete_stmt->bindParam(':delete_id', $delete_id);

          // ทำการ execute คำสั่ง SQL
          if ($delete_stmt->execute()) {
              // หากลบข้อมูลสำเร็จ ทำสิ่งที่ต้องการ เช่น รีเดิร์กหน้าหรือแจ้งเตือน
              header("Location: home.php");
              exit;
          } else {
              // หากเกิดข้อผิดพลาดในการลบข้อมูล
              echo "Error deleting record: " . $db->errorInfo();
          }
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Itim&display=swap">
    
    <script defer src="main.js"></script>

    <?php
    include './../../cdnScript.html'
    ?>
    
    <title>Coupon Website</title>
</head>
<body>

  <div class="menu-wrapper _fixed menu_translatex_0_first">
    <a href="#" class="logo">
        <img class="logo-img" style="width: 88px; height: 88px;" src="https://one-thailand.com/assets/img/logoback.png?lastmod=1700105349" onerror="this.src='https://placehold.co/50x50?text=no image';">
    </a>
    
    <!-- เพิ่มเมนูตรงนี้ -->
    <a href="#">Home</a>
  </div>

  <div class="content">
      <!-- เนื้อหาหลักของเว็บไซต์ -->
      <form class="row g-3">
        <div class="message-box row">
          <h4>ข้อมูลส่วนลด</h4>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="index.html" target="_blank"><button class="btn btn-primary btn-rounded btn-warning" type="button">เพิ่มข้อมูลคูปอง</button></a>
            </div>
            <p></p>
            <nav class="gap-2 d-md-flex me-auto justify-content-md-end">
              <form class="d-flex gap-2 me-auto">
                <input class="form-control-right" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </nav>
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
                <th>
                  #
                </th>
                <th>
                  พื้นที่
                </th>
                <th>
                  code
                </th>
                <th>
                  ประเภทคูปอง
                </th>
                <th>
                  มูลค่าส่วนลด
                </th>
                <th>
                  จำนวนที่ใช้
                </th>
                <th>
                  วันที่สร้าง
                </th>
                <th>
                  วันหมดอายุ
                </th>
                <th>
                  ร้านที่ใช้
                </th>
                <th>
                  สถานะ
                </th>
                <th>
                  เครื่องมือ
                </th>
              </tr>
            </thead>
            <tbody id="table-coupon">
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
               
              </tr>
            </tbody>

          </table>
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
  <!-- JavaScript เพื่อทำ AJAX request -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetchDataAndDisplay();
    });
  
    async function fetchDataAndDisplay() {
      try {
        const response = await fetch('http://localhost:8000/backend/display_data.php');
        const data = await response.json();

        // เรียกใช้ฟังก์ชันสำหรับแสดงข้อมูล
        displayDataInTable(data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    }

    // ฟังก์ชันสำหรับแสดงข้อมูลในตาราง
    function displayDataInTable(datas) {
      $("#table-coupon").empty();

      var html = ''
      for (const [i, res] of datas.entries()) {
        html += `<tr>`
        html += `<td>${i + 1}</td>`
        html +=`<td>${res.county}</td>`
        html +=`<td>${res.coupon_code}</td>`
        html +=`<td>${res.couponType}</td>`
        html +=`<td>${res.discount_value}</td>`
        html +=`<td>${res.couponNumber}</td>`
        html +=`<td>${res.creation_date}</td>`
        html +=`<td>${res.expiration_date}</td>`
        html +=`<td>${res.store}</td>`
        html +=`<td>${res.usage_status}</td>`
        html +=`<td>`
        html +=`<a href="#" onclick="editCoupon(${res.id})" class="btn btn-warning">แก้ไข</a>`
        html +=`<a href="?delete_id=${res.id}" class="btn btn-danger delete">ลบ</a>`
        html +=`</td>`
        html +=`</tr>`
      }
      
      $("#table-coupon").append(html)
    }
    function editCoupon(id) {
        window.location.href = "/backend/couponEdit.php?edit_id=" + id;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll(".delete");
        deleteButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // ดึงข้อมูลหรือรหัสของรายการที่ต้องการลบ
                var itemId = this.getAttribute("data-id");
            });
        });
    });

  </script>
</body>
</html>
