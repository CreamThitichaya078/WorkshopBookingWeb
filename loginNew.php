<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Ionicons -->
  <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
  <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center; 
      align-items: center; 
    }

    .navbar {
      background-color: #4c5c41;
    }

    .form-box {
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
      animation: fadeIn 1s ease;
    }

    .form-box h2 {
      margin-bottom: 30px;
      color: #4c5c41;
    }

    .input-box {
      position: relative;
      margin-bottom: 20px;
    }

    .input-box input {
      width: 100%;
      padding: 10px 40px 10px 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      outline: none;
    }

    .input-box label {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: white;
      padding: 0 5px;
      color: #aaa;
      pointer-events: none;
      transition: 0.3s;
    }

    .input-box input:focus + label,
    .input-box input:not(:placeholder-shown) + label {
      top: 0;
      left: 5px;
      font-size: 12px;
      color: #4c5c41;
    }

    .icon {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 1.2rem;
      color: #4c5c41;
    }

    .btn {
      width: 100%;
      background-color: #4c5c41;
      color: white;
      border-radius: 8px;
      padding: 10px;
      margin-top: 20px;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #6a7c5b;
    }

    .remember-forgot {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin: 10px 0;
    }

    .login-register {
      margin-top: 20px;
      font-size: 14px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container-fluid">
    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
      <ion-icon name="menu-outline" style="font-size: 2rem; color: white;"></ion-icon>
    </a>
    <a class="navbar-brand mx-auto" href="#" style="font-size: 25px;">FLOWIER</a>
  </div>
</nav>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="gallery_before.php">Gallery</a></li>
      <li class="nav-item"><a class="nav-link" href="all_workshop_before.php">Workshop</a></li>
      <li class="nav-item"><a class="nav-link" href="about_before.php">About</a></li>
    </ul>
  </div>
</div>

<!-- Form Box -->
<div class="form-box">
  <h2>Login</h2>
  <form action="login.php" method="post">
    <div class="input-box">
      <input type="email" name="email" required placeholder=" ">
      <label>Email</label>
      <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
    </div>
    <div class="input-box">
      <input type="password" name="password" required placeholder=" ">
      <label>Password</label>
      <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
    </div>

    <div class="remember-forgot">
      <label><input type="checkbox"> Remember me</label>
      <a href="#">Forgot Password?</a>
    </div>

    <button type="submit" class="btn">Login</button>

    <div class="login-register">
      <p>Don't have an account? <a href="registerNew.php">Register</a></p>
    </div>
  </form>
</div>
<script>
        const body = document.querySelector('body');
        const registerLink = document.querySelector('.register-link');
        const loginLink = document.querySelector('.login-link');
        const wrapper = document.querySelector('.wrapper');
        registerLink.addEventListener('click', () => {
            wrapper.classList.add('active');
            body.classList.add('bg-active'); // เปลี่ยนสีพื้นหลัง
        });

        loginLink.addEventListener('click', () => {
            wrapper.classList.remove('active');
            body.classList.add('bg-active'); // เปลี่ยนสีพื้นหลัง
        });
    <script>
<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
