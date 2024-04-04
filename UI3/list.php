
<?php
        require_once 'connection.php';

        session_start();
        $username = $_SESSION['username'];

        $sqlcustomerid = "SELECT customer_id FROM customer WHERE customer_email='$username'";
        $resultcustomerid = $conn->query($sqlcustomerid);
        $row = $resultcustomerid->fetch_assoc();

        $sqlname = "SELECT customer_firstname, customer_lastname FROM customer WHERE customer_id = $row[customer_id]";
        $resultname = $conn->query($sqlname);

        $sqlbooking = "SELECT *
        FROM payment
        LEFT JOIN booking ON booking.booking_id = payment.booking_id
        join hotel on booking.hotel_id = hotel.hotel_id
        WHERE payment.customer_id = $row[customer_id]
        GROUP BY booking.booking_id, booking.hotel_id, booking.check_in_time, booking.check_out_time";
        $resultbooking = $conn->query($sqlbooking);

        

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        /*ฟอนต์ google ที่นำมาใช้*/
        @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');

        .righttxt {
            text-align: right;
        }

        .lefttxt {
            text-align: left;
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
            width: 15%;
            height: 170%;
            align-items: center;
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
            background-color: #ffffff;
            text-align: center;
            width: 90%;
            height: 85%;
            flex-shrink: 0;
            border-radius: 10px;
            font-size: 20px;
            margin: auto;
        }

        body {
            font-family: 'Athiti', sans-serif;
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
            background-size: cover;
        }



        select {
            width: 75%;
            /* กว้างของช่อง dropdown */
            padding: 10px;
            /* ระยะห่างภายในช่อง dropdown */
            font-family: 'Athiti', sans-serif;
            font-size: 16px;
            /* ขนาดตัวอักษร */
            border: 1px solid #d3d3d3;
            /* ขอบของช่อง dropdown */
            border-radius: 3px;
            color: #000000;
            /* สีข้อความในช่อง dropdown */
        }

        select option {
            font-family: 'Athiti', sans-serif;
            font-size: 14px;
            /* ขนาดตัวอักษรของตัวเลือก */
            color: #ffffff;
            /* สีข้อความของตัวเลือก */
        }

        .fdate .ldate {
            font-family: 'Athiti', sans-serif;
        }

        .search {
            font-family: 'Athiti', sans-serif;
            background-color: #59A3B4;
            border-radius: 10px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            width: 50%;
            height: 15%;
            flex-shrink: 0;
            color: #ffffff;
            font-size: 20px;
        }

        .flex-container {
            display: flex;
            flex-direction: row;
            /* จัดวางแบบแนวนอน */
            align-items: center;
            /* จัดให้อยู่ตรงกลางแนวตั้ง */
            flex-shrink: 0;

        }

        .cover2 {
            background-color: #ffffff;
        }

        h2 {
            text-align: center;
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
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 5px;
            max-width: 100%;
            /* กำหนดความกว้างสูงสุดเป็น 600px */
            height: 100%; 
            overflow: auto;
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

        /* กำหนดขนาดของช่อง */
        input.form-control {
            width: 100%;
            /* ปรับขนาดตามที่คุณต้องการ */
            font-size: 100%;
            /* ปรับขนาดตัวอักษรตามที่คุณต้องการ */
        }

        /* กำหนดขนาดของปุ่ม plus และ minus */
        button.plusButton,
        button.minusButton {
            width: 30px;
            /* ปรับขนาดตามที่คุณต้องการ */
            height: 30px;
            /* ปรับขนาดตามที่คุณต้องการ */
            font-size: 16px;
            /* ปรับขนาดตัวอักษรตามที่คุณต้องการ */
            padding: 0;
            /* ลบขอบของปุ่ม */
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

        .dropdown-room .btn-secondary {
            border-radius: 10px;
            border: 1px solid #ACACAC;
            background: #FFF;
            color: black;
            width: 80%;
            margin-right: 20%;
        }

        .footer-basic {
            padding:40px 0;
            background-color:#4b4c4d;
            color:#89C8D6;
        }

        .footer-basic ul {
            padding:0;
            list-style:none;
            text-align:center;
            font-size:18px;
            line-height:1.6;
            margin-bottom:0;
        }

        .footer-basic li {
            padding:0 10px;
        }

        .footer-basic ul a {
            color:inherit;
            text-decoration:none;
            opacity:0.8;
        }

        .footer-basic ul a:hover {
            opacity:1;
        }

        .footer-basic .social {
            text-align:center;
            padding-bottom:25px;
            align-items: center;
        }

        .footer-basic .social > a {
            font-size:24px;
            width:40px;
            height:40px;
            line-height:40px;
            display:inline-block;
            text-align:center;
            border-radius:50%;
            border:1px solid #FFFFFF;
            margin:0 8px;
            color:inherit;
            opacity:0.75;
        }

        .footer-basic .social > a:hover {
            opacity:0.9;
        }

        .footer-basic .copyright {
            text-align:center;
            font-size:15px;
            color:#ffffff;
        }
        
        h1{
            font-size: 230%;
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
        <br>
        <h2>รายการจอง</h2>

        <?php
        

        if ($resultbooking->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table"><tr><th>ชื่อที่พัก</th><th>วันเช็คอิน</th><th>วันเช็คเอาท์</th><th>ราคา</th><th>สถานะการจอง</th><th>เพิ่มเติม</th></tr>';
        
            while ($row2 = $resultbooking->fetch_assoc()) {
                echo "<tr><td>" . (isset($row2['hotel_name']) ? $row2['hotel_name'] : "") . "</td>";
                echo "<td>" . (isset($row2['check_in_time']) ? $row2['check_in_time'] : "") . "</td>";
                echo "<td>" . (isset($row2['check_out_time']) ? $row2['check_out_time'] : "") . "</td>";
                echo "<td>" . (isset($row2['amount']) ? $row2['amount'] : "") . "</td>";
                if ($row2['booking_status'] == 1) {
                    echo "<td>เสร็จสิ้น</td>";
                } else {
                    echo "<td>รอดำเนินการ</td>";
                }
                echo "<td><a href='detail.php?booking_id=" . $row2['booking_id'] . "'>รายละเอียด</a></td>";
            }
        
            echo "</table>";
            echo '</div>';
        } else {
            echo "ไม่พบรายการจอง";
        }
        ?>
    </div>
</form>

    
</body>

</html>