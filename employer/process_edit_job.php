<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$employer_id = $_SESSION['user_id'];
$job_id = $_POST['job_id'];

$title = $_POST['job_title'];
$desc = $_POST['job_description'];
$loc = $_POST['location'];
$exp = $_POST['experience'];
$sal = $_POST['salary'];
$vac = $_POST['vacancy_count'];

// Secure Update
$sql = "UPDATE jobs SET job_title=?, job_description=?, location=?, experience=?, salary=?, vacancy_count=? 
        WHERE id=? AND employer_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssiii", $title, $desc, $loc, $exp, $sal, $vac, $job_id, $employer_id);

if ($stmt->execute()) {
    header("Location: manage_jobs.php?msg=updated");
} else {
    echo "Error updating job: " . $conn->error;
}
?>