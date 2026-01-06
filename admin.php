<?php
    $host = 'sql312.infinityfree.com';
    $user = 'if0_38703613';
    $pass = 'flowier99';
    $db = 'if0_38703613_db_webapp';
    
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset('utf8mb4');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ดึงข้อมูลจากฐานข้อมูล ของจัดดอกไม้
    $sql = "SELECT SUM(Quantity) as total_guest, SUM(Total_Price) as total_price FROM Booking WHERE Workshop = 'Flower Arranging Class'";
    $result = $conn->query($sql);
    $total_price = 0; 
    $total_guest = 0;
    $max_guest = 30; // จำนวนสูงสุดของผู้เข้าร่วม (ตั้งไว้เป็น 30)

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_guest = $row['total_guest'];
        $total_price = $row['total_price'];
    }

    // $total_price = number_format($total_price, 2);
    $total_price = number_format($total_price, 2, '.', '') + 0;

    // คำนวณค่าที่ใช้ในการแสดงผล ของทำน้ำหอม
    $remaining_guest = $max_guest - $total_guest;

    $sql_perfume = "SELECT COUNT(*) as total_guest,SUM(Total_Price) as total_price FROM Booking WHERE Workshop = 'Flower Perfume Class'";
    $result_perfume = $conn->query($sql_perfume);
    $total_price_perfume = 0; 
    $total_guest_perfume= 0;
    $max_guest_perfume = 30; // จำนวนสูงสุดของผู้เข้าร่วม (ตั้งไว้เป็น 30)

    if ($result_perfume->num_rows > 0) {
        $row = $result_perfume->fetch_assoc();
        $total_guest_perfume = $row['total_guest'];
        $total_price_perfume = $row['total_price'];
    }

    // $total_price_perfume = number_format($total_price_perfume, 2);
    $total_price_perfume = number_format($total_price_perfume, 2, '.', '') + 0;

    // คำนวณค่าที่ใช้ในการแสดงผล
    $remaining_guest_perfume = $max_guest_perfume - $total_guest_perfume;


    $total_income = $total_price + $total_price_perfume;

    $sql_member = "SELECT COUNT(*) as members FROM Member";
    $result_member = $conn->query($sql_member);
    $total_members = 0; // ตั้งค่าเริ่มต้น

    if ($result_member->num_rows > 0) {
        $row = $result_member->fetch_assoc();
        $total_members = $row['members'];
    }


    // ปิดการเชื่อมต่อ
    // $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Ionicons -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>

    <!-- External CSS -->
    <link rel="stylesheet" href="adstyle.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">


    <style>
        body {
            padding: 40px; /* เพิ่ม padding รอบๆ ขอบของ window */
            padding-top: 70px
        }

        table {
            padding: 20px; /* เว้นระยะรอบๆ ขอบของตาราง */
        }

        td {
            padding: 15px; /* เว้นระยะระหว่างข้อมูลในแต่ละเซลล์ */
        }

        #content .grid-box {
            display: grid;
            grid-template-columns: 2fr 2fr 1fr;
            grid-template-rows: auto auto auto;
            grid-template-areas: 
                "box1 box2 box3"
                "box1 box2 box4"
                "box5 box5 box6";
            gap: 30px; /* เพิ่มระยะห่างระหว่างกล่อง */
        }
        .b2 {
            border: 5px solid red;
            grid-area: box2;
            background-color: white !important;
            border-radius: 15px;
            border: 0px solid black;
            padding: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            height: 100%;
            flex-grow: 1;
            box-sizing: border-box;
            overflow: hidden;  /* ทำให้ทุกอย่างอยู่ในกรอบ */ 
        }
        .b3 { 
            border: 5px solid red;
            grid-area: box3;
            background-color: white !important;
            border-radius: 15px;
            border: 0px solid black;
            padding: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            height: 100%;
            flex-grow: 1;
            box-sizing: border-box;
            overflow: hidden;  /* ทำให้ทุกอย่างอยู่ในกรอบ */
            justify-content: center;  /* จัดแนวตั้งให้ตรงกลาง */
            align-items: center;      /* จัดแนวนอนให้ตรงกลาง */
            text-align: center;
        }
        .b4 { 
            border: 5px solid red;
            grid-area: box4;
            background-color: white !important;
            border-radius: 15px;
            border: 0px solid black;
            padding: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            height: 100%;
            flex-grow: 1;
            box-sizing: border-box;
            overflow: hidden;  /* ทำให้ทุกอย่างอยู่ในกรอบ */
            justify-content: center;  /* จัดแนวตั้งให้ตรงกลาง */
            align-items: center;      /* จัดแนวนอนให้ตรงกลาง */
            text-align: center;
        }
        .b5{
            border: 5px solid red;
            grid-area: box5;
            background-color: white !important;
            border-radius: 15px;
            border: 0px solid black;
            padding: 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            height: 100%;
            flex-grow: 1;
            box-sizing: border-box;
            /* overflow: hidden;  /* ทำให้ทุกอย่างอยู่ในกรอบ 
            justify-content: center;  /* จัดแนวตั้งให้ตรงกลาง 
            align-items: center;      /* จัดแนวนอนให้ตรงกลาง 
            text-align: center; */

        }
        .b6{
            border: 5px solid red;
            grid-area: box6;
            background-color: white !important;
            border-radius: 15px;
            border: 0px solid black;
            padding: 0px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            height: 100%;
            flex-grow: 1;
            box-sizing: border-box;
            overflow: hidden;  /* ทำให้ทุกอย่างอยู่ในกรอบ */
            justify-content: center;  /* จัดแนวตั้งให้ตรงกลาง */
            align-items: center;      /* จัดแนวนอนให้ตรงกลาง */
            text-align: center;
            
            display: flex;
            align-items: center;  /* จัดให้เป็นแนวนอนและกึ่งกลางแนวตั้ง */
            gap: 20px;  /* เพิ่มช่องว่างระหว่างรูปภาพและข้อมูล */

        }
        .no-border th, .no-border td {
            border: none !important; /* ลบกรอบจาก th และ td */
        }

        .table th, .table td {
            padding: 20px; /* เพิ่ม padding ให้แต่ละเซลล์ */
        }

        .table {
            margin-left: 150px;  /* เพิ่มระยะห่างด้านซ้าย */
            margin-right: 150px; /* เพิ่มระยะห่างด้านขวา */
        }

                /* เปลี่ยนสีเมื่อเอาเมาส์ไปชี้ที่แถว */
        /* .table tbody tr:hover {
            background-color: black; /* สีเมื่อเมาส์ชี้ 
        } */

        /* สไตล์สำหรับกรอบรูปภาพ */
        .profile-image-container {
            width: 50px;
            height: 50px;
            overflow: hidden;
            border-radius: 50%;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        /* สไตล์สำหรับข้อมูล Username และ Email */
        .user-info p {
            margin: 0; /* ลบ margin ของ <p> */
        }

        .navbar .logout-btn {
            background-color: white; /* สีแดงสำหรับปุ่ม Logout */
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            color : #4c5c41;
        }

        .navbar .logout-btn:hover {
            background-color: #c82333; /* สีเมื่อ hover */
            color: white;
        }
    </style>

</head>

<body>
    <nav class="navbar fixed-top" style="height: 80px; background-color: #4c5c41;">
        <div class="container-fluid">
            <!-- ปุ่มเมนูทางซ้าย ใช้ Ionicons -->
            <!--<button class="btn bg-transparent border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <ion-icon name="menu-outline" style="font-size: 1.8rem; color: white;"></ion-icon>
            </button>-->
            

            <!-- ชื่อโลโก้ -->
            <!--<a class="navbar-brand text-white mx-auto" href="#">LOGO</a>-->
            <a class="navbar-brand position-absolute start-50 translate-middle-x text-white" href="#"
                style="font-size:25px;">FLOWIER</a>

            <!-- ปุ่ม Logout ด้านขวา -->
            <div class="d-flex ms-auto">
                <form action="logout.php" method="POST">
                    <button type="submit" class="logout-btn" href="logout.php">Logout</button>
                </form>
            </div>

            <!-- ไอคอนด้านขวา -->
            <div class="">
                <!-- เพิ่ม data-bs-toggle และ data-bs-target สำหรับการเปิด offcanvasProfile -->
                <!--<a href="#" style="margin-right: 30px;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile">
                    <ion-icon name="person-outline" style="font-size: 1.5rem; color: white;"></ion-icon>
                </a>-->
                <!-- <button class="btnLogin-popup">Login</button> -->
            </div>
            <!--<div class="d-flex ms-auto gap-3">
          <a href="#"><ion-icon name="person-outline" style="font-size: 1.4rem; color: white;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile"></ion-icon></a>
          <a href="#"><ion-icon name="ticket-outline" style="font-size: 1.4rem; color: white;"></ion-icon></a>
          <a href="#"><ion-icon name="bag-outline" style="font-size: 1.4rem; color: white;"></ion-icon></a>
      </div>-->

            
        </div>
    </nav>

    <div id="content">
        <div class="head-title">
            <div class="left" style="margin: 30px;font-weight: 600;"> 
                <h1>ADMIN</h1>
            </div>
        </div>
        <div class="grid-box">
            <div class="box b1" style="padding: 35px;">
                <h4>Flower Arranging Class</h4>
                <div class="divider"></div>
                <div class="chart-container">
                    <canvas id="progressChart1"></canvas>
                    <div class="info" style="margin-left: 35px;">
                        <div class="income" >
                            <h5>Income</h5>
                            <!-- <h6>5000 Baht</h6> -->
                            <h6><?php echo $total_price; ?> Baht</h6>
                            
                        </div>
                        <br>

                        <div class="num">
                            <h5>Num</h5>
                            <h6><?php echo $total_guest; ?>/<?php echo $max_guest; ?> guest</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b2" style="padding: 35px;background-color: white !important;">
                <h4>Flower Perfume Class</h4>
                <div class="divider"></div>
                <div class="chart-container">
                    <canvas id="progressChart2"></canvas>
                    <div class="info" style="margin-left: 35px;">
                        <div class="income" >
                            <h5>Income</h5>
                            <!-- <h6>5000 Baht</h6> -->
                            <h6><?php echo $total_price_perfume; ?> Baht</h6>
                        </div>
                        <br>
                        <div class="num">
                            <h5>Num</h5>
                            <h6><?php echo $total_guest_perfume; ?>/<?php echo $max_guest_perfume; ?> guest</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box b3" >
                <h4>Total Income</h4>
                <h6><?php echo $total_income; ?> Baht</h6>
            </div>
            <div class="box b4">
                <h4>Members</h4>
                <h6><?php echo $total_members; ?> Member</h6>
            </div>
            <div class="box b5" style="padding: 40px;">
            <h4 style="margin-bottom: 30px;font-weight: 600;">Recent Payment</h4>
            <!-- <div class="divider"></div> -->
                <table class="table table-bordered no-border" style="font-size: 15px;font-weight: 400;">
                    <thead style="font-size: 18px;font-weight: 500;">
                        <tr>
                            <th>Username</th>
                            <th>Workshop</th>
                            <th>Booking Time</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // คำสั่ง SQL เพื่อดึงข้อมูลล่าสุด 10 รายการ
                            $sql_booking = "SELECT B.Booking_ID, M.Username, B.Date_Time, B.Workshop, B.Quantity,B.Total_Price ,B.Booking_Time
                                            FROM Booking B 
                                            INNER JOIN Member M ON B.Email = M.Email
                                            ORDER BY B.Date_Time DESC
                                            LIMIT 10";
                            $result_booking = $conn->query($sql_booking);

                            // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
                            if ($result_booking->num_rows > 0) {
                                // ใช้ลูปเพื่อแสดงข้อมูลในแต่ละแถว
                                while($row = $result_booking->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['Username'] . "</td>";
                                    echo "<td>" . $row['Workshop'] . "</td>";
                                    echo "<td>" . $row['Booking_Time'] . "</td>";
                                    echo "<td>" . $row['Quantity'] . "</td>";
                                    echo "<td>" . $row['Total_Price'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No bookings found.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box b6" style="padding: 40px; width: 350px;"> <!-- ลดความกว้างของ box6 -->
                <h4 style="margin-bottom: 10px; font-weight: 600;">Recent Members</h4>
                <table class="table table-bordered no-border" style="font-size: 15px; font-weight: 400;">
                    <tbody>
                        <?php
                            // คำสั่ง SQL ดึงข้อมูล 10 สมาชิกล่าสุด
                            $sql_members = "SELECT M.Profile, M.Username, M.Email FROM Member M ORDER BY M.Date_Time DESC LIMIT 10";
                            $result_members = $conn->query($sql_members);

                            // ตรวจสอบว่ามีข้อมูลหรือไม่
                            if ($result_members->num_rows > 0) {
                                while ($row = $result_members->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td style='padding: 15px; text-align: left; display: flex; align-items: center;'>"; // ใช้ flexbox
                                    // รูปภาพ
                                    if ($row['Profile']) {
                                        // ถ้ามีข้อมูลรูปภาพในฐานข้อมูลเป็น BLOB
                                        echo "<div class='profile-image-container' style='margin-right: 15px;'>";
                                        echo "<img src='data:image/jpeg;base64," . base64_encode($row['Profile']) . "' alt='Profile Image' class='profile-image'>";
                                        echo "</div>";
                                    } else {
                                        echo "<div class='profile-image-container' style='margin-right: 15px;'>";
                                        echo "<img src='user.png' alt='Profile Image' class='profile-image'>"; // ใช้รูป default หากไม่มีข้อมูล BLOB
                                        echo "</div>";
                                    }
                                    
                                    // ข้อความ Username และ Email โดยจัดให้อยู่ในแนวตั้ง
                                    echo "<div style='display: flex; flex-direction: column;'>";
                                    echo "<strong>" . $row['Username'] . "</strong>"; // Username อยู่ด้านบน
                                    echo "<span style='color: #666;'>" . $row['Email'] . "</span>"; // Email อยู่ด้านล่าง
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td style='text-align: left;'>No members found.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>




        </div>
        
    </div>


    <script>      
        var totalGuest1 = <?php echo $total_guest; ?>;
        var maxGuest1 = <?php echo $max_guest; ?>;
        var remainingGuest1 = <?php echo $remaining_guest; ?>;

        var percentage1 = ((totalGuest1 / maxGuest1) * 100).toFixed(0);
        var displayText1 = (percentage1 == 100) ? "Complete!!" : percentage1 + "%";

        var ctx1 = document.getElementById('progressChart1').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [totalGuest1, remainingGuest1],
                    backgroundColor: ['#1565C0', '#E3F2FD'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    tooltip: { enabled: false },
                    legend: { display: false },
                }
            },
            plugins: [{
                beforeDraw: function(chart) {
                    var ctx = chart.ctx;
                    ctx.restore();
                    var fontSize = (chart.height / 10).toFixed(2);
                    ctx.font = fontSize + "px Arial";
                    ctx.textBaseline = "middle";
                    ctx.textAlign = "center";
                    ctx.fillStyle = "#000";
                    ctx.fillText(displayText1, chart.width / 2, chart.height / 2);
                    ctx.save();
                }
            }]
        });

    </script>

    <script>      
        var totalGuest2 = <?php echo $total_guest_perfume; ?>;
        var maxGuest2 = <?php echo $max_guest_perfume; ?>;
        var remainingGuest2 = <?php echo $remaining_guest_perfume; ?>;

        var percentage2 = ((totalGuest2 / maxGuest2) * 100).toFixed(0);
        var displayText2 = (percentage2 == 100) ? "Complete!!" : percentage2 + "%";

        var ctx2 = document.getElementById('progressChart2').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [totalGuest2, remainingGuest2],
                    backgroundColor: ['#1565C0', '#E3F2FD'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    tooltip: { enabled: false },
                    legend: { display: false },
                }
            },
            plugins: [{
                beforeDraw: function(chart) {
                    var ctx = chart.ctx;
                    ctx.restore();
                    var fontSize = (chart.height / 10).toFixed(2);
                    ctx.font = fontSize + "px Arial";
                    ctx.textBaseline = "middle";
                    ctx.textAlign = "center";
                    ctx.fillStyle = "#000";
                    ctx.fillText(displayText2, chart.width / 2, chart.height / 2);
                    ctx.save();
                }
            }]
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>

</body>
</html>