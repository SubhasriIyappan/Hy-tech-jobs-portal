<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employer') {
  header('Location: ../login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employer Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
    }

    .dashboard-header {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      color: white;
      padding: 40px 0;
      margin-bottom: 40px;
      border-radius: 0 0 20px 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .action-card {
      border: none;
      border-radius: 15px;
      transition: transform 0.3s, box-shadow 0.3s;
      height: 100%;
      text-align: center;
      padding: 30px;
      background: white;
    }

    .action-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .card-icon {
      font-size: 3rem;
      margin-bottom: 15px;
    }

    .btn-logout {
      border: 2px solid white;
      color: white;
      border-radius: 50px;
      padding: 8px 25px;
      transition: 0.3s;
    }

    .btn-logout:hover {
      background: white;
      color: #1e3c72;
    }
  </style>
</head>

<body>

  <!-- Header -->
  <div class="dashboard-header text-center">
    <div class="container">
      <h2 class="fw-bold">🏢 Employer Dashboard</h2>
      <p class="opacity-75">Manage your company profile, post jobs, and find the best talent.</p>
      <div class="mt-3">
        <a href="../logout.php" class="btn btn-logout text-decoration-none">Logout</a>
      </div>
    </div>
  </div>

  <div class="container mb-5">
    <div class="row g-4">

      <!-- Company Profile -->
      <div class="col-md-3">
        <a href="company_profile.php" class="text-decoration-none text-dark">
          <div class="card action-card shadow-sm">
            <div class="card-icon">🏢</div>
            <h5 class="fw-bold">Company Profile</h5>
            <p class="text-muted small">Update your company details, logo, and HR contact.</p>
          </div>
        </a>
      </div>

      <!-- Post Job -->
      <div class="col-md-3">
        <a href="post_job.php" class="text-decoration-none text-dark">
          <div class="card action-card shadow-sm">
            <div class="card-icon">➕</div>
            <h5 class="fw-bold">Post New Job</h5>
            <p class="text-muted small">Create a new job listing to attract candidates.</p>
          </div>
        </a>
      </div>

      <!-- Manage Jobs -->
      <div class="col-md-3">
        <a href="manage_jobs.php" class="text-decoration-none text-dark">
          <div class="card action-card shadow-sm">
            <div class="card-icon">📋</div>
            <h5 class="fw-bold">Manage Jobs</h5>
            <p class="text-muted small">Edit existing jobs, check vacancies, or delete posts.</p>
          </div>
        </a>
      </div>

      <!-- Applications -->
      <div class="col-md-3">
        <a href="applications.php" class="text-decoration-none text-dark">
          <div class="card action-card shadow-sm">
            <div class="card-icon">📩</div>
            <h5 class="fw-bold">Applications</h5>
            <p class="text-muted small">View resumes and manage applicant status.</p>
          </div>
        </a>
      </div>

    </div>
  </div>

</body>

</html>