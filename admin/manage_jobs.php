<?php
session_start();
include '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Job Management</title>
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

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="text-center mb-4 fw-bold fs-4 text-white">Admin Panel 🛡️</div>
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="manage_users.php">👥 Manage Users</a>
        <a href="manage_employees.php">👨‍💼 Employee Details</a>
        <a href="manage_employers.php">🏢 Employer Details</a>
        <a href="manage_jobs.php" class="bg-secondary bg-opacity-25">💼 Job Management</a>
    </div>

    <div class="content">
        <h3 class="mb-4">💼 All Posted Jobs</h3>

        <div class="table-container">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Salary</th>
                        <th>Vacancies</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT jobs.*, employers.company_name, employers.company_logo 
                        FROM jobs 
                        LEFT JOIN employer_details AS employers ON jobs.employer_id = employers.user_id 
                        ORDER BY jobs.id DESC";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($row['job_title']) ?></td>
                            <td><?= htmlspecialchars($row['company_name'] ?? 'Unknown') ?></td>
                            <td><?= htmlspecialchars($row['location']) ?></td>
                            <td><?= htmlspecialchars($row['salary']) ?></td>
                            <td><?= $row['vacancy_count'] ?? 1 ?></td>
                            <td>
                                <a href="view_applications.php?job_id=<?= $row['id'] ?>"
                                    class="btn btn-sm btn-info text-white">View Apps</a>
                                <a href="../employer/delete_job.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this job?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>