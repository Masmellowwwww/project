<?php
require_once 'connection.php';
session_start();
$username = $_SESSION['username'];
$fdate = $_SESSION['fdate'];
$ldate = $_SESSION['ldate'];;
$quantityAdults = $_SESSION['quantityAdults'];
$quantityRoom = $_SESSION['quantityRoom'];

$hotel_id = $_GET['hotel_id'];
$_SESSION['hotel_id'] = $hotel_id ;

$roomtype_id = $_GET['roomtype_id'];
$_SESSION['roomtype_id'] = $roomtype_id;

$sqlcustomerid2 = "SELECT customer_id FROM customer WHERE customer_email='$username'";
$resultcustomerid2 = $conn->query($sqlcustomerid2);
$row2 = $resultcustomerid2->fetch_assoc();


$sqlname2 = "SELECT customer_firstname, customer_lastname FROM customer WHERE customer_id = $row2[customer_id]";
$resultname2 = $conn->query($sqlname2);



$roomQuery = "SELECT * FROM roomtype
JOIN photo ON roomtype.roomtype_id = photo.roomtype_id
JOIN hotel ON roomtype.hotel_id = hotel.hotel_id
WHERE roomtype.roomtype_id = $roomtype_id AND hotel.hotel_id = '$hotel_id'";
$room_data = mysqli_query($conn, $roomQuery);

$booking_room = mysqli_fetch_assoc($room_data);

// Query สำหรับดึงข้อมูลโรงแรม
$sql = "SELECT * FROM hotel join photo using(hotel_id) WHERE hotel_id = '$hotel_id'";
$hotel_des = $conn->query($sql);
$hotelData = mysqli_fetch_assoc($hotel_des);

$location = "SELECT * from locations join hotel using(location_id) WHERE hotel_id = '$hotel_id'";
$hotel_location = $conn->query($location);
$address = mysqli_fetch_assoc($hotel_location);

$check_in = strtotime($_SESSION["fdate"]);
$check_out = strtotime($_SESSION["ldate"]);

$days_dif = ($check_out - $check_in) / (60 * 60 * 24);
$_SESSION['days_dif'] = $days_dif;

$totalPrice = $quantityRoom * $days_dif * $booking_room["room_price"];
$_SESSION['totalPrice'] = $totalPrice;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
    <style>
        /*ฟอนต์ google ที่นำมาใช้*/
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
            right: 2%;
            width: 15%;
            height: 260%;
            align-items: right;
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
        /* CSS เพิ่มเติมสำหรับหน้าเว็บการจอง */
        .box {
            width: 80%;
            background-color: #ffffff;
            border-radius: 20px;
            transform: translateX(13%);
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #photo {
            margin: 20px auto;
        }

        #hotel_name {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .left {
            text-align: left;
            margin: 10px 0;
        }

        .right {
            text-align: right;
            margin: 10px 0;
        }

        #quantityAdults,
        #quantityRoom,
        #totalPrice,
        #convenient {
            font-size: 18px;
            color: #555;
        }

        #quantityAdults,
        #quantityRoom {
            font-weight: 600;
        }

        .btn {
            font-size: 24px;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }

        body {
            font-family: 'Athiti', sans-serif;
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
    background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
        padding: 0;
        }
        

        .move-right {
            margin-left: 10%;
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
                    if ($resultname2->num_rows > 0) {
                        // output data of each row
                        $row2 = $resultname2->fetch_assoc();
                        echo $row2['customer_firstname'] . " " . $row2['customer_lastname'];
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
    <form action="payment.php" method="POST">
        <div class="box">
            <div class="box">
                <div class="row">
                    <div class="left" id="photo">
                        <img src="<?php echo $hotelData["photo_url"]; ?>" width="300" height="200">
                    </div>
                    <div class="right">
                        <h2 class="left" id="hotel_name"><?php echo $hotelData["hotel_name"]; ?></h2>
                        <p class="left"><?php echo $address["address"]; ?></p>
                        <h4 class="left"><?php echo $_SESSION['fdate'] . " - " . $_SESSION['ldate']; ?></h4>
                        <p class="left"><?php echo $days_dif . " คืน"; ?></p>
                    </div>
                </div>
            </div>
            <br>
            <p class="left move-right">
                <?php
                
$sqlcustomerid = "SELECT customer_id FROM customer WHERE customer_email='$username'";
$resultcustomerid = $conn->query($sqlcustomerid);
$row = $resultcustomerid->fetch_assoc();


$sqlname = "SELECT customer_firstname, customer_lastname FROM customer WHERE customer_id = $row[customer_id]";
$resultname = $conn->query($sqlname);

            
                if ($resultname->num_rows > 0) {
                    // output data of each row
                    $row = $resultname->fetch_assoc();
                    echo "ชื่อผู้จอง: " . $row['customer_firstname'] . " " . $row['customer_lastname'];
                    } else {
                    echo "-";
                    }
                ?></p>


    
                <div class="box">
                    <div class="row">
                        <div>
                            <p class="left"><?php echo $booking_room["room_type"]; ?></p>
                            <p class="left">
                                <img src="<?php echo $booking_room["photo_url"]; ?>" width="40%">
                            </p>
                        </div>
                        <div>
                            <p class="left" id="quantityAdults"><?php echo $_SESSION['quantityAdults'] . " คน"; ?></p>
                            <p class="left">จำนวนห้อง </p>
                            <p class="left" id="quantityRoom" name="quantityRoom"><?php echo $quantityRoom ; ?></p>
                            <p class="left" name="totalPrice" id="totalPrice"><?php echo "ราคารวม THB " . $booking_room["room_price"] * $quantityRoom * $days_dif; ?>
                        </div>
                    </div>
                </div>
                
               <p class="left">คำขอรับบริการอื่นเพิ่มเติม</p>
                
                <input type="text" name="service_requests" size="60" value="-">
            
                <p style="color: red;">ถ้ากดยืนยันการจอง จะนับเวลาในการชำระเงิน 15 นาที</p>
                <a><input type="button" value="ยืนยันการจอง" onclick=storeDataAndRedirect()></a>
            </div>
    </form>
    <script>
        function storeDataAndRedirect() {
            
            // Get the data from the form fields
            <?php
            
            $totalPrice = $booking_room["room_price"] * $_SESSION['quantityRoom'] * $days_dif; 
            $_SESSION['totalPrice'] = $totalPrice;
            ?>

            // Set a cookie with a 15-minute expiration
            document.cookie = "cookie1=ทดสอบ; max-age=" + (60 * 15);
            // Redirect to the payment page
            window.location.href = "payment.php";

        }

        // Set a timer to redirect to the home page after 15 minutes
        setTimeout(function() {
            window.location.href = "customer_page.php";
        }, 15 * 60 * 1000); // 15 minutes in milliseconds
        window.location.href = paymentUrl;
    </script>
    <script>
        // เลือกทุกปุม
        const buttons = document.querySelectorAll('.minusButton, .plusButton');

        // เพิ่ม event listener สำหรับแต่ละปุม
        buttons.forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();
                // หาอินพุตที่เกี่ยวข้องโดยใช้ data-target
                const targetId = button.getAttribute('data-target');
                const quantityInput = document.getElementById(targetId);
                const totalPriceDisplay = document.getElementById('totalPrice');

                if (quantityInput && totalPriceDisplay) {
                    let currentValue = parseInt(quantityInput.innerHTML);
                    const minValue = 1;
                    const maxValue = 10;

                    if (button.textContent === '-' && !isNaN(currentValue)) {
                        if (currentValue > minValue) {
                            quantityInput.innerHTML = currentValue - 1;
                            updateTotalPrice(currentValue - 1);
                        }
                    } else if (button.textContent === '+' && currentValue < maxValue) {
                        quantityInput.innerHTML = currentValue + 1;
                        updateTotalPrice(currentValue + 1);
                    }
                }
            });
        });

        function updateTotalPrice(quantity) {
            const roomPrice = <?php echo $booking_room["room_price"]; ?>;
            const night = <?php echo $days_dif ?>;
            const total = roomPrice * quantity * night;
            const totalPriceDisplay = document.getElementById('totalPrice');
            totalPriceDisplay.innerHTML = `ราคารวม THB ${total}`;
        }
    </script>



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