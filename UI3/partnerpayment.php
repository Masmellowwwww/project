
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

        @media screen and (max-width: 640px) {
            body{width: 100%;

            }
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
            height: 780px;
            width: 95%;
            margin: auto;
            margin-bottom: 1%;
            flex-shrink: 0;
            border-radius: 20px;
            padding: 1%;
            font-family: 'Athiti', sans-serif;

            
        }

        
        .border-container {
            margin-left: 2%;
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
                <li><a href="addroomtype.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #000; background-color: #ffffff; font-size: 100%;">เพิ่มห้องพัก</button></a></li>
                <li><a href="partnerpayment.php"><button type="button" class="btn btn-light" style="text-align: center; width: 100%; color: #59A3B4; background-color: #ffffff; font-size: 100%;">ช่องทางการรับเงิน</button></a></li>
        
                <li class="dropdown-link">
                    <a href=""><svg width="30" height="30" viewBox="0 0 35 35">
                            <path d="M35 0H0V3.2H35V0Z" fill="black" />
                            <path d="M35 14.3999H0V17.5999H35V14.3999Z" fill="black" />
                            <path d="M35 28.7999H0V31.9999H35V28.7999Z" fill="black" />
                        </svg>
                    </a>
                    <ul class="dropdown">
                        <li><a href="index.php"><button type="button"
                        class="btn btn-outline-light text-dark" style="text-align: center; width: 100%;  font-size: 100%;">ออกจากระบบ</button></a></li>
                    </ul>
                    </ul>
                </li>
        </div>
        </ul>
    </nav>
    <br><br><br><br>
    <div class="cover">
        
  
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


  <form action="updatebank.php" method="post">
  <div class="border-container">
    <div class="payment">
      <h2>เลือกช่องทางการรับเงิน</h2><br>
      <div class="row">
        <div class="col-sm-3">
        <input type="radio" name="checkbox_name[]" value="กสิกร" >
        <label for="bank">ธนาคารกสิกร</label>
            <img id="bank" src="https://bluporthuahin.com/wp-content/uploads/2020/01/icon_kbank.png" style="width: 60px; height: 60px;">
      </div>

      <div class="col-sm-3">
      <input type="radio" name="checkbox_name[]" value="กรุงเทพ">
      <label for="bank">ธนาคารกรุงเทพ</label>
            <img id="bank" src="https://awards.brandingforum.org/wp-content/uploads/2016/10/BBL-New-EN.jpg" style="width: 60px; height: 60px;">
      </div>

      <div class="col-sm-3">
      <input type="radio" name="checkbox_name[]" value="ไทยพาณิชย์">
      <label for="bank">ธนาคารไทยพาณิชย์</label>
            <img id="bank" src="https://play-lh.googleusercontent.com/fRj3gVsSGNq1izt8NON0l6Cdqt2dEK4IRhInLoPLlunZMCA0wwOmVnaeDYQEZ8ejWQ" style="width: 60px; height: 60px;">
      </div>

      <div class="col-sm-3">
      <input type="radio" name="checkbox_name[]" value="กรุงไทย">
      <label for="bank">ธนาคารกรุงไทย</label>
            <img id="bank" src="https://i0.wp.com/www.kanjanabaramee.org/wp-content/uploads/2017/11/logo_ktb_sqr.jpg?fit=380%2C380&ssl=1" style="width: 60px; height: 60px;">
        
      </div>
    </div>
    
    <label for="bank_number">เลขที่บัญชี</label><br>
    <input type="text" name="bank_number" id="bank_number" >
    <input type="submit" value="ยืนยัน" id="submit" onclick="return bank_check()">
    
    <h5>
        <input type="radio" name="payment" value="กรุงไทย">
        <label for="bank">โอนเงินเข้าบัญชีธนาคาร</label>
    </h5>
    <p>หลังจากที่ลูกค้าเช็คเอาต์ เราจะโอนเงินเข้าบัญชีธนาคารของท่านโดยตรง</p>
    
  </div>

  </form>

  <script>
    function bank_check() {
    var accountNumber = document.getElementById("bank_number").value;

    // ตรวจสอบว่าหมายเลขบัญชีมีความยาว 10 หลัก
    if (accountNumber.length !== 10) {
        alert("เลขบัญชีต้องมีความยาว 10 หลัก");
        return false;
    }

    // ตรวจสอบว่าหมายเลขบัญชีประกอบด้วยตัวเลขเท่านั้น
    if (!/^\d+$/.test(accountNumber)) {
        alert("เลขบัญชีต้องประกอบด้วยตัวเลขเท่านั้น");
        return false;
    }

    // นำหมายเลขบัญชีที่ไม่รวมหลักตรวจสอบไปคำนวณ
    var accountWithoutChecksum = accountNumber.substring(0, 9);

    // คำนวณหลักตรวจสอบ
    var sum = 0;
    for (var i = 0; i < accountWithoutChecksum.length; i++) {
        var digit = parseInt(accountWithoutChecksum.charAt(i));
        if (i % 2 === 0) {
            digit *= 2;
            if (digit > 9) {
                digit -= 9;
            }
        }
        sum += digit;
    }

    var checksum = (10 - (sum % 10)) % 10;

    // เปรียบเทียบหลักตรวจสอบที่คำนวณกับหลักตรวจสอบที่ในหมายเลขบัญชี
    var actualChecksum = parseInt(accountNumber.charAt(9));

    if (checksum === actualChecksum) {
        return true;
    } else {
        alert("เลขบัญชีไม่ถูกต้อง");
        return false;
    }
}



  </script>

  

</body>

</html>