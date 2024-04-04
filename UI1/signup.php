<?php
require_once 'connection.php';



// รับค่าอีเมลจากฟอร์ม
$signup = $_POST['signup'];
$signup = implode(",", $signup);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$c_pass = $_POST['c_pass'];
$tel = $_POST['tel'];


if ($signup == 'customer') {
    $sqlcustomer = "SELECT * FROM customer WHERE customer_email = '$email'";
    $resultcustomer = mysqli_query($conn, $sqlcustomer); // ส่งคำสั่ง SQL ไปยังฐานข้อมูล

    $errors = array(); // สร้างอาร์เรย์เพื่อเก็บข้อผิดพลาด

    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($tel)) {
        // มีข้อมูลที่ไม่ครบถ้วน
        echo "<script>alert('โปรดกรอกข้อมูลให้ครบถ้วน'); window.location.href = 'signup_page.php'; </script>";
        exit;
    } else {

        // ตรวจสอบรูปแบบของอีเมล
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "รูปแบบอีเมลไม่ถูกต้อง";
        }

        // ตรวจสอบความยาวของรหัส (ตั้งแต่ 6 ตัวอักษรขึ้นไป)
        if (strlen($password) < 6 || strlen($c_pass) < 6) {
            $errors[] = "รหัสควรมีอย่างน้อย 6 ตัวอักษร";
        }

        // ตรวจสอบว่ารหัสผ่านและยืนยันรหัสผ่านตรงกัน
        if ($password !== $c_pass) {
            $errors[] = "รหัสผ่านไม่ตรงกับยืนยันรหัสผ่าน";
        }

        // ตรวจสอบรูปแบบของเบอร์โทรศัพท์
        if (!preg_match('/^0[0-9]{9}$/', $tel)) {
            $errors[] = "รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง";
        }
        // ถ้ามีข้อผิดพลาด แสดงข้อความข้อผิดพลาด
        if (!empty($errors)) {
            echo "<script>alert('ข้อผิดพลาด:\\n" . implode("\\n", $errors) . "'); window.location.href = 'signup_page.php'; </script>";
            exit;
        }
        if ($resultcustomer) {
            // ตรวจสอบว่ามีข้อมูลผู้ใช้ด้วยอีเมลนี้หรือไม่
            if ($resultcustomer->num_rows > 0) {
                // มีอีเมลนี้ในฐานข้อมูล
                echo "<script>alert('อีเมลนี้มีอยู่ในระบบ');
                window.location.href = 'signup_page.php' </script>";
                exit; // ตัวอย่างสุดท้ายควรมี exit เพื่อหยุดการทำงานของสคริปต์
            } else {

                // ไม่มีอีเมลนี้ในฐานข้อมูล
                // บันทึกอีเมลลงในฐานข้อมูล
                $sqlcus = "INSERT INTO customer (customer_firstname, customer_lastname, customer_email, customer_password, customer_phone_num) 
                VALUES ('$fname', '$lname', '$email', '$password', '$tel')";
                if (mysqli_query($conn, $sqlcus)) {
                    echo "<script>
                    alert('บันทึกอีเมลสำเร็จ');
                    window.location.href = 'http://10.0.15.21/dsba/65070172/Project/UI3/';
                  </script>";
                    exit; // ตัวอย่างสุดท้ายควรมี exit เพื่อหยุดการทำงานของสคริปต์
                }
            }
        }
    }
}


if ($signup == 'partner') {
    $sqlpartner = "SELECT * FROM partner WHERE partner_email = '$email'";
    $resultpartner = mysqli_query($conn, $sqlpartner); // ส่งคำสั่ง SQL ไปยังฐานข้อมูล

    $errors = array(); // สร้างอาร์เรย์เพื่อเก็บข้อผิดพลาด

    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($tel)) {
        // มีข้อมูลที่ไม่ครบถ้วน
        echo "<script>alert('โปรดกรอกข้อมูลให้ครบถ้วน'); window.location.href = 'signup_page.php'; </script>";
        exit;
    } else {

        // ตรวจสอบรูปแบบของอีเมล
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "รูปแบบอีเมลไม่ถูกต้อง";
        }

        // ตรวจสอบความยาวของรหัส (ตั้งแต่ 6 ตัวอักษรขึ้นไป)
        if (strlen($password) < 6 || strlen($c_pass) < 6) {
            $errors[] = "รหัสควรมีอย่างน้อย 6 ตัวอักษร";
        }

        // ตรวจสอบว่ารหัสผ่านและยืนยันรหัสผ่านตรงกัน
        if ($password !== $c_pass) {
            $errors[] = "รหัสผ่านไม่ตรงกับยืนยันรหัสผ่าน";
        }

        // ตรวจสอบรูปแบบของเบอร์โทรศัพท์
        if (!preg_match('/^0[0-9]{9}$/', $tel)) {
            $errors[] = "รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง";
        }
        // ถ้ามีข้อผิดพลาด แสดงข้อความข้อผิดพลาด
        if (!empty($errors)) {
            echo "<script>alert('ข้อผิดพลาด:\\n" . implode("\\n", $errors) . "'); window.location.href = 'signup_page.php'; </script>";
            exit;
        }
        // ตรวจสอบว่ามีข้อมูลผู้ใช้ด้วยอีเมลนี้หรือไม่
        if ($resultpartner->num_rows > 0) {
            // มีอีเมลนี้ในฐานข้อมูล
            echo "<script>alert('อีเมลนี้มีอยู่ในระบบ');window.location.href = 'signup_page.php' </script>";
            exit; // ตัวอย่างสุดท้ายควรมี exit เพื่อหยุดการทำงานของสคริปต์
        } else {
            // ไม่มีอีเมลนี้ในฐานข้อมูล
            // บันทึกอีเมลลงในฐานข้อมูล
            $sqlpart = "INSERT INTO partner (partner_firstname, partner_lastname, partner_email, partner_password, partner_phone_num) 
                VALUES ('$fname', '$lname', '$email', '$password', '$tel')";
            if (mysqli_query($conn, $sqlpart)) {
                echo "<script>
                    alert('บันทึกอีเมลสำเร็จ');
                    window.location.href = 'http://10.0.15.21/dsba/65070172/Project/UI3/';
                  </script>";
                exit; // ตัวอย่างสุดท้ายควรมี exit เพื่อหยุดการทำงานของสคริปต์
            } else {
                echo "<script>
                    alert('สมัครไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                    window.location.href = 'http://10.0.15.21/dsba/65070172/Project/UI3/';
                  </script>" . mysqli_error($conn);
            }
        }
    }
}



mysqli_close($conn);
?>