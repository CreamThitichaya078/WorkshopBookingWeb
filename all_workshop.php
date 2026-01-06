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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workshop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Ionicons -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>
    <style>
         body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1; /* Allow main to take up remaining space */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 130px;
        }

        .workshop-container {
            display: flex;
            gap: 20px;
        }

        .workshop-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
            overflow: hidden;
        }

        .workshop-card img {
            width: 100%;
            height: auto;
            display: block;
        }

        .workshop-details {
            padding: 20px;
        }

        .workshop-details h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .workshop-details p {
            margin-bottom: 10px;
        }

        .workshop-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .details-button {
            background-color: #4C5C41;
            color: #ffffff;
            border: none;
            padding: 10px 155px;
            border-radius: 9px;
            cursor: pointer;
            text-decoration: none;
        }
        .cart-add {
            cursor: pointer;
        }

        footer {
            text-align: center;
            padding: 20px;
        }

        .social-icons {
            margin-bottom: 10px;
        }

        .social-icons a {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-size: cover;
            margin: 0 10px;
        }

        .social-icons .instagram {
            background-image: url('instagram (1).png');
        }

        .social-icons .messenger {
            background-image: url('mail.png');
        }


    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <main>
        <div class="workshop-container">
            <div class="workshop-card">
                <img src="image55.png" alt="Flower Arrangement Workshop">
                <div class="workshop-details">
                    <h3>Flower Arrangement Workshop</h3>
                    <p>3,400 ฿ THB / 1 guest</p>
                    <div class="workshop-actions">
                        <a class="details-button" href="Flower_Arranging_Class.php">Details</a>
                    </div>
                </div>
            </div>

            <div class="workshop-card">
                <img src="image77.png" alt="Natural Flower Perfume Workshop">
                <div class="workshop-details">
                    <h3>Natural Flower Perfume Workshop</h3>
                    <p>3,900 ฿ THB / 1 guest</p>
                    <div class="workshop-actions">
                        <a class="details-button" href="Flower_Perfume_Class.php">Details</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="social-icons">
            <a href="#" class="instagram"></a> 
            <a href="#" class="messenger"></a>
        </div>
        <div class="copyright">@2025_CREAM&CHOMPOO_WebApp</div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    
</body>
</html>







