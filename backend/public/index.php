<?php
// include __DIR__.'/display_data.php';
include __DIR__ . '/../../backend/display_data.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Itim&display=swap">
    
    <title>Coupon Website</title>

</head>
<body>
    <div class="menu-wrapper _fixed menu_translatex_0_first">
        <a href="#" class="logo">
            <img class="logo-img" style="width: 88px; height: 88px;" src="https://one-thailand.com/assets/img/logoback.png?lastmod=1700105349"onerror="this.src='https://placehold.co/50x50?text=no image';">
        </a>
        
        <!-- เพิ่มเมนูตรงนี้ -->
        <a href="#">Home</a>
    </div>
    <div class="content">
        <table class="table">
            <tbody id="data-container">
                <!-- ข้อมูลจะถูกแสดงที่นี่ -->
            </tbody>
        </table>

        <!-- JavaScript เพื่อทำ AJAX request -->
        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     fetchDataAndDisplay();
            // });
            
            // async function fetchDataAndDisplay() {
            //     try {
            //         const response = await fetch('display_data.php');
            //         const data = await response.json();

            //         // เรียกใช้ฟังก์ชันสำหรับแสดงข้อมูล
            //         displayDataInTable(data);
            //     } catch (error) {
            //         console.error('Error fetching data:', error);
            //     }
            // }

            // ฟังก์ชันสำหรับแสดงข้อมูลในตาราง
            function displayDataInTable(data) {
                const tableBody = document.getElementById('data-container');

                // ตรวจสอบว่ามีข้อมูลหรือไม่
                if (data.length > 0) {
                    // วนลูปเพื่อแสดงข้อมูลในตาราง
                    data.forEach(row => {
                        const tableRow = document.createElement('tr');
                        tableRow.innerHTML = `
                            <td>${row.id}</td>
                            <td>${row.county}</td>
                            <td>${row.coupon_code}</td>
                            <!-- เพิ่มคอลัมน์ตามข้อมูลที่ต้องการแสดง -->
                        `;

                        // เพิ่มข้อมูลลงใน tbody
                        tableBody.appendChild(tableRow);
                    });
                } else {
                    // ถ้าไม่มีข้อมูล
                    const noDataRow = document.createElement('tr');
                    noDataRow.innerHTML = '<td colspan="3">No data found.</td>';
                    tableBody.appendChild(noDataRow);
                }
            }
        </script>
    </div>
</body>
</html>
