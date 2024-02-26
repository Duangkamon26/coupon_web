<?php
require_once('connDB.php');

if (isset($_REQUEST['edit_id'])) {
    try {
        $id = $_REQUEST['edit_id'];
        $select_stmt = $db->prepare("SELECT * FROM couponadmin WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        // echo $countyInput;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

// กำหนดค่าให้กับตัวแปร
$creation_date_edit = date('Y-m-d');
$expiration_date_edit = date('Y-m-d', strtotime('+1 month'));
$startTime_edit = '00:00:00';
$endTime_edit = '23:59:59';
$startDistance_edit = isset($_POST['startDistance_edit']) ? $_POST['startDistance_edit'] : null;
$endDistance_edit = isset($_POST['endDistance_edit']) ? $_POST['endDistance_edit'] : null;
$couponNumber_edit = isset($_POST['couponNumber_edit']) ? $_POST['couponNumber_edit'] : null;
$minimumValue_edit = isset($_POST['minimumValue_edit']) ? $_POST['minimumValue_edit'] : null;
$discount_value_edit = isset($_POST['discount_value_edit']) ? $_POST['discount_value_edit'] : null;


// ตรวจสอบว่ามีการส่งค่ามาจากฟอร์ม
if (isset($_POST['submit'])) {
    $startTime_edit = $_POST['startTime_edit'];
    $endTime_edit = $_POST['endTime_edit'];
    $couponNumber_edit = $_POST['couponNumber_edit'];
    $minimumValue_edit = $_POST['minimumValue_edit'];
    $discount_value_edit = $_POST['discount_value_edit'];
}
// ตรวจสอบค่าที่ส่งมา
if (!isset($_POST['status_edit'])) {
    $status_edit = 0; // ปิดใช้งาน
  } else {
    $status_edit = 1; // เปิดใช้งาน
  }


// แปลงค่าให้เป็นรูปแบบที่ถูกต้อง
// $startTime_edit = DateTime::createFromFormat("H:i:s", $startTime_edit)->format("Y-m-d H:i:s");
// $endTime_edit = DateTime::createFromFormat("H:i:s", $endTime_edit)->format("Y-m-d H:i:s");
$startTime_edit = date('H:i:s', strtotime($startTime_edit));
$endTime_edit = date('H:i:s', strtotime($endTime_edit));

// ประมวลผลการแก้ไข
  if (empty($startTime_edit) || empty($endTime_edit) || empty($couponNumber_edit) || empty($minimumValue_edit) || empty($discount_value_edit)) {
    echo "<p>กรุณากรอกข้อมูลให้ครบถ้วน</p>";
  } else {
    // เตรียมคำสั่งอัปเดต
    $stmt = $conn->prepare("UPDATE coupons SET startTime = ?, endTime = ?, couponNumber = ?, minimumValue = ?, discount_value = ?, creation_date = ?, expiration_date = ? WHERE id = ?");

    // อัปเดตข้อมูลคูปอง
    $stmt->execute([
      $startTime_edit,
      $endTime_edit,
      $couponNumber_edit,
      $minimumValue_edit,
      $discount_value_edit,
      $creation_date_edit,
      $expiration_date_edit,
      $_GET['edit_id'],
    ]);

    // แสดงข้อความแจ้งเตือนและเปลี่ยนหน้าเว็บ
    if ($stmt->rowCount() > 0) {
      echo "<p>แก้ไขข้อมูลคูปองสำเร็จ</p>";
      echo "<script>window.location.href = 'coupons.php';</script>";
    } else {
      echo "<p>เกิดข้อผิดพลาด ไม่สามารถแก้ไขข้อมูลคูปองได้</p>";
    }
  }

// ตรวจสอบและแสดงข้อผิดพลาด
if (file_exists('error_log')) {
  echo "<p>ข้อผิดพลาด:</p>";
  echo "<pre>";
  echo file_get_contents('error_log');
  echo "</pre>";
}


// ประมวลผลการแก้ไข
if (isset($_REQUEST['btn_edit'])) {
    $errors = array();

    // ตรวจสอบข้อมูล
    $county_edit = $_REQUEST['select_countyInput'];
    if (empty($county_edit)) {
        $errors['county'] = "Please enter a county";
    }

    $coupon_code_edit = $_REQUEST['text_coupon_codeInput'];
    if (empty($coupon_code_edit)) {
        $errors['coupon_code'] = "Please enter a coupon code";
    }

    $couponType_edit = $_REQUEST['select_couponTypeInput'];
    if (empty($couponType_edit)) {
        $errors['couponType'] = "Please enter a couponType";
    }

    $discount_value_edit = $_REQUEST['number_discount_valueInput'];
    if (empty($discount_value_edit)) {
        $errors['discunt_value'] = "Please enter a discount_value";
    }

    $couponNumber_edit = $_REQUEST['number_couponNumberInput'];
    if (empty($couponNumber_edit)) {
        $errors['couponNumber'] = "Please enter a couponNumber";
    }

    $creation_date_edit = $_REQUEST['date_creation_dateInput'];
    if (empty($creation_date_edit)) {
        $errors['creation_date'] = "Please enter a creation_date";
    }

    $expiration_date_edit = $_REQUEST['date_expiration_dateInput'];
    if (empty($expiration_date_edit)) {
        $errors['expiration_date'] = "Please enter a expiration_date";
    }

    $store_edit = $_REQUEST['text_storeInput'];
    if (empty($store_edit)) {
        $errors['store'] = "Please enter a store_edit";
    }

    $usage_status_edit = $_REQUEST['select_usage_statusInput'];
    if (empty($usage_status_edit)) {
        $errors['usage_status'] = "Please enter a usage_status";
    }

    $displayType_edit = $_REQUEST['select_displayTypeInput'];
    if (empty($displayType_edit)) {
        $errors['displayType'] = "Please enter a displayType";
    }

    $details1_edit = $_REQUEST['text_details1Input'];
    if (empty($details1_edit)) {
        $errors['details1'] = "Please enter a details1";
    }

    $details2_edit = $_REQUEST['text_details2Input'];
    if (empty($details2_edit)) {
        $errors['details2'] = "Please enter a details2";
    }

    $formFile_edit = $_REQUEST['file_formFileInput'];
    if (empty($formFile_edit)) {
        $errors['formFile'] = "Please enter a formFile";
    }

    $startTime_edit = $_REQUEST['time_startTimeInput']; 
    if (empty($startTime_edit)) {
        $errors['startTime'] = "Please enter a startTime";
    }

    $endTime_edit = $_REQUEST['time_endTimeInput'];
    if (empty($endTime_edit)) {
        $errors['endTime'] = "Please enter a endTime";
    }

    $defaultCheck_edit = $_REQUEST['checkbox_defaultCheckInput'];
    if (empty($defaultCheck_edit)) {
        $errors['defaultCheck'] = "Please enter a defaultCheck";
    }

    $startDistance_edit = $_REQUEST['number_startDistanceInput'];
    if (empty($startDistance_edit)) {
        $errors['startDistance'] = "Please enter a startDistance";
    }

    $endDistance_edit = $_REQUEST['number_endDistanceInput'];
    if (empty($endDistance_edit)) {
        $errors['endDistance'] = "Please enter a endDistance";
    }

    $couponType1_edit = $_REQUEST['select_couponType1Input'];
    if (empty($couponType1_edit)) {
        $errors['couponType1'] = "Please enter a couponType1";
    }

    $valueType_edit = $_REQUEST['select_valueTypeInput'];
    if (empty($valueType_edit)) {
        $errors['valueType'] = "Please enter a valueType";
    }

    $discountValueType_edit = $_REQUEST['checkbox_discountValueTypeInput'];
    if (empty($discountValueType_edit)) {
        $errors['discountValueType'] = "Please enter a discountValueType";
    }

    $discountValueType1_edit = $_REQUEST['checkbox_discountValueType1Input'];
    if (empty($discountValueType1_edit)) {
        $errors['discountValueType1'] = "Please enter a discountValueType1";
    }

    $discountValueType2_edit = $_REQUEST['checkbox_discountValueType2Input'];
    if (empty($discountValueType2_edit)) {
        $errors['discountValueType2'] = "Please enter a discountValueType2";
    }

    $discountValueType3_edit = $_REQUEST['checkbox_discountValueType3Input'];
    if (empty($discountValueType3_edit)) {
        $errors['discountValueType3'] = "Please enter a discountValueType3";
    }

    $minimumValue_edit = $_REQUEST['number_minimumValueInput'];
    if (empty($minimumValue_edit)) {
        $errors['minimumValue'] = "Please enter a minimumValue";
    }

    $discountType_edit = $_REQUEST['number_discountTypeInput'];
    if (empty($discountType_edit)) {
        $errors['discountType'] = "Please enter a discountType";
    }

    $maximumDiscount_edit = $_REQUEST['text_maximumDiscountInput'];
    if (empty($maximumDiscount_edit)) {
        $errors['maximumDiscount'] = "Please enter a maximumDiscount";
    }

    $repeatCoupons_edit = $_REQUEST['select_repeatCouponsInput'];
    if (empty($repeatCoupons_edit)) {
        $errors['repeatCoupons'] = "Please enter a repeatCoupons";
    }

    $storeType_edit = $_REQUEST['select_storeTypeInput'];
    if (empty($storeType_edit)) {
        $errors['storeType'] = "Please enter a storeType";
    }

    $couponAutomatic_edit = $_REQUEST['checkbox_couponAutomaticInput'];
    if (empty($couponAutomatic_edit)) {
        $errors['couponAutomatic'] = "Please enter a couponAutomatic";
    }

    $customer_edit = $_REQUEST['checkbox_customerInput'];
    if (empty($customer_edit)) {
        $errors['customer'] = "Please enter a customer";
    }


    // อัปเดตข้อมูล
    if (count($errors) === 0) {
        $id = $_REQUEST['edit_id'];

        $edit_stmt = $db->prepare("UPDATE couponadmin SET ... WHERE id = :id");
        $edit_stmt->bindParam(':county_edit', $county_edit);
        $edit_stmt->bindParam(':coupon_code_edit', $coupon_code_edit);
        $edit_stmt->bindParam(':couponType_edit', $couponType_edit);
        $edit_stmt->bindParam(':discount_value_edit', $discount_value_edit);
        $edit_stmt->bindParam(':couponNumber_edit', $couponNumber_edit);
        $edit_stmt->bindParam(':creation_date_edit', $creation_date_edit);
        $edit_stmt->bindParam(':expiration_date_edit', $expiration_date_edit);
        $edit_stmt->bindParam(':store_edit', $store_edit);
        $edit_stmt->bindParam(':usage_status_edit', $usage_status_edit);
        $edit_stmt->bindParam(':displayType_edit', $displayType_edit);
        $edit_stmt->bindParam(':details1_edit', $details1_edit);
        $edit_stmt->bindParam(':details2_edit', $details2_edit);
        $edit_stmt->bindParam(':formFile_edit', $formFile_edit);
        $edit_stmt->bindParam(':startTime_edit', $startTime_edit);
        $edit_stmt->bindParam(':endTime_edit', $endTime_edit);
        $edit_stmt->bindParam(':defaultCheck_edit', $defaultCheck_edit);
        $edit_stmt->bindParam(':startDistance_edit', $startDistance_edit);
        $edit_stmt->bindParam(':endDistance_edit', $endDistance_edit);
        $edit_stmt->bindParam(':couponType1_edit', $couponType1_edit);
        $edit_stmt->bindParam(':valueType_edit', $valueType_edit);
        $edit_stmt->bindParam(':discountValueType_edit', $discountValueType_edit);
        $edit_stmt->bindParam(':discountValueType1_edit', $discountValueType1_edit);
        $edit_stmt->bindParam(':discountValueType2_edit', $discountValueType2_edit);
        $edit_stmt->bindParam(':discountValueType3_edit', $discountValueType3_edit);
        $edit_stmt->bindParam(':minimumValue_edit', $minimumValue_edit);
        $edit_stmt->bindParam(':discountTypee_edit', $discountType_edit);
        $edit_stmt->bindParam(':maximumDiscount_edit', $maximumDiscount_edit);
        $edit_stmt->bindParam(':repeatCoupons_edit', $repeatCoupons_edit);
        $edit_stmt->bindParam(':storeType_edit', $storeType_edit);
        $edit_stmt->bindParam(':couponAutomatic_edit', $couponAutomatic_edit);
        $edit_stmt->bindParam(':customer_edit', $customer_edit);
        $edit_stmt->bindParam(':id', $id);

        if ($edit_stmt->execute()) {
            $editMsg = "Record edit successfully...";
            header("refresh:2;home.php");
        } else {
            echo "Error updating record";
        }
    } else {
        // แสดงข้อผิดพลาด
        foreach ($errors as $key => $value) {
            echo "<p style='color:red'>" . $value . "</p>";
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
        <form class="row g-3" action="save_data.php" method="post">
            <div class="message-box row">
                <p>ข้อมูลส่วนลด</p>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="county_edit" class="form-label">อำเภอ/เมือง *</label>
                    </div>
                    <select class="form-select" id="county_edit" aria-label="District" value="<?php echo $county_edit; ?>" required>
                        <option selected> </option>
                        <option value="ทับสะแก">ทับสะแก</option>
                        <?php
                        // ตรวจสอบว่ามีข้อมูลในตัวแปร $countyInput หรือไม่
                        if (isset($county_edit)) {
                            // ใช้วงลูปเพื่อแสดงตัวเลือกของอำเภอ/เมือง
                            foreach ($county_edit as $county) {
                                echo "<option value='$county'>$county</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="displayType_edit" class="form-label">ประเภทการแสดง *</label>
                    </div>
                    <select id="displayType_edit" value="<?php echo $displayType_edit; ?>" class="form-select" type="select" aria-label="Display Type" required>
                        <option selected> </option>
                        <option value="แสดงหน้าใช้คูปอง">แสดงหน้าใช้คูปอง</option>
                        <option value="ค้นหา">ค้นหา</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="coupon_code_edit" class="form-label">Coupen Code *</label>
                    <!-- <input type="text" class="form-control" id="coupon_code_edit" value="<?php echo $coupon_code_edit; ?>" name="coupon_code_edit" required> -->
                    <input type="text" name="coupon_code_edit" id="coupon_code_edit" value="<?php echo $coupon_code_edit; ?>">
                </div>
                <div class="col-md-6">
                    <label for="details1_edit" class="form-label">รายละเอียดแบบสั้น *</label>
                    <input type="text" class="form-control" id="details1_edit" value="<?php echo $details1_edit; ?>" required>
                </div>
                <div class="col-12">
                    <label for="details2_edit" class="form-label">รายละเอียดแบบเต็ม *</label>
                    <input type="text" class="form-control" id="details2_edit" value="<?php echo $details2_edit; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="formFile_edit" class="form-label">รูปคูปอง</label>
                    <input class="form-control" type="file" id="formFile_edit" value="<?php echo $formFile_edit; ?>" required>
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
                    <label for="creation_date_edit" class="form-label">วันเริ่มต้น</label>
                    <input type="date" class="form-control" id="creation_date_edit" name="creation_date" value="<?php echo $creation_date_edit; ?>">
                </div>
                <div class="col-md-6 date-fields">
                    <label for="expiration_date_edit" class="form-label">วันหมดอายุ</label>
                    <input type="date" class="form-control" id="expiration_date_edit" name="expiration_date" value="<?php echo $expiration_date_edit; ?>">
                </div>
                <div class="col-md-6 date-fields">
                    <label for="startTime_edit" class="form-label">เวลาเริ่มต้น (เริ่มที่ 00:00)</label>
                    <input type="time" class="form-control" id="startTime_edit" name="startTime_edit" value="<?php echo $startTime_edit; ?>">
                </div>
                <div class="col-md-6 date-fields">
                    <label for="endTime_edit" class="form-label">เวลาสิ้นสุด (เริ่มที่ 23:59)</label>
                    <input type="time" class="form-control" id="endTime_edit" name="endTime_edit" value="<?php echo $endTime_edit; ?>">
                </div>
                <div class="col-md-6 day-fields">
                    <label for="creation_date1_edit" class="form-label">วันเริ่มต้น</label>
                    <input type="date" class="form-control" id="creation_date1_edit" name="creation_date1_edit">
                </div>
                <div class="col-md-6 day-fields">
                    <label for="expiration_date1_edit" class="form-label">วันหมดอายุ</label>
                    <input type="date" class="form-control" id="expiration_date1_edit" name="expiration_date1_edit">
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1_edit">
                    <label class="form-check-label" for="defaultCheck1_edit">
                        จันทร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2_edit">
                    <label class="form-check-label" for="defaultCheck2_edit">
                        อังคาร
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck3_edit">
                    <label class="form-check-label" for="defaultCheck3_edit">
                        พุธ
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck4_edit">
                    <label class="form-check-label" for="defaultCheck4_edit">
                        พฤหัสบดี
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck5_edit">
                    <label class="form-check-label" for="defaultCheck5_edit">
                        ศุกร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck6_edit">
                    <label class="form-check-label" for="defaultCheck6_edit">
                        เสาร์
                    </label>
                </div>
                <div class="form-check day-fields">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck7_edit">
                    <label class="form-check-label" for="defaultCheck7_edit">
                        อาทิตย์
                    </label>
                </div>
            </div>

            <div class="message-box row">
                <p>ข้อมูลเงื่อนไขส่วนลด</p>
                <div class="col-md-3">
                    <label for="startDistance_edit" class="form-label">ระยะทางเริ่มต้น</label>
                    <input type="number" class="form-control" id="startDistance_edit" value="<?php echo $startDistance_edit; ?>">
                </div>
                <div class="col-md-3">
                    <label for="endDistance_edit" class="form-label">ระยะทางสิ้นสุด</label>
                    <input type="number" class="form-control" id="endDistance_edit" value="<?php echo $endDistance_edit; ?>">
                </div>
                <div class="col-md-3">
                    <label for="couponType1_edit" class="form-label">ประเภทคูปอง</label>
                    <select id="couponType1_edit" class="form-select" aria-label="District" value="<?php echo $couponType1_edit; ?>">
                        <option selected> </option>
                        <option value="ส่วนลดครั้งแรก">ส่วนลดครั้งแรก</option>
                        <option value="ส่วนลดพิเศษ">ส่วนลดพิเศษ</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="couponType_edit" class="form-label">ประเภทส่วนลด</label>
                    <select id="couponType_edit" class="form-select" aria-label="District" value="<?php echo $couponType_edit; ?>">
                        <option selected> </option>
                        <option value="ส่วนลดราคาทั้งหมด (ราคาอาหาร + ค่าจัดส่ง)">ส่วนลดราคาทั้งหมด (ราคาอาหาร + ค่าจัดส่ง)</option>
                        <option value="ส่วนลดค่าจัดส่ง">ส่วนลดค่าจัดส่ง</option>
                        <option value="ส่วนลดค่าบริการ">ส่วนลดค่าบริการ</option>
                        <option value="ส่วนลดราคาอาหาร">ส่วนลดราคาอาหาร</option>
                        <option value="ส่วนลดค่าจัดส่งแบบระบุระยะทาง">ส่วนลดค่าจัดส่งแบบระบุระยะทาง</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="couponNumber_edit" class="form-label">จำนวนคูปอง</label>
                    <input type="number" class="form-control" id="couponNumber_edit" value="<?php echo $couponNumber_edit; ?>">
                </div>
                <div class="col-md-4">
                    <label for="valueType_edit" class="form-label">ประเภทการระบุมูลค่าส่วนลด</label>
                    <select id="valueType_edit" class="form-select" aria-label="District" value="<?php echo $valueType_edit; ?>">
                        <option selected> </option>
                        <option value="ระบุมูลค่า (ปกติ)">ระบุมูลค่า (ปกติ)</option>
                        <option value="ระบุช่วงมูลค่า">ระบุช่วงมูลค่า</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="discountValueType_edit" class="form-label">ประเภทการระบุมูลค่าส่วนลด</label>
                    <input id="discountValueType_edit" class="form-control" value="<?php echo $discountValueType_edit; ?>">
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="discountValueType1_edit" value="<?php echo $discountValueType1_edit; ?>">
                            <label class="form-check-label" for="discountValueType1_edit"> ราคาอาหาร </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="discountValueType2_edit" value="<?php echo $discountValueType2_edit; ?>">
                            <label class="form-check-label" for="discountValueType2_edit"> ค่าจัดส่ง </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="discountValueType3_edit" value="<?php echo $discountValueType3_edit; ?>">
                            <label class="form-check-label" for="discountValueType3_edit"> ค่าบริการ </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="minimumValue_edit" class="form-label">มูลค่ารถเข็นขั้นต่ำ (ไม่จำเป็น) </label>
                    <input type="number" class="form-control" id="minimumValue_edit" value="<?php echo $minimumValue_edit; ?>">
                </div>
                <div class="col-md-2">
                    <label for="discount_value_edit" class="form-label">มูลค่าส่วนลด *</label>
                    <input type="number" class="form-control" id="discount_value_edit" value="<?php echo $discount_value_edit; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="discountType_edit" class="form-label">ประเภทส่วนลด *</label>
                    <select id="discountType_edit" class="form-select" aria-label="District" value="<?php echo $discountType_edit; ?>" required>
                        <option selected> </option>
                        <option value="เปอร์เซ็น % ">เปอร์เซ็น % </option>
                        <option value="ลดตามราคาที่ระบุ">ลดตามราคาที่ระบุ </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="maximumDiscount_edit" class="form-label">ส่วนลดสูงสุด (ไม่จำเป็น)</label>
                    <input type="text" class="form-control" id="maximumDiscount_edit" value="<?php echo $maximumDiscount_edit; ?>">
                </div>
                <div class="col-md-3">
                    <label for="repeatCoupons_edit" class="form-label">ลูกค้าใช้คูปองซ้ำ *</label>
                    <select id="repeatCoupons_edit" class="form-select" aria-label="District" value="<?php echo $repeatCoupons_edit; ?>" required>
                        <option selected> </option>
                        <option value="ไม่ได้">ไม่ได้</option>
                        <option value="ได้">ได้</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="usage_status_edit" class="form-label">สถานะ *</label>
                    <!-- <br />
                        <input type="checkbox" name="usage_status_edit" id="usage_status_edit" <?php if ($coupon['usage_status'] == 1) { echo "checked"; } ?>>
                    <br /> -->
                    <select id="usage_status_edit" class="form-select" aria-label="District" required>
                        <option selected> </option>
                        <option value="เปิดใช้งาน">เปิดใช้งาน</option>
                        <option value="ปิดใช้งาน">ปิดใช้งาน</option>
                    </select>
                </div>
            </div>
            <div class="message-box row">
                <p>เลือกร้านที่ใช้ส่วนลด</p>
                <div class="col-md-4">
                    <label for="storeType_edit" class="form-label">ประเภทร้านค้า</label>
                    <select id="storeType_edit" class="form-select" aria-label="District" value="<?php echo $storeType_edit; ?>">
                        <option selected> </option>
                        <option value="เลือกร้านเอง">เลือกร้านเอง</option>
                        <option value="เลือกประเภทร้าน">เลือกประเภทร้าน</option>
                        <option value="เลือกกลุ่มร้าน">เลือกกลุ่มร้าน</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="couponAutomatic_edit" value="<?php echo $couponAutomatic_edit; ?>">
                            <label class="form-check-label" for="couponAutomatic_edit">ใช้คูปองอัตโนมัติ</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="store_edit" class="form-label">เลือกร้านค้า</label>
                    <input type="text" class="form-control" id="store_edit" name="store" value="<?php echo $store_edit; ?>" required>
                </div>
            </div>
            <div class="message-box row">
                <p>เลือกลูกค้าที่ใช้ส่วนลด</p>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="customer_edit" <?php echo $customer_edit ? 'checked="checked"' : ''; ?>>
                            <label class="form-check-label" for="customer_edit">เลือกลูกค้า</label>
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
            const discountValueType = document.getElementById('discountValueTypeInput') ? document.getElementById('discountValueTypeInput').value : null;
            const discountValueType1 = document.getElementById('discountValueType1Input') ? document.getElementById('discountValueType1Input').value : null;
            const discountValueType2 = document.getElementById('discountValueType2Input') ? document.getElementById('discountValueType2Input').value : null;
            const discountValueType3 = document.getElementById('discountValueType3Input') ? document.getElementById('discountValueType3Input').value : null;
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
                discountValueType: discountValueType,
                discountValueType1: discountValueType1,
                discountValueType2: discountValueType2,
                discountValueType3: discountValueType3,
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
    </script>
</body>

</html>