<?php 
require_once 'connection.php';

session_start();
$username = $_SESSION['username'];
$fdate = $_SESSION['fdate'];
$ldate = $_SESSION['ldate'];
$quantityRoom = $_SESSION['quantityRoom'];
$quantityAdults = $_SESSION['quantityAdults'];
$hotelid = $_SESSION['hotel_id'];
$roomtype_id = $_SESSION['roomtype_id'];
$totalPrice = $_SESSION['totalPrice'];
$days_dif = $_SESSION['days_dif'];



$sqlcustomerid = "SELECT customer_id FROM customer WHERE customer_email='$username'";
$resultcustomerid = $conn->query($sqlcustomerid);
$roww = $resultcustomerid->fetch_assoc();

$bid = "SELECT MAX(booking_id) AS currentbid FROM booking";
$connbid = $conn->query($bid);
$currentbid = mysqli_fetch_assoc($connbid);
$nextbid = $currentbid["currentbid"]+1;
$_SESSION['nextbid'] = $nextbid;


$room_search = "SELECT room.room_id
        FROM room
        WHERE room.hotel_id = '$hotelid'
        AND room.roomtype_id = '$roomtype_id'
        AND NOT EXISTS (
            SELECT 1
            FROM booking
            WHERE booking.room_id = room.room_id
            AND check_in_time <= '$ldate'
            AND check_out_time >= '$fdate'
            AND booking_status = '1'
        )";

$result = mysqli_query($conn, $room_search);

if ($result) {
    $roomIds = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $roomIds[] = $row['room_id'];

    }

// ตรวจสอบว่ามีห้องพร้อมใช้พอจำนวนที่คุณต้องการจองหรือไม่
if (count($roomIds) >= $quantityRoom) {
    for ($i = 0; $i < $quantityRoom; $i++) {
        // เลือกหมายเลขห้องอันดับแรกจากรายการ
        $selectedRoomId = array_shift($roomIds);



        // สร้างคำสั่ง SQL สำหรับการเพิ่มข้อมูลการจองลงในฐานข้อมูล
        // เราใช้ค่า booking_id ที่มีค่าเริ่มต้นตลอดการจอง

        $booking = "INSERT INTO booking (check_in_time, check_out_time, booking_status, hotel_id, customer_id, room_id, booking_id)
                VALUES ('$fdate', '$ldate', 0, '$hotelid', '{$roww['customer_id']}',  '$selectedRoomId', '$nextbid');";

        // ทำการเพิ่มข้อมูลการจอง

        $result = mysqli_query($conn, $booking);
        
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
    <style>
        /*ฟอนต์ google ที่นำมาใช้*/
        @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');

        /*แถบด้านบน*/
        nav {
            position: fixed;
            top: 0;
            width: 99%;
            height: 70px;
            background-color: #ffffff;
        }

        nav ul {
            float: right;
            background-color: #ffffff;
            display: inline;
        }

        nav ul li a:hover {
            color: #3c8f8c;
        }

        li {
            color: #59A3B4;
            text-align: center;
            font-family: 'Athiti', sans-serif;
            font-size: 24px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        nav ul li {
            display: inline-block;
            font-size: 19px;
            line-height: 45px;
            padding: 0 15px;
        }

        body {
            font-family: 'Athiti', sans-serif;
            background-image: url("https://i.pinimg.com/564x/62/95/79/629579823c4b0f350238522d1067dfb2.jpg");
            background-size: 100%;
        }

        .dropdown .btn-secondary {
            background-color: white;
            color: black;
            width: 100%;
            border: 0px;
        }

        .border-container {
            position: center;
            background-color: #F6F6F6;
            height: 90%;
            width: 90%;
            margin-top: 30px;
            flex-shrink: 0;
            border-radius: 10px;
            font-size: 18px;
            padding: 25px;
            transform: translateX(5%);
        }

        .row {
            position: center;
        }

        .detail {
            margin-top: 50px;
        }

        form {
            margin-top: 30px;
        }

        .col-sm-3 {
            font-size: 16px;
        }
    </style>
</head>

<body>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าชำระเงิน</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <form action="confirm.php" method="post" enctype="multipart/form-data">
            <div class="border-container p-4">
                <div class="payment">
                    <h2 class="text-center">เลือกช่องทางการชำระเงิน</h2>
                    <div class="row">
                        <div class="col-sm-3 mb-4">
                            <div class="card text-center">
                                <input type="radio" name="checkbox_name[]" value="กสิกร" id="kbank">
                                <label for="kbank">ธนาคารกสิกร</label>
                                <img src="https://bluporthuahin.com/wp-content/uploads/2020/01/icon_kbank.png" class="img-fluid">
                            </div>
                        </div>

                        <div class="col-sm-3 mb-4">
                            <div class="card text-center">
                                <input type="radio" name="checkbox_name[]" value="กรุงเทพ" id="bbl">
                                <label for="bbl">ธนาคารกรุงเทพ</label>
                                <img src="https://awards.brandingforum.org/wp-content/uploads/2016/10/BBL-New-EN.jpg" class="img-fluid">
                            </div>
                        </div>

                        <div class="col-sm-3 mb-4">
                            <div class="card text-center">
                                <input type="radio" name="checkbox_name[]" value="ไทยพาณิชย์" id="scb">
                                <label for="scb">ธนาคารไทยพาณิชย์</label>
                                <img src="https://play-lh.googleusercontent.com/fRj3gVsSGNq1izt8NON0l6Cdqt2dEK4IRhInLoPLlunZMCA0wwOmVnaeDYQEZ8ejWQ" class="img-fluid">
                            </div>
                        </div>

                        <div class="col-sm-3 mb-4">
                            <div class="card text-center">
                                <input type="radio" name="checkbox_name[]" value="กรุงไทย" id="ktb">
                                <label for="ktb">ธนาคารกรุงไทย</label>
                                <img src="https://i0.wp.com/www.kanjanabaramee.org/wp-content/uploads/2017/11/logo_ktb_sqr.jpg?fit=380%2C380&ssl=1" class="img-fluid">
                            <br>
                            <br>
                            <p><span id="countdown"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="ยืนยันการชำระเงิน" name="action" onclick="window.location.href='confirm.php'">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <!--เกี่ยวกับการแสดงผลของแถบด้านบน เวอร์ชั่นที่ใช้-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- จัดการการแสดงผลของรายการแถบ Dropdown -->
    <script>
        // รับอ้างอิงถึงรายการแถบ Dropdown
        var actionItem = document.querySelector(".action-item");
        var anotherActionItem = document.querySelector(".another-action-item");
        var somethingElseItem = document.querySelector(".something-else-item");

        // ซ่อนรายการแถบแรกและรายการที่สอง
        actionItem.style.display = "none";
        anotherActionItem.style.display = "none";
        somethingElseItem.style.display = 'none';

        // รับอ้างอิงถึงปุ่ม Dropdown
        var dropdownButton = document.getElementById("dropdownMenuButton");

        // สร้างตัวแปรสำหรับตรวจสอบสถานะแถบ Dropdown
        var isDropdownOpen = false;

        // เมื่อคลิกที่ปุ่ม Dropdown
        dropdownButton.addEventListener("click", function () {
            if (isDropdownOpen) {
                // ถ้าแถบ Dropdown เปิดอยู่ให้ปิด
                actionItem.style.display = "none";
                anotherActionItem.style.display = "none";
                somethingElseItem.style.display = 'none';
                isDropdownOpen = false;
            } else {
                // แสดงรายการแถบ Dropdown เมื่อคลิก
                actionItem.style.display = "block";
                anotherActionItem.style.display = "block";
                somethingElseItem.style.display = 'block';
                isDropdownOpen = true;
            }
        });
        var locationSelect = document.getElementById("locationSelect");

        // เมื่อคลิกที่ option
        locationSelect.addEventListener("change", function () {
            // ดึงค่า URL จาก option ที่เลือก
            var selectedOption = locationSelect.options[locationSelect.selectedIndex];
            var url = selectedOption.value;

            // เปิดลิงก์ไปยัง URL ที่กำหนด
            if (url) {
                window.location.href = url;
            }
        });
    </script>
    <script>
        function startCountdown() {
            // Set the countdown duration in seconds (15 minutes in this example)
            var duration = 15 * 60; // 15 minutes * 60 seconds

            var countdownElement = document.getElementById("countdown");

            var countdownInterval = setInterval(function () {
                var minutes = Math.floor(duration / 60);
                var seconds = duration % 60;

                // Format minutes and seconds with leading zeros
                var formattedTime = minutes.toString().padStart(2, "0") + ":" + seconds.toString().padStart(2, "0");

                // Display the countdown timer
                countdownElement.textContent = formattedTime;

                if (duration <= 0) {
                    // Redirect to the home page when the countdown reaches zero
                    window.location.href = "home.php";
                    clearInterval(countdownInterval); // Stop the countdown
                }

                duration--; // Decrement the remaining time
            }, 1000); // Update the timer every second (1000 ms)
        }

        // Start the countdown when the page loads
        window.onload = startCountdown;
    </script>

</body>

</html>