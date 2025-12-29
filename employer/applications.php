<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employer') {
  header('Location: ../login.php');
  exit;
}

include '../db.php';

$employer_id = $_SESSION['user_id'];

$sql = "
SELECT 
  job_applications.id AS app_id,
  jobs.job_title,
  users.name AS employee_name,
  users.email AS employee_email,
  job_applications.applied_at,
  job_applications.status,
  employee_details.resume_path
FROM job_applications
JOIN jobs ON job_applications.job_id = jobs.id
JOIN users ON job_applications.employee_id = users.id
LEFT JOIN employee_details ON users.id = employee_details.user_id
WHERE jobs.employer_id = ?
ORDER BY job_applications.id DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Job Applications</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
    }

    .table-card {
      border: none;
      border-radius: 15px;
      background: white;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      padding: 20px;
    }

    .table thead {
      background: #1e3c72;
      color: white;
    }

    .applicant-name {
      font-weight: 600;
      color: #333;
    }
  </style>
</head>

<body>

  <div class="container mt-5 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold">📩 Received Applications</h3>
      <a href="dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">← Back to Dashboard</a>
    </div>

    <div class="table-card">
      <?php if ($result->num_rows > 0): ?>
        <table class="table table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th class="p-3">Job Role</th>
              <th class="p-3">Candidate</th>
              <th class="p-3">Applied On</th>
              <th class="p-3">Resume</th>
              <th class="p-3">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()) {
              $statusClass = match ($row['status']) {
                'approved' => 'bg-success',
                'rejected' => 'bg-danger',
                default => 'bg-warning text-dark'
              };
              ?>
              <tr>
                <td class="p-3"><?= htmlspecialchars($row['job_title']) ?></td>
                <td class="p-3">
                  <div class="applicant-name"><?= htmlspecialchars($row['employee_name']) ?></div>
                  <small class="text-muted"><?= htmlspecialchars($row['employee_email']) ?></small>
                </td>
                <td class="p-3 text-muted"><?= date('d M Y', strtotime($row['applied_at'])) ?></td>
                <td class="p-3">
                  <?php if (!empty($row['resume_path'])): ?>
                    <a href="../uploads/resumes/<?= $row['resume_path'] ?>" target="_blank"
                      class="btn btn-sm btn-outline-primary rounded-pill">📄 View Resume</a>
                  <?php else: ?>
                    <span class="text-muted small">No Resume</span>
                  <?php endif; ?>
                </td>
                <td class="p-3">
                  <span class="badge <?= $statusClass ?> rounded-pill px-3"><?= ucfirst($row['status']) ?></span>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="text-center py-5 text-muted">
          <h4>📭 No applications received yet.</h4>
        </div>
      <?php endif; ?>
    </div>

  </div>

</body>

</html>