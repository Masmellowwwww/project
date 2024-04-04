<?php
require_once 'connection.php';

$sql = "SELECT hotel.hotel_id, hotel.hotel_name, photo.photo_url, MIN(roomtype.room_price) AS min_price FROM room
JOIN roomtype ON room.roomtype_id = roomtype.roomtype_id
JOIN hotel ON room.hotel_id = hotel.hotel_id
JOIN locations ON hotel.location_id = locations.location_id
JOIN photo ON room.roomtype_id = photo.roomtype_id
GROUP BY hotel.hotel_id;";


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Document</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');




    body {
        background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
        background-size: 100%;
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

        .btn_custom {
            background-color: #ffffff;
            border: solid 1px #67C94A;
            color: #195008;
        }

        .btn-primary:hover {
        background-color: #59A3B4;
        border-color: #59A3B4;
        box-shadow: none;
        outline: none;
        }

        .btn-primary {
        color: #59A3B4;
        background-color: #ffffff;
        border-color: #59A3B4;
        }

        #cover {
                border-radius: 20px;
                background: #F6F6F6;
                box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
                text-align: center;
                width: 80%;
                height: 315px;
                flex-shrink: 0;
                border-radius: 10px;
                font-size: 20px;
                margin: auto;

            }

        body {
            font-family: 'Athiti', sans-serif;
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
            background-size: 100%;
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
            display: flex;

        }

        .same_line {
            display: inline-block;
            margin-left: 10%;
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
            background-color: #ffffff;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            width: 310px;
            flex-shrink: 0;
            text-align: left;
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
        <a href="main_page.php"><img src="logo.png" width="90px" height="80px"></a>
        <ul>
        <div class="navbar-nav">
        <li><a href="http://10.0.15.21/dsba/65070172/Project/UI3/"><button type="button"
                    class="btn btn-light" style="text-align: center; width: 100%; color: #59A3B4; font-size: 100%;">เข้าสู่ระบบ</button></a></li>
                    <li><a href="signup_page.php"><button type="button"
                    class="btn btn-outline-info" style="text-align: center; width: 100%; border: 1px solid #59A3B4; font-size: 100%">สมัครสมาชิก</button></a></li>

        </div>
        </ul>
    </nav>

    <br>
    <br>
    <br>
    <br>
    <ul></ul>
    <div class="cover">
    <form id="cover" action="search_room.php" method="POST">
        <br>
        <h1>ค้นหาที่พัก</h1>
       <br>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 39 39" fill="none">
                <path d="M15.6096 3.90039C12.5046 3.90039 9.52688 5.13389 7.33136 7.32954C5.13583 9.52519 3.9024 12.5031 3.9024 15.6083C3.9024 18.7134 5.13583 21.6913 7.33136 23.887C9.52688 26.0826 12.5046 27.3161 15.6096 27.3161C18.7145 27.3161 21.6923 26.0826 23.8878 23.887C26.0833 21.6913 27.3168 18.7134 27.3168 15.6083C27.3168 12.5031 26.0833 9.52519 23.8878 7.32954C21.6923 5.13389 18.7145 3.90039 15.6096 3.90039ZM9.64209e-08 15.6083C0.000355754 13.124 0.59359 10.6756 1.7304 8.46673C2.86721 6.25784 4.51476 4.35217 6.53613 2.90812C8.55751 1.46406 10.8943 0.523321 13.3524 0.164078C15.8104 -0.195164 18.3187 0.0374668 20.6687 0.842638C23.0188 1.64781 25.1428 3.00226 26.8641 4.79344C28.5855 6.58461 29.8545 8.76078 30.5657 11.1411C31.277 13.5214 31.4099 16.037 30.9534 18.479C30.4969 20.921 29.4642 23.2188 27.9412 25.1814L38.4523 35.6931C38.8077 36.0611 39.0044 36.554 38.9999 37.0656C38.9955 37.5773 38.7903 38.0667 38.4285 38.4285C38.0667 38.7903 37.5774 38.9955 37.0658 38.9999C36.5542 39.0044 36.0613 38.8077 35.6933 38.4522L25.1822 27.9405C22.8748 29.732 20.111 30.8401 17.2052 31.1387C14.2994 31.4373 11.3681 30.9145 8.74458 29.6297C6.12111 28.345 3.91077 26.3498 2.3649 23.8711C0.819033 21.3923 -0.000324524 18.5296 9.64209e-08 15.6083Z" fill="black" />
            </svg>
            <select id="place" name="going_to">
                <option value="0">คุณจะไปที่ไหน?</option>
                <option value="กรุงเทพ">กรุงเทพ</option>
                <option value="ชลบุรี">ชลบุรี</option>
            </select>

        </p>



        <div class="form-row">
            <div class="col-sm-6">
                <p class="same_line">
                    <label for="fdate">วันเช็คอิน</label>
                    <input type="date" data-date="" data-date-format="YYYY MMMM DD" id="fdate" name="fdate" max="ldate">
                    <label for="ldate">วันเช็คเอาท์</label>
                    <input type="date" id="ldate" name="ldate" /></input>
                </p>
            </div>
            <div class="col-sm-6">
                <div class="dropdown-room">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 41 33" fill="none">
                            <path d="M1 31.1364V29.3637C1 22.5103 6.55575 16.9546 13.4091 16.9546C20.2625 16.9546 25.8182 22.5103 25.8182 29.3637V31.1364" stroke="black" stroke-width="2" stroke-linecap="round" />
                            <path d="M22.2727 20.5C22.2727 15.6048 26.2411 11.6364 31.1363 11.6364C36.0316 11.6364 40 15.6048 40 20.5V21.3864" stroke="black" stroke-width="2" stroke-linecap="round" />
                            <path d="M13.4091 16.9545C17.3253 16.9545 20.5001 13.7797 20.5001 9.86361C20.5001 5.94741 17.3253 2.77271 13.4091 2.77271C9.49294 2.77271 6.31824 5.94741 6.31824 9.86361C6.31824 13.7797 9.49294 16.9545 13.4091 16.9545Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M31.1364 11.6364C34.0737 11.6364 36.4546 9.25532 36.4546 6.31818C36.4546 3.38104 34.0737 1 31.1364 1C28.1992 1 25.8182 3.38104 25.8182 6.31818C25.8182 9.25532 28.1992 11.6364 31.1364 11.6364Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span id="quantityLabel">ห้อง: 1, ผู้เข้าพัก: 1</span>
                    </button>


                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li class="room">
                            <p class="dropdown-item">ห้อง
                                <button class="btn minusButton" data-target="quantityRoom">-</button>
                                <input type="number" id="quantityRoom" name="quantityRoom" class="form-control" min="1" value="1" placeholder="1 ห้อง">

                                <button class="btn plusButton" data-target="quantityRoom">+</button>
                            </p>
                        </li>
                        <li class="adult">
                            <p class="dropdown-item">ผู้เข้าพัก
                                <button class="btn minusButton" data-target="quantityAdults">-</button>
                                <input type="number" id="quantityAdults" name="quantityAdults" class="form-control" min="1" value="1" placeholder="ผู้เข้าพัก 1">
                                <button class="btn plusButton" data-target="quantityAdults">+</button>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" value="ค้นหา" class="btn btn-dark" style="width: 40%; height: 17%; background-color: #59A3B4; border: 1px solid #59A3B4; font-size: 100%" onclick="storeData()">
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!--ทำให้วันที่ต้องการเช็คอิน ไม่เกินวันเช็คเอาท์-->
    <script>
        //date
        var fdateInput = document.getElementById("fdate");
        var ldateInput = document.getElementById("ldate");

        fdateInput.addEventListener("input", function() {
            var fdateValue = new Date(this.value);
            var ldateValue = new Date(ldateInput.value);

            if (fdateValue >= ldateValue) {
                var newFDate = new Date(ldateValue);
                newFDate.setDate(ldateValue.getDate() - 1);
                var year = newFDate.getFullYear();
                var month = String(newFDate.getMonth() + 1).padStart(2, "0");
                var day = String(newFDate.getDate()).padStart(2, "0");
                fdateInput.value = year + "-" + month + "-" + day;
            }
        });

        ldateInput.addEventListener("input", function() {
            var fdateValue = new Date(fdateInput.value);
            var ldateValue = new Date(this.value);

            if (fdateValue >= ldateValue) {
                var newFDate = new Date(ldateValue);
                newFDate.setDate(ldateValue.getDate() - 1);
                var year = newFDate.getFullYear();
                var month = String(newFDate.getMonth() + 1).padStart(2, "0");
                var day = String(newFDate.getDate()).padStart(2, "0");
                fdateInput.value = year + "-" + month + "-" + day;
            }
        });
    </script>


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
    <!-- jQuery JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <!-- Bootstrap JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js'></script>
    <!--ทำการเลื่อนแถบเลื่อนที่พักแบบต่างๆ-->
    <script>
        $(document).ready(function() {

            $("#tile-1 .nav-tabs a").click(function() {

                var position = $(this).parent().position();

                var width = $(this).parent().width();

                $("#tile-1 .slider").css({
                    "left": +position.left,
                    "width": width
                });

            });
            var actWidth = $("#tile-1 .nav-tabs").find(".active").parent("li").width();

            var actPosition = $("#tile-1 .nav-tabs .active").position();

            $("#tile-1 .slider").css({
                "left": +actPosition.left,
                "width": actWidth
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault(); // ป้องกันการส่งฟอร์มโดยปรับเป็นการจัดการด้วย JavaScript

                var formData = $(this).serialize(); // รับข้อมูลจากฟอร์มเป็นรูปแบบข้อมูลที่จะส่ง

                // ส่งข้อมูลไปยังไฟล์ PHP อื่น ๆ
                $.post('search_data.php', formData, function(response) {
                    // ให้ทำอะไรสักอย่างเมื่อส่งข้อมูลสำเร็จ หรือให้แสดงข้อความหรือทำการควบคุมอื่น ๆ ตามที่ต้องการ
                    alert('Data sent successfully');
                });
            });
        });
    </script>

 

    <!--ทำการเพิ่มลด จำนวนห้องและผู้เข้าพัก-->
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

                if (quantityInput) {
                    let currentValue = parseInt(quantityInput.value);
                    if (button.textContent === '-' && !isNaN(currentValue)) {
                        if (currentValue > 1) {
                            quantityInput.value = currentValue - 1;
                        }
                    } else if (button.textContent === '+') {
                        quantityInput.value = currentValue + 1;
                    }
                }
            });
        });
    </script>
    <script>
        // ฟังก์ชันเพิ่มค่า
        function increaseValue(target) {
            var input = document.getElementById(target);
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            input.value = value;
            updateQuantityLabel();
        }

        // ฟังก์ชันลดค่า
        function decreaseValue(target) {
            var input = document.getElementById(target);
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                input.value = value;
            }
            updateQuantityLabel();
        }

        // ฟังก์ชันอัปเดตเนื้อหาของ label
        function updateQuantityLabel() {
            var quantityRoom = document.getElementById("quantityRoom").value;
            var quantityAdults = document.getElementById("quantityAdults").value;
            var quantityLabel = document.getElementById("quantityLabel");
            quantityLabel.textContent = `ห้อง: ${quantityRoom}, ผู้เข้าพัก: ${quantityAdults}`;
        }

        // ใส่การเชื่อมโยงไปยังปุ่ม plus และ minus ใน HTML
        var plusButtons = document.querySelectorAll(".plusButton");
        var minusButtons = document.querySelectorAll(".minusButton");

        plusButtons.forEach(function(button) {
            var target = button.getAttribute("data-target");
            button.addEventListener("click", function() {
                increaseValue(target);
            });
        });

        minusButtons.forEach(function(button) {
            var target = button.getAttribute("data-target");
            button.addEventListener("click", function() {
                decreaseValue(target);
            });
        });
    </script>

<br>
<br>
<div class="cover2">
    <br>
    <br>
    <h2>ที่พักแนะนำสำหรับคุณ</h2>
    <br>
    <br>
    <section class="center">
        <style>
            .hotel-container {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 15px;
                transform: translateX(20px);
            }

            .hotel-entry {
                text-align: left;
            }
        </style>
        <div class="hotel-container">
        <?php
                $sql = "SELECT hotel.hotel_id, hotel.hotel_name, photo.photo_url, locations.address, MIN(roomtype.room_price) AS min_price FROM room
                JOIN roomtype ON room.roomtype_id = roomtype.roomtype_id
                JOIN hotel ON room.hotel_id = hotel.hotel_id
                JOIN locations ON hotel.location_id = locations.location_id
                JOIN photo ON room.roomtype_id = photo.roomtype_id
                GROUP BY hotel.hotel_id;";
                $all_hotels = $conn->query($sql);

                while ($data = mysqli_fetch_assoc($all_hotels)) {
                    $minPriceQuery = "SELECT MIN(room_price) AS min_price FROM roomtype WHERE hotel_id = " . $data["hotel_id"];
                    $minPriceResult = $conn->query($minPriceQuery);
                    $minPriceData = mysqli_fetch_assoc($minPriceResult);
                    $minPrice = "THB " . $minPriceData["min_price"];
                ?>
                    <div class="hotel-entry">
                        <p class="hotels">
                            <a href="each_hotel.php?hotel_id=<?php echo $data["hotel_id"]; ?>"><img src="<?php echo $data["photo_url"]; ?>" width="300px" height="300px" id="hotel_img"></a>
                        </p>
                        <p class="hotels" id="hotel_des">
                            <a href="each_hotel.php?hotel_id=<?php echo $data["hotel_id"]; ?>"><span style="display: block; text-align: left;">
                                    <span style="color: black;"> <b><?php echo $data["hotel_name"]; ?></b><br>
                                        <?php echo $data["address"]; ?><br></span>
                                    <span style="color: red;"><?php echo "ราคา (เริ่มต้น) " . $minPrice; ?></span>
                                </span></a>
                        </p>

                    </div>
                <?php
                }
                ?>
        </div>
    </section>

    <div class="footer-basic">
        <footer>
            <div class="social"><a href="https://www.facebook.com/ITLadkrabang"><i class="icon ion-social-facebook"></i></a><a href="https://www.instagram.com/itladkrabang/"><i class="icon ion-social-instagram"></i></a><a href="https://www.it.kmitl.ac.th/th/"><i class="icon ion-social-google"></i></a></div>

            <p class="copyright">Copyright © 2023 - ISAD</p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </div>

<body>
</head>
