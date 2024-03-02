
// async function fetchDataAndDisplay() {
//     try {
//         const response = await fetch('http://localhost:8000/backend/display_data.php');
//         const responseData = await response.text();
//     console.log('Response Data:', responseData);  // แสดงข้อมูลที่ได้รับ

//     // ต่อไปนี้: ลองแปลง responseData เป็น JSON
//     const data = JSON.parse(responseData);
//     console.log('Parsed Data:', data);

//     // ... ส่วนอื่น ๆ ของโค้ด
//   } catch (error) {
//     console.error('Error fetching data:', error);
//   }
// }

var someElement = document.getElementById('someElementId');
console.log(someElement); // ดูค่าที่ console

// document.addEventListener("DOMContentLoaded", function() {
//     var buttonStatus = localStorage.getItem('buttonStatus');
//     if (buttonStatus === 'closed') {
//         var button = document.getElementById('myButton');
//         button.classList.remove('btn-success');
//         button.classList.add('btn-danger');
//         button.textContent = 'ปิดใช้งาน';
//     }
// });

// ฟังก์ชันยืนยันการส่งข้อมูล
function confirmSubmission() {
    var isConfirmed = confirm("Do you want to submit the data?");

    if (isConfirmed) {
        alert("Data submitted successfully!");
    } else {
        alert("Data submission canceled.");
    }
}


// ฟังก์ชันสำหรับการส่งฟอร์ม
function submitForm() {
    var formData = new FormData(document.getElementById("myForm"));

    // ตัวอย่างการใช้ fetch API สำหรับคำขอที่ไม่ซิงโครนัส
    fetch('http://localhost/backend/save_data.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            alert(data); // แสดงข้อความจากเซิร์ฟเวอร์
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.addEventListener('DOMContentLoaded', function () {
    var saveButton = document.getElementById('saveButton');
    if (saveButton) {
        saveButton.addEventListener('click', function (event) {
            event.preventDefault();
            saveDataToBackend();
        });
    } else {
        throw new Error('Element with ID "saveButton" not found.');
    }
});

function saveDataToBackend() {
    // รับค่าจากฟอร์มหรือทำอย่างอื่นตามที่ต้องการ
    var county = document.getElementById('countyInput');
    var coupon_code = document.getElementById('coupon_codeInput');
    var couponType = document.getElementById('couponTypeInput');
    var discount_value = document.getElementById('discount_valueInput');
    var couponNumber = document.getElementById('couponNumberInput');
    var creation_date = document.getElementById('creation_dateInput');
    var expiration_date = document.getElementById('expiration_dateInput');
    var creation_date1 = document.getElementById('creation_date1Input');
    var expiration_date1 = document.getElementById('expiration_date1Input');
    var store = document.getElementById('storeInput');
    var usage_status = document.getElementById('usage_statusInput');
    var displayType = document.getElementById('displayTypeInput');
    var details1 = document.getElementById('details1Input');
    var details2 = document.getElementById('details2Input');
    var formFile = document.getElementById('formFileInput');
    var startTime = document.getElementById('startTimeInput');
    var endTime = document.getElementById('endTimeInput');
    var defaultCheck = document.getElementById('defaultCheckInput');
    var startDistance = document.getElementById('startDistanceInput');
    var endDistance = document.getElementById('endDistanceInput');
    var couponType1 = document.getElementById('couponType1Input');
    var valueType = document.getElementById('valueTypeInput');
    var calculateDiscount1 = document.getElementById('calculateDiscount1Input');
    var calculateDiscount2 = document.getElementById('calculateDiscount2Input');
    var calculateDiscount3 = document.getElementById('calculateDiscount3Input');
    var minimumValue = document.getElementById('minimumValueInput');
    var discountType = document.getElementById('discountTypeInput');
    var maximumDiscount = document.getElementById('maximumDiscountInput');
    var repeatCoupons = document.getElementById('repeatCouponsInput');
    var storeType = document.getElementById('storeTypeInput');
    var couponAutomatic = document.getElementById('couponAutomaticInput');
    var customer = document.getElementById('customerInput');

    // สร้าง object ที่มีข้อมูลที่ต้องการส่งไปที่ backend
    var data = {
        county: county ? county.value : '',
        coupon_code: coupon_code ? coupon_code.value : '',
        couponType: couponType ? couponType.value : '',
        discount_value: discount_value ? discount_value.value : '',
        couponNumber: couponNumber ? couponNumber.value : '',
        creation_date: creation_date ? creation_date.value : '',
        expiration_date: expiration_date ? expiration_date.value : '',
        creation_date1: creation_date1 ? creation_date1.value : '',
        expiration_date1: expiration_date1 ? expiration_date1.value : '',
        store: store ? store.value : '',
        usage_status: usage_status ? usage_status.value : '',
        displayType: displayType ? displayType.value : '',
        details1: details1 ? details1.value : '',
        details2: details2 ? details2.value : '',
        formFile: formFile ? formFile.value : '',
        startTime: startTime ? startTime.value : '',
        endTime: endTime ? endTime.value : '',
        defaultCheck: defaultCheck ? defaultCheck.value : '',
        startDistance: startDistance ? startDistance.value : '',
        endDistance: endDistance ? endDistance.value : '',
        couponType1: couponType1 ? couponType1.value : '',
        valueType: valueType ? valueType.value : '',
        calculateDiscount1: calculateDiscount1 ? calculateDiscount1.value : '',
        calculateDiscount2: calculateDiscount2 ? calculateDiscount2.value : '',
        calculateDiscount3: calculateDiscount3 ? calculateDiscount3.value : '',
        minimumValue: minimumValue ? minimumValue.value : '',
        discountType: discountType ? discountType.value : '',
        maximumDiscount: maximumDiscount ? maximumDiscount.value : '',
        repeatCoupons: repeatCoupons ? repeatCoupons.value : '',
        storeType: storeType ? storeType.value : '',
        couponAutomatic: couponAutomatic ? couponAutomatic.value : '',
        customer: customer ? customer.value : '',

    };

}

