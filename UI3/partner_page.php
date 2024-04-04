<?php
require_once 'connection.php';
session_start();
$username = $_SESSION['username'];

$sqlpartnerid = "SELECT partner_id FROM partner WHERE partner_email='$username'";
$resultpartnerid = $conn->query($sqlpartnerid);
$row = $resultpartnerid->fetch_assoc();

$sqlname = "SELECT partner_firstname, partner_lastname FROM partner WHERE partner_id = $row[partner_id]";
$resultname = $conn->query($sqlname);

$sqlhotel = "SELECT hotel_name FROM hotel WHERE hotel_id = '$row[partner_id]'";
$resulthotel = $conn->query($sqlhotel);

$sqlwait = "SELECT COUNT(booking_status) as wait FROM booking WHERE hotel_id = '$row[partner_id]' AND booking_status = 0";
$resultwait = $conn->query($sqlwait);

$sqlconf = "SELECT COUNT(booking_status) as conf FROM booking WHERE hotel_id = '$row[partner_id]' AND booking_status = 1";
$resultconf = $conn->query($sqlconf);

$sqlincome = "SELECT SUM(amount) as income FROM booking JOIN payment ON booking.booking_id=payment.payment_id WHERE booking.hotel_id = '$row[partner_id]' AND booking.booking_status = 1;";
$resultincome = $conn->query($sqlincome);


// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Title Here</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');

    * {
      font-family: 'Athiti', sans-serif;
    }

    body {
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
            background-size: 100%;
            height: 160%;
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

    form {
      z-index: 99;
      margin-top: 80px;
      margin-bottom: 20px;
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
      height: 50px;
      align-items: center;
    }

    .dropdown-link:hover .dropdown {
      top: 90%;
      opacity: 1;
      visibility: visible;
    }

    .dropdown-link:hover a i {
      transform: rotate(-180deg);
    }


    .row {
      position: relative;
      padding: px;
      padding-left: 30px;
      margin-top: 20px;
      width: 100%;
    }

    .col-sm-4 {
      text-align: center;
      /* Center the content */
    }

    .col-md-6 {
      margin-top: 20px;
      text-align: center;
      /* Center the content */
    }

    .col-md-12 {
      margin-top: 20px;
      text-align: center;
      /* Center the content */
    }

    h2 {
      font-size: 3rem;
      /* Updated the font size property */
    }
    h3 {
      font-size: 4rem;
      /* Updated the font size property */
    }
  </style>
</head>

<body>

<nav>
        <a href="partner_page.php"><img src="logo.png" width="90px" height="80px"></a>
        <ul>
        <div class="navbar-nav">
        <li><a href="partner_page.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #59A3B4; background-color: #ffffff; font-size: 100%;">หน้าหลัก</button></a></li>
                <li><a href="partnerlist.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">ข้อมูลการจองที่พัก</button></a></li>
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
                        <li><a href="index.php"><button type="button"
                        class="btn btn-outline-light text-dark" style="text-align: center; width: 100%;font-size: 100%;">ออกจากระบบ</button></a></li>
                    </ul>
                    </ul>
                </li>
        </div>
        </ul>
    </nav>

  <form  method="post">
    <div class="container-fluid">
      <div class="row text-center">
        <div class="col-md-6">
          <div class="card card-bd">
            <div class="card-border"></div>
            <div class="card-body box-style">
              <div class="media align-items-center">
                <h2 id="process">ชื่อ - นามสกุล</h2>
                <h3> <?php
                      if ($resultname->num_rows > 0) {
                        // output data of each row
                        $row = $resultname->fetch_assoc();
                        echo $row['partner_firstname'] . " " . $row['partner_lastname'];
                      } else {
                        echo "-";
                      }
                      ?> </h3>
                <svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-bd">
            <div class="card-border"></div>
            <div class="card-body box-style">
              <div class="media align-items-center">
                <h2 id="conferm">โรงแรม</h2>
                <h3> <?php
                      if ($resulthotel->num_rows > 0) {
                        // output data of each row
                        $row = $resulthotel->fetch_assoc();
                        echo $row['hotel_name'];
                      } else {
                        echo "-";
                      }
                      ?> </h3>
                <svg width="150" height="150" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-bd">
            <div class="card-border"></div>
            <div class="card-body box-style">
              <div class="media align-items-center">
                <h2 id="process">รอดำเนินการ</h2>
                <h3> <?php
                      if ($resultwait->num_rows > 0) {
                        // output data of each row
                        $row = $resultwait->fetch_assoc();
                        echo $row['wait'];
                      } else {
                        echo "-";
                      }
                      ?> </h3>
                <svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-bd">
            <div class="card-border"></div>
            <div class="card-body box-style">
              <div class="media align-items-center">
                <h2 id="conferm">ยืนยันการจอง</h2>
                <h3> <?php
                      if ($resultconf->num_rows > 0) {
                        // output data of each row
                        $row = $resultconf->fetch_assoc();
                        echo $row['conf'];
                      } else {
                        echo "-";
                      }
                      ?> </h3>
                <svg width="150" height="150" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card card-bd">
            <div class="card-border"></div>
            <div class="card-body box-style">
              <div class="media align-items-center">
                <h2 id="total_price">รายได้ทั้งหมด</h2>
                <h3> <?php
                      if ($resultincome->num_rows > 0) {
                        // output data of each row
                        $row = $resultincome->fetch_assoc();
                        if ($row['income'] == NULL) {
                          echo 0;
                        } else {
                          echo $row['income'];
                        }
                      } else {
                        echo "-";
                      }
                      ?> </h3>
                <svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>




  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>









</body>

</html>