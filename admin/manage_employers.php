<?php
session_start();
include '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employer Details</title>
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

        .company-logo-sm {
            height: 40px;
            width: 40px;
            object-fit: contain;
            border-radius: 5px;
            border: 1px solid #eee;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="text-center mb-4 fw-bold fs-4 text-white">Admin Panel 🛡️</div>
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="manage_users.php">👥 Manage Users</a>
        <a href="manage_employees.php">👨‍💼 Employee Details</a>
        <a href="manage_employers.php" class="bg-secondary bg-opacity-25">🏢 Employer Details</a>
        <a href="manage_jobs.php">💼 Job Management</a>
    </div>

    <div class="content">
        <h3 class="mb-4">🏢 Employer Directory</h3>

        <div class="table-container">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Company</th>
                        <th>Official Email</th>
                        <th>Phone</th>
                        <th>HR Contact</th>
                        <th>Website</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT u.name AS username, u.email, e.* 
                        FROM users u 
                        LEFT JOIN employer_details e ON u.id = e.user_id 
                        WHERE u.role='employer'";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()):
                        $logo = !empty($row['company_logo']) ? "../uploads/logos/" . rawurlencode($row['company_logo']) : "https://cdn-icons-png.flaticon.com/512/4300/4300059.png";
                        ?>
                        <tr>
                            <td class="fw-bold">
                                <img src="<?= $logo ?>" class="company-logo-sm">
                                <?= htmlspecialchars($row['company_name'] ?? $row['username']) ?>
                            </td>
                            <td><?= htmlspecialchars($row['company_email'] ?? $row['email']) ?></td>
                            <td><?= htmlspecialchars($row['company_phone'] ?? '-') ?></td>
                            <td>
                                <?= htmlspecialchars($row['hr_name'] ?? '-') ?><br>
                                <small class="text-muted"><?= htmlspecialchars($row['hr_phone'] ?? '') ?></small>
                            </td>
                            <td>
                                <?php if (!empty($row['company_website'])): ?>
                                    <a href="<?= htmlspecialchars($row['company_website']) ?>" target="_blank">Visit</a>
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