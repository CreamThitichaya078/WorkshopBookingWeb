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


<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>

    <style>
        body {
            padding-top: 100px;
            background-color: white;
        }

        .team-section {
            text-align: center;
            padding: 40px 20px;
        }

        .team-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .team-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .team-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 220px;
            transition: transform 0.2s ease-in-out;
        }

        .team-card:hover {
            transform: scale(1.05);
        }

        .team-card img {
            width: 100%;
            max-width: 160px;
            margin-bottom: 15px;
        }

        .team-card p {
            font-size: 15px;
            margin: 0;
            line-height: 1.4;
        }

        footer {
            text-align: center;
            padding: 20px;
            /* background-color: #f1f1f1; เพิ่มพื้นหลังฟุตเตอร์ */
            margin-top: 20px; /* เพิ่มระยะห่างจากเนื้อหา */
        }

        .social-icons {
            margin-bottom: 10px; /* เพิ่มระยะห่างระหว่างไอคอนกับข้อความ */
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-size: contain; /* ใช้ contain เพื่อให้ไอคอนไม่ถูกยืด */
            background-position: center;
            background-repeat: no-repeat;
            margin: 0 10px;
        }

        .social-icons .instagram {
            background-image: url('instagram (1).png'); /* เปลี่ยนเป็นเส้นทางที่ถูกต้อง */
        }

        .social-icons .messenger {
            background-image: url('mail.png'); /* เปลี่ยนเป็นเส้นทางที่ถูกต้อง */
        }

        .copyright {
            font-size: 14px;
            color: #666; /* สีอ่อนสำหรับข้อความ */
        }
    </style>
</head>
<body>

    <div class="team-section">
        <div class="team-title">OUR TEAM</div>
        <div class="team-container">
            <div class="team-card">
                <img src="chompoo.png" alt="Chompoo">
                <p>Patcharee Jokram<br>(Chompoo)</p>
            </div>
            <div class="team-card">
                <img src="cream.png" alt="Cream">
                <p>Thitichaya Krueangphatee<br>(Cream)</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="social-icons">
            <a href="#" class="instagram"></a> 
            <a href="#" class="messenger"></a>
        </div>
        <div class="copyright">@2025_CREAM&CHOMPOO_WebApp</div>
    </footer>
    
    </body>
</html>