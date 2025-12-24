<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='employer'){
  header('Location: ../login.php'); 
  exit;
}

include '../db.php';

$employer_id = $_SESSION['user_id'];

$sql = "
SELECT 
  job_applications.id AS app_id,
  jobs.job_title,
  users.name AS employee_name,
  users.email AS employee_email,
  job_applications.applied_at
FROM job_applications
JOIN jobs ON job_applications.job_id = jobs.id
JOIN users ON job_applications.employee_id = users.id
WHERE jobs.employer_id = ?
ORDER BY job_applications.applied_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>Job Applications</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h4>Job Applications</h4>

<table class="table table-bordered mt-3">
<tr>
  <th>#</th>
  <th>Job Title</th>
  <th>Employee Name</th>
  <th>Email</th>
  <th>Applied Date</th>
</tr>

<?php $i=1; while($row = $result->fetch_assoc()){ ?>
<tr>
  <td><?= $i++ ?></td>
  <td><?= $row['job_title'] ?></_]()
}