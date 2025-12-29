<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
  header('Location: ../login.php');
  exit;
}
include '../db.php';
$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f6f9;
    }

    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background: #343a40;
      color: white;
      padding-top: 20px;
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

    .content {
      margin-left: 250px;
      padding: 30px;
    }

    .table-card {
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <div class="text-center mb-4 fw-bold fs-4 text-white">Admin Panel 🛡️</div>
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="manage_users.php" class="bg-secondary bg-opacity-25">👥 Manage Users</a>
    <a href="manage_employees.php">👨‍💼 Employee Details</a>
    <a href="manage_employers.php">🏢 Employer Details</a>
    <a href="manage_jobs.php">💼 Job Management</a>
    <a href="../logout.php" class="text-danger mt-5">🚪 Logout</a>
  </div>

  <div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>👥 Manage Users</h3>
      <a href="add_user.php" class="btn btn-success rounded-pill px-4 shadow-sm">+ Add New User</a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <div class="table-card">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td>#<?= $row['id'] ?></td>
              <td class="fw-bold"><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td>
                <span class="badge bg-secondary"><?= ucfirst($row['role']) ?></span>
              </td>
              <td>
                <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">✏️ Edit</a>
                <a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                  onclick="return confirm('Are you sure? This will delete all related data.');">🗑️ Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>