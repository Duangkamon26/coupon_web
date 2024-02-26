<?php
// เรียกใช้ไฟล์ connDB.php ที่มีการเชื่อมต่อกับฐานข้อมูล
require_once('../../backend/connDB.php');

// Include ENV
require_once('env.php');

// ตรวจสอบว่ามีการส่งค่า delete_id มาหรือไม่
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];

  try {
    // ทำการเตรียมคำสั่ง SQL สำหรับลบข้อมูล
    $delete_stmt = $db->prepare("DELETE FROM couponadmin WHERE id = :delete_id");

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <?php
  include '../../cdnScript.php'
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
          <a href="index.php" target="_blank"><button class="btn btn-primary btn-rounded btn-warning" type="button">เพิ่มข้อมูลคูปอง</button></a>
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
                รหัสคูปอง
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
    document.addEventListener("DOMContentLoaded", function() {
      fetchDataAndDisplay();
    });

    async function fetchDataAndDisplay() {
      try {
        const response = await fetch(
          `<?php echo $_DOMAIN; ?>/backend/display_data.php`
        );
        const data = await response.json();

        // เรียกใช้ฟังก์ชันสำหรับแสดงข้อมูล
        displayDataInTable(data);
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    }

    // ฟังก์ชันสำหรับแสดงข้อมูลในตาราง
    function displayDataInTable(datas) {
      $("#table-coupon").empty();

      var html = "";

      for (const [i, res] of datas.entries()) {
        html += `<tr>`;
        html += `<td>${i + 1}</td>`;
        html += `<td>${res.county}</td>`;
        html += `<td>${res.coupon_code}</td>`;
        html += `<td>${res.couponType}</td>`;
        html += `<td>${res.discount_value}</td>`;
        html += `<td>${res.couponNumber}</td>`;
        html += `<td>${res.creation_date}</td>`;
        html += `<td>${res.expiration_date}</td>`;
        html += `<td>${res.store}</td>`;

        html += `<td>`;
        // html += `<button id="toggleButton" class="btn btn-success">เปิดใช้งาน</button>`;
        html += `<a href="#" id="open_button_${res.id}" onclick="confirmAction(${
      res.id
    }, '${res.usage_status}')" class="btn btn-${
      res.usage_status == "1" ? "success" : "danger"
    }" style="margin-right: 5px;">${
      res.usage_status == "1" ? "เปิดใช้งาน" : "ปิดใช้งาน"
    }</a>`;
        // html += `<a href="#" id="open_button_${i}" onclick="confirmAction(${res.id}, '${res.usage_status}')" class="btn btn-${res.usage_status === 'open' ? 'success' : 'danger'}" style="margin-right: 5px;">${res.usage_status === 'open' ? 'เปิดใช้งาน' : 'ปิดใช้งาน'}</a>`;
        // html += `<a href="#" id="myButton" onclick="confirmAction()" class="btn btn-success" style="margin-right: 5px;">เปิดใช้งาน</a>`;
        html += `</td>`;
        // html += `<td>${res.usage_status}</td>`;
        html += `<td>`;
        html += `<div style="display: flex; justify-content: space-between;">`;
        html += `<a href="index.php?id=${res.id}" class="btn btn-warning" style="margin-right: 5px;">แก้ไข</a>`;
        html += `<a href="?delete_id=${res.id}" class="btn btn-danger delete">ลบ</a>`;
        html += `</div>`;
        html += `</td>`;
        html += `</tr>`;
      }

      $("#table-coupon").append(html);
    }

    document.addEventListener("DOMContentLoaded", function() {
      var deleteButtons = document.querySelectorAll(".delete");
      deleteButtons.forEach(function(button) {
        button.addEventListener("click", function() {
          // ดึงข้อมูลหรือรหัสของรายการที่ต้องการลบ
          var itemId = this.getAttribute("data-id");
        });
      });
    });

    async function getButtonStatus(id) {
      try {
        const response = await fetch(`<?php echo $_DOMAIN; ?>/backend/get_status.php?id=${id}`);
        if (!response.ok) {
          throw new Error("เกิดข้อผิดพลาด: " + response.statusText);
        }
        const status = await response.json();
        return status;
      } catch (error) {
        console.error("เกิดข้อผิดพลาด:", error);
        // แสดงข้อความแจ้งเตือนผู้ใช้
      }
    }

    async function updateButtonStatus(id, status) {
      try {
        const data = JSON.stringify({
          id,
          status,
        });

        const response = await fetch(
          `<?php echo $_DOMAIN; ?>/backend/update_status.php?id=${id}&status=${status}`, {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
            },
          }
        );

        if (!response.ok) {
          throw new Error("เกิดข้อผิดพลาด: " + response.statusText);
        }

        $(`#open_button_${id}`).empty();
        $(`#open_button_${id}`).attr(
          "onclick",
          `confirmAction(${id}, ${status == 1 ? 0 : 1})`
        );
        $(`#open_button_${id}`).append(status == 1 ? "ปิดใช้งาน" : "เปิดใช้งาน");

        const haveClass = $(`#open_button_${id}`).hasClass("btn-success");
        $(`#open_button_${id}`).removeClass(
          haveClass ? "btn-success" : "btn-danger"
        );
        $(`#open_button_${id}`).addClass(haveClass ? "btn-danger" : "btn-success");
      } catch (error) {
        console.error("เกิดข้อผิดพลาด:", error);
        // แสดงข้อความแจ้งเตือนผู้ใช้
      }
    }

    async function confirmAction(id, status) {
      try {
        // แสดงข้อความยืนยัน
        const result = await Swal.fire({
          title: "ต้องการปิดใช้งานใช่หรือไม่?",
          text: "คุณไม่สามารถย้อนกลับการกระทำนี้ได้!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "ปิดใช้งาน!",
        });

        // ตรวจสอบว่าผู้ใช้กดยืนยัน
        if (!result.isConfirmed) {
          return;
        }

        updateButtonStatus(id, status);
      } catch (error) {
        console.error("เกิดข้อผิดพลาด:", error);
      }
    }
  </script>
</body>

</html>