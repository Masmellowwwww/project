<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script></script>
</head>
<body>
  
</body>
</html>
<?php
require_once 'connection.php';

session_start();
$username = $_SESSION['username'];

$bank = $_POST['checkbox_name'];
$bank = implode(",", $bank);
$num_bank = $_POST['bank_number'];



$sqlnumbank = "UPDATE partner SET bank_number='$num_bank' WHERE partner_email='$username'";
$sqlcatebank = "UPDATE partner SET bank='$bank' WHERE partner_email='$username'";



if ($conn->query($sqlnumbank) == TRUE AND $conn->query($sqlcatebank) == TRUE) {
  echo "<script>
  alert('ระบบได้ทำการบันทึกเรียบร้อย');
  window.location.href = 'partner_page.php'; 
</script>";
   // Close connection
   mysqli_close($conn);
    
    
} else {
    echo "ข้อผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
    header("Location: partner_page.php");
    // Close connection
    mysqli_close($conn);
}



?>