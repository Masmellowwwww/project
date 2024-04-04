<?php
require_once 'connection.php';

session_start();
$username = $_SESSION['username'];
$room_id = $_SESSION['roomtype_id'];
$hotel_id = $_SESSION['hotel_id'];




// ดึงหมายเลขห้อง (room_id) ที่พร้อมใช้
$sql = "SELECT room.room_id
        FROM room
        WHERE room.hotel_id = {$_SESSION['hotel_id']}
        AND room.roomtype_id = {$_SESSION['roomtype_id']}
        AND NOT EXISTS (
            SELECT 1
            FROM booking
            WHERE booking.room_id = room.room_id
            AND check_in_time <= '{$_SESSION['ldate']}'
            AND check_out_time >= '{$_SESSION['fdate']}'
            AND booking_status = '1'
        )";

$result = mysqli_query($conn, $sql);

if ($result) {
    $roomIds = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $roomIds[] = $row['room_id'];
    }

// ตรวจสอบว่ามีห้องพร้อมใช้พอจำนวนที่คุณต้องการจองหรือไม่
if (count($roomIds) >= $quantityRoom) {
    for ($i = 0; $i < $quantityRoom; $i++) {
        // เลือกหมายเลขห้องอันดับแรกจากรายการ
        $selectedRoomId = array_shift($roomIds);

        // สร้างคำสั่ง SQL สำหรับการเพิ่มข้อมูลการจองลงในฐานข้อมูล
        // เราใช้aค่า booking_id ที่มีค่าเริ่มต้นตลอดการจอง
        $sql = "INSERT INTO booking (booking_id, check_in_time, check_out_time, hotel_id, customer_id, booking_status, room_id)
                VALUES ($bookId, '{$_SESSION['fdate']}', '{$_SESSION['ldate']}', {$_SESSION['hotel_id']}, '{$_SESSION['customer_id']}', '0', $selectedRoomId);";

        // ทำการเพิ่มข้อมูลการจอง
        $result = mysqli_query($conn, $sql);
        
        if ($result){
            // คุณสามารถใช้ค่า $bookId ในการติดตามการจองทั้งหมด
            $_SESSION['bookId'] = $bookId;
            echo "Booking ID: " . $bookId;
            
        }
    }
}
}

?>