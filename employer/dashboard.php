<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='employer'){
  header('Location: ../login.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Employer Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h3>Employer Dashboard</h3>

<div class="row mt-4">

  <!-- Company Profile -->
  <div class="col-md-4">
    <a href="company_profile.php" class="text-decoration-none text-dark">
      <div class="card p-4 text-center">
        <h5>Company Profile</h5>
      </div>
    </a>
  </div>

  <!-- Post Job -->
  <div class="col-md-4">
    <a href="post_job.php" class="text-decoration-none text-dark">
      <div class="card p-4 text-center">
        <h5>Post Job</h5>
      </div>
    </a>
  </div>

  <!-- Applications -->
  <div class="col-md-4">
    <a href="applications.php" class="text-decoration-none text-dark">
      <div class="card p-4 text-center">
        <h5>Applications</h5>
      </div>
    </a>
  </div>

</div>

<a href="../logout.php" class="btn btn-danger mt-4">Logout</a>
</div>

</body>
</html>
