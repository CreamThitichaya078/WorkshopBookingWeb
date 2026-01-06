<?php
session_start();
include('connect.php');

// ดึง email จาก session
$email = $_SESSION['Email'] ?? '';
if (!$email) {
    die("Email not found in session. Please login again.");
}

// ดึงข้อมูลผู้ใช้จาก DB
$sql = "SELECT * FROM Member WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $conn->error);
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">Edit Profile</h3>
    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="username" value="<?php echo htmlspecialchars($user['Username']); ?>">
        <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" name="profile_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['First_Name']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['Last_Name']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['Username']); ?>" >
        </div>

        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['Phone_Number']); ?>">
        </div>

        <hr>
        <h6 class="text-uppercase mt-4">Add Credit/Debit</h6>

        <div class="mb-3">
            <input type="text" name="card_name" class="form-control" placeholder="Name on Card">
        </div>

        <div class="mb-3">
            <input type="text" name="card_number" class="form-control" placeholder="Credit Card Number">
        </div>

        <div class="mb-3">
            <input type="text" name="expiry" class="form-control" placeholder="Month/Year">
        </div>

        <div class="mb-3">
            <input type="text" name="cvv" class="form-control" placeholder="Security Code (CVV)">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="home_after_login.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
