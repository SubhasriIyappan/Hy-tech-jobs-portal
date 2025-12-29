<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin')
        header('Location: admin/dashboard.php');
    if ($_SESSION['role'] == 'employee')
        header('Location: employee/dashboard.php');
    if ($_SESSION['role'] == 'employer')
        header('Location: employer/dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal - Find Your Dream Job</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar */
        .navbar-brand {
            font-weight: 700;
            color: #007bff !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://source.unsplash.com/1600x900/?office,working') no-repeat center center/cover;
            height: 80vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        /* Buttons */
        .btn-lg-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Features */
        .feature-icon {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 15px;
        }

        .feature-card {
            transition: transform 0.3s;
            border: none;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        /* Footer */
        footer {
            background: #343a40;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">🚀 Job Portal</a>
            <div class="d-flex">
                <a href="login.php" class="btn btn-outline-primary me-2 rounded-pill px-4">Login</a>
                <a href="register/register.php" class="btn btn-primary rounded-pill px-4 shadow-sm">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <h1 class="hero-title">Find the Career You Deserve</h1>
            <p class="hero-subtitle">Connecting top talent with the best employers. Your future starts here.</p>
            <div>
                <a href="login.php" class="btn btn-primary btn-lg btn-lg-custom me-3 shadow">Job Seeker</a>
                <a href="register/register.php" class="btn btn-outline-light btn-lg btn-lg-custom shadow">Post a Job</a>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-5 fw-bold">Why Choose Us?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-4 feature-card h-100 shadow-sm">
                        <div class="feature-icon">🔍</div>
                        <h5>Search Jobs</h5>
                        <p class="text-muted">Browse thousands of jobs in top companies and find the perfect match for
                            your skills.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 feature-card h-100 shadow-sm">
                        <div class="feature-icon">🏢</div>
                        <h5>Top Employers</h5>
                        <p class="text-muted">Connect directly with reputable employers who are looking for talent like
                            you.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 feature-card h-100 shadow-sm">
                        <div class="feature-icon">🚀</div>
                        <h5>Career Growth</h5>
                        <p class="text-muted">Take the next big step in your career with opportunities that help you
                            grow.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">&copy; 2024 Job Portal. All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>