<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employer') {
  header('Location: ../login.php');
  exit;
}
include '../db.php';

$employer_id = $_SESSION['user_id'];
$jobs = $conn->query("SELECT jobs.id AS job_id, jobs.job_title 
                      FROM jobs WHERE employer_id = $employer_id");

?>
<!DOCTYPE html>
<html>

<head>
  <title>View Applications</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h4>Applications Received</h4>

    <?php while ($job = $jobs->fetch_assoc()) {
      $job_id = $job['job_id'];
      $apps = $conn->query("SELECT ja.*, u.name, u.email 
                          FROM job_applications ja 
                          JOIN users u ON ja.employee_id = u.id
                          WHERE ja.job_id = $job_id");
      ?>
      <div class="card mb-3 p-3">
        <h5><?= $job['job_title'] ?></h5>

        <?php if ($apps->num_rows > 0) { ?>
          <div class="alert alert-info">
            <strong>Application Count:</strong> <?= $apps->num_rows ?> <br>
            Application details available to Admin only.
          </div>
        <?php } else { ?>
          <p>No applications yet.</p>
        <?php } ?>

      </div>
    <?php } ?>
  </div>
</body>

</html>