<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$employer_id = $_SESSION['user_id'];
$job_id = $_GET['id'];

// Secure Delete
$stmt = $conn->prepare("DELETE FROM jobs WHERE id=? AND employer_id=?");
$stmt->bind_param("ii", $job_id, $employer_id);

if ($stmt->execute()) {
    header("Location: manage_jobs.php?msg=deleted");
} else {
    echo "Error deleting job: " . $conn->error;
}
?>