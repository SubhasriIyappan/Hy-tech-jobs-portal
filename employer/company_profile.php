<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employer') {
  header('Location: ../login.php');
  exit;
}
include '../db.php';

$id = $_SESSION['user_id'];

// Fetch all details including logo and address
$q = $conn->query("SELECT u.name, u.email, e.*
                   FROM users u
                   JOIN employer_details e ON u.id=e.user_id
                   WHERE u.id=$id");
$data = $q->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Company Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
    }

    .profile-sidebar {
      background: #fff;
      text-align: center;
      padding: 40px 20px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .company-logo {
      width: 150px;
      height: 150px;
      object-fit: contain;
      margin-bottom: 20px;
      border-radius: 10px;
      border: 1px solid #eee;
      padding: 10px;
      background: white;
    }

    .section-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      border: none;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      margin-bottom: 25px;
    }

    .section-title {
      border-bottom: 2px solid #1e3c72;
      padding-bottom: 10px;
      margin-bottom: 20px;
      color: #1e3c72;
      font-weight: 600;
    }

    .info-label {
      font-weight: 600;
      color: #555;
      display: block;
      margin-bottom: 5px;
    }

    .info-value {
      color: #333;
      margin-bottom: 15px;
      display: block;
    }
  </style>
</head>

<body>

  <div class="container mt-5 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold text-dark">🏢 Company Profile</h3>
      <a href="dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">← Back to Dashboard</a>
    </div>

    <div class="row">

      <!-- Left Sidebar: Identity -->
      <div class="col-md-4 mb-4">
        <div class="profile-sidebar h-100">
          <!-- Logo -->
          <?php
          $logo = !empty($data['company_logo']) ? "../uploads/logos/" . rawurlencode($data['company_logo']) : "https://cdn-icons-png.flaticon.com/512/4300/4300059.png";
          ?>
          <img src="<?= $logo ?>" class="company-logo shadow-sm">

          <h4 class="fw-bold mb-1"><?= htmlspecialchars($data['company_name']) ?></h4>
          <p class="text-muted"><a href="<?= htmlspecialchars($data['company_website']) ?>" target="_blank"
              class="text-decoration-none text-secondary">🌐 Visit Website</a></p>

          <div class="mt-4">
            <a href="edit_company_profile.php" class="btn btn-primary w-100 rounded-pill shadow-sm">✏️ Edit Profile</a>
          </div>
        </div>
      </div>

      <!-- Right Content: Details -->
      <div class="col-md-8">

        <!-- About Section -->
        <div class="section-card">
          <h5 class="section-title">📝 About Company</h5>
          <p class="text-secondary" style="line-height: 1.8;">
            <?= nl2br(htmlspecialchars($data['company_description'] ?? 'No description added yet.')) ?>
          </p>
        </div>

        <div class="row">
          <!-- HR Contact -->
          <div class="col-md-6">
            <div class="section-card h-100">
              <h5 class="section-title">👤 HR Contact</h5>

              <span class="info-label">Name</span>
              <span class="info-value"><?= htmlspecialchars($data['hr_name']) ?></span>

              <span class="info-label">Email</span>
              <span class="info-value"><?= htmlspecialchars($data['hr_email']) ?></span>

              <span class="info-label">Phone</span>
              <span class="info-value"><?= htmlspecialchars($data['hr_phone']) ?></span>
            </div>
          </div>

          <!-- Contact Info -->
          <div class="col-md-6">
            <div class="section-card h-100">
              <h5 class="section-title">📍 Official Contact</h5>

              <span class="info-label">Official Email</span>
              <span class="info-value"><?= htmlspecialchars($data['company_email']) ?></span>

              <span class="info-label">Official Phone</span>
              <span class="info-value"><?= htmlspecialchars($data['company_phone']) ?></span>

              <span class="info-label">Address</span>
              <span class="info-value"><?= nl2br(htmlspecialchars($data['company_address'] ?? '')) ?></span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>

</html>