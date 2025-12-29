<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
  header('Location: ../login.php');
  exit;
}
include '../db.php';

// Stats
$user_count = $conn->query("SELECT COUNT(*) as c FROM users")->fetch_assoc()['c'];
$job_count = $conn->query("SELECT COUNT(*) as c FROM jobs")->fetch_assoc()['c'];
$app_count = $conn->query("SELECT COUNT(*) as c FROM job_applications")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f6f9;
      overflow-x: hidden;
    }

    /* Sidebar */
    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background: #343a40;
      color: white;
      padding-top: 20px;
      transition: 0.3s;
    }

    .sidebar a {
      padding: 15px 25px;
      text-decoration: none;
      font-size: 1rem;
      color: #ddd;
      display: block;
      transition: 0.3s;
    }

    .sidebar a:hover {
      background: #495057;
      color: white;
      border-left: 4px solid #007bff;
    }

    .sidebar .brand {
      font-size: 1.5rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 30px;
      color: #fff;
    }

    /* Content */
    .content {
      margin-left: 250px;
      padding: 30px;
    }

    .stats-card {
      background: white;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-left: 5px solid #007bff;
    }

    .stats-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: #333;
    }

    .stats-label {
      color: #777;
      font-weight: 500;
    }

    .stats-icon {
      font-size: 3rem;
      color: #e9ecef;
    }

    .welcome-banner {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 30px;
      border-radius: 15px;
      margin-bottom: 30px;
      box-shadow: 0 5px 15px rgba(118, 75, 162, 0.3);
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="brand">Admin Panel 🛡️</div>
    <a href="dashboard.php" class="bg-secondary bg-opacity-25">📊 Dashboard</a>
    <a href="manage_users.php">👥 Manage Users</a>
    <a href="manage_employees.php">👨‍💼 Employee Details</a>
    <a href="manage_employers.php">🏢 Employer Details</a>
    <a href="manage_jobs.php">💼 Job Management</a>
    <a href="../logout.php" class="text-danger mt-5">🚪 Logout</a>
  </div>

  <!-- Main Content -->
  <div class="content">

    <div class="welcome-banner">
      <h2>👋 Welcome back, Admin!</h2>
      <p class="mb-0 opacity-75">Here's what's happening on your portal today.</p>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-4">
      <div class="col-md-4">
        <div class="stats-card" style="border-left-color: #007bff;">
          <div>
            <div class="stats-number"><?= $user_count ?></div>
            <div class="stats-label">Total Users</div>
          </div>
          <div class="stats-icon">👥</div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stats-card" style="border-left-color: #28a745;">
          <div>
            <div class="stats-number"><?= $job_count ?></div>
            <div class="stats-label">Active Jobs</div>
          </div>
          <div class="stats-icon">💼</div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stats-card" style="border-left-color: #ffc107;">
          <div>
            <div class="stats-number"><?= $app_count ?></div>
            <div class="stats-label">Applications</div>
          </div>
          <div class="stats-icon">📝</div>
        </div>
      </div>
    </div>

  </div>

</body>

</html>