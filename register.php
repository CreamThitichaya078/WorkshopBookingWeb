<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connect.php"; // เชื่อมต่อฐานข้อมูล

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // รับค่าจากฟอร์ม
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // เข้ารหัสรหัสผ่าน
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
    date_default_timezone_set('Asia/Bangkok');
    $current_datetime = date("Y-m-d H:i:s");

    // เพิ่มข้อมูลผู้ใช้ลงฐานข้อมูล
    $sql = "INSERT INTO Member (First_Name, Last_Name, Email, Username,Date_Time,Profile, Password) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    $profile = ""; // หรือค่าที่คุณต้องการจริง ๆ
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $username,$current_datetime, $profile,     $password);
    // เพิ่มข้อมูลผู้ใช้ลงฐานข้อมูล
    $sql = "INSERT INTO Member (First_Name, Last_Name, Email, Username, Password) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $username, $password);

    if ($stmt->execute()) {
        //echo "ลงทะเบียนสำเร็จ!";
        header("Location: loginNew.php");
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }
}
?>
