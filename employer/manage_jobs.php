<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employer') {
    header('Location: ../login.php');
    exit;
}
include '../db.php';

$employer_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM jobs WHERE employer_id=$employer_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Jobs</title>
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

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .job-title {
            font-weight: 600;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="container mt-5 mb-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">📋 Manage My Jobs</h3>
            <a href="dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">← Back to Dashboard</a>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="alert alert-danger rounded-3 shadow-sm">Job Deleted Successfully!</div>
        <?php endif; ?>
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'updated'): ?>
            <div class="alert alert-success rounded-3 shadow-sm">Job Updated Successfully!</div>
        <?php endif; ?>

        <div class="table-card">
            <table class="table table-hover align-middle">
                <thead class="table-dark" style="border-radius: 10px;">
                    <tr>
                        <th class="p-3">Job Details</th>
                        <th class="p-3">Vacancies</th>
                        <th class="p-3">Posted Date</th>
                        <th class="p-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="p-3">
                                <div class="job-title"><?= htmlspecialchars($row['job_title']) ?></div>
                                <small class="text-muted">📍 <?= htmlspecialchars($row['location']) ?></small>
                            </td>
                            <td class="p-3">
                                <span class="badge bg-info text-dark"><?= $row['vacancy_count'] ?? 1 ?> Openings</span>
                            </td>
                            <td class="p-3 text-muted"><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                            <td class="p-3 text-end">
                                <a href="edit_job.php?id=<?= $row['id'] ?>"
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3">✏️ Edit</a>
                                <a href="delete_job.php?id=<?= $row['id'] ?>"
                                    class="btn btn-sm btn-outline-danger rounded-pill px-3 ms-2"
                                    onclick="return confirm('Are you sure you want to delete this job?');">🗑️ Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <?php if ($result->num_rows == 0): ?>
                <div class="text-center py-5">
                    <p class="text-muted">You haven't posted any jobs yet.</p>
                    <a href="post_job.php" class="btn btn-primary rounded-pill shadow-sm">Post a New Job</a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</body>

</html>