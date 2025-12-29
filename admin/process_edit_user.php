<?php
include '../db.php';
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];

$sql = "UPDATE users SET name=?, email=?, role=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $email, $role, $id);

if ($stmt->execute()) {
    header("Location: manage_users.php?msg=User Updated Successfully");
} else {
    echo "Error: " . $conn->error;
}
?>