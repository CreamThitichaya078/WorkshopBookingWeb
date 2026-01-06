<?php
session_start();
include "connect.php"; // ดึงไฟล์เชื่อมฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ค้นหาผู้ใช้จากฐานข้อมูล
    $sql = "SELECT * FROM Member WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // ตรวจสอบรหัสผ่าน
        if ($password === $user['Password']) {
            $_SESSION['Email'] = $user['Email']; // ✅ ใช้ตัวเล็กให้สอดคล้อง

            // ✅ ถ้าเป็นแอดมิน ให้ไปหน้า admin.php
            if ($email === 'admin@gmail.com' && $password === 'admin1234') {
                header("Location: admin.php");
            } else {
                header("Location: home_after_login.php");
            }
            exit();
        } else {
            echo "<script>alert('รหัสผ่านไม่ถูกต้อง'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('ไม่พบอีเมลนี้ในระบบ'); window.history.back();</script>";
    }
}
?>
