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
    <a href="my_applications.php" class="text-decoration-none">
      <div class="card p-4 text-center btn btn-outline-primary">
        My Profile
      </div>
    </a>
  </div>

  <div class="col-md-4">
    <a href="jobs.php" class="text-decoration-none">
      <div class="card p-4 text-center btn btn-outline-success">
        Browse Jobs
      </div>
    </a>
  </div>

  <div class="col-md-4">
    <a href="apply_job.php" class="text-decoration-none">
      <div class="card p-4 text-center btn btn-outline-warning">
        Applied Jobs
      </div>
    </a>
  </div>
</div>


  <a href="../logout.php" class="btn btn-danger mt-4">Logout</a>
</div>
</body>
</html>
