<?php include 'navbar_before.php'; ?>
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
        .navigation .btnLogin-popup {
            background-color: #4c5c41;
            color: white;
            padding: 0px 20px white; /* เพิ่ม padding เพื่อขยายขนาดปุ่ม */
            font-size: 1.1rem; /* เพิ่มขนาดตัวอักษร */
            border-radius: 10px; /* เพิ่มความโค้งมนให้กับขอบ (ถ้าต้องการ) */
            /* คุณสามารถเพิ่ม CSS อื่นๆ เพื่อปรับแต่งลักษณะของปุ่มได้ตามต้องการ */
            text-decoration: none; /* เพิ่มบรรทัดนี้เพื่อลบเส้นใต้ */
        }

        .navigation .btnLogin-popup:hover {
            background-color: white; /* ตัวอย่างสีพื้นหลังเมื่อ hover */
            color: #4c5c41;
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