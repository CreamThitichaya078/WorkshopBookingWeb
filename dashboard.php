<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: home.php"); // ถ้ายังไม่ล็อกอิน ให้กลับไปหน้าแรก
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
