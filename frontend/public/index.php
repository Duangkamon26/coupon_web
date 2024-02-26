<?php require_once('env.php')?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Itim&display=swap">
    <title>Coupon Website</title>
    <script defer src="main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        // เมื่อมีการเปลี่ยนค่าใน radio buttons
        function handleRadioChange() {
            var selectedValue = document.querySelector('input[name="inlineRadioOptions"]:checked').value;
            var dateFields = document.querySelectorAll('.date-fields');
            var dayFields = document.querySelectorAll('.day-fields');

            // ซ่อนทุก field ของวันที่
            dateFields.forEach(function(dateField) {
                dateField.style.display = 'none';
            });

            // ซ่อนทุก field ของวัน
            dayFields.forEach(function(dayField) {
                dayField.style.display = 'none';
            });

            // แสดง field ตามที่ถูกเลือก
            if (selectedValue === 'option1') {
                dateFields.forEach(function(dateField) {
                    dateField.style.display = 'block';
                });
            } else if (selectedValue === 'option2') {
                dayFields.forEach(function(dayField) {
                    dayField.style.display = 'block';
                });
            }
        }
    </script>
</head>

<body>
    <div class="menu-wrapper _fixed menu_translatex_0_first">
        <a href="#" class="logo">
            <img class="logo-img" style="width: 88px; height: 88px;" src="https://one-thailand.com/assets/img/logoback.png?lastmod=1700105349" onerror="this.src='https:/placehold.co/50x50?text=no image';">
        </a>

        <!-- เพิ่มเมนูตรงนี้ -->
        <a href="home.php">Home</a>
    </div>

    <div class="content">
        <!-- เนื้อหาหลักของเว็บไซต์ -->
        <form class="row g-3" id="myForm">
            <div class="message-box row">
                <p>ข้อมูลส่วนลด</p>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="countyInput" class="form-label">อำเภอ/เมือง *</label>
                    </div>
                    <select class="form-select" id="countyInput" aria-label="District" required>
                        <option selected> </option>
                        <option value="ทับสะแก">ทับสะแก</option>
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
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" onchange="handleRadioChange()">
                        <label class="form-check-label" for="inlineRadio1">เลือกวันที่</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" onchange="handleRadioChange()">
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
                    <input class="form-check-input" type="checkbox" value="จันทร์" id="defaultCheckInput">
                    <label class="form-check-label" for="defaultCheckInput">
                        จันทร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="อังคาร" id="defaultCheck2Input">
                    <label class="form-check-label" for="defaultCheck2Input">
                        อังคาร
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="พุธ" id="defaultCheck3Input">
                    <label class="form-check-label" for="defaultCheck3Input">
                        พุธ
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="พฤหัสบดี" id="defaultCheck4Input">
                    <label class="form-check-label" for="defaultCheck4Input">
                        พฤหัสบดี
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="ศุกร์" id="defaultCheck5Input">
                    <label class="form-check-label" for="defaultCheck5Input">
                        ศุกร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="เสาร์" id="defaultCheck6Input">
                    <label class="form-check-label" for="defaultCheck6Input">
                        เสาร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="อาทิตย์" id="defaultCheck7Input">
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
                    <select id="couponType1Input" type="select" class="form-select" aria-label="District">
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
                    <select id="valueTypeInput" type="select" class="form-select" aria-label="District">
                        <option selected> </option>
                        <option value="ระบุมูลค่า (ปกติ)">ระบุมูลค่า (ปกติ)</option>
                        <option value="ระบุช่วงมูลค่า">ระบุช่วงมูลค่า</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">คำนวณส่วนลดจาก</label>
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="ราคาอาหาร" id="calculateDiscount1Input">
                            <label class="form-check-label" for="calculateDiscount1Input"> ราคาอาหาร </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="ค่าจัดส่ง" id="calculateDiscount2Input">
                            <label class="form-check-label" for="calculateDiscount2Input"> ค่าจัดส่ง </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="ค่าบริการ" id="calculateDiscount3Input">
                            <label class="form-check-label" for="calculateDiscount3Input"> ค่าบริการ </label>
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
                    <select id="discountTypeInput" type="select" class="form-select" aria-label="District" required>
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
                    <select id="repeatCouponsInput" type="select" class="form-select" aria-label="District" required>
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
                    <select id="storeTypeInput" type="select" class="form-select" aria-label="District">
                        <option selected> </option>
                        <option value="เลือกร้านเอง">เลือกร้านเอง</option>
                        <option value="เลือกประเภทร้าน">เลือกประเภทร้าน</option>
                        <option value="เลือกกลุ่มร้าน">เลือกกลุ่มร้าน</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="ใช้คูปองอัตโนมัติ" id="couponAutomaticInput">
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
                            <input class="form-check-input" type="checkbox" value="เลือกลูกค้า" id="customerInput">
                            <label class="form-check-label" for="customerInput">เลือกลูกค้า</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <a href="home.php"><button class="btn btn-danger" type="button">ย้อนกลับ</button></a>
                <div class="d-flex gap-2 justify-content-center">
                    <button id="saveButton" class="btn btn-success" type="button" onclick="save_data()">บันทึก</button>

                </div>
            </div>

        </form>
    </div>


    <script src="main.js"></script>
    <script>
        var idEdit = null;
        $(document).ready(function() {
            console.log('getUrlVars() -> ', getUrlVars())
            const queryParam = getUrlVars();

            if (queryParam['id'] != undefined && +queryParam['id'] != 0) {
                idEdit = +queryParam['id'];
                getDataById()
                console.log('idEdit -> ', idEdit)
            }
        });

        function getDataById() {
            fetch(`../../backend/getDataById.php?id=${idEdit}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
                .then(response => response.text())
                .then(data => {
                    data = JSON.parse(data)
                    data = data.data;
                    console.log(data); // แสดงข้อความจาก backend

                    $("#countyInput").val(data.county)
                    $("#displayTypeInput").val(data.displayType)
                    $("#coupon_codeInput").val(data.coupon_code)
                    $("#couponTypeInput").val(data.couponType)
                    $("#discount_valueInput").val(data.discount_value)
                    $("#couponNumberInput").val(data.couponNumber)
                    $("#creation_dateInput").val(data.creation_date)
                    $("#expiration_dateInput").val(data.expiration_date)
                    $("#storeInput").val(data.store)
                    $("#usage_statusInput").val(data.usage_status)
                    $("#details1Input").val(data.details1)
                    $("#details2Input").val(data.details2)
                    $("#formFileInput").val(data.formFile)
                    $("#creation_date1Input").val(data.creation_date1)
                    $("#expiration_date1Input").val(data.expiration_date1)
                    $("#startTimeInput").val(data.startTime)
                    $("#endTimeInput").val(data.endTime)
                    $("#defaultCheckInput").val(data.defaultCheck)
                    $("#startDistanceInput").val(data.startDistance)
                    $("#endDistanceInput").val(data.endDistance)
                    $("#couponType1Input").val(data.couponType1)
                    $("#valueTypeInput").val(data.valueType)
                    $("#calculateDiscount1Input").val(data.calculateDiscount1)
                    $("#calculateDiscount2Input").val(data.calculateDiscount2)
                    $("#calculateDiscount3Input").val(data.calculateDiscount3)
                    $("#minimumValueInput").val(data.minimumValue)
                    $("#discountTypeInput").val(data.discountType)
                    $("#maximumDiscountInput").val(data.maximumDiscount)
                    $("#repeatCouponsInput").val(data.repeatCoupons)
                    $("#storeTypeInput").val(data.storeType)
                    $("#couponAutomaticInput").val(data.couponAutomatic)
                    $("#customerInput").val(data.customer)

                })
                .catch(error => {
                    console.error('เกิดข้อผิดพลาดในการส่งข้อมูล:', error)
                });
        }

        function save_data() {
            const county = document.getElementById('countyInput') ? document.getElementById('countyInput').value : null;
            const coupon_code = document.getElementById('coupon_codeInput') ? document.getElementById('coupon_codeInput').value : null;
            const couponType = document.getElementById('couponTypeInput') ? document.getElementById('couponTypeInput').value : null;
            const discount_value = document.getElementById('discount_valueInput') ? document.getElementById('discount_valueInput').value : null;
            const couponNumber = document.getElementById('couponNumberInput') ? document.getElementById('couponNumberInput').value : null;
            const creation_date = document.getElementById('creation_dateInput') ? document.getElementById('creation_dateInput').value : null;
            const expiration_date = document.getElementById('expiration_dateInput') ? document.getElementById('expiration_dateInput').value : null;
            const creation_date1 = document.getElementById('creation_date1Input') ? document.getElementById('creation_date1Input').value : null;
            const expiration_date1 = document.getElementById('expiration_date1Input') ? document.getElementById('expiration_date1Input').value : null;
            const store = document.getElementById('storeInput') ? document.getElementById('storeInput').value : null;
            const usage_status = document.getElementById('usage_statusInput') ? document.getElementById('usage_statusInput').value : null;
            const displayType = document.getElementById('displayTypeInput') ? document.getElementById('displayTypeInput').value : null;
            const details1 = document.getElementById('details1Input') ? document.getElementById('details1Input').value : null;
            const details2 = document.getElementById('details2Input') ? document.getElementById('details2Input').value : null;
            const formFile = document.getElementById('formFileInput') ? document.getElementById('formFileInput').value : null;
            const startTime = document.getElementById('startTimeInput') ? document.getElementById('startTimeInput').value : null;
            const endTime = document.getElementById('endTimeInput') ? document.getElementById('endTimeInput').value : null;
            const defaultCheck = document.getElementById('defaultCheckInput') ? document.getElementById('defaultCheckInput').value : null;
            const startDistance = document.getElementById('startDistanceInput') ? document.getElementById('startDistanceInput').value : null;
            const endDistance = document.getElementById('endDistanceInput') ? document.getElementById('endDistanceInput').value : null;
            const couponType1 = document.getElementById('couponType1Input') ? document.getElementById('couponType1Input').value : null;
            const valueType = document.getElementById('valueTypeInput') ? document.getElementById('valueTypeInput').value : null;
            const calculateDiscount1 = document.getElementById('calculateDiscount1Input') ? document.getElementById('calculateDiscount1Input').value : null;
            const calculateDiscount2 = document.getElementById('calculateDiscount2Input') ? document.getElementById('calculateDiscount2Input').value : null;
            const calculateDiscount3 = document.getElementById('calculateDiscount3Input') ? document.getElementById('calculateDiscount3Input').value : null;
            const minimumValue = document.getElementById('minimumValueInput') ? document.getElementById('minimumValueInput').value : null;
            const discountType = document.getElementById('discountTypeInput') ? document.getElementById('discountTypeInput').value : null;
            const maximumDiscount = document.getElementById('maximumDiscountInput') ? document.getElementById('maximumDiscountInput').value : null;
            const repeatCoupons = document.getElementById('repeatCouponsInput') ? document.getElementById('repeatCouponsInput').value : null;
            const storeType = document.getElementById('storeTypeInput') ? document.getElementById('storeTypeInput').value : null;
            const couponAutomatic = document.getElementById('couponAutomaticInput') ? document.getElementById('couponAutomaticInput').value : null;
            const customer = document.getElementById('customerInput') ? document.getElementById('customerInput').value : null;

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
                creation_date1: creation_date1,
                expiration_date1: expiration_date1,
                store: store,
                usage_status: usage_status,
                displayType: displayType,
                details1: details1,
                details2: details2,
                formFile: formFile,
                startTime: startTime,
                endTime: endTime,
                defaultCheck: defaultCheck,
                startDistance: startDistance,
                endDistance: endDistance,
                couponType1: couponType1,
                valueType: valueType,
                calculateDiscount1: calculateDiscount1,
                calculateDiscount2: calculateDiscount2,
                calculateDiscount3: calculateDiscount3,
                minimumValue: minimumValue,
                discountType: discountType,
                maximumDiscount: maximumDiscount,
                repeatCoupons: repeatCoupons,
                storeType: storeType,
                couponAutomatic: couponAutomatic,
                customer: customer,
            }

            console.log('body -> ', body)

            // ส่งข้อมูลไปยังไฟล์ save_data.php ที่อยู่ในฝั่ง backend
            fetch('<?php echo $_DOMAIN; ?>/backend/save_data.php', {
                    method: 'POST',
                    headers: {
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                        'Content-Type': 'application/json',
                    },
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
                        window.location.href = 'index.php';
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
            fetch('<?php echo $_DOMAIN; ?>/backend/save_data.php', {
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

        function getUrlVars() {
            var vars = [],
                hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
    </script>

</body>

</html>