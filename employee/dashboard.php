<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='employee'){
  header('Location: ../login.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Employee Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Employee Dashboard</h3>

  <div class="row mt-4">
    <div class="col-md-4">
      <div class="card p-4 text-center">My Profile</div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 text-center">Browse Jobs</div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 text-center">Applied Jobs</div>
    </div>
  </div>

  <a href="../logout.php" class="btn btn-danger mt-4">Logout</a>
</div>
</body>
</html>
