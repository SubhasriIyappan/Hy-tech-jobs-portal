<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employer') {
  header('Location: ../login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Post a New Job</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f8;
    }

    .form-card {
      border: none;
      border-radius: 15px;
      padding: 40px;
      background: white;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .form-label {
      font-weight: 500;
      color: #444;
    }

    .form-control,
    .form-select {
      border-radius: 8px;
      padding: 12px;
      border: 1px solid #ddd;
    }

    .form-control:focus {
      border-color: #1e3c72;
      box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
    }
  </style>
</head>

<body>

  <div class="container mt-5 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold">➕ Post a New Job</h3>
      <a href="dashboard.php" class="btn btn-outline-secondary rounded-pill px-4">← Back to Dashboard</a>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="form-card">
          <form method="post" action="process_post_job.php">
            <div class="mb-4">
              <label class="form-label">Job Title 💼</label>
              <input type="text" name="job_title" class="form-control" placeholder="e.g. Senior Marketing Manager"
                required>
            </div>

            <div class="mb-4">
              <label class="form-label">Job Description 📝</label>
              <textarea name="job_description" class="form-control" rows="6"
                placeholder="Describe the role responsibilities and requirements..." required></textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-4">
                <label class="form-label">Location 📍</label>
                <input type="text" name="location" class="form-control" placeholder="e.g. San Francisco, CA" required>
              </div>
              <div class="col-md-6 mb-4">
                <label class="form-label">Salary Package 💰</label>
                <input type="text" name="salary" class="form-control" placeholder="e.g. $90,000 / Year">
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-md-6 mb-3">
                <label class="form-label">Experience Required ⏳</label>
                <select name="experience" class="form-select">
                  <option>Fresher</option>
                  <option>0-1 Years</option>
                  <option>1-3 Years</option>
                  <option>3-5 Years</option>
                  <option>5+ Years</option>
                  <option>10+ Years</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Number of Vacancies 🔢</label>
                <input type="number" name="vacancy_count" class="form-control" placeholder="1" min="1" value="1"
                  required>
              </div>
            </div>

            <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm"
              style="background: #1e3c72; border: none;">🚀 Publish Job Post</button>

          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>