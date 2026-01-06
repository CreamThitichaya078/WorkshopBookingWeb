<?php
// ใช้สำหรับเชื่อมต่อฐานข้อมูล Docker หรือ Localhost
// $host = 'db'; // หรือ 'localhost' ถ้าใช้ในเครื่องตัวเอง
// $user = 'root';
// $pass = 'MYSQL_ROOT_PASSWORD';
// $db = 'db_webapp';

// // เชื่อมต่อฐานข้อมูล
// $conn = new mysqli($host, $user, $pass, $db);
// $conn->set_charset("utf8mb4");

// // ตรวจสอบการเชื่อมต่อ
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// ===== ตัวเลือกอื่น (comment ไว้เฉย ๆ เผื่อใช้ในอนาคต) =====

// // ใช้สำหรับ hosting บน InfinityFree
$host = 'sql312.infinityfree.com';
$user = 'if0_38703613';
$pass = 'flowier99';
$db = 'if0_38703613_db_webapp';

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8mb4');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// // ใช้ PDO แทน mysqli (ปลอดภัยกว่า)
// try {
//     $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
//     $options = [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ];
//     $pdo = new PDO($dsn, $user, $pass, $options);
//     echo "✅ Connection successful!";
// } catch (PDOException $e) {
//     echo "❌ Connection failed: " . $e->getMessage();
// }
?>