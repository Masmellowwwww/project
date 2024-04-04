<?php require_once 'connection.php';?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rest In Place</title>
    <!-- Bootstrap 4 CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        /*ฟอนต์ google ที่นำมาใช้*/
        @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');

        @media screen and (max-width: 640px) {
            body{width: 100%;

            }
        }

        .righttxt {
            text-align: right;
        }

        .lefttxt {
            text-align: left;
        }

        /*แถบด้านบน*/
        nav {
            border-radius: 0px 0px 20px 20px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            position: fixed;
            top: 0;
            width: 100%;
            height: 80px;
            background-color: #ffffff;
        }

        nav ul {

            float: right;
            display: inline;
            z-index: 100;
        }

        nav ul li a:hover {
            color: #ffffff;
        }

        * {
            padding: 1;
            box-sizing: border-box;
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

        li:hover {
            background-color: #59A3B4;
            border-radius: 4px;
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
            transition: 0.3s;
            right: 2px;
            width: 200px;
            height: 50px;

        }

        .dropdown-link:hover .dropdown {
            top: 140%;
            opacity: 1;
            visibility: visible;
        }

        .dropdown-link:hover a i {
            transform: rotate(-180deg);
        }

        .navbar {
            border-radius: 7px;
            position: relative;
        }

        a {
            text-decoration: none;
        }

        .signup {
            width: 135px;
            height: 50px;
            flex-shrink: 0;
            font-size: 20px;
            font-family: 'Athiti', sans-serif;
            border-radius: 10px;
            border: 1px solid #59A3B4;
            background-color: #ffffff;
        }

        .signup:hover {
            background-color: #ffffff;
            color: #59A3B4;
        }

        /*จบแถบด้านบน*/

        #cover {
            background-color: white;
            text-align: center;
            width: 70%;
            height: 85%;
            border-radius: 50px;
            font-size: 20px;
            margin: auto;
        }

        body {
            font-family: 'Athiti', sans-serif;
            background-image: url("https://images-ext-1.discordapp.net/external/ZnbHdhukRcHI6HijJ0TLzr6D4FT-q0nA-y73aOApXbs/https/i.pinimg.com/564x/c0/c6/cc/c0c6cc9cb4432d823bb068b9303e1ce4.jpg?width=372&height=661");
            background-size: 50%;
        }

        .fdate .ldate {
            font-family: 'Athiti', sans-serif;
        }

        .cover2 {
            background-color: #ffffff;
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
            margin-top: 10px;

        }

        .roomtype {
            margin: 10px;
            height: 40px;
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

        .hotels {
            display: inline-block;

        }

        .same_line {
            display: inline-block;
        }

        #hotel_img {
            border-radius: 20px 20px 0px 0px;
            background: url(<path-to-image>), rgb(255, 255, 255) 50% / cover no-repeat;
            width: 310px;
            height: 150px;
            flex-shrink: 0;
        }

        #hotel_des {
            border-radius: 0px 0px 20px 20px;
            background: rgb(222, 222, 222);
            width: 310px;
            flex-shrink: 0;
            text-align: center;
            /* จัดให้อยู่กึ่งกลางข้อความ */
            padding: 10px;
            /* เพิ่มระยะห่างข้อความ */
            margin-top: -20px;
            /* ปรับข้อความให้อยู่ตรงกับรูปด้านล่าง */
        }

        .center {
            text-align: center;
        }

        ul li .dropdown {
            margin-left: 10px;
        }

        .tile {
            width: 80%;
            margin: 20px auto;
        }

        #tile-1 .tab-pane {
            padding: 15px;
            height: 80px;
        }

        #tile-1 .nav-tabs {
            position: relative;
            border: none !important;
            background-color: #fff;
            /*   box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2); */
            border-radius: 6px;
        }

        #tile-1 .nav-tabs li {
            margin: 0px !important;
        }

        #tile-1 .nav-tabs li a {
            position: relative;
            margin-right: 0px !important;
            padding: 20px 40px !important;
            font-size: 16px;
            border: none !important;
            color: #333;
        }

        #tile-1 .nav-tabs a:hover {
            background-color: #fff !important;
            border: none;
        }

        td,
        th {
            border-bottom: 2px solid #000;
            padding: 5px;
            text-align: left;
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

        .signup_as:hover {
            background-color: #ffffff;
            color: #59A3B4;
        }

        #tile-1 .slider {
            display: inline-block;
            width: 25px;
            height: 4px;
            border-radius: 3px;
            background-color: #39bcd3;
            position: absolute;
            z-index: 1200;
            bottom: 0;
            transition: all .4s linear;
        }

        #tile-1 .nav-tabs .active {
            background-color: transparent !important;
            border: none !important;
            color: #39bcd3 !important;
        }

    </style>
</head>

<body>
    <nav>
        <a href="manager_page.php"><img src="logo.png" width="px" height="80px"></a>
        <ul>
            <div class="navbar">
                <ul></ul>
                <li class="dropdown-link">
                    <a href=""><svg width="30" height="30" viewBox="0 0 35 32">
                            <path d="M35 0H0V3.2H35V0Z" fill="black" />
                            <path d="M35 14.3999H0V17.5999H35V14.3999Z" fill="black" />
                            <path d="M35 28.7999H0V31.9999H35V28.7999Z" fill="black" />
                        </svg>
                    </a>

                    </a>
                    <ul class="dropdown">
                        <li><a href="index.php">ออกจากระบบ</a></li>
                    </ul>
            </div>
        </ul>
    </nav>
    <br>
    <br>
    <br>
    <br>
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
            

            $booking_id = $_GET['booking_id'];

            $sql = "SELECT hotel_name FROM booking join hotel on booking.hotel_id = hotel.hotel_id where booking_id = $booking_id";
            $result1 = $conn->query($sql);
            $row = $result1->fetch_assoc();

            $sql1 = "SELECT room_details, room_type FROM booking join room on booking.room_id = room.room_id join roomtype on room.roomtype_id = roomtype.roomtype_id where booking_id = $booking_id";
            $result2 = $conn->query($sql1);
            $row1 = $result2->fetch_assoc();

            $photo = "SELECT photo_url FROM booking join room on booking.room_id = room.room_id join roomtype on room.roomtype_id = roomtype.roomtype_id join photo on roomtype.roomtype_id = photo.roomtype_id where booking_id = $booking_id";
            $result3 = $conn->query($photo);
            $row2 = $result3->fetch_assoc();

            $customer = "SELECT customer_firstname, customer_lastname FROM booking join customer on booking.customer_id = customer.customer_id where booking_id = $booking_id";
            $result4 = $conn->query($customer);
            $row3 = $result4->fetch_assoc();

            $max = "SELECT max_person, num_room, room_price FROM booking join room on booking.room_id = room.room_id join roomtype on room.roomtype_id = roomtype.roomtype_id where booking_id = $booking_id";
            $result5 = $conn->query($max);
            $row4 = $result5->fetch_assoc();

            $date = "SELECT DATEDIFF(check_out_time, check_in_time) AS duration FROM booking where booking_id = $booking_id";
            $result6 = $conn->query($date);
            $row5 = $result6->fetch_assoc();

            $amount = "SELECT booking.booking_id, payment.amount FROM booking JOIN payment ON booking.payment_id = payment.payment_id WHERE booking.booking_id = $booking_id";
            $result8 = $conn->query($amount);
            $row7 = $result8->fetch_assoc();

            $date1 = "SELECT check_out_time, check_in_time FROM booking where booking_id = $booking_id";
            $result9 = $conn->query($date1);
            $row8 = $result9->fetch_assoc();

            echo '<div class="table-responsive"><h1>' . $row['hotel_name'] . '</h1><div class="horizontal-line"></div>';
            echo '<b>เช็คอิน: </b>' . $row8['check_in_time'] . ' <div class="roomtype">' . $row5['duration'] . ' คืน</div><b> เช็คเอาต์: </b>' . $row8['check_out_time'] . '</div>';
            echo '<section>';
            echo '<div class="left"><h3>รายละเอียดที่พัก</h3><img src="' . $row2['photo_url'] . '" alt="Room Photo" style="border-radius: 20px; width: 60%;"><br>';
            echo '<div class="roomtype">' . $row1['room_type'] . '</div><br>';
            echo $row1['room_details'] . '</div>';

            echo '<div class="right"><b>ข้อมูลผู้เข้าพัก</b><br>';
            echo $row3['customer_firstname'] . " " . $row3['customer_lastname'] . '<br><div class="horizontal-line"></div>';
            echo '<b>จำนวนผู้เข้าพักสูงสุด</b>' . '<br>' . $row4['max_person'] . '<br><div class="horizontal-line"></div>';
            echo '<b>ข้อมูลการชำระเงิน</b>' . '<br>' . 'ราคา/ห้อง';
            echo '<div class="bath"><b>THB </b>' . $row4['room_price'] * $row5['duration'] . '</div>';
            echo '</section>';
            echo '<br><input type="button" value="กลับไปที่หน้าการจองของฉัน" class="goback" onclick="Back()">';

            ?>
        </div>
    </form>
    <script>
        function Back() {
            window.location.href = "manager_page.php"; // แทน 'list.php' ด้วย URL ของหน้าที่คุณต้องการไป
        }
    </script>



</body>

</html>