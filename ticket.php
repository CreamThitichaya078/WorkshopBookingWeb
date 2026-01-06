<?php
session_start(); // ต้องมีบรรทัดนี้เสมอเมื่อต้องการใช้ session
include('connect.php');

// ตรวจสอบว่ามี email ใน session หรือไม่
if (isset($_SESSION['Email'])) {
    $email = $_SESSION['Email'];

    // ดึงข้อมูลของผู้ใช้จากฐานข้อมูล
    $sql_user = "SELECT First_Name, Last_Name, Email, Username,Phone_Number, Profile FROM Member WHERE Email = ?";
    $stmt = $conn->prepare($sql_user);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user_result = $stmt->get_result();

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $first_name = $user_row['First_Name'];
        $last_name = $user_row['Last_Name'];
        $username = $user_row['Username'];
        $phone = $user_row['Phone_Number'];
        $profile_img = $user_row['Profile'];

        // ตรวจสอบว่ามีรูปภาพหรือไม่
        if (!empty($profile_img)) {
            $base64_img = base64_encode($profile_img);
        } else {
            $base64_img = "user.png"; // หรือใส่ URL รูป default ก็ได้
        }
    } else {
        echo "ไม่พบข้อมูลผู้ใช้";
    }
} else {
    echo "กรุณาเข้าสู่ระบบก่อน";
    // หรือจะ redirect ไปหน้า login ก็ได้:
    // header("Location: login.php");
    // exit();
}
?>

<?php

include('connect.php');

$email = $_SESSION['Email'] ?? null;
if (!$email) {
    die("Email not found in session. Please login again.");
}

// ดึงข้อมูลตั๋วทั้งหมดของผู้ใช้ (เรียงจากล่าสุด)
$sql = "SELECT * FROM Booking WHERE Email = '$email' ORDER BY Date_Time DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// ดึงข้อมูลของผู้ใช้
$sql_user = "SELECT First_Name, Last_Name, Email, Username, Profile FROM Member WHERE Email='$email'";
$user_result = $conn->query($sql_user);

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $first_name = $user_row['First_Name'];
    $last_name = $user_row['Last_Name'];
    $email = $user_row['Email'];
    $username = $user_row['Username'];
    $profile_img = isset($user_row['Profile']) ? $user_row['Profile'] : "https://cdn-icons-png.flaticon.com/512/847/847969.png";
    $base64_img = base64_encode($profile_img);
}
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Your Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f9f9f9;
            padding-top: 80px;
        }

        .ticket-container {
            max-width: 200px;
            margin: 30px;
            text-align: center;
        }

        .ticket-box {
            margin: 40px 235px ;
            width: 65%;
            border: 1px solid #ccc;
            border-radius: 15px;
            background-color: #fff;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .ticket-info {
            flex: 2;
            padding-right: 20px;
            text-align: left;
        }

        .ticket-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4c5c41;
        }

        .price-text {
            font-size: 1.1rem;
            font-weight: bold;
            color: #000;
        }

        .barcode-section {
            flex: 1;
            border-left: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            padding-left: 20px;
        }

        .vertical-info {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            font-size: 0.8rem;
            color: #4c5c41;
            text-align: center;
            margin-right: 10px;
        }

        .barcode-img img {
            transform: rotate(90deg);
            height: 150px;
        }

        .footer-icons {
            text-align: center;
            margin-top: 40px;
            font-size: 1.4rem;
            color: #555;
        }

        .footer-icons i {
            margin: 0 10px;
        }

        .footer-icons div {
            font-size: 0.8rem;
            color: #888;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<?php include('navbar.php'); ?>

<div class="container ticket-container">
    <h2 class="mb-4">Your Tickets</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while($ticket = $result->fetch_assoc()): ?>
            <div class="ticket-box">
                <!-- ซ้าย: ข้อมูลตั๋ว -->
                <div class="ticket-info">
                    <div class="ticket-title mb-2"><?= htmlspecialchars($ticket['Workshop']) ?></div>
                    <div>วันที่ <strong><?= htmlspecialchars($ticket['Date_Time']) ?></strong></div>
                    <div>รอบ <strong><?= htmlspecialchars($ticket['Booking_Time']) ?></strong></div>
                    <div>จำนวน <strong><?= htmlspecialchars($ticket['Quantity']) ?> ท่าน</strong></div>
                    <br>
                    <div class="price-text">ราคารวม <?= number_format($ticket['Total_Price']) ?> Baht</div>
                    <div class="text-muted" style="font-size: 0.85rem;">ชำระเงินผ่าน <?= htmlspecialchars($ticket['Payment_Method']) ?></div>
                </div>

                <!-- ขวา: บาร์โค้ด -->
                <div class="barcode-section">
                    <div class="vertical-info">
                        <?= htmlspecialchars($ticket['Workshop']) ?><br>
                        วันที่ <?= htmlspecialchars($ticket['Date_Time']) ?><br>
                        รอบ <?= htmlspecialchars($ticket['Booking_Time']) ?><br>
                        จำนวน <?= htmlspecialchars($ticket['Quantity']) ?> ท่าน
                    </div>
                    <div class="barcode-img">
                        <img src="https://play-lh.googleusercontent.com/eNX8KUWYbYWZjWP2gjpLKa57v_TZBMcGVIbzi1ERdL8WKFa32xqNrvH3fvrx_vM9bao" 
                            alt="barcode image" 
                            style="height: 180px; transform: rotate(270deg); object-fit: contain;">
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Your ticket information was not found.</p>
    <?php endif; ?>

    <!-- ปิดการเชื่อมต่อฐานข้อมูล -->
    <?php 
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
    ?> 

    <!-- Footer -->
    <div class="footer-icons">
        <i class="bi bi-instagram"></i>
        <i class="bi bi-envelope"></i>
        <div>@2025_CREAM&amp;CHOMPOO_WebApp</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
