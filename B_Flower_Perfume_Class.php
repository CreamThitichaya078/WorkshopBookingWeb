

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flower Perfume Class</title>

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
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding: 130px;
            gap: 2rem;
            align-items: start; /* ปรับการจัดแนวตามแนวตั้งเป็นเริ่มต้น */
            justify-content: center; /* จัดให้เนื้อหาอยู่ตรงกลางตามแนวนอน */
            width: 90%; /* กำหนดความกว้างของ main (ปรับตามต้องการ) */
            margin: 0px auto 0; /* จัดกึ่งกลาง main ในหน้าจอ */
        }

        .carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .carousel img {
            width: 100%;
            display: none;
            transition: opacity 0.5s ease;
            border-radius: 0px;
        }

        .carousel img.active {
            display: block;
        }

        .carousel button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            color: black;
            border: 0px solid gray;
            border-radius: 50%;
            padding: 0.75rem;
            width: 40px;
            height: 40px;
            cursor: pointer;
            font-size: 1.2rem;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .carousel .prev {
            left: 10px;
        }

        .carousel .next {
            right: 10px;
        }

        .product-details {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem; /* ลดระยะห่างระหว่างแต่ละส่วนใน details */
            padding: 0; /* ลบ padding เพิ่มความแน่นขนัด */
            margin: 0; /* ลบ margin */
        }

        .details h1 {
            font-size: 1.75rem; /* ลดขนาดฟอนต์เพื่อให้พอดีกับเนื้อหา */
            margin: 0 0 0.5rem 0; /* ทำให้ห่างจากเนื้อหาอื่นแค่ 0.5rem */
        }

        .details p {
            font-size: 1rem; /* ปรับขนาดฟอนต์ให้อ่านง่าย */
            margin: 0; /* ลบ margin เพิ่มระเบียบ */
        }

        .price-quantity {
            display: flex;
            align-items: center;
            gap: 1.5rem; /* เพิ่มระยะห่างระหว่างราคากับ quantity-box */
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 1rem; 
        }

        .price-quantity p {
            margin: 0;
            line-height: 1; /* ทำให้ไม่กินพื้นที่แนวตั้งเกินไป */
        }

        .quantity-box {
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px; /* เพิ่มความมนนิดนึง */
            padding: 0 0.75rem;
            gap: 1rem;
            font-size: 1.1rem;
            height: 40px;
            align-self: center; /* ทำให้ตรงแนวเดียวกับราคา */
            margin-top: 2px; 
            position: relative;
        top: -2px;
        }

        .qty-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #333;
            cursor: pointer;
            padding: 0 0.25rem;
            transition: color 0.2s ease;
        }

        .qty-btn:hover {
            color: #000;
        }

        .qty-number {
            font-weight: 500;
            width: 40px;
            text-align: center;
        }

        /* Select wrapper */
        .select-wrapper {
            position: relative;
            width: 48%; /* ให้แต่ละ dropdown ใช้พื้นที่ครึ่งหนึ่ง */
            margin-right: 4%; /* ระยะห่างระหว่าง 2 dropdown */
        }

        .select-wrapper:last-child {
            margin-right: 0; /* ทำให้ไม่มีระยะห่างที่ขวาสุด */
        }
        /* Style สำหรับ select */
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #ffffff;
            border: 1px solid #000000;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 1rem;
            line-height: 20px; /* จัดตัวอักษรให้อยู่ตรงกลาง */
            color: #000000;
            width: 100%;
            cursor: pointer;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            padding-right: 40px; /* เพิ่มพื้นที่ด้านขวาเพื่อใส่ลูกศร */
            height: 30px;
        }
        /* เพิ่มลูกศรลงใน select wrapper */
        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 10px;
            top: 75%;
            transform: translateY(-50%);
            pointer-events: none;
            width: 30px;
            height: 25px;
            background: url('down-arrow.png') no-repeat center;
            background-size: contain; /* ปรับขนาดภาพ */
            
        }

        .main-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* กำหนดระยะห่างระหว่าง 2 dropdown */
            width: 100%;
        }
        .actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .actions button {
            padding: 12px 20px;
            border: 1px solid #000;
            color: rgb(0, 0, 0);
            background-color: #ffffff;
            cursor: pointer;
            border-radius: 4px;
            font-size: 1em;
            transition: background-color 0.6s ease;
        }

        .actions button:hover {
            color: rgb(255, 255, 255);
            background-color: #000000;
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
    
<!-- Navbar -->
<?php include('navbar_before.php'); ?>
    <main>
        <div class="carousel">
            <img src="image77.png" alt="Flower 1" class="active" />
            <img src="image88.png" alt="Flower 2" />
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div>
        <div class="details">
            <h1>Flower Perfume Class</h1>
            <p>Learn how to make a flower perfume.</p>


            <form action="loginNew.php" method="POST">
                <!-- ราคา + จำนวน -->
                <div class="price-quantity">
                    <p>3,900 ฿ THB / 1 guest</p>
                    <div class="quantity-box">
                        <button class="qty-btn" type="button">-</button>
                        <span class="qty-number">1</span>
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <button class="qty-btn" type="button">+</button>
                    </div>
                </div>

                <!-- วันที่ + เวลา -->
                <div class="main-wrapper">
                    <!-- Date Dropdown -->
                    <div class="select-wrapper">
                        <label for="date" style="font-size: 1rem; margin-bottom: 5px; display: block;">Date</label>
                        <select id="date" name="date" required>
                            <option value="12 Apr 2025">12 Apr 2025</option>
                            <option value="13 Apr 2025">13 Apr 2025</option>
                        </select>
                    </div>

                    <!-- Time Dropdown -->
                    <div class="select-wrapper">
                        <label for="time" style="font-size: 1rem; margin-bottom: 5px; display: block;">Time</label>
                        <select id="time" name="time" required>
                            <option value="10:00 - 12:00 AM">10:00 - 12:00 AM</option>
                            <option value="14:00 - 16:00 PM">14:00 - 16:00 PM</option>
                        </select>
                    </div>
                </div>

                <!-- ซ่อนค่า workshop -->
                <input type="hidden" name="Workshop" value="Flower Perfume Class" required>
                <input type="hidden" name="Price" value="3900" required>

                <!-- ปุ่มยืนยัน -->
                <div class="actions">
                    <button type="submit">BOOK NOW</button>
                </div>
            </form>

            <div>
                <p>Learn how to make perfume from flowers, herbs, and other plants from your garden. This class focuses on how to make oil based perfume.</p>
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
    <script>
        const images = document.querySelectorAll('.carousel img');
        const nextBtn = document.querySelector('.carousel .next');
        const prevBtn = document.querySelector('.carousel .prev');
        let current = 0;
    
        function showImage(index) {
            images.forEach((img, i) => {
                img.classList.toggle('active', i === index);
            });
        }
    
        nextBtn.addEventListener('click', () => {
            current = (current + 1) % images.length;
            showImage(current);
        });
    
        prevBtn.addEventListener('click', () => {
            current = (current - 1 + images.length) % images.length;
            showImage(current);
        });
    
        showImage(current);
    
        // ปรับจำนวนคนระหว่าง 1-4
        const qtyDisplay = document.querySelector('.qty-number');
        const qtyInput = document.getElementById('quantity');
        const qtyButtons = document.querySelectorAll('.qty-btn');
        let count = 1;

        qtyButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.textContent === '+' && count < 4) {
                    count++;
                } else if (btn.textContent === '-' && count > 1) {
                    count--;
                }
                qtyDisplay.textContent = count;
                qtyInput.value = count;
            });
        });
    </script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>