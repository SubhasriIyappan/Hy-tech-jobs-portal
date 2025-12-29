<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employee') {
  header('Location: ../login.php');
  exit;
}
include '../db.php';

$where = [];
$params = [];
$types = "";

/* SEARCH LOGIC */
if (!empty($_GET['job_title'])) {
  $where[] = "job_title LIKE ?";
  $params[] = "%" . $_GET['job_title'] . "%";
  $types .= "s";
}
if (!empty($_GET['location'])) {
  $where[] = "location LIKE ?";
  $params[] = "%" . $_GET['location'] . "%";
  $types .= "s";
}
if (!empty($_GET['salary'])) {
  $where[] = "salary LIKE ?";
  $params[] = "%" . $_GET['salary'] . "%";
  $types .= "s";
}

$sql = "SELECT * FROM jobs";
if (count($where) > 0) {
  $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);
if (count($params) > 0) {
  $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

/* FETCH APPLIED JOBS */
$my_id = $_SESSION['user_id'];
$app_sql = "SELECT job_id FROM job_applications WHERE employee_id = $my_id";
$app_res = $conn->query($app_sql);
$applied_jobs = [];
while ($row = $app_res->fetch_assoc()) {
  $applied_jobs[] = $row['job_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Browse Jobs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
    }

    .search-card {
      border: none;
      border-radius: 15px;
      padding: 20px;
      background: white;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .job-card {
      border: none;
      border-radius: 12px;
      transition: all 0.3s;
      background: white;
      margin-bottom: 20px;
      overflow: hidden;
      border-left: 5px solid #007bff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .job-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .job-title {
      font-weight: 700;
      color: #333;
    }

    .job-meta {
      font-size: 0.9rem;
      color: #666;
      margin-top: 10px;
    }

    .meta-icon {
      margin-right: 5px;
    }
  </style>
</head>

<body>

  <div class="container mt-5 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold">🚀 Browse Jobs</h3>
      <a href="dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">← Back to Dashboard</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'applied'): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Job Applied Successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <!-- Search Section -->
    <div class="search-card mb-4">
      <form method="get" class="row g-2">
        <div class="col-md-4">
          <input type="text" name="job_title" class="form-control" placeholder="🔍 Search by Job Role">
        </div>
        <div class="col-md-3">
          <input type="text" name="location" class="form-control" placeholder="📍 Location">
        </div>
        <div class="col-md-3">
          <input type="text" name="salary" class="form-control" placeholder="💰 Salary">
        </div>
        <div class="col-md-2">
          <button class="btn btn-primary w-100 fw-bold">Search</button>
        </div>
      </form>
    </div>

    <!-- Job List -->
    <div class="row">
      <?php while ($job = $result->fetch_assoc()) {
        $is_applied = in_array($job['id'], $applied_jobs);
        ?>
        <div class="col-md-6">
          <div class="job-card p-4">
            <h5 class="job-title"><?= htmlspecialchars($job['job_title']) ?></h5>
            <p class="text-muted small mb-2"><?= substr(htmlspecialchars($job['job_description']), 0, 100) ?>...</p>

            <div class="job-meta">
              <span class="me-3">📍 <?= htmlspecialchars($job['location']) ?></span>
              <span class="me-3">💼 <?= htmlspecialchars($job['experience']) ?></span>
            </div>
            <div class="job-meta text-success fw-bold">
              💰 <?= htmlspecialchars($job['salary']) ?>
            </div>

            <form method="post" action="apply_job.php" class="mt-3">
              <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
              <?php if ($is_applied): ?>
                <button type="button" class="btn btn-secondary btn-sm w-100 rounded-pill" disabled>✅ Already
                  Applied</button>
              <?php else: ?>
                <button class="btn btn-primary btn-sm w-100 rounded-pill shadow-sm">Apply Now 🚀</button>
              <?php endif; ?>
            </form>
          </div>
        </div>
      <?php } ?>

      <?php if ($result->num_rows == 0): ?>
        <div class="col-12 text-center text-muted mt-5">
          <h4>😞 No jobs found matching your criteria.</h4>
        </div>
      <?php endif; ?>

    </div>

  </div>
</body>

</html>