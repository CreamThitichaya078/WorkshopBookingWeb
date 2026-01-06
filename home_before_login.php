<?php include 'navbar_before.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Ionicons -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>

    <!-- External CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 130vh;
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 100px;
        }

        .image-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .image-wrapper {
            position: relative;
        }

        .image-wrapper img {
            display: block;
            width: 100%;
            height: auto;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(76, 92, 065, 0.5); /* Semi-transparent background */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            align-items: flex-end; /* Align title to the bottom */
            padding-bottom: 0px; /* Add some padding at the bottom */
        }

        .image-wrapper:hover .image-overlay {
            opacity: 1;
        }

        .image-title {
            text-align: center;
            font-size: 1.5em;
            font-family: sans-serif;
            font-weight: bold;
            margin-bottom: 1;
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

    <main>
        <div class="image-container">
        <a href="gallery_before.php">
            <div class="image-wrapper">
                <img src="Property 1=Frame 7.png" alt="Image 1">
                <div class="image-overlay">
                    <h2 class="image-title">GALLERY</h2>
                </div>
            </div>
        </a>
            <div class="image-wrapper">
            <a href="all_workshop_before.php">
                <img src="Component 2.png" alt="Image 2">
                <div class="image-overlay">
                    <h2 class="image-title">WORKSHOP</h2>
                </div>
            </div>
            </a>
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
