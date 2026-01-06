

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
            <!-- Left: Menu Button -->
            <button class="btn bg-transparent border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <ion-icon name="menu-outline" style="font-size: 1.8rem; color: white;"></ion-icon>
            </button>

            <!-- Logo -->
            <a class="navbar-brand position-absolute start-50 translate-middle-x text-white" href="home_after_login.php"
                style="font-size: 25px;">FLOWIER</a>

            <!-- Right: Icons -->
            <div class="d-flex ms-auto">
                <a href="#" style="margin-right: 30px;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile">
                    <ion-icon name="person-outline" style="font-size: 1.5rem; color: white;"></ion-icon>
                </a>
                <a href="ticket.php" style="margin-right: 30px;">
                    <ion-icon name="ticket-outline" style="font-size: 1.5rem; color: white;"></ion-icon>
                </a>
                <!-- <a href="#" style="margin-right: 30px;">
                    <ion-icon name="bag-outline" style="font-size: 1.5rem; color: white;"></ion-icon>
                </a> -->
            </div>

            <!-- Left Menu -->
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
                            <a class="nav-link" style="font-size: larger;" href="gallery.php">Gallery</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: larger;" href="all_workshop.php">Workshop</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: larger;" href="about.php">About</a>
                        </li>
                        <li>
                            <div class="text-center mt-3">
                                <div id="google_translate_element"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Profile -->
            <div class="offcanvas offcanvas-end border-0 shadow-none" tabindex="-1" id="offcanvasProfile"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="custom-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"
                        style="background: none; border: none;">
                        <ion-icon name="close-outline" style="font-size: 24px; color: black;"></ion-icon>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <!-- รูปโปรไฟล์ -->
                    <div class="mb-3 text-center">
                        <?php if (!empty($base64_img)): ?>
                            <img src="data:image/jpeg;base64,<?php echo $base64_img; ?>" 
                                alt="Profile" class="profile-img rounded-circle">
                        <?php else: ?>
                            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                                alt="Default" class="profile-img rounded-circle">
                        <?php endif; ?>
                    </div>

                    <!-- ข้อมูลผู้ใช้ -->
                    <div class="mb-3">
                        <p class="mb-1 text-uppercase fw-bold small">Username</p>
                        <p class="mb-2"><?php echo htmlspecialchars($username); ?></p>

                        <p class="mb-1 text-uppercase fw-bold small">Name Surname</p>
                        <p class="mb-2"><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></p>

                        <p class="mb-1 text-uppercase fw-bold small">Email</p>
                        <p class="mb-3"><?php echo htmlspecialchars($email); ?></p>

                        <p class="mb-1 text-uppercase fw-bold small">PHONE NUMBER </p>
                        <p class="mb-3"><?php echo htmlspecialchars($phone); ?></p>
                    </div>

                    <!-- ปุ่มแก้ไข (ไปยัง edit_profile.php) -->
                    <div class="text-center mb-4" style="text-align: center;margin-left:45px">
                        <a href="edit_profile.php" class="btn btn-outline-dark w-75">EDIT DETAILS</a>
                    </div>

                    <!-- ล็อกเอาท์ -->
                    <div class="text-center">
                        <a href="logout.php" class="text-decoration-none text-dark small">
                            Logout <ion-icon name="log-out-outline"></ion-icon>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>