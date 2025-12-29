<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employee') {
    header('Location: ../login.php');
    exit;
}
include '../db.php';

$id = $_SESSION['user_id'];
$q = $conn->query("SELECT u.name,u.email,e.*
                   FROM users u
                   JOIN employee_details e ON u.id=e.user_id
                   WHERE u.id=$id");
$data = $q->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .profile-card {
            border-radius: 15px;
            border: none;
            overflow: hidden;
        }

        .profile-sidebar {
            background: #fff;
            text-align: center;
            padding: 30px;
        }

        .profile-img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #f1f1f1;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
            border-bottom: 2px solid #eef2f5;
            padding-bottom: 8px;
        }

        .info-row {
            margin-bottom: 12px;
        }

        .label {
            font-weight: 600;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container mt-5 mb-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">My Profile</h3>
            <a href="dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">← Back to Dashboard</a>
        </div>

        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-4 mb-4">
                <div class="card profile-card shadow-sm h-100">
                    <div class="profile-sidebar">
                        <?php
                        $img = !empty($data['profile_img']) ? "../uploads/images/" . $data['profile_img'] : "https://cdn-icons-png.flaticon.com/512/3135/3135715.png";
                        ?>
                        <img src="<?= $img ?>" class="profile-img shadow-sm" alt="Profile">
                        <h4 class="fw-bold"><?= htmlspecialchars($data['name']) ?></h4>
                        <p class="text-muted mb-1"><?= htmlspecialchars($data['email']) ?></p>
                        <p class="badge bg-primary"><?= htmlspecialchars($data['qualification'] ?? 'N/A') ?></p>

                        <div class="mt-4">
                            <a href="edit_profile.php" class="btn btn-primary w-100 rounded-pill">✏️ Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Details -->
            <div class="col-md-8">
                <div class="card profile-card shadow-sm p-4">

                    <h5 class="section-title">👤 Personal Details</h5>
                    <div class="row info-row">
                        <div class="col-sm-6"><span class="label">📅 DOB:</span> <?= $data['dob'] ?? '-' ?></div>
                        <div class="col-sm-6"><span class="label">🚻 Gender:</span> <?= $data['gender'] ?? '-' ?></div>
                    </div>
                    <div class="row info-row">
                        <div class="col-sm-6"><span class="label">📞 Mobile:</span> <?= $data['mobile'] ?? '-' ?></div>
                    </div>

                    <h5 class="section-title mt-4">🎓 Professional Info</h5>
                    <div class="info-row"><span class="label">🎓 College:</span> <?= $data['college'] ?? '-' ?></div>
                    <div class="info-row"><span class="label">📆 Passing Year:</span>
                        <?= $data['year_of_passing'] ?? '-' ?></div>
                    <div class="info-row"><span class="label">💼 Experience:</span> <?= $data['experience'] ?? '-' ?>
                    </div>
                    <div class="info-row"><span class="label">💡 Skills:</span> <?= $data['skills'] ?? '-' ?></div>

                    <h5 class="section-title mt-4">📍 Location</h5>
                    <div class="row info-row">
                        <div class="col-sm-4"><span class="label">City:</span> <?= $data['city'] ?? '-' ?></div>
                        <div class="col-sm-4"><span class="label">State:</span> <?= $data['state'] ?? '-' ?></div>
                        <div class="col-sm-4"><span class="label">Country:</span> <?= $data['country'] ?? '-' ?></div>
                    </div>

                    <h5 class="section-title mt-4">📄 Resume</h5>
                    <?php if (!empty($data['resume_path'])): ?>
                        <a href="../uploads/resumes/<?= $data['resume_path'] ?>" target="_blank"
                            class="btn btn-outline-primary btn-sm rounded-pill">📄 View Resume</a>
                    <?php else: ?>
                        <span class="text-muted small">No resume uploaded.</span>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>