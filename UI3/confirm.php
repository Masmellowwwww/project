<?php
require_once 'connection.php';
session_start();
$username = $_SESSION['username'];
$hotelid = $_SESSION['hotel_id'];
$roomtype = $_SESSION['roomtype_id'];
$totalPrice = $_SESSION['totalPrice'];
$nextbid = $_SESSION['nextbid'];
$quantityAdults = $_SESSION['quantityAdults'];
$quantityRoom = $_SESSION['quantityRoom'];
$fdate = $_SESSION['fdate'];
$ldate = $_SESSION['ldate'];
$days_dif = $_SESSION['days_dif'];

$bank = $_POST['checkbox_name'];
$bank = implode(",", $bank);

$sql = "SELECT * FROM hotel join photo using(hotel_id) WHERE hotel_id = '$hotelid'";
$hotel_des = $conn->query($sql);
$hotelData = mysqli_fetch_assoc($hotel_des);

$sqlcustomerid = "SELECT customer_id FROM customer WHERE customer_email='$username'";
$resultcustomerid = $conn->query($sqlcustomerid);
$row = $resultcustomerid->fetch_assoc();

$sqlname = "SELECT customer_firstname, customer_lastname FROM customer WHERE customer_id = $row[customer_id]";
$resultname = $conn->query($sqlname);



$payment = "INSERT INTO payment (pay_by, amount, booking_id, customer_id) 
VALUES ('$bank', '$totalPrice' ,'$nextbid', '{$row['customer_id']}')";
$result = mysqli_query($conn, $payment);

if ($result) {
    // ดึงค่า Auto Increment ล่าสุดจากการเพิ่มข้อมูลในตาราง payment
    $paymentId = mysqli_insert_id($conn);
}

$roomQuery = "SELECT * FROM roomtype
JOIN photo ON roomtype.roomtype_id = photo.roomtype_id
JOIN hotel ON roomtype.hotel_id = hotel.hotel_id
WHERE roomtype.roomtype_id = $roomtype AND hotel.hotel_id = $hotelid";
$room_data = mysqli_query($conn, $roomQuery);
$booking_room = mysqli_fetch_assoc($room_data);

$update_booking_status = "UPDATE booking SET booking_status ='1' where booking_status = '0'";
$resultupdate = mysqli_query($conn, $update_booking_status);

$charged_amount = $totalPrice  * 0.9;

$partner = "SELECT partner_id from hotel where hotel_id = $hotelid";
$search_partner = $conn->query($partner);
$ppp = mysqli_fetch_assoc($search_partner);
$pid = $ppp["partner_id"];

$finance = "INSERT INTO finance (finance_amount, finance_total, finance_status, payment_id, partner_id) 
VALUES ('$totalPrice', '$charged_amount',1,'$paymentId', '$pid')";
$resultfn = mysqli_query($conn, $finance);

$location = "SELECT * from locations join hotel using(location_id) where hotel_id = '$hotelid'";
$hotel_location = $conn->query($location);
$address = mysqli_fetch_assoc($hotel_location);

$hotel_data = "SELECT * from photo join hotel using(hotel_id) where photo.hotel_id = '$hotelid'";

$room_photo = "SELECT photo_url from photo where photo.roomtype_id = '$roomtype'";

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm booking</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
    <style>
        /* Define the fonts */
        @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');

        @media screen and (max-width: 640px) {
            body{width: 100%;

            }
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
            height:230%;
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
        /* General body styles */
        body {
    font-family: 'Athiti', sans-serif;
    background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
    background-size: cover;
}

        /* Dropdown button styles */
        .dropdown .btn-secondary {
            background-color: white;
            color: black;
            width: 100%;
            border: 0px;
        }

        /* Container for content */
        .border-container {
            background-color: #F6F6F6;
            border-radius: 10px;
            font-size: 18px;
            padding: 25px;
            margin: 30px auto;
            width: 60%;
            max-width: 500px;
        }

        /* Cover section styles */
        .cover {
            background-color: #ffffff;
            /* Change to your desired color */
            text-align: center;
            padding: 20px;
            border-radius: 5px;
        }

        .cover h2 {
            color: #59A3B4;
            /* Change to your desired color */
        }

        .cover p {
            font-size: 16px;
            margin: 10px 0;
        }

        .cover img {
            width: 100%;
            max-width: 400px;
            margin: 10px 0;
            border-radius: 5px;
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
    <br><br><br><br>
    <div class="cover">
        <p><svg xmlns="http://www.w3.org/2000/svg" width="77" height="77" viewBox="0 0 77 77" fill="none">
                <path d="M77 38.5C77 59.763 59.763 77 38.5 77C17.237 77 0 59.763 0 38.5C0 17.237 17.237 0 38.5 0C59.763 0 77 17.237 77 38.5ZM34.0467 58.8854L62.6112 30.3209C63.5812 29.351 63.5812 27.7782 62.6112 26.8083L59.0986 23.2956C58.1286 22.3255 56.5559 22.3255 55.5858 23.2956L32.2903 46.5909L21.4142 35.7148C20.4443 34.7449 18.8715 34.7449 17.9014 35.7148L14.3888 39.2275C13.4188 40.1974 13.4188 41.7702 14.3888 42.7401L30.5339 58.8853C31.504 59.8554 33.0766 59.8554 34.0467 58.8854Z" fill="#59A3B4" />
            </svg></p>
        <h2>การจองของท่านได้รับการยืนยันแล้ว</h2>
        <div>
            <p><img src="<?php echo $hotelData['photo_url']; ?>"></p>
            <p><?php echo $hotelData['hotel_name']; ?></p>
            <p><?php echo $address['address']; ?></p>
            <p>เช็คอิน</p>
            <p><?php echo "$fdate"; ?></p>
            <p>เช็คเอาท์</p>
            <p><?php echo "$ldate"; ?></p>
        </div>
        <div>
            <p><img src="<?php echo $booking_room['photo_url']; ?>"></p>
            <p>รายละเอียดที่พัก</p>
            <p><?php echo $booking_room['room_type'];?></p>
        </div>
        <!-- <div>
            <p>ข้อมูลผู้เข้าพัก</p>
            <p><?php if ($resultname->num_rows > 0) {
                    // output data of each row
                    $row = $resultname->fetch_assoc();
                    echo $row['customer_firstname'] . " " . $row['customer_lastname'];
                } else {
                    echo "-";
                } ?></p>
            <p><?php echo $quantityAdults . " คน"; ?></p>
            <p>ข้อมูลการชำระเงิน</p>
            <p><?php echo $quantityRoom . " ห้อง x " . $days_dif . " คืน"; ?></p>
            <p><?php echo "THB " . $totalPrice; ?></p>
        </div> -->
    </div>

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
</body>

</html>
