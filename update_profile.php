<?php
session_start(); // ✅ ต้องมีบรรทัดนี้
ob_start();  // เริ่มบัฟเฟอร์ข้อมูล
include('connect.php');

// รับค่าจาก POST
$username     = $_POST["username"] ?? '';
$first_name   = $_POST["first_name"] ?? '';
$last_name    = $_POST["last_name"] ?? '';
$email        = $_SESSION['Email'] ?? '';
$phone        = $_POST["phone"] ?? '';
$card_name    = $_POST["card_name"] ?? '';
$card_number  = $_POST["card_number"] ?? '';
$expiry       = $_POST["expiry"] ?? '';
$cvv          = $_POST["cvv"] ?? '';

// ตรวจสอบว่าข้อมูลหลักไม่ว่าง
if (!$email) {
    die("Missing required fields.");
}

// ตรวจสอบว่ามีไฟล์รูปภาพที่อัปโหลดหรือไม่
$profile_image = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $profile_image = file_get_contents($_FILES['profile_image']['tmp_name']);
}

// เตรียม SQL สำหรับอัปเดตข้อมูล
if ($profile_image !== null) {
    $stmt = $conn->prepare("UPDATE Member SET 
        First_Name = ?, 
        Last_Name = ?, 
        Phone_Number = ?, 
        Profile = ?,
        Username= ?
        WHERE Email = ?");

    $null = NULL; // ใช้ตัวแปรสำหรับ BLOB
    $stmt->bind_param("sssbss", $first_name, $last_name, $phone, $null,$username, $email);
    $stmt->send_long_data(3, $profile_image); // index 3 คืออันที่ 4 ของ bind_param
}
 else {
    $stmt = $conn->prepare("UPDATE Member SET 
        First_Name = ?, 
        Last_Name = ?, 
        Phone_Number = ?, 
        Username= ?
        WHERE Email = ?");
    $stmt->bind_param("sssss", $first_name, $last_name, $phone, $username, $email);
}

if (!$stmt->execute()) {
    die("Update failed: " . $stmt->error);
}

// ถ้ากรอกข้อมูลบัตรเครดิต ให้เพิ่มในตาราง Credit_Cards
if ($card_name && $card_number && $expiry && $cvv) {
    $sql2 = "INSERT INTO Credit_Cards 
             (Name, Credit_Card_Number, MonthYear, CVV, Email)
             VALUES 
             (?, ?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("sssss", $card_name, $card_number, $expiry, $cvv, $email);

    if (!$stmt2->execute()) {
        die("Card insert failed: " . $stmt2->error);
    }
}

$conn->close();
header("Location: home_after_login.php");
exit();

ob_end_flush();  // สิ้นสุดการบัฟเฟอร์ข้อมูล
?>
