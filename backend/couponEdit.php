<?php
require_once('connDB.php');

if (isset($_REQUEST['edit_id'])) {
    try {
        $id = $_REQUEST['edit_id'];
        $select_stmt = $db->prepare("SELECT * FROM admincoupon WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        // echo $countyInput;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

if (isset($_REQUEST['btn_edit'])){
    $county_edit = $_REQUEST['select_countyInput'];
    $coupon_code_edit = $_REQUEST['text_coupon_codeInput'];
    $couponType_edit = $_REQUEST['select_couponTypeInput'];
    $discount_value_edit = $_REQUEST['number_discount_valueInput'];
    $couponNumber_edit = $_REQUEST['number_couponNumberInput'];
    $creation_date_edit = $_REQUEST['date_creation_dateInput'];
    $expiration_date_edit = $_REQUEST['date_expiration_dateInput'];
    $store_edit = $_REQUEST['text_storeInput'];
    $usage_status_edit = $_REQUEST['select_usage_statusInput'];

    if (empty($county_edit)) {
        $errorMsg = "Please Enter county";
    } else if (empty($coupon_code_edit)) {
        $errorMsg = "Please Enter coupon_code";
    }else {
        try {
            if(!isset($errorMsg)){
                $edit_stmt = $db->prepare("UPDATE admincoupon SET countyInput = :county_edit, coupon_codeInput = :coupon_code_edit, 
                couponTypeInput = :couponType_edit, discount_valueInput = :discount_value_edit, couponNumberInput = :couponNumber_edit,
                creation_dateInput = :creation_date_edit, expiration_dateInput = :expiration_date_edit, storeInput = :store_edit,
                usage_statusInput = :usage_status_edit WHERE id = :id");
                $edit_stmt->bindParam(':county_edit', $county_edit);
                $edit_stmt->bindParam(':coupon_code_edit', $coupon_code_edit);
                $edit_stmt->bindParam(':couponType_edit', $couponType_edit);
                $edit_stmt->bindParam(':discount_value_edit', $discount_value_edit);
                $edit_stmt->bindParam(':couponNumber_edit', $couponNumber_edit);
                $edit_stmt->bindParam(':creation_date_edit', $creation_date_edit);
                $edit_stmt->bindParam(':expiration_date_edit', $expiration_date_edit);
                $edit_stmt->bindParam(':store_edit', $store_edit);
                $edit_stmt->bindParam(':usage_status_edit', $usage_status_edit);
                $edit_stmt->bindParam(':id', $id);

                if ($edit_stmt->execute()) {
                    $editMsg = "Record edit successfully...";
                    header("refresh:2;home.php");
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
// ตรวจสอบว่ามีข้อผิดพลาดที่เกิดขึ้นหรือไม่
if(file_exists('error_log')) {
    // อ่านไฟล์ error_log เพื่อดูข้อผิดพลาดที่เกิดขึ้น
    $error_log_content = file_get_contents('error_log');
    // แสดงข้อผิดพลาดที่ได้รับ
    echo nl2br($error_log_content);
} else {
    echo "No errors logged.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../backend/public/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Itim&display=swap">
    <title>Coupon Website</title>
    <!-- <script defer src="main.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // เมื่อมีการเปลี่ยนค่าใน radio buttons
        function handleRadioChange() {
            var selectedValue = document.querySelector('input[name="inlineRadioOptions"]:checked').value;
            var dateFields = document.querySelectorAll('.date-fields');
            var dayFields = document.querySelectorAll('.day-fields');

            // ซ่อนทุก field ของวันที่
            dateFields.forEach(function (dateField) {
                dateField.style.display = 'none';
            });

            // ซ่อนทุก field ของวัน
            dayFields.forEach(function (dayField) {
                dayField.style.display = 'none';
            });

            // แสดง field ตามที่ถูกเลือก
            if (selectedValue === 'option1') {
                dateFields.forEach(function (dateField) {
                    dateField.style.display = 'block';
                });
            } else if (selectedValue === 'option2') {
                dayFields.forEach(function (dayField) {
                    dayField.style.display = 'block';
                });
            }
        }
    </script>
</head>

<body>

    <?php
        if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>

    <?php 
        if (isset($editMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $editMsg; ?></strong>
        </div>
    <?php } ?>

    <div class="content">
        <!-- เนื้อหาหลักของเว็บไซต์ -->
        <form class="row g-3" id="myForm">
            <div class="message-box row">
                <p>ข้อมูลส่วนลด</p>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="countyInput" class="form-label">อำเภอ/เมือง *</label>
                    </div>
                    <select class="form-select" id="countyInput" aria-label="District" value="<?php echo $countyInput; ?>" required>
                        <option selected> </option>
                        <option value="ทับสะแก">ทับสะแก</option>
                        <?php
                        // ตรวจสอบว่ามีข้อมูลในตัวแปร $countyInput หรือไม่
                        if (isset($countyInput)) {
                            // ใช้วงลูปเพื่อแสดงตัวเลือกของอำเภอ/เมือง
                            foreach ($countyInput as $county) {
                                echo "<option value='$county'>$county</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="displayTypeInput" class="form-label">ประเภทการแสดง *</label>
                    </div>
                    <select id="displayTypeInput" class="form-select" type="select" aria-label="Display Type" required>
                        <option selected> </option>
                        <option value="แสดงหน้าใช้คูปอง">แสดงหน้าใช้คูปอง</option>
                        <option value="ค้นหา">ค้นหา</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="coupon_codeInput" class="form-label">Coupen Code *</label>
                    <input type="text" class="form-control" id="coupon_codeInput" name="coupon_codeInput" required>
                </div>
                <div class="col-md-6">
                    <label for="details1Input" class="form-label">รายละเอียดแบบสั้น *</label>
                    <input type="text" class="form-control" id="details1Input" required>
                </div>
                <div class="col-12">
                    <label for="details2Input" class="form-label">รายละเอียดแบบเต็ม *</label>
                    <input type="text" class="form-control" id="details2Input" required>
                </div>
                <div class="mb-3">
                    <label for="formFileInput" class="form-label">รูปคูปอง</label>
                    <input class="form-control" type="file" id="formFileInput" required>
                </div>
            </div>


            <div class="message-box row">
                <p>ข้อมูลวันที่ใช้งานส่วนลด</p>
                <div class="d-flex align-items-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1" onchange="handleRadioChange()">
                        <label class="form-check-label" for="inlineRadio1">เลือกวันที่</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2" onchange="handleRadioChange()">
                        <label class="form-check-label" for="inlineRadio2">เลือกวัน</label>
                    </div>
                </div>
                <div class="col-md-6 date-fields">
                    <label for="creation_dateInput" class="form-label">วันเริ่มต้น</label>
                    <input type="date" class="form-control" id="creation_dateInput" name="creation_date">
                </div>
                <div class="col-md-6 date-fields">
                    <label for="expiration_dateInput" class="form-label">วันหมดอายุ</label>
                    <input type="date" class="form-control" id="expiration_dateInput" name="expiration_date">
                </div>
                <div class="col-md-6 date-fields">
                    <label for="startTimeInput" class="form-label">เวลาเริ่มต้น (เริ่มที่ 00:00)</label>
                    <input type="time" class="form-control" id="startTimeInput" name="startTimeInput">
                </div>
                <div class="col-md-6 date-fields">
                    <label for="endTimeInput" class="form-label">เวลาสิ้นสุด (เริ่มที่ 23:59)</label>
                    <input type="time" class="form-control" id="endTimeInput" name="endTimeInput">
                </div>
                <div class="col-md-6 day-fields">
                    <label for="creation_date1Input" class="form-label">วันเริ่มต้น</label>
                    <input type="date" class="form-control" id="creation_date1Input" name="creation_date1Input">
                </div>
                <div class="col-md-6 day-fields">
                    <label for="expiration_date1Input" class="form-label">วันหมดอายุ</label>
                    <input type="date" class="form-control" id="expiration_date1Input" name="expiration_date1Input">
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1Input">
                    <label class="form-check-label" for="defaultCheck1Input">
                        จันทร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2Input">
                    <label class="form-check-label" for="defaultCheck2Input">
                        อังคาร
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck3Input">
                    <label class="form-check-label" for="defaultCheck3Input">
                        พุธ
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck4Input">
                    <label class="form-check-label" for="defaultCheck4Input">
                        พฤหัสบดี
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck5Input">
                    <label class="form-check-label" for="defaultCheck5Input">
                        ศุกร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck6Input">
                    <label class="form-check-label" for="defaultCheck6Input">
                        เสาร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck7Input">
                    <label class="form-check-label" for="defaultCheck7Input">
                        อาทิตย์
                    </label>
                </div>
            </div>

            <div class="message-box row">
                <p>ข้อมูลเงื่อนไขส่วนลด</p>
                <div class="col-md-3">
                    <label for="startDistanceInput" class="form-label">ระยะทางเริ่มต้น</label>
                    <input type="number" class="form-control" id="startDistanceInput">
                </div>
                <div class="col-md-3">
                    <label for="endDistanceInput" class="form-label">ระยะทางสิ้นสุด</label>
                    <input type="number" class="form-control" id="endDistanceInput">
                </div>
                <div class="col-md-3">
                    <label for="couponType1Input" class="form-label">ประเภทคูปอง</label>
                    <select id="couponType1Input" class="form-select" aria-label="District">
                        <option selected> </option>
                        <option value="ส่วนลดครั้งแรก">ส่วนลดครั้งแรก</option>
                        <option value="ส่วนลดพิเศษ">ส่วนลดพิเศษ</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="couponTypeInput" class="form-label">ประเภทส่วนลด</label>
                    <select id="couponTypeInput" class="form-select" aria-label="District">
                        <option selected> </option>
                        <option value="ส่วนลดราคาทั้งหมด (ราคาอาหาร + ค่าจัดส่ง)">ส่วนลดราคาทั้งหมด (ราคาอาหาร + ค่าจัดส่ง)</option>
                        <option value="ส่วนลดค่าจัดส่ง">ส่วนลดค่าจัดส่ง</option>
                        <option value="ส่วนลดค่าบริการ">ส่วนลดค่าบริการ</option>
                        <option value="ส่วนลดราคาอาหาร">ส่วนลดราคาอาหาร</option>
                        <option value="ส่วนลดค่าจัดส่งแบบระบุระยะทาง">ส่วนลดค่าจัดส่งแบบระบุระยะทาง</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="couponNumberInput" class="form-label">จำนวนคูปอง</label>
                    <input type="number" class="form-control" id="couponNumberInput">
                </div>
                <div class="col-md-4">
                    <label for="valueTypeInput" class="form-label">ประเภทการระบุมูลค่าส่วนลด</label>
                    <select id="valueTypeInput" class="form-select" aria-label="District">
                        <option selected> </option>
                        <option value="ระบุมูลค่า (ปกติ)">ระบุมูลค่า (ปกติ)</option>
                        <option value="ระบุช่วงมูลค่า">ระบุช่วงมูลค่า</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="discountValueTypeInput" class="form-label">ประเภทการระบุมูลค่าส่วนลด</label>
                    <input id="discountValueTypeInput" class="form-control">
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="discountValueType1Input">
                            <label class="form-check-label" for="discountValueType1Input"> ราคาอาหาร </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="discountValueType2Input">
                            <label class="form-check-label" for="discountValueType2Input"> ค่าจัดส่ง </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="discountValueType3Input">
                            <label class="form-check-label" for="discountValueType3Input"> ค่าบริการ </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="minimumValueInput" class="form-label">มูลค่ารถเข็นขั้นต่ำ (ไม่จำเป็น) </label>
                    <input type="number" class="form-control" id="minimumValueInput">
                </div>
                <div class="col-md-2">
                    <label for="discount_valueInput" class="form-label">มูลค่าส่วนลด *</label>
                    <input type="number" class="form-control" id="discount_valueInput" required>
                </div>
                <div class="col-md-3">
                    <label for="discountTypeInput" class="form-label">ประเภทส่วนลด *</label>
                    <select id="discountTypeInput" class="form-select" aria-label="District" required>
                        <option selected> </option>
                        <option value="เปอร์เซ็น % ">เปอร์เซ็น % </option>
                        <option value="ลดตามราคาที่ระบุ">ลดตามราคาที่ระบุ </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="maximumDiscountInput" class="form-label">ส่วนลดสูงสุด (ไม่จำเป็น)</label>
                    <input type="text" class="form-control" id="maximumDiscountInput">
                </div>
                <div class="col-md-3">
                    <label for="repeatCouponsInput" class="form-label">ลูกค้าใช้คูปองซ้ำ *</label>
                    <select id="repeatCouponsInput" class="form-select" aria-label="District" required>
                        <option selected> </option>
                        <option value="ไม่ได้">ไม่ได้</option>
                        <option value="ได้">ได้</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="usage_statusInput" class="form-label">สถานะ *</label>
                    <select id="usage_statusInput" class="form-select" aria-label="District" required>
                        <option selected> </option>
                        <option value="เปิดใช้งาน">เปิดใช้งาน</option>
                        <option value="ปิดใช้งาน">ปิดใช้งาน</option>
                    </select>
                </div>
            </div>
            <div class="message-box row">
                <p>เลือกร้านที่ใช้ส่วนลด</p>
                <div class="col-md-4">
                    <label for="storeTypeInput" class="form-label">ประเภทร้านค้า</label>
                    <select id="storeTypeInput" class="form-select" aria-label="District">
                        <option selected> </option>
                        <option value="เลือกร้านเอง">เลือกร้านเอง</option>
                        <option value="เลือกประเภทร้าน">เลือกประเภทร้าน</option>
                        <option value="เลือกกลุ่มร้าน">เลือกกลุ่มร้าน</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="couponAutomaticInput">
                            <label class="form-check-label" for="couponAutomaticInput">ใช้คูปองอัตโนมัติ</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="storeInput" class="form-label">เลือกร้านค้า</label>
                    <input type="text" class="form-control" id="storeInput" name="store" required>
                </div>
            </div>
            <div class="message-box row">
                <p>เลือกลูกค้าที่ใช้ส่วนลด</p>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="customerInput">
                            <label class="form-check-label" for="customerInput">เลือกลูกค้า</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <a href="/frontend/public/home.php"><button class="btn btn-danger" type="button">ย้อนกลับ</button></a>
                <div class="d-flex gap-2 justify-content-center">
                    <button id="saveButton" class="btn btn-success" type="button" onclick="save_data()">บันทึก</button>

                </div>
            </div>

        </form>
    </div>
    <script>
        function save_data() {
            const county = document.getElementById('countyInput') ? document.getElementById('countyInput').value : null;
            const coupon_code = document.getElementById('coupon_codeInput') ? document.getElementById('coupon_codeInput').value : null;
            const couponType = document.getElementById('couponTypeInput') ? document.getElementById('couponTypeInput').value : null;
            const discount_value = document.getElementById('discount_valueInput') ? document.getElementById('discount_valueInput').value : null;
            const couponNumber = document.getElementById('couponNumberInput') ? document.getElementById('couponNumberInput').value : null;
            const creation_date = document.getElementById('creation_dateInput') ? document.getElementById('creation_dateInput').value : null;
            const expiration_date = document.getElementById('expiration_dateInput') ? document.getElementById('expiration_dateInput').value : null;
            const store = document.getElementById('storeInput') ? document.getElementById('storeInput').value : null;
            const usage_status = document.getElementById('usage_statusInput') ? document.getElementById('usage_statusInput').value : null;

            if (couponNumber == null || couponNumber <= 0) {
                // alert('กรุณากรอก จำนวนคูปอง !')
            }

            const body = {
                county: county,
                coupon_code: coupon_code,
                couponType: couponType,
                discount_value: discount_value,
                couponNumber: couponNumber,
                creation_date: creation_date,
                expiration_date: expiration_date,
                store: store,
                usage_status: usage_status,
            }

            console.log('body -> ', body)

            // ส่งข้อมูลไปยังไฟล์ save_data.php ที่อยู่ในฝั่ง backend
            fetch('./../../backend/save_data.php', {
                method: 'POST',
                headers: {
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                    'Content-Type': 'application/json',
                },
                // body: `county=${county}&coupon_code=${coupon_code}&couponType=${couponType}&discount_value=${discount_value}&couponNumber=${couponNumber}&creation_date=${creation_date}&expiration_date=${expiration_date}&store=${store}&usage_status=${usage_status}`,
                body: JSON.stringify(body),
            })
                .then(response => response.text())
                .then(data => {
                    data = JSON.parse(data)
                    console.log(data); // แสดงข้อความจาก backend

                    Swal.fire({
                        position: "top-end",
                        icon: data.status ? "success" : "error",
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(() => {
                        window.location.href = 'index.html';
                    }, 1500);

                    // หลังจากบันทึกเรียบร้อย ให้ redirect ไปยังหน้า home.php
                    // window.location.href = 'home.php';
                })
                .catch(error => {
                    console.error('เกิดข้อผิดพลาดในการส่งข้อมูล:', error)
                });
        }
        // Example of handling form submission using AJAX
        function submitForm() {
            var formData = new FormData(document.getElementById("myForm"));

            // Example using fetch API for asynchronous request
            fetch('http://localhost/coupon_web/backend/save_data.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data); // Show response from server
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>


</body>

</html>