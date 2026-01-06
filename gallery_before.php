<?php include 'navbar_before.php'; ?>
<title>Gallery</title>
<style>
    body {
        padding-top: 100px;
        background-color: white;
        font-family: Arial, sans-serif; /* เพิ่มฟอนต์ให้ดูดี */
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
            padding: 10px 20px; /* เพิ่ม padding เพื่อขยายขนาดปุ่ม */
            font-size: 1.1rem; /* เพิ่มขนาดตัวอักษร */
            border-radius: 10px; /* เพิ่มความโค้งมนให้กับขอบ (ถ้าต้องการ) */
            /* คุณสามารถเพิ่ม CSS อื่นๆ เพื่อปรับแต่งลักษณะของปุ่มได้ตามต้องการ */
            text-decoration: none; /* เพิ่มบรรทัดนี้เพื่อลบเส้นใต้ */
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
