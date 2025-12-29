<?php
session_start();
include '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Details</title>
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
        <a href="manage_employees.php" class="bg-secondary bg-opacity-25">👨‍💼 Employee Details</a>
        <a href="manage_employers.php">🏢 Employer Details</a>
        <a href="manage_jobs.php">💼 Job Management</a>
    </div>

    <div class="content">
        <h3 class="mb-4">👨‍💼 Employee Directory</h3>

        <div class="table-container">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>City/State</th>
                        <th>Skills</th>
                        <th>Resume</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT u.name, u.email, e.* 
                        FROM users u 
                        LEFT JOIN employee_details e ON u.id = e.user_id 
                        WHERE u.role='employee'";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['mobile'] ?? '-') ?></td>
                            <td><?= htmlspecialchars(($row['city'] ?? '-') . ', ' . ($row['state'] ?? '-')) ?></td>
                            <td><?= htmlspecialchars($row['skills'] ?? '-') ?></td>
                            <td>
                                <?php if (!empty($row['resume_path'])): ?>
                                    <a href="../uploads/resumes/<?= $row['resume_path'] ?>" target="_blank"
                                        class="btn btn-sm btn-outline-primary">View</a>
                                <?php else:
                                    echo "-"; endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>