<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.php');
  exit;
}

$job_id = $_POST['job_id'] ?? null;
$employee_id = $_SESSION['user_id'];

if (!$job_id) {
  die("Error: Job ID is missing.");
}

$sql = "INSERT INTO job_applications (job_id,employee_id) VALUES (?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $job_id, $employee_id);
$stmt->execute();

header("Location: jobs.php?msg=applied");
exit;
?>