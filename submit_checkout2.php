<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // เริ่มต้น session

include('connect.php'); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้าง Booking ID แบบสุ่ม
function generateBookingID($length = 5) { // ตั้งค่าความยาวที่ต้องการ (เช่น 5)
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$booking_id = generateBookingID();

// รับข้อมูลจากฟอร์ม
$email = $_SESSION['Email'];
$quantity = $_POST['quantity'];
$date_input = $_POST['date_input'];
$time_input = $_POST['time_input'];
$price_per_guest = $_POST['Price'];
$workshop = $_POST['Workshop'];

// แปลง $date_input เป็นรูปแบบ Y-m-d
$date = date('Y-m-d', strtotime($date_input));

// ดึงเวลาเริ่มต้นจากช่วงเวลา
$time_parts = explode(' - ', $time_input);
$start_time = $time_parts[0];

// รวมเป็น DateTime
$booking_time = date('Y-m-d H:i:s', strtotime("$date $start_time"));

// คำนวณราคา
$total_price = $price_per_guest * $quantity;

// รับข้อมูลการชำระเงิน
$payment_method = $_POST['payment'];

// วันที่และเวลาปัจจุบัน
$current_datetime = date('Y-m-d H:i:s');

// สร้างคำสั่ง SQL
$sql = "INSERT INTO Booking (Booking_ID, Email, Date_Time, Workshop, Quantity, Total_Price, Payment_Method, Booking_Time)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// เตรียมคำสั่ง SQL
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// bind parameters
$stmt->bind_param("ssssdsss", $booking_id, $email, $current_datetime, $workshop, $quantity, $total_price, $payment_method, $booking_time);

// ดำเนินการบันทึกข้อมูล
if ($stmt->execute()) {
    header('Location: ticket.php');
    exit();
} else {
    echo "Error executing statement: " . $stmt->error . "<br>";
}

// ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();
?>