<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.php');
  exit;
}

$employer_id = $_SESSION['user_id'];
$title = $_POST['job_title'];
$desc = $_POST['job_description'];
$loc = $_POST['location'];
$exp = $_POST['experience'];
$sal = $_POST['salary'];
$vac = $_POST['vacancy_count'] ?? 1;

$sql = "INSERT INTO jobs (employer_id,job_title,job_description,location,experience,salary,vacancy_count)
        VALUES (?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssi", $employer_id, $title, $desc, $loc, $exp, $sal, $vac);
$stmt->execute();

header("Location: dashboard.php?msg=job_posted");

header("Location: dashboard.php");
exit;
?>