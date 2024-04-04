<?php
require_once 'connection.php';

            session_start();
            $username = $_SESSION['username'];

            $booking_id = $_GET['booking_id'];


            $sqlcustomerid = "SELECT customer_id FROM customer WHERE customer_email='$username'";
            $resultcustomerid = $conn->query($sqlcustomerid);
            $rowname = $resultcustomerid->fetch_assoc();

            $sqlname = "SELECT customer_firstname, customer_lastname FROM customer WHERE customer_id = $rowname[customer_id]";
            $resultname = $conn->query($sqlname);

            $sql = "SELECT hotel_name FROM booking join hotel on booking.hotel_id = hotel.hotel_id where booking_id = $booking_id";
            $result1 = $conn->query($sql);
            $row0 = $result1->fetch_assoc();

            $sql1 = "SELECT room_details, room_type FROM booking join roomtype on booking.room_id = roomtype.roomtype_id where booking_id = $booking_id";
            $result2 = $conn->query($sql1);
            $row1 = $result2->fetch_assoc();

            $photo = "SELECT photo_url,room_type,room_details FROM booking 
            join room on booking.room_id = room.room_id 
            join roomtype on room.roomtype_id = roomtype.roomtype_id 
            join photo on photo.roomtype_id = roomtype.roomtype_id
            where booking_id = $booking_id";
            $result3 = $conn->query($photo);
            $row2 = $result3->fetch_assoc();

            $partner = "SELECT partner_firstname, partner_lastname, partner_phone_num 
            FROM booking join hotel on booking.hotel_id = hotel.hotel_id
            join partner on partner.partner_id = hotel.partner_id 
            where booking_id = $booking_id";
            $result4 = $conn->query($partner);
            $row3 = $result4->fetch_assoc();

            $max = "SELECT max_person, num_room FROM booking join room on booking.room_id = room.room_id 
            join roomtype on room.roomtype_id = roomtype.roomtype_id where booking_id = $booking_id";
            $result5 = $conn->query($max);
            $row4 = $result5->fetch_assoc();

            $date = "SELECT DATEDIFF(check_out_time, check_in_time) AS duration FROM booking where booking_id = $booking_id";
            $result6 = $conn->query($date);
            $row5 = $result6->fetch_assoc();

            $room = "SELECT num_room FROM booking join roomtype on booking.room_id = roomtype.roomtype_id where booking_id = $booking_id";
            $result7 = $conn->query($room);
            $row6 = $result7->fetch_assoc();

            $amount = "SELECT amount FROM payment JOIN booking ON booking.booking_id = payment.booking_id WHERE booking.booking_id = $booking_id";
            $result8 = $conn->query($amount);
            $row7 = $result8->fetch_assoc();

            $date1 = "SELECT check_out_time, check_in_time FROM booking where booking_id = $booking_id";
            $result9 = $conn->query($date1);
            $row8 = $result9->fetch_assoc();

             // close connection
mysqli_close($conn);
            ?>
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
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
            background-size: cover;
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
            margin-top: 10px ;

        }
        
        .roomtype {
            margin: 10px;
            height: 40px;
            display: inline-block;
            background-color: #59A3B4; /* สีพื้นหลังสีฟ้า */
            color: white; /* สีตัวอักษรขาว */
            padding: 10px; /* เพิ่มขอบเท่ากับขนาดของพื้นหลัง */
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

        .dropdown .btn-secondary {
            background-color: white;
            color: black;
            width: 100%;

        }
    </style>
</head>

<body>
<nav>
        <a href="customer_page.php"><img src="logo.png" width="80px" height="80px"></a>
        <ul>
            

                <div class="navbar-nav">
                <li class="dropdown-link">
                    <a href=""><svg width="30" height="30" viewBox="0 0 35 35">
                            <path d="M35 0H0V3.2H35V0Z" fill="black" />
                            <path d="M35 14.3999H0V17.5999H35V14.3999Z" fill="black" />
                            <path d="M35 28.7999H0V31.9999H35V28.7999Z" fill="black" />
                        </svg>
                    </a>

                    <ul class="dropdown" aria-labelledby="dropdownMenuButton">
                      <li>
                      <?php
                    if ($resultname->num_rows > 0) {
                        // output data of each row
                        $row = $resultname->fetch_assoc();
                        echo $row['customer_firstname'] . " " . $row['customer_lastname'];
                        } else {
                        echo "-";
                        }
                    ?>
                      </li>  
                    <li><a href="list.php"><button type="button"
                    class="btn btn-outline-light text-dark" style="text-align: center; width: 100%; font-size: 100%;">การจองของฉัน</button></a></li>
                        <li><a href="index.php"><button type="button"
                        class="btn btn-outline-light text-dark" style="text-align: center; width: 100%; font-size: 100%;">ออกจากระบบ</button></a></li>
                    </ul>
                    
        </ul>
    </nav>
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

            echo '<div class="table-responsive"><h1>' . $row0['hotel_name'] . '</h1><div class="horizontal-line"></div>';
            echo '<b>เช็คอิน: </b>' . $row8['check_in_time'] . ' <div class="roomtype">' . $row5['duration'] . ' คืน</div><b> เช็คเอาต์: </b>' . $row8['check_out_time'] . '</div>';
            echo '<section>';
            echo '<div class="left"><h3>รายละเอียดที่พัก</h3><img src="' . $row2['photo_url'] . '" alt="Room Photo" style="border-radius: 20px; width: 60%;"><br>';
            echo '<div class="roomtype">' . $row2['room_type'] . '</div><br>';
            echo $row2['room_details'] . '</div>';

            echo '<div class="right"><b>ติดต่อเจ้าของที่พัก</b><br>';
            echo $row3['partner_firstname'] . " " . $row3['partner_lastname'] . '<br>' . $row3['partner_phone_num'] . '<div class="horizontal-line"></div>';
            echo '<b>จำนวนผู้เข้าพักสูงสุด</b>' . '<br>' . $row4['max_person'] * $row4['num_room'] . '<br><div class="horizontal-line"></div>';
            echo '<b>ข้อมูลการชำระเงิน</b>' . '<br>' . $row4['num_room'] . ' ห้อง x ' . $row5['duration'] . ' คืน';
            echo '<div class="bath"><br><b>THB </b>' . $row7['amount'] . '</div>';
            echo '</section>';
            echo '<br><input type="button" value="กลับไปที่หน้าการจองของฉัน" class="goback" onclick="goBack()">';

            ?>
        </div>
    </form>
    <script>
        function goBack() {
            window.location.href = "list.php"; // แทน 'list.php' ด้วย URL ของหน้าที่คุณต้องการไป
        }
    </script>



</body>

</html>