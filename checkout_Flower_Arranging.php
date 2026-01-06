<?php
session_start(); // เริ่มต้น session เพียงครั้งเดียว
include('connect.php');

// ตรวจสอบว่ามี email ใน session หรือไม่
if (isset($_SESSION['Email'])) {
    $email = $_SESSION['Email'];

    // ดึงข้อมูลของผู้ใช้จากฐานข้อมูล
    $sql_user = "SELECT First_Name, Last_Name, Email, Username, Phone_Number, Profile FROM Member WHERE Email = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("s", $email);
    $stmt_user->execute();
    $user_result = $stmt_user->get_result();

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $first_name = $user_row['First_Name'];
        $last_name = $user_row['Last_Name'];
        $username = $user_row['Username'];
        $phone = $user_row['Phone_Number'];
        $profile_img_data = $user_row['Profile'];

        // ตรวจสอบว่ามีรูปภาพหรือไม่
        $base64_img = !empty($profile_img_data) ? base64_encode($profile_img_data) : "user.png"; // หรือใส่ URL รูป default ก็ได้
    } else {
        echo "ไม่พบข้อมูลผู้ใช้";
        // อาจจะ redirect ไปหน้า error หรือ login ก็ได้
    }
    $stmt_user->close();

    // --- ส่วนของการรับข้อมูลการจอง ---
    // (ส่วนนี้ควรจะอยู่ภายในเงื่อนไขที่ตรวจสอบว่ามี email ใน session แล้ว)

    // รับข้อมูลจากฟอร์ม
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
    $date_input = isset($_POST['date']) ? $_POST['date'] : '';
    $time_input = isset($_POST['time']) ? $_POST['time'] : '';
    $price_per_guest = isset($_POST['Price']) ? $_POST['Price'] : 0;

    // แปลง $date_input เป็นรูปแบบ Y-m-d
    if (!empty($date_input)) {
        $date = date('Y-m-d', strtotime($date_input));
    } else {
        $date = null; // หรือค่าเริ่มต้นอื่น ๆ ตามความเหมาะสม
    }

    // ดึงเวลาเริ่มต้นจากช่วงเวลา
    if (!empty($time_input)) {
        $time_parts = explode(' - ', $time_input);
        $start_time = trim($time_parts[0]); // "10:00"
    } else {
        $start_time = null; // หรือค่าเริ่มต้นอื่น ๆ ตามความเหมาะสม
    }

    // รวมเป็น DateTime ที่ MySQL ต้องการ
    if ($date !== null && $start_time !== null) {
        $booking_time = date('Y-m-d H:i:s', strtotime("$date $start_time")); // ได้รูปแบบถูกต้อง
    } else {
        $booking_time = null; // หรือค่าเริ่มต้นอื่น ๆ ตามความเหมาะสม
    }

    // คำนวณราคา (หากมี)
    $total_price = $price_per_guest * $quantity;

    // **การปิด Connection ควรทำเมื่อสิ้นสุดการทำงาน**
    // $conn->close();

} else {
    echo "กรุณาเข้าสู่ระบบก่อน";
    // หรือจะ redirect ไปหน้า login ก็ได้:
    // header("Location: login.php");
    // exit();
}

ob_start(); // เริ่มต้นการบัฟเฟอร์เอาท์พุต (ควรอยู่หลังการประมวลผล PHP ส่วนบน)
// ... ส่วน HTML ของคุณ ...

ob_end_flush(); // ส่งข้อมูลออกหลังจากการทำงานเสร็จสิ้น
$conn->close(); // ปิด Connection เมื่อสิ้นสุดการทำงาน
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>
    <style>
        body {
            font-family: sans-serif;
            margin: 50;
            background: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            padding: 100px;
            flex: 1;
        }
        .checkout-title {
            font-size: 2rem;
            margin-bottom: 2rem;
        }
        .cart-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid #ccc;
            padding-bottom: 1rem;
        }
        .cart-item img {
            width: 150px;
            object-fit: cover;
            border-radius: 0px;
            max-width: 100%;
            height: auto;
        }

        .cart-info {
            flex: 1;
        }
        .cart-price {
            text-align: left;
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* จัดทุกอย่างใน cart-price ให้ชิดซ้าย */
        }
        .subtotal {
            display: flex;
            justify-content: space-between;
            font-size: 1.2rem;
            margin: 2rem 0 1rem 0;
            border-top: 1px solid #ccc;
            padding-top: 1rem;
        }
        .payment-method {
            margin-bottom: 2rem;
        }
        .payment-method label {
            display: block;
            margin-bottom: 1rem;
        }
        .payment-fields input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: none;
            border-bottom: 1px solid #000;
            outline: none;
        }
        .payment-fields {
            display: none;
        }
        .qr-code {
            text-align: center;
            margin-top: 1rem;
        }
        .qr-code img {
            width: 200px;
            height: 200px;
        }
        .remember {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        .remember input {
            margin-right: 0.5rem;
        }
        .purchase-btn {
            width: 100%;
            padding: 1rem;
            border: 1px solid black;
            background: white;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s;
        }
        .purchase-btn:hover {
            background: black;
            color: white;
        }

        .payment-fields-container {
            max-width: 400px; /* หรือ 500px ก็ได้ */
            margin: -10 auto; /* จัดกึ่งกลางกรณีหน้ากว้าง */
        }
        .payment-fields {
            text-align: left;
        }

        /* ช่อง input ของบัตรเครดิตเรียงสวย ๆ */
        #credit-fields input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            font-size: 1rem;
            border-radius: 0px;
            border: 0px solid #ccc;
        }

        /* รูป QR ไม่ใหญ่เกินไป */
        .qr-code img {
            max-width: 200px;
            height: auto;
        }

        .qr-code {
            text-align: left; /* ชิดซ้าย QR ทั้งชุด */
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
</head>

<body>
    <?php include('navbar.php'); ?>

    <main>
        <form action="submit_checkout.php" method="POST">
            <div class="checkout-title">Checkout</div>
            <hr>

            <div class="cart-item">
            <img src="image55.png" alt="Flower Class">
            <div class="cart-info">
                <h2>Flower Arranging Class</h2>
                <p>Learn the techniques to mix and match flowers with color theory, how to pick the type of flowers, flowers composition, wrapping techniques and especially how to extend flower life.</p>
                <p style="color: gray; font-size: 0.8rem;"><?php echo date('d M Y', strtotime($date)); ?> <?php echo $time_input; ?></p>
            </div>
            <div class="cart-price">
                <div><?php echo number_format($price_per_guest, 2); ?> THB</div>
                <div class="quantity-box">
                    <span class="qty-number"><?php echo $quantity; ?></span> </div>
            </div>
            </div>

            <div class="subtotal">
            <span>Subtotal</span>
            <span><?php echo number_format($total_price, 2); ?> THB</span>
            </div>

            <div class="payment-method">
            <h4>Payment Method</h4>
            <label>
                <input type="radio" name="payment" value="qr" checked onchange="showPaymentFields()"> QR Promptpay
            </label>
            <label>
                <input type="radio" name="payment" value="credit" onchange="showPaymentFields()"> Credit/Debit
            </label>
            <div class="payment-fields-container">
                <div id="qr-fields" class="payment-fields" style="display: block;">
                <div class="qr-code">
                    <img src="QR.png" alt="QR Code">
                    <p>Please scan the QR code to pay.</p>
                </div>
                </div>

                <div id="credit-fields" class="payment-fields" style="display: none;">
                <input type="text" name="card_number" placeholder="Card Number" >
                <input type="text" name="cardholder_name" placeholder="Cardholder Name" >
                <input type="text" name="expiry_date" placeholder="Expiry Date (MM/YY)" >
                <input type="text" name="cvv" placeholder="CVV">
                </div>
            </div>
            </div>

            <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember card</label>
            </div>

            <input type="hidden" name="Workshop" value="Flower Arranging Class">
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
            <input type="hidden" name="date_input" value="<?php echo $date_input; ?>">
            <input type="hidden" name="time_input" value="<?php echo $time_input; ?>">
            <input type="hidden" name="Price" value="<?php echo $price_per_guest; ?>">

            <button type="submit" class="purchase-btn">Complete Purchase</button>
            
        </form>
        </main>

    <footer>
        <div class="social-icons">
            <a href="#" class="instagram"></a>
            <a href="#" class="messenger"></a>
        </div>
        <div class="copyright">@2025_CREAM&CHOMPOO_WebApp</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // เริ่มต้นให้แสดงช่องบัตร
        showPaymentFields();

        function showPaymentFields() {
            const payment = document.querySelector('input[name="payment"]:checked').value;
            const qrFields = document.getElementById('qr-fields');
            const creditFields = document.getElementById('credit-fields');
            if (payment === 'qr') {
                qrFields.style.display = 'block';
                creditFields.style.display = 'none';
            } else {
                qrFields.style.display = 'none';
                creditFields.style.display = 'block';
            }
        }
    </script>
</body>
</html>