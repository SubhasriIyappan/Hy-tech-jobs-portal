<?php
session_start();
include '../db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employer') {
    header('Location: ../login.php');
    exit;
}

$id = $_GET['id'];
$employer_id = $_SESSION['user_id'];

// Verify ownership
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id=? AND employer_id=?");
$stmt->bind_param("ii", $id, $employer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Job not found or access denied.");
}

$job = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5 mb-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Edit Job</h3>
            <a href="manage_jobs.php" class="btn btn-secondary">Back to Job List</a>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <form method="post" action="process_edit_job.php">
                <input type="hidden" name="job_id" value="<?= $job['id'] ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Job Title 💼</label>
                    <input type="text" name="job_title" class="form-control"
                        value="<?= htmlspecialchars($job['job_title']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Job Description 📝</label>
                    <textarea name="job_description" class="form-control" rows="5"
                        required><?= htmlspecialchars($job['job_description']) ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Location 📍</label>
                        <input type="text" name="location" class="form-control"
                            value="<?= htmlspecialchars($job['location']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Salary Package 💰</label>
                        <input type="text" name="salary" class="form-control"
                            value="<?= htmlspecialchars($job['salary']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Experience Required ⏳</label>
                        <select name="experience" class="form-select">
                            <option <?= $job['experience'] == 'Fresher' ? 'selected' : '' ?>>Fresher</option>
                            <option <?= $job['experience'] == '0-1 Years' ? 'selected' : '' ?>>0-1 Years</option>
                            <option <?= $job['experience'] == '1-3 Years' ? 'selected' : '' ?>>1-3 Years</option>
                            <option <?= $job['experience'] == '3-5 Years' ? 'selected' : '' ?>>3-5 Years</option>
                            <option <?= $job['experience'] == '5+ Years' ? 'selected' : '' ?>>5+ Years</option>
                            <option <?= $job['experience'] == '10+ Years' ? 'selected' : '' ?>>10+ Years</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Number of Vacancies 🔢</label>
                        <input type="number" name="vacancy_count" class="form-control" min="1"
                            value="<?= $job['vacancy_count'] ?? 1 ?>" required>
                    </div>
                </div>

                <button class="btn btn-primary w-100 py-2 mt-3">💾 Update Job</button>

            </form>
        </div>
    </div>

</body>

</html>