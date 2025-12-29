<?php
include '../db.php';
$name = $_POST['name'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$sql = "INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $pass, $role);

if ($stmt->execute()) {
    // If role is employee/employer, create dummy details row to avoid errors later
    $user_id = $conn->insert_id;
    if ($role == 'employee') {
        $conn->query("INSERT INTO employee_details (user_id) VALUES ($user_id)");
    } elseif ($role == 'employer') {
        $conn->query("INSERT INTO employer_details (user_id) VALUES ($user_id)");
    }
    header("Location: manage_users.php?msg=User Added Successfully");
} else {
    echo "Error: " . $conn->error;
}
?>