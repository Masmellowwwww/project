<?php
require_once 'connection.php';

session_start();
isset( $_SESSION['username'] ) ? $username = $_SESSION['username'] : $username = "";
isset( $_GET['booking_id'] ) ? $booking_id = $_GET['booking_id'] : $booking_id = "";

$sql = "SELECT hotel_name FROM booking join hotel on booking.hotel_id = hotel.hotel_id where booking_id = $booking_id";
$result1 = $conn->query($sql);
$row = $result1->fetch_assoc();

$sql1 = "SELECT roomtype.room_details, roomtype.room_type FROM booking join room on booking.room_id = room.room_id JOIN roomtype ON room.hotel_id = roomtype.hotel_id AND room.roomtype_id = roomtype.roomtype_id where booking_id = $booking_id";
$result2 = $conn->query($sql1);
$row1 = $result2->fetch_assoc();

$photo = "SELECT photo_url FROM booking join photo on booking.hotel_id = photo.hotel_id where booking_id = $booking_id";
$result3 = $conn->query($photo);
$row2 = $result3->fetch_assoc();

$customer = "SELECT customer_firstname, customer_lastname, customer_phone_num FROM booking join customer on booking.customer_id = customer.customer_id where booking_id = $booking_id";
$result4 = $conn->query($customer);
$row3 = $result4->fetch_assoc();

$max = "SELECT room_price FROM booking 
join room on booking.room_id = room.room_id
JOIN roomtype ON room.hotel_id = roomtype.hotel_id where booking_id = $booking_id";
$result5 = $conn->query($max);
$row4 = $result5->fetch_assoc();

$date = "SELECT DATEDIFF(check_out_time, check_in_time) AS duration FROM booking where booking_id = $booking_id";
$result6 = $conn->query($date);
$row5 = $result6->fetch_assoc();

$room = "SELECT room_id FROM booking  where booking_id = $booking_id";
$result7 = $conn->query($room);
$row6 = $result7->fetch_assoc();

$date1 = "SELECT check_out_time, check_in_time FROM booking where booking_id = $booking_id";
$result9 = $conn->query($date1);
$row8 = $result9->fetch_assoc();

$status = "SELECT booking_status, service_requests FROM booking where booking_id = $booking_id";
$result0 = $conn->query($status);
$row9 = $result0->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.7.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Document</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');




        body {
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
            background-size: cover;
            font-family: 'Athiti', sans-serif;
        }

        
        nav {
            border-radius: 0px 0px 20px 20px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            position: fixed;
            top: 0;
            width: 100%;
            height: 80px;
            background-color: #ffffff;
            z-index: 100;
        }

        ul {
            display: inline;
            z-index: 100;
            margin-top: 17px;
        }

        nav ul li a:hover {
            color:  #ffffff;
            align-items: center;
            border-radius: 4px;
            text-align: center;
        }

        
        li {
            color: #59A3B4;
            text-align: center;
            font-family: 'Athiti', sans-serif;
            font-size: 24px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-decoration: none;

        }

        nav ul li {
            display: inline-block;
            font-size: 19px;
            line-height: 45px;
            padding: 0 15px;
        }

        a {
            text-decoration: none;
        }

        * {
            box-sizing: border-box;
        }

        .navbar-nav {
            display: inline-block;
            float: right;
            margin-top: 1%;
            margin-right: 1%;


            
        }
        .dropdown {
            position: absolute;
            display: block;
            background-color: #ffffff;
            top: 120%;
            opacity: 0;
            visibility: hidden;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(255, 255, 255, 0.9), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: 0.5s;
            right: 1%;
            width: 13%;
            height: 60%;
            align-items: center;
        }
        
        .dropdown-link{
                margin-left: 500px;
                
            }

        .dropdown-link:hover {
            background-color: #59A3B4;
            border-radius: 4px;
        }
        
        .dropdown-link:hover .dropdown {
            top: 90%;
            opacity: 1;
            visibility: visible;
        }

        .dropdown-link:hover a i {
            transform: rotate(-180deg);
        }

        #cover {
            background-color: white;
            text-align: center;
            width: 70%;
            height: 750px;
            border-radius: 50px;
            font-size: 20px;
            margin: auto;
        }

        body {
            font-family: 'Athiti', sans-serif;
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
            background-size: 100%;
        }

        h1 {
            margin-top: 10px;
        }

        h2 {
            text-align: center;
        }

        h3 {
            font-weight: bold;
        }

        .horizontal-line {
            width: 100%;
            height: 1px;
            background-color: #ACACAC;
            margin-top: 20px;

        }

        .roomtype {
            margin: 10px;
            height: 50px;
            display: inline-block;
            background-color: #59A3B4;
            /* สีพื้นหลังสีฟ้า */
            color: white;
            /* สีตัวอักษรขาว */
            padding: 10px;
            /* เพิ่มขอบเท่ากับขนาดของพื้นหลัง */
            border-radius: 20px;
            justify-content: center;
            align-items: center;
        }

        .bath {
            text-align: right;
            font-size: larger;
        }

        .where {
            font-family: 'Athiti', sans-serif;

        }


        .tile {
            width: 80%;
            margin: 20px auto;
        }

        .table-responsive {
            text-align: center;
            height: 20%;
            width: 100%;
            border: 1px solid #ACACAC;
            margin-top: 30px;
            float: left;
            border-radius: 20px;
        }

        section {
            margin-top: 20px;
            text-align: center;
            width: 100%;
            height: 60%;
            float: left;
            border: 1px solid #ACACAC;
            display: flex;
            border-radius: 20px;
        }

        .left {
            flex: 1;
            padding: 20px;
        }

        .right {
            padding: 30px;
            flex: 1;
            border-left: 1px solid #ACACAC;
            text-align: left;
            /* เพิ่มเส้นแบ่งระหว่างคอลัม์ */
        }

        .goback {
            font-family: 'Athiti', sans-serif;
            background-color: #59A3B4;
            border-radius: 10px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            width: auto;
            height: 50px;
            flex-shrink: 0;
            color: #ffffff;
            font-size: 20px;
            margin-top: 20px;
            cursor: pointer;
        }

</style>

</head>

<body>
    <nav>
        <a href="partner_page.php"><img src="logo.png" width="90px" height="80px"></a>
        <ul>
        <div class="navbar-nav">
                <li class="dropdown-link">
                    <a href=""><svg width="30" height="30" viewBox="0 0 35 35">
                            <path d="M35 0H0V3.2H35V0Z" fill="black" />
                            <path d="M35 14.3999H0V17.5999H35V14.3999Z" fill="black" />
                            <path d="M35 28.7999H0V31.9999H35V28.7999Z" fill="black" />
                        </svg>
                    </a>
                    <ul class="dropdown">
                        <li><a href="index.php"><button type="button"
                        class="btn btn-outline-light text-dark" style="text-align: center; width: 100%; font-size: 100%;">ออกจากระบบ</button></a></li>
                    </ul>
                    </ul>
                </li>
        </div>
        </ul>
    </nav>
    <br><br><br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
        dropdownButton.addEventListener("click", function() {
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
        locationSelect.addEventListener("change", function() {
            // ดึงค่า URL จาก option ที่เลือก
            var selectedOption = locationSelect.options[locationSelect.selectedIndex];
            var url = selectedOption.value;

            // เปิดลิงก์ไปยัง URL ที่กำหนด
            if (url) {
                window.location.href = url;
            }
        });
    </script>
    <form id="cover">
        <div class="tile" id="tile-1">
            <?php

            echo '<div class="table-responsive"><h1>' . $row['hotel_name'] . '</h1><div class="horizontal-line"></div>';
            echo '<b>เช็คอิน: </b>' . $row8['check_in_time'] . ' <div class="roomtype">';
            if ($row9['booking_status'] == 1) {
                echo 'ยืนยันการจอง';
            } else {
                echo 'รอดำเนินการ';
            }
            echo '</div><b> เช็คเอาต์: </b>' . $row8['check_out_time'] . '</div>';            
            echo '<section>';
            echo '<div class="left"><h3>รายละเอียดที่พัก</h3><img src="' . $row2['photo_url'] . '" alt="Room Photo" style="border-radius: 20px; width: 60%;"><br>';
            echo '<div class="roomtype">' . $row1['room_type'] . '</div><br>';
            echo $row1['room_details'] . '</div>';

            echo '<div class="right"><b>ข้อมูลผู้เข้าพัก</b><br>';
            echo $row3['customer_firstname'] . " " . $row3['customer_lastname'] . 
            '<br><b>เบอร์โทร</b><br>' . $row3['customer_phone_num'] . '<br><div class="horizontal-line"></div>';
            echo '<b>รหัสห้องที่จอง</b>' . '<br>' . $row6['room_id'] . '<br><div class="horizontal-line"></div>';
            echo '<b>คำขอรับบริการเพิ่มเติม</b>' . '<br>' . $row9['service_requests'] . '<br><div class="horizontal-line"></div>';
            echo '<b>ข้อมูลการชำระเงิน</b>' . '<br>' . $row5['duration'] . ' คืน';
            echo '<div class="bath"><b>THB </b>' . $row4['room_price']*$row5['duration'] . '</div>';
            echo '</section>';
            echo '<br><input type="button" value="กลับไปที่หน้าข้อมูลการจองที่พัก" class="btn btn-dark mt-3" style="width: 30%; height: 70%; background-color: #59A3B4; border: 1px solid #59A3B4;"  onclick="Back()">';

            ?>
        </div>
    </form>
    <script>
        function Back() {
            window.location.href = "partnerlist.php"; // แทน 'list.php' ด้วย URL ของหน้าที่คุณต้องการไป
        }
    </script>



</body>

</html>