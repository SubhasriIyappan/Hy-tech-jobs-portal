<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='employee'){
  header('Location: ../login.php'); exit;
}
include '../db.php';

$employee_id = $_SESSION['user_id'];
$apps = $conn->query("SELECT ja.*, j.job_title, u.name AS employer_name 
                      FROM job_applications ja
                      JOIN jobs j ON ja.job_id = j.id
                      JOIN users u ON j.employer_id = u.id
                      WHERE ja.employee_id = $employee_id
                      ORDER BY ja.applied_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>My Applications</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h4>My Applied Jobs</h4>

<?php if($apps->num_rows>0){ ?>
<table class="table table-bordered">
<tr><th>Job Title</th><th>Employer</th><th>Applied At</th></tr>
<?php while($a = $apps->fetch_assoc()){ ?>
<tr>
<td><?= $a['job_title'] ?></td>
<td><?= $a['employer_name'] ?></td>
<td><?= $a['applied_at'] ?></td>
</tr>
<?php } ?>
</table>
<?php } else { ?>
<p>You have not applied to any job yet.</p>
<?php } ?>

</div>
</body>
</html>
