<?php
require_once 'connection.php';
session_start();
$username = $_SESSION['username'];

$sqlpartnerid = "SELECT partner_id FROM partner WHERE partner_email='$username'";
$resultpartnerid = $conn->query($sqlpartnerid);
$row1 = $resultpartnerid->fetch_assoc();

$sqlname = "SELECT partner_firstname, partner_lastname FROM partner WHERE partner_id = $row1[partner_id]";
$resultname = $conn->query($sqlname);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Document</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');




        body {
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
            background-size: 100%;
            height: 160% font-family: 'Athiti', sans-serif;
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
            color: #ffffff;
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

        .dropdown-link {
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
            margin-left: 2%;
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
    </style>

    <script>
        $(document).ready(function () {
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
                <li><a href="partner_page.php"><button type="button" class="btn btn-light"
                            style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">หน้าหลัก</button></a>
                </li>
                <li><a href="partnerlist.php"><button type="button" class="btn btn-light"
                            style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">ข้อมูลการจองที่พัก</button></a>
                </li>
                <li><a href="addhotel.php"><button type="button" class="btn btn-light"
                            style="text-align: center; width: 100%; color: #59A3B4; background-color: #ffffff; font-size: 100%;">จัดการข้อมูลที่พัก</button></a>
                </li>
                <li><a href="addroomtype.php"><button type="button" class="btn btn-light"
                            style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">เพิ่มห้องพัก</button></a>
                </li>
                <li><a href="partnerpayment.php"><button type="button" class="btn btn-light"
                            style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">ช่องทางการรับเงิน</button></a>
                </li>

                <li class="dropdown-link">
                    <a href=""><svg width="30" height="30" viewBox="0 0 35 35">
                            <path d="M35 0H0V3.2H35V0Z" fill="black" />
                            <path d="M35 14.3999H0V17.5999H35V14.3999Z" fill="black" />
                            <path d="M35 28.7999H0V31.9999H35V28.7999Z" fill="black" />
                        </svg>
                    </a>
                    <ul class="dropdown">
                        <li><a href="index.php"><button type="button" class="btn btn-outline-light text-dark"
                                    style="text-align: center; width: 100%; background-color: #59A3B4 font-size: 100%;">ออกจากระบบ</button></a>
                        </li>
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

            editDataLink.addEventListener("click", function () {
                // เปลี่ยนหน้าไปยัง URL ที่คุณต้องการ
                window.location.href = "partner_page.php";
            });
        </script>
        <form action="addhotel.php" method="post" enctype="multipart/form-data" id="cover">
            <div class="tile" id="tile-1">

                <div class="table-container" id="allBookings">
                    <?php


                    $sql = "SELECT * FROM partner join hotel on hotel.partner_id = partner.partner_id join locations on hotel.location_id = locations.location_id join photo on photo.hotel_id = hotel.hotel_id WHERE partner.partner_id = 41";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    if (isset($row['hotel_id']) == NULL) {
                        if (isset($_POST['action'])) {
                            isset($_POST['hotelname']) ? $hotelname = $_POST['hotelname'] : $hotelname = "";
                            isset($_POST['address']) ? $address = $_POST['address'] : $address = "";
                            isset($_POST['country']) ? $country = $_POST['country'] : $country = "";
                            isset($_POST['province']) ? $province = $_POST['province'] : $province = "";
                            isset($_POST['city']) ? $city = $_POST['city'] : $city = "";
                            isset($_POST['postcode']) ? $postcode = $_POST['postcode'] : $postcode = "";
                            isset($_POST['w3review']) ? $w3review = $_POST['w3review'] : $w3review = "";
                            isset($_POST['file']) ? $photo_url = $_POST['file'] : $wphoto_url = "";


                            $insertSQL = "INSERT INTO locations (address, country, province, city, postcode)
                        VALUES ('$address', '$country', '$province', '$city', '$postcode')";
                            $result = $conn->query($insertSQL);

                            if ($result) {
                                // อ่านค่า location_id ที่ถูกสร้างขึ้น
                                $location_id = $conn->insert_id;

                                // ใช้ค่า location_id ในการเพิ่มข้อมูลลงในตาราง hotel
                                $insertSQL2 = "INSERT INTO hotel (hotel_name, convenient, partner_id, location_id)
                            VALUES ('$hotelname', '$w3review', 41, '$location_id')";
                                $result2 = $conn->query($insertSQL2);

                                if ($result2) {

                                    $hotel_id = $conn->insert_id;

                                    $insertSQL3 = "INSERT INTO photo (photo_url, hotel_id)
                                VALUES ('$photo_url', '$hotel_id')";
                                    $result3 = $conn->query($insertSQL3);

                                }
                            }
                        }
                        echo '<br>
                        <h2>ชื่อที่พัก</h2>
                        <div class="col-lg-12">
                        <!-- เพิ่มฟิลด์เพิ่มเติมที่เกี่ยวกับผู้สมัครตามความเหมาะสม -->
                        <p> 
                            <input type="text" name="tel" id="tel" class="form-control bg-white" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                        </p>
                        <br>
                        <h2>ประเภทที่พัก</h2>
                            <div>
                                <input type="radio" class="typeroom" name="select_type[]" value="คอนโด/อพาร์ตเมนต์">
                                <label for="typeroom">คอนโด / อพาร์ตเมนต์</label>
                            </div>
                            <div>
                                <input type="radio" class="typeroom" name="select_type[]" value="บังกะโล">
                                <label for="typeroom">บังกะโล</label>
                            </div>
                            <div>
                                <input type="radio" class="typeroom" name="select_type[]" value="บ้านเดียว">
                                <label for="typeroom">บ้านเดี่ยว</label>
                            </div>
                            <div>
                                <input type="radio" class="typeroom" name="select_type[]" value="วิลล่า">
                                <label for="typeroom">วิลล่า</label>
                        </div>
                        <br>
                    </div>
                            <h2>ตำแหน่งที่ตั้ง</h2>
                <div class="group-address">
                    <div class="address">
                        <label>ที่อยู่</label><br/>
                        <p> 
                            <input type="text" name="address" class="form-control bg-white" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                        </p>
                    </div>
                <div class="row">
                    <div class="col-sm-6">
                    <labe>ประเทศ</labe><br />
                    <p> 
                        <input type="text" name="tel" id="tel" class="form-control bg-white" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                    </p>
                </div>
                <div class="col-lg-6">
                    <labe>จังหวัด</labe><br />
                    <p> 
                        <input type="text" name="tel" id="tel" class="form-control bg-white" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                    </p>
                </div>
                    <div class="col-sm-6">
                        <labe>เมือง</labe><br/>
                        <p> 
                            <input type="text" name="tel" id="tel" class="form-control bg-white" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <labe>รหัสไปรษณีย์</labe><br/>
                        <p> 
                            <input type="text" name="tel" id="tel" class="form-control bg-white" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                        </p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>สิ่งอำนวยความสะดวก</h2>
                        <textarea cols="50" rows="6"></textarea>
                    </div>
                    <div class="col-sm-6">
                        <h2>URLภาพของที่พัก</h2>
                        <p>ลิงค์แปลงภาพ: <a href="https://convertio.co/th/png-webp/">https://convertio.co/th/png-webp/</a></p>
                        <textarea cols="50" rows="4" placeholder="ใส่urlรูปภาพที่นี่"></textarea>
                    </div>
                </div>  
    </div>';
                        echo '<form method="post" action="addhotel.php"><input type="hidden" name="partner"><input type="submit" name="action" value="แก้ไขข้อมูลที่พัก" class="btn btn-dark mt-4" style="width: 20%; background-color: #59A3B4; border: 1px solid #59A3B4;"></form>';
                    } else {
                        if (isset($_POST['action'])) {
                            $hotelname = $_POST['hotelname'];
                            $address = $_POST['address'];
                            $country = $_POST['country'];
                            $province = $_POST['province'];
                            $city = $_POST['city'];
                            $postcode = $_POST['postcode'];
                            $w3review = $_POST['w3review'];
                            $photo_url = $_POST['file'];

                            $updateSQL = "UPDATE hotel
                        SET hotel_name = '$hotelname',
                            convenient = '$w3review'
                        WHERE hotel_id = $row[hotel_id]";
                            $result = $conn->query($updateSQL);
                            $updateSQL2 = "UPDATE locations
                        SET address = '$address',
                            country = '$country',
                            province = '$province',
                            city = '$city',
                            postcode = '$postcode'
                        WHERE location_id = $row[location_id]";
                            $result2 = $conn->query($updateSQL2);
                            $updateSQL3 = "UPDATE photo
                        SET photo_url = '$photo_url'
                        WHERE hotel_id = $row[hotel_id]";
                            $result3 = $conn->query($updateSQL3);
                            if ($result and $result2 and $result3) {
                                // อัปเดตสำเร็จ
                                echo '<script>window.location.href = "addhotel.php";</script>';
                                exit;
                            } else {
                                // อัปเดตไม่สำเร็จ
                                echo 'เกิดข้อผิดพลาดในการอัปเดต: ' . $conn->error;
                            }
                        }
                        echo '<h2>ชื่อที่พัก</h2>
                        <div class="input-group flex-nowrap">
                <input type="text" class="form-control" placeholder="" name="hotelname" aria-describedby="addon-wrapping" value="' . $row['hotel_name'] . '"></div>
                <div class="top-body">
                <h2>ประเภทที่พัก</h2>
                        <div>
                            <input type="radio" class="typeroom" name="select_type[]" value="' . $row['hotel_type'] . '" checked>
                            <label for="typeroom">' . $row['hotel_type'] . '</label>
                        </div>
                        <div>
                            <input type="radio" class="typeroom" name="select_type[]" value="คอนโด/อพาร์ตเมนต์">
                            <label for="typeroom">คอนโด / อพาร์ตเมนต์</label>
                        </div>
                        <div>
                            <input type="radio" class="typeroom" name="select_type[]" value="บังกะโล">
                            <label for="typeroom">บังกะโล</label>
                        </div>
                        <div>
                            <input type="radio" class="typeroom" name="select_type[]" value="บ้านเดียว">
                            <label for="typeroom">บ้านเดี่ยว</label>
                        </div>
                        <div>
                            <input type="radio" class="typeroom" name="select_type[]" value="วิลล่า">
                            <label for="typeroom">วิลล่า</label>
                        </div>
                    </div>
                            <h2>ตำแหน่งที่ตั้ง</h2>
                <div class="group-address">
                    <div class="address">
                        <label>ที่อยู่</label><br />
                        <input type="text" class="form-control" placeholder="" name="address" aria-describedby="addon-wrapping" value="' . $row['address'] . '">
                    </div>
                <div class="fix-item-address">
                    <div class="item">
                    <labe>ประเทศ</labe><br />
                    <input type="text" class="form-control country" placeholder="" name="country" aria-describedby="addon-wrapping" value="' . $row['country'] . '">
                </div>
                <div class="item">
                    <labe style="margin-left:15px">จังหวัด</labe><br />
                    <input type="text" class="form-control apv" placeholder="" name="province" aria-describedby="addon-wrapping" value="' . $row['province'] . '">
                </div>
                <div class="item">
                    <labe>เมือง</labe><br />
                    <input type="text" class="form-control city" placeholder="" name="city" aria-describedby="addon-wrapping" value="' . $row['city'] . '">
                </div>
                <div class="item">
                    <labe>รหัสไปรษณีย์</labe><br />
                    <input type="text" class="form-control zip" placeholder="" name="postcode" aria-describedby="addon-wrapping" value="' . $row['postcode'] . '">
                </div>
                <div class="box-Convenience">
                <h2>สิ่งอำนวยความสะดวก</h2>
                <textarea id="w3review" name="w3review" rows="4" cols="50">' . $row['convenient'] . '</textarea>
                <h2>URLภาพของที่พัก</h2>
                    <textarea id="file-upload" name="file" rows="4" cols="50">' . $row['photo_url'] . '</textarea>
                </div></div></div>';
                        echo '<form method="post" action="addhotel.php"><input type="hidden" name="partner"><input type="submit" name="action" value="แก้ไขข้อมูลที่พัก" class="add"></form>';
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </form>

</body>

</html>