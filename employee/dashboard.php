<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employee') {
  header('Location: ../login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
    }

    .dashboard-header {
      background: linear-gradient(135deg, #007bff, #0056b3);
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
  </style>
</head>

<body>

  <!-- Header -->
  <div class="dashboard-header text-center">
    <div class="container">
      <h2 class="fw-bold">👋 Welcome, Job Seeker!</h2>
      <p class="opacity-75">Your career journey starts here. Manage your profile and find your dream job.</p>
    </div>
  </div>

  <div class="container">
    <div class="row g-4">

      <!-- My Profile -->
      <div class="col-md-4">
        <a href="my_profile.php" class="text-decoration-none text-dark">
          <div class="card action-card shadow-sm">
            <div class="card-icon">👤</div>
            <h5 class="fw-bold">My Profile</h5>
            <p class="text-muted small">View and edit your resume and personal details.</p>
          </div>
        </a>
      </div>

      <!-- Browse Jobs -->
      <div class="col-md-4">
        <a href="jobs.php" class="text-decoration-none text-dark">
          <div class="card action-card shadow-sm">
            <div class="card-icon">🔍</div>
            <h5 class="fw-bold">Browse Jobs</h5>
            <p class="text-muted small">Explore new opportunities and apply today.</p>
          </div>
        </a>
      </div>

      <!-- Applied Jobs -->
      <div class="col-md-4">
        <a href="my_applications.php" class="text-decoration-none text-dark">
          <div class="card action-card shadow-sm">
            <div class="card-icon">📁</div>
            <h5 class="fw-bold">My Applications</h5>
            <p class="text-muted small">Track the status of your submitted applications.</p>
          </div>
        </a>
      </div>

    </div>

    <div class="text-center mt-5">
      <a href="../logout.php" class="btn btn-outline-danger px-4 rounded-pill">Logout</a>
    </div>
  </div>

</body>

</html>