<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}
include '../db.php';

$job_id = $_GET['job_id'] ?? 0;

/* Handle Status Update */
if (isset($_GET['action'], $_GET['app_id'])) {
    $status = $_GET['action'];
    $app_id = $_GET['app_id'];
    $stmt = $conn->prepare("UPDATE job_applications SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $app_id);
    $stmt->execute();
    header("Location: view_applications.php?job_id=$job_id");
    exit;
}

/* Fetch Job Details */
$jobQ = $conn->query("SELECT j.*, e.company_name FROM jobs j JOIN employer_details e ON j.employer_id = e.user_id WHERE j.id=$job_id");
$job = $jobQ->fetch_assoc();

/* Fetch Applications */
$sql = "SELECT ja.id as app_id, ja.status, ja.applied_at,
               u.name, u.email,
               ed.skills, ed.resume_path, ed.city, ed.state
        FROM job_applications ja
        JOIN users u ON ja.employee_id = u.id
        LEFT JOIN employee_details ed ON u.id = ed.user_id
        WHERE ja.job_id = $job_id";

$apps = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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

        .card-box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background: #1e3c72;
            color: white;
        }

        .status-badge {
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 15px;
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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="manage_jobs.php" class="btn btn-outline-secondary rounded-pill mb-2">← Back to Jobs</a>
                <h3 class="fw-bold">Job Applications</h3>
            </div>
            <button onclick="downloadPDF()" class="btn btn-danger rounded-pill px-4 shadow-sm">
                📥 Download Report (PDF)
            </button>
        </div>

        <!-- Job Info Card -->
        <div class="card-box mb-4">
            <h5 class="text-primary fw-bold"><?= htmlspecialchars($job['job_title']) ?></h5>
            <div class="row text-muted">
                <div class="col-md-4">🏢 Company: <?= htmlspecialchars($job['company_name']) ?></div>
                <div class="col-md-4">📍 Location: <?= htmlspecialchars($job['location']) ?></div>
                <div class="col-md-4">💰 Salary: <?= htmlspecialchars($job['salary']) ?></div>
            </div>
            <div class="mt-2">
                <strong>Total Applicants: </strong> <span class="badge bg-dark"><?= $apps->num_rows ?></span>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="card-box" id="applications-report">
            <!-- PDF Header (Hidden usually, visible in PDF) -->
            <div class="text-center mb-4 d-none d-print-block">
                <h3>Application Report</h3>
                <p>Job: <?= htmlspecialchars($job['job_title']) ?> | Company:
                    <?= htmlspecialchars($job['company_name']) ?></p>
            </div>

            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Candidate</th>
                        <th>Skills</th>
                        <th>Location</th>
                        <th>Applied On</th>
                        <th class="no-print">Resume</th>
                        <th>Status</th>
                        <th class="no-print">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $apps->fetch_assoc()) {
                        $statusClass = match ($row['status']) {
                            'approved' => 'bg-success',
                            'rejected' => 'bg-danger',
                            default => 'bg-warning text-dark'
                        };
                        ?>
                        <tr>
                            <td class="fw-bold">
                                <?= htmlspecialchars($row['name']) ?><br>
                                <small class="text-muted fw-normal"><?= htmlspecialchars($row['email']) ?></small>
                            </td>
                            <td><?= htmlspecialchars($row['skills'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['city'] ?? '-') ?></td>
                            <td><?= date('d M Y', strtotime($row['applied_at'])) ?></td>

                            <td class="no-print">
                                <?php if ($row['resume_path']): ?>
                                    <a href="../uploads/resumes/<?= $row['resume_path'] ?>" target="_blank"
                                        class="btn btn-sm btn-outline-info">📄 PDF</a>
                                <?php else: ?>
                                    <span class="text-muted small">No File</span>
                                <?php endif; ?>
                            </td>

                            <td><span class="badge <?= $statusClass ?> status-badge"><?= ucfirst($row['status']) ?></span>
                            </td>

                            <td class="no-print">
                                <?php if ($row['status'] == 'pending'): ?>
                                    <a href="?job_id=<?= $job_id ?>&app_id=<?= $row['app_id'] ?>&action=approved"
                                        class="btn btn-sm btn-success">Approve</a>
                                    <a href="?job_id=<?= $job_id ?>&app_id=<?= $row['app_id'] ?>&action=rejected"
                                        class="btn btn-sm btn-danger">Reject</a>
                                <?php else: ?>
                                    <span class="text-muted small">Completed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php if ($apps->num_rows == 0) {
                echo "<div class='text-center py-5 text-muted'><h4>No applications received yet.</h4></div>";
            } ?>
        </div>

    </div>

    <script>
        function downloadPDF() {
            // Clone the element to modify it for PDF without affecting the view
            var element = document.getElementById('applications-report');

            var opt = {
                margin: 0.5,
                filename: 'Applications_Report_<?= preg_replace("/[^a-zA-Z0-9]+/", "_", $job['job_title']) ?>.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
            };

            // Exclude elements with 'no-print' class manually if needed, 
            // but html2pdf captures visual state. We can hide columns via CSS before generation if strictly required.
            // Simple CSS injection for the print
            var style = document.createElement('style');
            style.innerHTML = '.no-print { display: none !important; }';
            document.head.appendChild(style);

            html2pdf().set(opt).from(element).save().then(function () {
                // Cleanup
                document.head.removeChild(style);
            });
        }
    </script>

</body>

</html>