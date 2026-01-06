<?php
include 'connect.php';  // เชื่อมต่อฐานข้อมูล
include 'navbar.php';   // เรียกใช้งาน Navbar

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล (ตัวอย่างใช้ id = 1)
$email = "krueangphatee_t@silpakorn.ed";
$sql = "SELECT First_Name, Last_Name, Email, Username, Profile FROM Member WHERE Email='$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['First_Name'];
    $last_name = $row['Last_Name'];
    $email = $row['Email'];
    $username = $row['Username'];
    $profile_img = $row['Profile'];  // รูปโปรไฟล์
} else {
    echo "No user found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  <style>
    .profile-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }
  </style>
</head>

<body>
  <div class="container mt-5 pt-5">
    <div class="row justify-content-center">
      <div class="col-8">
        <h3 class="text-center mb-4">Profile</h3>
        <div class="card">
          <div class="card-body">
            <div class="mb-3 text-center">
              <img src="<?php echo $profile_img ? $profile_img : 'https://cdn-icons-png.flaticon.com/512/847/847969.png'; ?>" 
                   alt="Profile" class="profile-img">
            </div>

            <div class="mb-3">
              <p class="mb-1 text-uppercase fw-bold small">Username</p>
              <p class="mb-2"><?php echo htmlspecialchars($username); ?></p>

              <p class="mb-1 text-uppercase fw-bold small">Name Surname</p>
              <p class="mb-2"><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></p>

              <p class="mb-1 text-uppercase fw-bold small">Email</p>
              <p class="mb-3"><?php echo htmlspecialchars($email); ?></p>
            </div>

            <!-- ปุ่มแก้ไข -->
            <div class="text-center mb-4">
              <button class="btn btn-outline-dark w-75">EDIT DETAILS</button>
            </div>

            <!-- ล็อกเอาท์ -->
            <div class="text-center">
              <a href="#" class="text-decoration-none text-dark small">
                Logout <ion-icon name="log-out-outline"></ion-icon>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
