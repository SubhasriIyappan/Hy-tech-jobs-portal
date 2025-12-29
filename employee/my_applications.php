<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employee') {
  header('Location: ../login.php');
  exit;
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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>My Applications</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .app-card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      background: white;
    }

    .table thead {
      background: #007bff;
      color: white;
    }

    .status-badge {
      font-weight: 500;
      font-size: 0.85rem;
      padding: 5px 12px;
      border-radius: 20px;
    }
  </style>
</head>

<body>

  <div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold">📁 My Applied Jobs</h3>
      <a href="dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">← Back to Dashboard</a>
    </div>

    <div class="card app-card">
      <div class="card-body p-0">
        <?php if ($apps->num_rows > 0) { ?>
          <table class="table table-hover mb-0">
            <thead class="table-dark">
              <tr>
                <th class="p-3">Job Title</th>
                <th class="p-3">Employer</th>
                <th class="p-3">Applied Date</th>
                <th class="p-3">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($a = $apps->fetch_assoc()) {
                $statusClass = match ($a['status']) {
                  'approved' => 'bg-success',
                  'rejected' => 'bg-danger',
                  default => 'bg-warning text-dark'
                };
                ?>
                <tr>
                  <td class="p-3 fw-bold"><?= htmlspecialchars($a['job_title']) ?></td>
                  <td class="p-3"><?= htmlspecialchars($a['employer_name']) ?></td>
                  <td class="p-3 text-muted"><?= date('d M Y', strtotime($a['applied_at'])) ?></td>
                  <td class="p-3">
                    <span class="badge status-badge <?= $statusClass ?>">
                      <?= ucfirst($a['status']) ?>
                    </span>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } else { ?>
          <div class="text-center p-5 text-muted">
            <h4>📭 You haven't applied to any jobs yet.</h4>
            <a href="jobs.php" class="btn btn-primary mt-3 rounded-pill">Browse Jobs</a>
          </div>
        <?php } ?>
      </div>
    </div>

  </div>
</body>

</html>