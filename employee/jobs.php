<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='employee'){
  header('Location: ../login.php'); exit;
}
include '../db.php';

$jobs = $conn->query("SELECT jobs.*, users.name AS company 
                      FROM jobs 
                      JOIN users ON jobs.employer_id = users.id
                      ORDER BY jobs.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Jobs</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h4>Available Jobs</h4>

<?php while($j = $jobs->fetch_assoc()){ ?>
<div class="card p-3 mb-3">
  <h5><?= $j['job_title'] ?></h5>
  <p><?= $j['job_description'] ?></p>
  <small><?= $j['location'] ?> | <?= $j['experience'] ?> | <?= $j['salary'] ?></small>

  <form method="post" action="apply_job.php" class="mt-2">
    <input type="hidden" name="job_id" value="<?= $j['id'] ?>">
    <button class="btn btn-success btn-sm">Apply</button>
  </form>
</div>
<?php } ?>

</div>
</body>
</html>
