<?php
session_start();
include 'db.php';

/* Safety check */
if (!isset($_POST['email'], $_POST['password'])) {
    die("Invalid Request");
}

$email    = $_POST['email'];
$password = $_POST['password'];

/* Prepare statement (SECURE) */
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare Failed: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

/* Password verify */
if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role']    = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    }

    if ($user['role'] === 'employee') {
        header("Location: employee/dashboard.php");
        exit;
    }

    if ($user['role'] === 'employer') {
        header("Location: employer/dashboard.php");
        exit;
    }

} else {
    echo "❌ Invalid Email or Password";
}
?>
