<?php
require_once 'connection.php';

session_start();

$username = $_SESSION['username'];
$sqlpartnerid = "SELECT partner_id FROM partner WHERE partner_email='$username'";
$resultpartnerid = $conn->query($sqlpartnerid);
$rowid = $resultpartnerid->fetch_assoc();


$sql = "SELECT * FROM booking
join hotel on booking.hotel_id = hotel.hotel_id
join room on booking.room_id = room.room_id
join roomtype on room.roomtype_id = roomtype.roomtype_id  
join partner on hotel.partner_id = partner.partner_id 
join customer on booking.customer_id = customer.customer_id where partner.partner_id = $rowid[partner_id]";
$result = $conn->query($sql);

// close connection
mysqli_close($conn);
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
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 5px;
            max-width: 100%;
            /* กำหนดความกว้างสูงสุดเป็น 600px */
            height: 100%;
            overflow: auto;
        }

        .cover {
            background-color: #ffffff;
            width: 95%;
            height: 780px;
            margin: auto;
            margin-bottom: 1%;
            flex-shrink: 0;
            border-radius: 20px;
            padding: 1%;
            font-family: 'Athiti', sans-serif;
        }

        h2 {
            text-align: center;
        }

        td,
        th {
            border-bottom: 2px solid #ACACAC;
            padding: 5px;
        }
    </style>

</head>

<body>
    <nav>
        <a href="partner_page.php"><img src="logo.png" width="90px" height="80px"></a>
        <ul>
            <div class="navbar-nav">
                <li><a href="partner_page.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">หน้าหลัก</button></a></li>
                <li><a href="partnerlist.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #59A3B4; background-color: #ffffff; font-size: 100%;">ข้อมูลการจองที่พัก</button></a></li>
                <li><a href="addhotel.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">จัดการข้อมูลที่พัก</button></a></li>
                <li><a href="addroomtype.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">เพิ่มห้องพัก</button></a></li>
                <li><a href="partnerpayment.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">ช่องทางการรับเงิน</button></a></li>

                <li class="dropdown-link">
                    <a href=""><svg width="30" height="30" viewBox="0 0 35 35">
                            <path d="M35 0H0V3.2H35V0Z" fill="black" />
                            <path d="M35 14.3999H0V17.5999H35V14.3999Z" fill="black" />
                            <path d="M35 28.7999H0V31.9999H35V28.7999Z" fill="black" />
                        </svg>
                    </a>
                    <ul class="dropdown">
                        <li><a href="index.php"><button type="button" class="btn btn-outline-light text-dark" style="text-align: center; width: 100%;font-size: 100%;">ออกจากระบบ</button></a></li>
                    </ul>
        </ul>
        </li>
        </div>
        </div>
        </ul>
    </nav>


    <br><br><br><br>

    <div class="cover">
        <div class="tile" id="tile-1">
            <h2>รายการจอง</h2>
            <br>

            <?php

            if ($result->num_rows > 0) {
                echo '<table class="table"><tr><th>ข้อมูลผู้จอง</th><th>วันเช็คอิน</th><th>วันเช็คเอาท์</th><th>ราคา</th><th>สถานะ</th><th>เพิ่มเติม</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . (isset($row['customer_firstname']) ? $row['customer_firstname'] : "") . ' ' . (isset($row['customer_lastname']) ? $row['customer_lastname'] : "") . "</td>";
                    echo "<td>" . (isset($row['check_in_time']) ? $row['check_in_time'] : "") . "</td>";
                    echo "<td>" . (isset($row['check_out_time']) ? $row['check_out_time'] : "") . "</td>";
                    echo "<td>" . (isset($row['room_price']) ? $row['room_price'] : "") . "</td>";
                    if ($row['booking_status'] == 1) {
                        echo "<td>ยืนยันการจอง</td>";
                    } else {
                        echo "<td>รอดำเนินการ</td>";
                    }
                    echo "<td><a href='partnerdetail.php?booking_id=" . $row['booking_id'] . "'>รายละเอียด</a></td>";
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