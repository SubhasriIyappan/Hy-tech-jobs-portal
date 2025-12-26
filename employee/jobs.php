<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='employee'){
  header('Location: ../login.php'); exit;
}
include '../db.php';

$where = [];
$params = [];
$types = "";

/* SEARCH LOGIC */
if(!empty($_GET['job_title'])){
  $where[] = "job_title LIKE ?";
  $params[] = "%".$_GET['job_title']."%";
  $types .= "s";
}

if(!empty($_GET['location'])){
  $where[] = "location LIKE ?";
  $params[] = "%".$_GET['location']."%";
  $types .= "s";
}

if(!empty($_GET['salary'])){
  $where[] = "salary LIKE ?";
  $params[] = "%".$_GET['salary']."%";
  $types .= "s";
}

$sql = "SELECT * FROM jobs";
if(count($where)>0){
  $sql .= " WHERE ".implode(" AND ",$where);
}
$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);
if(count($params)>0){
  $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>Browse Jobs</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

<h4>Browse Jobs</h4>

<!-- SEARCH FORM -->
<form method="get" class="row g-2 mb-4">
  <div class="col-md-4">
    <input type="text" name="job_title" class="form-control" placeholder="Job Role">
  </div>
  <div class="col-md-3">
    <input type="text" name="location" class="form-control" placeholder="Location">
  </div>
  <div class="col-md-3">
    <input type="text" name="salary" class="form-control" placeholder="Salary">
  </div>
  <div class="col-md-2">
    <button class="btn btn-primary w-100">Search</button>
  </div>
</form>

<!-- JOB LIST -->
<?php while($job = $result->fetch_assoc()){ ?>
<div class="card p-3 mb-3">
  <h5><?= $job['job_title'] ?></h5>
  <p><?= $job['job_description'] ?></p>
  <small>
    📍 <?= $job['location'] ?> |
    💼 <?= $job['experience'] ?> |
    💰 <?= $job['salary'] ?>
  </small>

  <form method="post" action="apply_job.php" class="mt-2">
    <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
    <button class="btn btn-success btn-sm">Apply Job</button>
  </form>
</div>
<?php } ?>

</div>
</body>
</html>
