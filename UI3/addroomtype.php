<?php
require_once 'connection.php';
?>


<!-- <?php include 'navbar.php'; ?> -->
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
            background-size: 100%;
            height: 160%
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
            margin-left: 470px;
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


        .tile {
            width: 80%;
            margin-left: 2% ;
        }

        .cover {
            background-color: #ffffff;
            text-align: left;
            height: 86%;
            width: 95%;
            margin: auto;
            margin-bottom: 1%;
            flex-shrink: 0;
            border-radius: 20px;
            padding: 1%;
            font-family: 'Athiti', sans-serif;
        }

        

        .box-room {
            border: 2px solid #e3e3e3;
            padding: 15px;
            margin: 0px 0px 10px 0px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-increas {
            display: flex;
        }

        .btn-increas button {
            width: 30px;
            height: 30px;
            background-color: #59A3B4;
            border: none;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn-increas button:hover {
            background-color: #4a8b9c;
        }

        input[type="text"] {
            font-size: 18px;
            padding: 5px;
            border: none;
            border-radius: 5px;
            background-color: #f8f8f8;
            text-align: center;
        }
        .price-per-day {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    
    </style>

    <script>
        $(document).ready(function() {
            console.log("test")
            let pathName = window.location.pathname;
            // pathName = pathName.replace("/project/RIP-RestInPlace","");
            console.log("check path = ", pathName);
            const navLinks = document.querySelectorAll("nav a")
                .forEach(link => {
                    if (link.href.includes(`${pathName}`)) {
                        link.classList.add('active');
                        console.log("Link = ", link)
                    }
                })
        });
    </script>
</head>

<body>
    <nav>
        <a href="partner_page.php"><img src="logo.png" width="90px" height="80px"></a>
        <ul>
        <div class="navbar-nav">
        <li><a href="partner_page.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">หน้าหลัก</button></a></li>
                <li><a href="partnerlist.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">ข้อมูลการจองที่พัก</button></a></li>
                <li><a href="addhotel.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">จัดการข้อมูลที่พัก</button></a></li>
                <li><a href="addroomtype.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #59A3B4; background-color: #ffffff; font-size: 100%;">เพิ่มห้องพัก</button></a></li>
                <li><a href="partnerpayment.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">ช่องทางการรับเงิน</button></a></li>
        
                <li class="dropdown-link">
                    <a href=""><svg width="30" height="30" viewBox="0 0 35 35">
                            <path d="M35 0H0V3.2H35V0Z" fill="black" />
                            <path d="M35 14.3999H0V17.5999H35V14.3999Z" fill="black" />
                            <path d="M35 28.7999H0V31.9999H35V28.7999Z" fill="black" />
                        </svg>
                    </a>
                    <ul class="dropdown">
                        <li><a href="index.php"><button type="button"
                        class="btn btn-outline-light text-dark" style="text-align: center; width: 100%; background-color: #59A3B4 font-size: 100%;">ออกจากระบบ</button></a></li>
                    </ul>
                    </ul>
                </li>
        </div>
        </ul>
    </nav>
    <br><br><br><br>
    
    <div class="cover">
    <script>
        const editDataLink = document.getElementById("editDataLink");

        editDataLink.addEventListener("click", function() {
            // เปลี่ยนหน้าไปยัง URL ที่คุณต้องการ
            window.location.href = "addroomtype.php";
        });
    </script>
    <form action="addroomtype.php" method="post" enctype="multipart/form-data" id="cover">
        <div class="tile" id="tile-1">

            <div class="table-container" id="allBookings">
                <?php

                $sqlpartnerid = "SELECT partner_id FROM partner WHERE partner_id=1";
                $resultpartnerid = $conn->query($sqlpartnerid);
                $row1 = $resultpartnerid->fetch_assoc();


                $sqlname = "SELECT partner_firstname, partner_lastname FROM partner WHERE partner_id = $row1[partner_id]";
                $resultname = $conn->query($sqlname);

                $sql = "SELECT * FROM partner join hotel on hotel.partner_id = partner.partner_id join locations on hotel.location_id = locations.location_id join photo on photo.hotel_id = hotel.hotel_id WHERE partner.partner_id = $row1[partner_id]";
                $result = $conn->query($sql);
                $row2 = $result->fetch_assoc();

                //ถ้าไม่มีข้อมูลที่พัก ให้เข้าเงื่อนไขนี้
                if (isset($row2['hotel_id']) == NULL) {
                    if (isset($_POST['action'])) {
                        echo '<script>window.location.href = "addhotel.php";</script>';
                        exit;
                    }
                    echo '<div class="detail-room">
                    <div class="col-lg-6">
                        <div class="title-detail">
                            <h2>รายละเอียดห้องพัก</h2>
                        </div>
                    </div>

                    <div class="body-detail">
                        <div class="room">
                            <div class="box-room">
                                <span>จำนวนห้อง</span>
                                <div class="btn-increas">
                                    <button type="button" style="width: 30px; height:30px" id="decrement-bedroom">
                                        <ion-icon name="remove-outline" size="small"></ion-icon></button>
                                        <input type="text" style="font-size:30px" name="countBedRoom" id="countBedRoom" value="กรุณากรอกข้อมูลที่พัก" disabled>
                                    <button type="button" style="width: 30px; height:30px" id="increment-bedroom">
                                        <ion-icon name="add-outline" size="small"></ion-icon></button>
                                </div>
                            </div>
                            <div class="box-room">
                                <span>จำนวนคนที่รองรับ/ห้อง</span>
                                <div class="btn-increas">
                                    <button type="button" style="width: 30px; height:30px" id="decrement-amount">
                                        <ion-icon name="remove-outline" size="small"></ion-icon></button>
                                        <input type="text" style="font-size:30px" name="amount" id="amount" value="กรุณากรอกข้อมูลที่พัก" disabled>
                                    <button type="button" style="width: 30px; height:30px" id="increment-amount">
                                        <ion-icon name="add-outline" size="small"></ion-icon></button>
                                </div>
                            </div>
                            <div class="text-per-day"><h2>URLภาพของห้องพัก</h2></div><p>ลิงค์แปลงภาพ: <a href="https://convertio.co/th/png-webp/">https://convertio.co/th/png-webp/</a></p>
                            <div class="all-img">
                                <textarea id="file-upload" name="file" rows="4" cols="50" placeholder="" disabled>กรุณากรอกข้อมูลที่พัก</textarea>
                            </div>
                        </div>
                        <div class="img-detail">
                            <div class="all-img">
                                <textarea id="file-upload" name="detail" rows="4" cols="60" placeholder="" disabled>กรุณากรอกข้อมูลที่พัก</textarea>
                            </div><br>

                            <div class="text-per-day">
                                <h2>ราคาต่อคืน</h2>
                            </div>
                            <div class="price-per-day">
                                <input type="text" name="price" id="price" placeholder="กรุณากรอกข้อมูลที่พัก" required disabled>
                                <h2 style="width:100px;">THB</h2>
                            </div><br>
                            <div class="text-per-day">
                            <h2>ประเภทห้องพัก</h2>
                            </div>
                            <div class="box-room">
                                <div id="etcContainer">
                                <label for="etcInput">ประเภทห้องพัก: </label>
                            </div>

                            </div>
                        </div>
                    </div>
                    <br><form method="post" action="addroomtype.php"><input type="submit" name="action" value="ไปเพิ่มข้อมูลที่พัก" class="add"></form>;
                </div>';

                }

                //ถ้ามีข้อมูลที่พัก ให้เข้าเงื่อนไขนี้
                else {
                    if (isset($_POST['action'])) {
                        $countBedRoom = $_POST['countBedRoom'];
                        $amount = $_POST['amount'];
                        $photo = $_POST['file'];
                        $price = $_POST['price'];
                        isset( $_POST['etcInput'] ) ? $room_type = $_POST['etcInput'] : $room_type= "";
                        $detail = $_POST['detail'];

                        $insertSQL = "INSERT INTO roomtype (room_type, room_price, room_details, max_person, hotel_id, partner_id)
                        VALUES ('$room_type', '$price', '$detail', '$amount', $row2[hotel_id], $row1[partner_id])";
                        $result = $conn->query($insertSQL);

                        if ($result) {
                            // อ่านค่า room_type_id ที่ถูกสร้างขึ้น
                            $room_type_id = $conn->insert_id;

                            $insertSQL3 = "INSERT INTO photo (photo_url, hotel_id, roomtype_id)
                            VALUES ('$photo', '$row2[hotel_id]', '$room_type_id')";
                            $result3 = $conn->query($insertSQL3);

                            for ($i = 0; $i < $countBedRoom; $i++) {
                                // ใช้ค่า room_type_id ในการเพิ่มข้อมูลลงในตาราง hotel
                                $insertSQL2 = "INSERT INTO room (roomtype_id, hotel_id, partner_id, room_status)
                            VALUES ('$room_type_id', $row2[hotel_id], $row1[partner_id], 1)";
                                $result2 = $conn->query($insertSQL2);
                            }
                        }
                    }
                    echo '
                    <div class="detail-room">
                    <div class="col-lg-6">
                        <div class="title-detail">
                            <h2>รายละเอียดห้องพัก</h2>
                        </div>
                    </div>

                    <div class="body-detail">
                        <div class="room">
                            <div class="box-room">
                                <span>จำนวนห้อง</span>
                                <div class="btn-increas">
                                    <button type="button" style="width: 30px; height:30px" id="decrement-bedroom">
                                        <ion-icon name="remove-outline" size="small"></ion-icon></button>
                                        <input type="text" style="font-size:30px" name="countBedRoom" id="countBedRoom" value="0">
                                    <button type="button" style="width: 30px; height:30px" id="increment-bedroom">
                                        <ion-icon name="add-outline" size="small"></ion-icon></button>
                                </div>
                            </div>
                            <div class="box-room">
                                <span>จำนวนคนที่รองรับ/ห้อง</span>
                                <div class="btn-increas">
                                    <button type="button" style="width: 30px; height:30px" id="decrement-amount">
                                        <ion-icon name="remove-outline" size="small"></ion-icon></button>
                                        <input type="text" style="font-size:30px" name="amount" id="amount" value="0">
                                    <button type="button" style="width: 30px; height:30px" id="increment-amount">
                                        <ion-icon name="add-outline" size="small"></ion-icon></button>
                                </div>
                            </div>
                            <div class="text-per-day"><h2>URLภาพของห้องพัก</h2></div><p>ลิงค์แปลงภาพ: <a href="https://convertio.co/th/png-webp/">https://convertio.co/th/png-webp/</a></p>
                            <div class="all-img">
                                <textarea id="file-upload" name="file" rows="4" cols="50" placeholder="ใส่urlรูปภาพที่นี่"></textarea>
                            </div>

                        </div>
                        <div class="img-detail">
                            <div class="all-img">
                                <textarea id="file-upload" name="detail" rows="4" cols="50" placeholder="ใส่รายละเอียดที่พักที่นี่"></textarea>
                            </div><br>

                            <div class="text-per-day">
                                <h2>ราคาต่อคืน</h2>
                            </div>
                            <div class="price-per-day">
                                <input type="text" name="price" id="price" placeholder="กรอกราคาที่นี่:" required>
                                <h2 style="width:100px;">THB</h2>
                            </div><br>
                            <div class="text-per-day"><h2>ประเภทห้องพัก</h2></div>
                                <div id="etcContainer">
                                <input type="text" name="price" id="price" placeholder="กรอกประเภทห้องพัก:" required>
                                </div>

                            </div>
                        </div>
                    </div>
                    <form method="post" action="addroomtype.php"><input type="submit" name="action" value="เพิ่มห้องพัก" class="btn btn-dark mt-4" style="width: 20%; background-color: #59A3B4; border: 1px solid #59A3B4;></form>
                </div>';
                    echo '<script>alert("เพิ่มข้อมูลสำเร็จ")</script>';
                }

                // close connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            var countBedRoom = 0; // Initialize countBedRoom to 0
            var singleRoom = 0; // Initialize singleRoom to 0
            var amount = 0; // Initialize amount to 0
            var bathroom = 0; // Initialize singleRoom to 0
            var count = 0;
            var oldButtonId = "";
            $("button").click(function() {
                // Get the id attribute of the clicked button
                var buttonId = $(this).attr("id");
                var splitButtonId = buttonId.split("-");
                if (splitButtonId[0] == "increment") {
                    // count++

                    if (buttonId == "increment-bedroom") {
                        let num = parseInt($("#countBedRoom").val(), 10);
                        num++;
                        $("#countBedRoom").val(num);
                    }
                    if (buttonId == "increment-amount") {
                        let num = parseInt($("#amount").val(), 10);
                        num++;
                        $("#amount").val(num);
                    }
                } else {
                    if (buttonId == "decrement-bedroom") {
                        let num = parseInt($("#countBedRoom").val(), 10);
                        if (num > 0) {
                            num--;
                        }
                        $("#countBedRoom").val(num);
                    }
                    if (buttonId == "decrement-amount") {
                        let num = parseInt($("#amount").val(), 10);
                        if (num > 0) {
                            num--;
                        }
                        $("#amount").val(num);
                    }
                    // $("#countBedRoom").text(count);
                }


                // Display the id in an alert (you can do something else with it)
                // alert("Button ID: " + buttonId);
            });

            e.preventDefault();
            $("#test").append(newDiv);
        });
    </script>
</body>

</html>