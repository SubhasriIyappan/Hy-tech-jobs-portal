<?php
include '../db.php';
$id = $_GET['id'];

// Cascading delete usually handled by DB, but here we do manual cleanup if needed
// For now, simpler delete:
$conn->query("DELETE FROM users WHERE id=$id");
$conn->query("DELETE FROM employee_details WHERE user_id=$id");
$conn->query("DELETE FROM employer_details WHERE user_id=$id");

header("Location: manage_users.php?msg=User Deleted Successfully");
?>