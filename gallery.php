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

<title>Gallery</title>

<style>
    body {
        padding-top: 100px;
        background-color: white;
    }

    .gallery-container {
        column-count: 4;
        column-gap: 1em;
        padding: 20px;
    }

    .gallery-container img {
        width: 100%;
        margin-bottom: 1em;
        border-radius: 10px;
        display: block;
    }

    @media (max-width: 1200px) {
        .gallery-container {
            column-count: 3;
        }
    }

    @media (max-width: 768px) {
        .gallery-container {
            column-count: 2;
        }
    }

    @media (max-width: 576px) {
        .gallery-container {
            column-count: 1;
        }
    }

    footer {
        text-align: center;
        padding: 20px;
    }
    .social-icons a {
        display: inline-block;
        width: 30px;
        height: 30px;
        background-size: cover;
        margin: 0 10px;
    }

    .social-icons .instagram {
        background-image: url('instagram (1).png'); /* Replace with your icon */
    }

    .social-icons .messenger {
        background-image: url('mail.png'); /* Replace with your icon */
    }
</style>

<div class="gallery-container">
    <img src="1.png" alt="Image 1">
    <img src="2.png" alt="Image 2">
    <img src="3.png" alt="Image 3">
    <img src="4.png" alt="Image 4">
    <img src="5.png" alt="Image 5">
    <img src="6.png" alt="Image 6">
    <img src="7.png" alt="Image 7">
    <img src="8.png" alt="Image 8">
    <img src="9.png" alt="Image 9">
    <img src="10.png" alt="Image 10">
    <img src="11.png" alt="Image 11">
    <img src="12.png" alt="Image 12">
    <img src="13.png" alt="Image 13">
    <img src="14.png" alt="Image 14">
    <img src="15.png" alt="Image 15">
    <img src="16.png" alt="Image 16">
</div>

<footer>
        <div class="social-icons">
            <a href="#" class="instagram"></a> 
            <a href="#" class="messenger"></a>
        </div>
        <div class="copyright">@2025_CREAM&CHOMPOO_WebApp</div>
</footer>
