

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Ionicons -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>


    <!-- Google Translate Plugin -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,th', // ใส่ภาษาที่ต้องการให้แปล
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <style>
        .offcanvas-body p {
            margin-bottom: 0.3rem;
            font-size: 0.95rem;
        }

        .offcanvas-body button {
            font-size: 0.9rem;
        }

        /* ปรับให้ข้อมูลในโปรไฟล์ชิดฝั่งซ้าย */
        .offcanvas-body {
            display: block;
            text-align: left; /* จัดตำแหน่งเนื้อหาทางซ้าย */
            padding-left: 30px; /* เพิ่มระยะห่างด้านซ้าย */
        }

        /* จัดปุ่มให้อยู่ตรงกลาง */
        .offcanvas-body .btn, .offcanvas-body .text-center {
            width: 100%; /* ให้ปุ่มขยายเต็มความกว้าง */
            text-align: center; /* จัดตำแหน่งให้ปุ่มอยู่ตรงกลาง */
        }

        /* จัดตำแหน่ง logout ให้อยู่ตรงกลาง */
        .offcanvas-body a {
            text-align: center; /* จัดตำแหน่งให้ปุ่ม logout อยู่ตรงกลาง */
            display: block; /* ทำให้ปุ่ม logout ขยายเต็มความกว้าง */
        }

        /* จัดรูปโปรไฟล์ให้อยู่กลาง */
        .offcanvas-body .profile-img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
            height: 100px;
        }
        .navigation .btnLogin-popup {
            padding: 10px 20px; /* เพิ่ม padding เพื่อขยายขนาดปุ่ม */
            font-size: 1.1rem; /* เพิ่มขนาดตัวอักษร */
            border-radius: 10px; /* เพิ่มความโค้งมนให้กับขอบ (ถ้าต้องการ) */
            /* คุณสามารถเพิ่ม CSS อื่นๆ เพื่อปรับแต่งลักษณะของปุ่มได้ตามต้องการ */
            text-decoration: none; /* เพิ่มบรรทัดนี้เพื่อลบเส้นใต้ */
        }
        .navigation .btnLogin-popup {
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 5px;
            text-decoration: none; /* ลบเส้นใต้ */
            background-color: #f8f9fa; /* ตัวอย่างสีพื้นหลัง */
            color: #4c5c41; /* ตัวอย่างสีตัวอักษร */
            border: 1px solid #4c5c41; /* ตัวอย่างขอบ */
            cursor: pointer;
        }

        .navigation .btnLogin-popup:hover {
            background-color: #4c5c41; /* ตัวอย่างสีพื้นหลังเมื่อ hover */
            color: white;
        }


        .navigation .btnLogin-popup {
            background-color: #4c5c41;
            color: white;
            padding: 10px 20px; /* เพิ่ม padding เพื่อขยายขนาดปุ่ม */
            font-size: 1.1rem; /* เพิ่มขนาดตัวอักษร */
            border-radius: 10px; /* เพิ่มความโค้งมนให้กับขอบ (ถ้าต้องการ) */
            border: 2px solid white; /* ตัวอย่างขอบ */
            /* คุณสามารถเพิ่ม CSS อื่นๆ เพื่อปรับแต่งลักษณะของปุ่มได้ตามต้องการ */
            text-decoration: none; /* เพิ่มบรรทัดนี้เพื่อลบเส้นใต้ */
            cursor: pointer;
        }

        .navigation .btnLogin-popup:hover {
            background-color: white; /* ตัวอย่างสีพื้นหลังเมื่อ hover */
            color: #4c5c41;
        }

        /* ปรับแต่ง Google Translate Container ให้ดูเหมือนปุ่มจริง */
        #google_translate_element {
            display: inline-block;
            background-color:white;
            border: 1px solid #4c5c41;
            padding: 8px 16px;
            border-radius: 8px;
            
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            margin-top: 30px;
            text-align: center;
            max-width: 200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ปรับสไตล์ภายใน gadget */
        .goog-te-gadget-simple {
            background-color: transparent !important;
            border: none !important;
            font-family: 'Segoe UI', sans-serif;
            font-weight: 500;
            font-size: 0.95rem !important;
            color: white !important;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* ซ่อนธงและตกแต่งลูกศรให้เรียบง่าย */
        .goog-te-gadget-icon {
            display: none !important;
        }

        .goog-te-menu-value span {
            color: white !important;
        }

        
        .text-center #google_translate_element {
            display: inline-block;
            margin-left: auto;
            margin-right: auto;
        }
        #google_translate_element:hover .goog-te-menu-value span {
            color: white !important;
        }

        
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top" style="height: 80px; background-color: #4c5c41;">
        <div class="container-fluid">
            <!-- ปุ่มเมนูทางซ้าย ใช้ Ionicons -->
            <!--<button class="btn bg-transparent border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <ion-icon name="menu-outline" style="font-size: 1.8rem; color: white;"></ion-icon>
            </button>-->
            <div class="d-flex" >
                <!-- เพิ่ม data-bs-toggle และ data-bs-target สำหรับการเปิด offcanvasProfile -->
                <a href="#" style="margin-left: 30px;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                    <ion-icon name="menu-outline" style="font-size: 2rem; color: white;"></ion-icon>
                </a>
            </div>

            <!-- ชื่อโลโก้ -->
            <!--<a class="navbar-brand text-white mx-auto" href="#">LOGO</a>-->
            <a class="navbar-brand position-absolute start-50 translate-middle-x text-white" href="home_before_login.php"
                style="font-size:25px;">FLOWIER</a>


            <!-- ไอคอนด้านขวา -->
            

            <div class="navigation">
                <a href="loginNew.php" class="btnLogin-popup">Login</a>
            </div>
            
            <!--<div class="d-flex ms-auto gap-3">
          <a href="#"><ion-icon name="person-outline" style="font-size: 1.4rem; color: white;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile"></ion-icon></a>
          <a href="#"><ion-icon name="ticket-outline" style="font-size: 1.4rem; color: white;"></ion-icon></a>
          <a href="#"><ion-icon name="bag-outline" style="font-size: 1.4rem; color: white;"></ion-icon></a>
      </div>-->

            <!-- Offcanvas Menu สำหรับเมนูหลัก -->
            <div class="offcanvas offcanvas-start border-0 shadow-none" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="custom-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"
                        style="background: none; border: none;">
                        <ion-icon name="close-outline" style="font-size: 24px; color: black;"></ion-icon>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <br><br>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: larger;" href="gallery_before.php">Gallery</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: larger;" href="all_workshop_before.php">Workshop</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: larger;" href="about_before.php">About</a>
                        </li>
                        <li>
                            <div class="text-center mt-3">
                                <div id="google_translate_element"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>