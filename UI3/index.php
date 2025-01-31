<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>log in</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <style>
     @import url('https://fonts.googleapis.com/css2?family=Athiti&display=swap');

     @media screen and (max-width: 640px) {
            body{width: 100%;
              

            }
            .container-fluid {
        flex-direction: column;
        padding: 10px;
        }
      }
    body {
      background-image: url("https://i.pinimg.com/564x/79/34/96/793496413f2024536541d6384593d465.jpg");
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: cover;
    }


    /* Control the left side */
    #leftHalf {
      float: left;
      background-color: #F6F6F6;
      text-align: left;
      height: 80%;
      width: 45%;
      margin-left: 20px;
      flex-shrink: 0;
      border-radius: 10px;
      font-size: 18px;
      padding: 25px;
      margin-top: 5%;
      font-family: 'Athiti', sans-serif;
    }

    /* Control the right side */
    #rightHalf {

      margin-left: 50%;
      height: 60px;
    }

    /* .btn-primary {
    background-color: rgb(55, 145, 229);
    border: rgb(55, 145, 229);
  } */

    .login {
      background-color: rgb(55, 145, 229);
      border: rgb(55, 145, 229);
    }

    .regis {
      background-color: #fff;
      border: rgb(61, 119, 177);
      color: rgb(55, 145, 229);
    }

    h2 {
      text-align: center;
    }
  </style>
</head>

<body class="text-center">
  <section class="vh-100">
    <div class="container-fluid">
      <div id="leftHalf">
        <h2>เข้าสู่ระบบ</h2>
        <main class="form-signin">
          <form  method="post">
            <div class="form-group">
              <label for="email">อีเมล</label><br>
              <input class="form-control" type="text" name="username"value="@gmail.com" placeholder="อีเมล">
            </div>

            <div class="form-group">
              <label for="password">รหัสผ่าน</label><br>
              <input class="form-control" type="password" name="password" placeholder="รหัสผ่าน">
            </div><br>

            <div class="form-group sign-in">
              <button type="submit" name="login" value="customer" class="login customer w-100 btn btn-md btn-primary">เข้าสู่ระบบผู้จอง</button>
            </div><br>

            <div class="form-group sign-in">
              <button type="submit" name="login" value="partner" class="login partner w-100 btn btn-md btn-primary" >เข้าสู่ระบบผู้ปล่อยเช่า</button><br>
              
            </div><br>

            <div class="form-group">
              <button type="submit" name="signup_page" id="signup_page" class="regis w-100 btn btn-md btn-primary">ยังไม่มีบัญชี? สมัครสมาชิก</button>
            </div><br>

            <div class="form-group">
              <button type="submit" name="login" value="manager" class="regis w-100 btn btn-md btn-primary" >เข้าสู่ระบบผู้จัดการ</button>
            </div>
          </form>
        </main>
      </div>

      <div id="rightHalf">
        <div class="centered">
          <img src="logo.png" id="logo" width="250px" height="250px">
        </div>
      </div>
    </div>
  </section>

  

  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rest_in_place3";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    
    session_start(); // เริ่มเซสชัน
    $username = $_POST["username"];
    $_SESSION['username'] = $username;
    $password = $_POST["password"];

  
    if(isset($_POST['signup_page'])) {
    $signup_page = $_POST['signup_page'];
    header("Location: http://10.0.15.21/dsba/65070172/Project/UI1/signup_page.php");
    }
    
  
    if (isset($_POST['login'])) {
    $login_type = $_POST['login'];
    $sql = "";

    if ($login_type == 'customer') {
      $sql = "SELECT * FROM customer WHERE customer_email='$username' AND customer_password='$password'";
    } elseif ($login_type == 'partner') {
      $sql = "SELECT * FROM partner WHERE partner_email='$username' AND partner_password='$password'";
    } elseif ($login_type == 'manager') {
      $sql = "SELECT * FROM manager WHERE manager_email='$username' AND manager_password='$password'";
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION["username"] = $username;
      $_SESSION["user_type"] = $login_type;
      $_SESSION["user_id"] = $row["{$login_type}_id"];

      // กำหนด URL สำหรับหน้าปลายทาง แยกตามประเภทผู้ใช้
      $redirect_url = "";

      if ($login_type == 'customer') {
        $redirect_url = "customer_page.php";
      } elseif ($login_type == 'partner') {
        $redirect_url = "partner_page.php";
      } elseif ($login_type == 'manager') {
        $redirect_url = "manager_page.php";
      }
      
      header("Location: $redirect_url");
      exit();
    } else {
      echo '<script>alert("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");</script>';
    }

    // Close connection
    mysqli_close($conn);
  }

  ?>
</body>


</html>