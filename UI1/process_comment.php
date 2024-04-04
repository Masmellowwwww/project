<?php
require_once 'connection.php'; // เชื่อมต่อกับฐานข้อมูล

session_start();
$fdate = $_SESSION['fdate'];
$ldate = $_SESSION['ldate'];
$quantityAdults = $_SESSION['quantityAdults'];
$quantityRoom = $_SESSION['quantityRoom'];
$commentscore = $_POST["rate"];
$commentText = $_POST["comment"];



// ทำการบันทึกคอมเมนต์ลงในฐานข้อมูล (ตัดส่วนนี้ต้องเขียนอย่างถูกต้องตามโครงสร้างของฐานข้อมูลของคุณ)
$insertCommentQuery = "INSERT INTO comments (comment_score,comment_description,hotel_id,customer_id) VALUES ('$commentscore','$commentText', '1'";
$result = $conn->query($insertCommentQuery);

if ($result) {
    echo '<script>alert("บันทึกคอมเมนต์สำเร็จ");';
    echo 'window.location = "each_hotel.php";</script>';
    exit();
} else {
    echo '<script>alert("เกิดข้อผิดพลาดในการบันทึกคอมเมนต์")</script>';
}





// Close connection
mysqli_close($conn);
?>