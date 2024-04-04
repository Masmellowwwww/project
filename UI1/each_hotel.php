<?php
require_once 'connection.php';

session_start();
$hotel_id = $_GET["hotel_id"];
$_SESSION["hotel_id"] = $hotel_id;
// Query สำหรับดึงข้อมูลโรงแรม
$sql = "SELECT * FROM hotel WHERE hotel_id = " . $hotel_id;
$hotel_des = $conn->query($sql);
$hotelData = mysqli_fetch_assoc($hotel_des);

$location = "SELECT * from locations join hotel using(location_id) where hotel_id = " . $hotel_id;
$hotel_location = $conn->query($location);
$address = mysqli_fetch_assoc($hotel_location);

$feedback = "SELECT * from comments join hotel using(hotel_id) join customer using(customer_id) where hotel_id = " . $hotel_id;
$comment = $conn->query($feedback);

// Query สำหรับดึงข้อมูลรูปภาพห้องแต่ละห้อง
$each_room = "SELECT roomtype.roomtype_id, roomtype.room_details, roomtype.room_type, roomtype.room_price, photo.photo_url 
                    FROM roomtype AS roomtype
                    LEFT JOIN photo AS photo ON roomtype.roomtype_id = photo.roomtype_id 
                    WHERE roomtype.hotel_id = " . $hotel_id;
$roomPhotosResult = $conn->query($each_room);

$minRoomPriceQuery = "SELECT MIN(roomtype.room_price) AS min_price FROM roomtype WHERE roomtype.hotel_id = " . $hotel_id;
$minRoomPriceResult = $conn->query($minRoomPriceQuery);
$minPriceData = mysqli_fetch_assoc($minRoomPriceResult);
$minPrice = $minPriceData["min_price"];


// ใช้ array สำหรับจัดเก็บข้อมูลของแต่ละประเภทห้อง
$typeData = array();

while ($row = mysqli_fetch_assoc($roomPhotosResult)) {
    $roomType = $row["room_type"];
    $roomId = $row["roomtype_id"];

    if (!array_key_exists($roomType, $typeData)) {
        $typeData[$roomType] = array(
            "price" => $row["room_price"],
            "rooms" => array(),
            "roomtype_id" => $row["roomtype_id"]
        );
    }

    $typeData[$roomType]["rooms"][] = array(
        "roomDetails" => $row["room_details"],
        "photos" => array($row["photo_url"]),
        "roomtype_id" => $roomId
    );
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
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

        a {
            text-decoration: none;
        }

        * {
            padding: 1;
            box-sizing: border-box;
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
            transition: 0.5s;
            right: 1%;
            width: 180px;
            height: 110px;
        }

        .dropdown-link:hover .dropdown {
            top: 90%;
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


        /*จบแถบด้านบน*/

        body {
        background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
        background-size: 100%;
        font-family: 'Athiti', sans-serif;
        }

        .center {
            text-align: center;
        }

        .hotels {
            display: inline-block;
        }

        .left {
            text-align: left;
            padding: 30px;
            flex: 1;
            margin: 5;
        }

        .right {
            text-align: right;
            padding: 20px;
            flex: 2;
        }

        .cover {
            background-color: #ffffff;
            border-radius: 20px 20px 20px 20px;
            width: 95%;
            margin: auto;
        }

        .same_line {
            display: inline-block;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 30px;
        }

        .box {
            width: 70%;
            height: 10%;
            padding: 25px;
            border: 1px solid #EFF3F4;
            border-radius: 10px 10px 10px 10px;
            background-color: #EFF3F4;
            position: absolute;
            right: 40px;
            text-align: justify;
            margin-right: 25px;
        }

        .box2 {
            width: 70%;
            height: 60%;
            border: 1px solid hsl(0, 0%, 0%);
            border-radius: 20px 20px 20px 20px;
            transform: translateX(200px);
        }

        .room-info {
            display: flex;
            align-items: center;
        }

        .price {
            font-size: 30px;
            color: red;
            text-align: right;
            margin: 5px;
        }

        .start-price {
            font-size: 14px;
            color: black;
            text-align: right;
            margin: 5px;
        }

        .reserve-button {
            text-align: right;
            margin: 5px;
        }

        .reserve-button a {
            text-decoration: none;
        }

        .book {
            background-color: #59A3B4;
            font-family: 'Athiti', sans-serif;
            font-size: 20px;
            color: #ffffff;
            margin: 0;
            width: 160px;
            height: 50px;
            border-radius: 10px;
        }

        .sign {
            margin-right: 20px;
        }

        .line {
            width: 1370px;
            height: 1px;
            background: #ACACAC;
            margin: auto;
        }
    </style>
</head>

<body>
    <!-- โค้ด HTML และแถบด้านบน (navbar) ตามที่คุณต้องการ -->
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
    <br><br><br><br>
    <div class="cover">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <div class="carousel-inner">
                    <?php
                    $active = true; // เพื่อให้รูปแรกเป็น active

                    foreach ($typeData as $roomType => $data) {
                        $rooms = $data["rooms"];
                        foreach ($rooms as $room) {
                            $photo_url = $room["photos"][0]; // เราใช้รูปแรกในรายการรูป
                    ?>
                            <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                                <img src="<?php echo $photo_url; ?>" class="w-50 mx-auto d-block" alt="<?php echo $roomType; ?> Room">
                            </div>
                    <?php
                            $active = false; // เปลี่ยน active เป็น false หลังจากแสดงรูปแรก
                        }
                    }
                    ?>
                </div>

                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
        <div>
            <div class="same_line">
                <h2 class="left"><?php echo $hotelData["hotel_name"]; ?></h2>
                <p class="left"><?php echo $address["address"]; ?></p>
            </div>
            <div class="same_line">
                <p class="right">ราคาเริ่มต้น(ต่อคืน)</p>
                <h2 class="right"><?php echo "THB " . $minPrice; ?></h2>
            </div>
        </div>
        <br>
        <form method="post">
            <div class="box2">
                <p class="left"><?php echo $hotelData["convenient"]; ?></p>
            </div>
            <br>
            <?php foreach ($typeData as $roomType => $typeInfo) { ?>
                <section class="center">
                    <div class="box2">
                        <div class="room-info">
                            <h2 class="left">
                                <?php echo $roomType; ?>
                            </h2>

                            <p class="hotels">
                                <?php foreach ($typeInfo["rooms"] as $room) { ?>
                                    <a href="">
                                        <img src="<?php echo $room["photos"][0]; ?>" width="200px" height="200px" style="border-radius: 20px 20px 20px 20px;" id="hotel_img">
                                    </a>
                                <?php } ?>
                            </p>
                            <p class="price">
                                <?php echo "THB " . $typeInfo["price"]; ?>
                            </p>
                            <p class="start-price">
                                ราคาเริ่มต้น (ต่อคืน)
                            </p>

                            <a >
                                <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                                <input type="hidden" name="roomtype_id" value="<?php echo $typeInfo["roomtype_id"]; ?>">
                                <input type="button" value="จองเลย" class="book" onclick="buynow()">
                            </a>
                        </div>
                    </div>
                    <br>

                </section>

            <?php
            }
            ?>
        </form>
        <div>
            <p class="left" style="font-size: 32px; font-weight: 900;">รีวิวจากผู้เข้าพักจริง</p>
            <?php while ($all_comment = mysqli_fetch_assoc($comment)) { ?>
                <div class="container">
                    <div class="left">
                        <p style="font-size: 40px; color:#59A3B4;">
                            <b><?php echo number_format($all_comment["comment_score"], 2); ?></b>
                        </p>
                        <p style="font-size: 20px;">
                            <b><?php echo $all_comment["customer_firstname"]; ?></b>
                        </p>
                    </div>
                    <div class="right">
                        <div class="box">
                            <p style="font-size: 20px;">
                                <?php echo $all_comment["comment_description"]; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <p style="text-align:center; color:#59A3B4;">______________________________________________________________________________________________________________________________________________________</p>
            <?php } ?>
            <form  method="post">
                <h2 class="left">กรอกความคิดเห็น</h2>
                <p><input type="text" name="name" placeholder="ชื่อ" style="width:17%; font-size:20px; font-family:'Athiti', sans-serif; margin-left:35px;">
                    <input type="number" name="rate" min=0 max=5 placeholder="ให้คะแนน ต่ำสุด 0 มากสุด 5" style="width:17%; font-size:20px; font-family:'Athiti', sans-serif; margin-left:35px;">
                </p>
                <p><input type="text" name="comment" placeholder="เขียนความคิดเห็นที่นี่" size="200" style="height:60px; width:94%; font-size:20px; font-family:'Athiti', sans-serif; margin-left:35px;"></p>
                <input type="button" value="ส่งความคิดเห็น" class="book" onclick="buynow()">
                <p><br></p>
            </form>
        </div>

                
        <script>
            function buynow(){
                alert ("กรุณาเข้าสู่ระบบ");
                window.location.href = "http://10.0.15.21/dsba/65070172/Project/UI3/";
            }

        </script>


        


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
            //var locationSelect = document.getElementById("locationSelect");

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