<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');

        #rightHalf {
            margin-left: 50%;
            height: 60px;
        }

        #leftHalf {
            float: left;
            background-color: #F6F6F6;
            text-align: left;
            height: 86%;
            width: 50%;
            margin-left: 1%;
            margin-top: 2%;
            flex-shrink: 0;
            border-radius: 10px;
            font-size: 18px;
            padding: 1%;
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

        nav ul {
            float: right;
            background-color: #ffffff;
        }

        nav ul li a:hover {
            color: #3c8f8c;
        }

        li {
            color: #59A3B4;
            text-align: center;
            font-family: 'Athiti', sans-serif;
            font-size: 24px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        nav ul li {
            font-family: 'Athiti', sans-serif;
            display: inline-block;
            font-size: 19px;
            line-height: 45px;
            padding: 0 15px;
        }

        a {
            text-decoration: none;
        }

        body {
            background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
            background-size: cover;
            font-family: 'Athiti', sans-serif;
        }

        .flex-container {
            display: flex;
            flex-direction: row;
            /* จัดวางแบบแนวนอน */
            align-items: center;
            /* จัดให้อยู่ตรงกลางแนวตั้ง */
        }

        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 3px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: 'Athiti', sans-serif;
        }

        .center {
            text-align: center;
            font-family: 'Athiti', sans-serif;
        }

        .signup_as {
            font-family: 'Athiti', sans-serif;
            background-color: #59A3B4;
            border-radius: 10px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            width: 50%;
            height: 50px;
            flex-shrink: 0;
            color: #ffffff;
            font-size: 20px;
        }

        .signup_as:hover {
            background-color: #ffffff;
            color: #59A3B4;
        }

        
        .signin_link {
            font-family: 'Athiti', sans-serif;
            background-color: #ffffff;
            border-radius: 10px;
            width: 100%;
            height: 50px;
            flex-shrink: 0;
            font-size: 20px;
        }
        
        .signin_link:hover {
            background-color: #ababab;
            color: #ffffff;
        }

        .centered {
            position: absolute;
            top: 30%;
            left: 60%;
        }

    </style>
</head>

<body>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- JavaScript Bootstrap และ jQuery (ถ้าคุณใช้ Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <nav>
        <a href="main_page.php"><img src="logo.png" width="90px" height="90px"></a>
    </nav>
    <p id="rightHalf"><img src="logo.png" width="400px" height="400px" class="centered"></p>
    <form action="signup.php" method="post" >
       <div class="form-group" id="leftHalf" onsubmit="return setSignupType()" >
       <h2 class="center" style="font-size: 300%;"><strong>สมัครสมาชิก</strong></h2>
       <input type="hidden" name="signup_type" id="signup_type" value="">
         <div class="form-row">
                <div class="col-sm-6">
                    <p>
                        <label for="fname">ชื่อ</label>
                        <input type="text" name="fname" id="fname" class="form-control bg-white" placeholder= "กรุณากรอกชื่อ" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 50%">
                    </p>

                </div>
                <div class="col-sm-6">
                    <p>
                        <label for="lname">นามสกุล</label>
                        <input type="text" name="lname" id="lname" class="form-control bg-white" placeholder= "กรุณากรอกนามสกุล" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 50%;">
                    </p>
                </div>

                <div class="col-lg-12">
                    <!-- เพิ่มฟิลด์เพิ่มเติมที่เกี่ยวกับผู้สมัครตามความเหมาะสม -->
                    <p> 
                        <label for="tel">หมายเลขโทรศัพท์</label><br>
                        <input type="text" name="tel" id="tel" class="form-control bg-white" placeholder= "กรุณากรอกหมายเลขโทรศัพท์" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                    </p>
                    <p>
                        <label for="email">อีเมล</label>
                        <br>
                        <input type="text" name="email" id="email" class="form-control bg-white" placeholder= "กรุณากรอกอีเมล" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                    </p>
                    <p>
                        <label for="password">รหัสผ่าน</label><br>
                        <input type="password" name="password" id="password" class="form-control bg-white"placeholder= "กรุณากรอกรหัสผ่าน" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                    </p>
                    <p>
                        <label for="c_pass">ยืนยันรหัสผ่าน</label><br>
                        <input type="password" name="c_pass" id="c_pass" class="form-control bg-white" placeholder= "กรุณายืนยันรหัสผ่าน" style="border-radius: 5px; border: 1px solid #ACACAC; background: #FFF; width: 100%; height: 13%;">
                    </p>

                </div>
                
                <div class="col-lg-6">
                <button type="submit" value="customer" name="signup[]" class="btn btn-dark mt-4" style="width: 100%; height: 70%; background-color: #59A3B4; border: 1px solid #59A3B4;"
                        onclick="setSignupType('')">สมัครสมาชิกผู้จอง</button>
                </div>

                <div class="col-lg-6">
                <button type="submit" value="partner" name="signup[]" class="btn btn-dark mt-4" style="width: 100%; height: 70%; background-color: #59A3B4; border: 1px solid #59A3B4;"
                        onclick="setSignupType('')">สมัครสมาชิกผู้เช่า</button>
                    <br>
                </div> 
                <div class="col-lg-12">
                   <a href="http://10.0.15.21/dsba/65070172/Project/UI3/">
                   <button type="button" value="มีบัญชีอยู่แล้ว? เข้าสู่ระบบ" class="btn btn-right mt-4" style="text-align: center; width: 100%; color: #59A3B4">มีบัญชีอยู่แล้ว?
                            เข้าสู่ระบบ</button>
                    </a>
                </div>
    </div>
        </div>
    </form>
   







   

</body>

</html>