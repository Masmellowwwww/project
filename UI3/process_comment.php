<?php
require_once 'connection.php'; // เชื่อมต่อกับฐานข้อมูล

session_start();
$username = $_SESSION['username'];
$fdate = $_SESSION['fdate'];
$ldate = $_SESSION['ldate'];
$quantityAdults = $_SESSION['quantityAdults'];
$quantityRoom = $_SESSION['quantityRoom'];
$commentscore = $_POST["rate"];
$commentText = $_POST["comment"];

$sqlcustomerid = "SELECT customer_id FROM customer WHERE customer_email='$username'";
$resultcustomerid = $conn->query($sqlcustomerid);
$row = $resultcustomerid->fetch_assoc();

$sqlname = "SELECT customer_firstname, customer_lastname FROM customer WHERE customer_id = $row[customer_id]";
$resultname = $conn->query($sqlname);


// ทำการบันทึกคอมเมนต์ลงในฐานข้อมูล (ตัดส่วนนี้ต้องเขียนอย่างถูกต้องตามโครงสร้างของฐานข้อมูลของคุณ)
$insertCommentQuery = "INSERT INTO comments (comment_score,comment_description,hotel_id,customer_id) VALUES ('$commentscore','$commentText', '1', '$row[customer_id]')";
$result = $conn->query($insertCommentQuery);

if ($result) {
    echo '<script>alert("บันทึกคอมเมนต์สำเร็จ");';
    echo 'window.location = "customer_page.php";</script>';
    
} else {
    echo '<script>alert("เกิดข้อผิดพลาดในการบันทึกคอมเมนต์")</script>';
}





// Close connection
mysqli_close($conn);
?>