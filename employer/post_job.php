<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='employer'){
  header('Location: ../login.php'); exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Post Job</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h4>Post Job</h4>

<form method="post" action="process_post_job.php">
<input type="text" name="job_title" class="form-control mb-2" placeholder="Job Title" required>

<textarea name="job_description" class="form-control mb-2" placeholder="Job Description" required></textarea>

<input type="text" name="location" class="form-control mb-2" placeholder="Location" required>

<select name="experience" class="form-select mb-2">
  <option>Fresher</option>
  <option>1-3 Years</option>
  <option>3-5 Years</option>
  <option>5+ Years</option>
</select>

<input type="text" name="salary" class="form-control mb-2" placeholder="Salary">

<button class="btn btn-primary">Post Job</button>
</form>
</div>
</body>
</html>
