<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='employer'){
  header('Location: ../login.php'); exit;
}
include '../db.php';

$id = $_SESSION['user_id'];

$q = $conn->query("SELECT u.name,u.email,e.*
                   FROM users u
                   JOIN employer_details e ON u.id=e.user_id
                   WHERE u.id=$id");
$data = $q->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title>Company Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h4>Company Profile</h4>

<table class="table table-bordered">
<tr><th>Company Name</th><td><?= $data['company_name'] ?></td></tr>
<tr><th>Company Email</th><td><?= $data['company_email'] ?></td></tr>
<tr><th>Phone</th><td><?= $data['company_phone'] ?></td></tr>
<tr><th>Website</th><td><?= $data['company_website'] ?></td></tr>
<tr><th>HR Name</th><td><?= $data['hr_name'] ?></td></tr>
<tr><th>HR Email</th><td><?= $data['hr_email'] ?></td></tr>
<tr><th>Description</th><td><?= $data['company_description'] ?></td></tr>
</table>

<a href="dashboard.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
