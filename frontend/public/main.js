
async function fetchDataAndDisplay() {
    try {
        const response = await fetch('http://localhost:8000/backend/display_data.php');
        const data = await response.text();
        console.log(data);  // แสดงข้อมูลที่ได้รับใน Console
        document.getElementById('data-container').innerHTML = data;
        displayDataInTable(data);  // ลองแสดงข้อมูลที่ได้ในตาราง
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// ในไฟล์ main.js ทำการเรียกใช้ fetchDataAndDisplay ที่ตอนท้ายไฟล์
document.addEventListener('DOMContentLoaded', function() {
    fetchDataAndDisplay();
});


function fetchDataAndDisplay() {
    var element = document.getElementById('nonExistentElement');

    // ตรวจสอบว่า element มีอยู่จริงก่อนที่จะทำอย่างอื่น
    if (element) {
        element.innerHTML = 'Some content';
    } else {
        console.error('Element not found.');
    }
}


// document.addEventListener('DOMContentLoaded', function() {
//     fetchDataAndDisplay();
//   });
  
//   async function fetchDataAndDisplay() {
//     try {
//       const response = await fetch('http://localhost:8000/backend/display_data.php');
//       const data = await response.json();
  
//       // Get the table body element
//       const tableBody = document.querySelector('table tbody');
  
//       // Check if the table body element exists
//       if (tableBody) {
//         // Clear existing content
//         tableBody.innerHTML = '';
  
//         // Call the function to display data in the table
//         displayDataInTable(data, tableBody);
//       } else {
//         console.error('Table body element not found.');
//       }
//     } catch (error) {
//       console.error('Error fetching data:', error);
//     }
//   }
  
//   // Function to display data in the table
//   function displayDataInTable(data, tableBody) {
//     // Check if data is an array and not empty
//     if (Array.isArray(data) && data.length > 0) {
//       // Loop through the data and create table rows
//       data.forEach(row => {
//         const tableRow = document.createElement('tr');
//         tableRow.innerHTML = `
//           <td>${row.id}</td>
//           <td>${row.county}</td>
//           <td>${row.coupon_code}</td>
//           <td>${row.couponType}</td>
//           <td>${row.discount_value}</td>
//           <td>${row.couponNumber}</td>
//           <td>${row.creation_date}</td>
//           <td>${row.expiration_date}</td>
//           <td>${row.store}</td>
//           <td>${row.usage_status}</td>
//         `;
  
//         // Append the table row to the table body
//         tableBody.appendChild(tableRow);
//       });
//     } else {
//       // If no data or data is not an array
//       const noDataRow = document.createElement('tr');
//       noDataRow.innerHTML = '<td colspan="10">No data found.</td>';
//       tableBody.appendChild(noDataRow);
//     }
//   }
  

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
    fetch('http://localhost:8000/backend/save_data.php', {
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

document.addEventListener('DOMContentLoaded', function() {
    // ตัวอย่างการเชื่อมโยงฟังก์ชัน saveDataToBackend กับปุ่มที่มี id เป็น 'saveButton'
    var saveButton = document.getElementById('saveButton');
    if (saveButton) {
      saveButton.addEventListener('click', saveDataToBackend);
    }
  });


function saveDataToBackend() {
    // รับค่าจากฟอร์มหรือทำอย่างอื่นตามที่ต้องการ
    var county = document.getElementById('countyInput').value;
    var coupon_code = document.getElementById('coupon_codeInput').value;
    var couponType = document.getElementById('couponTypeInput').value;
    var discount_value = document.getElementById('discount_valueInput').value;
    var couponNumber = document.getElementById('couponNumberInput').value;
    var creation_date = document.getElementById('creation_dateInput').value;
    var expiration_date = document.getElementById('expiration_dateInput').value;
    var store = document.getElementById('storeInput').value;
    var usage_status = document.getElementById('usage_statusInput').value;
    

    // สร้าง object ที่มีข้อมูลที่ต้องการส่งไปที่ backend
    var data = {
        county: county,
        coupon_code: coupon_code,
        couponType: couponType,
        discount_value: discount_value,
        couponNumber: couponNumber,
        creation_date: creation_date,
        expiration_date: expiration_date,
        store: store,
        usage_status: usage_status

    };

    // ทำการ fetch หรือใช้ AJAX library เพื่อส่งข้อมูลไปที่ backend
    fetch('http://localhost:8000/backend/save_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        // ทำอะไรก็ตามที่ต้องการเมื่อบันทึกข้อมูลเสร็จสมบูรณ์
        console.log(result);
    })
    .catch(error => {
        // ทำอะไรก็ตามที่ต้องการเมื่อเกิดข้อผิดพลาด
        console.error('Error saving data:', error);
    });
}
