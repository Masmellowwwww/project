<?php 
require_once 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // เริ่ม session เฉพาะเมื่อ session ยังไม่เริ่มต้น
}

    $going_to = $_POST['going_to'];
    $fdate = $_POST['fdate'];
    $ldate = $_POST['ldate'];
    $quantityRoom = $_POST['quantityRoom'];
    $quantityAdults = $_POST['quantityAdults'];
    $_SESSION['going_to'] = $going_to;
    $_SESSION['fdate'] = $fdate;
    $_SESSION['ldate'] = $ldate;
    $_SESSION['quantityRoom'] = $quantityRoom;
    $_SESSION['quantityAdults'] = $quantityAdults;
    ?>