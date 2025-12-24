<?php
session_start();
if(isset($_SESSION['role'])){
    // Role based redirect
    if($_SESSION['role']=='admin') header('Location: admin/dashboard.php');
    if($_SESSION['role']=='employee') header('Location: employee/dashboard.php');
    if($_SESSION['role']=='employer') header('Location: employer/dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Job Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f4f6f8; }
.center-box { max-width: 500px; margin: 100px auto; background: #fff; padding: 30px; border-radius: 10px; text-align: center; }
.btn-custom { width: 100%; margin: 10px 0; }
</style>
</head>
<body>

<div class="center-box">
    <h3>Welcome to Job Portal</h3>
    <p>Select your action:</p>

    <a href="login.php" class="btn btn-primary btn-custom">Login</a>
    <a href="register/register.php" class="btn btn-success btn-custom">Register</a>
</div>

</body>
</html>
