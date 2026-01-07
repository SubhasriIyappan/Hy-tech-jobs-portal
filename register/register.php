<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Account | Job Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #eef2f5;
            font-family: 'Poppins', sans-serif;
            padding: 40px 0;
        }

        .register-card {
            max-width: 850px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            color: #007bff;
            font-weight: 600;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 10px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .form-control,
        .form-select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e1e1e1;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .btn-register {
            padding: 12px;
            font-size: 1.1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="register-card">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Create an Account 🚀</h2>
                <p class="text-muted">Join us to find your dream job or hire top talent</p>
            </div>

            <?php if (isset($_GET['error']) && $_GET['error'] == 'email_exists'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> This email is already registered. Please login or use a different email.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="post" action="process_register.php" enctype="multipart/form-data">

                <!-- Role Selection -->
                <div class="row justify-content-center mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">I want to register as:</label>
                        <select name="role" id="role" class="form-select border-primary" required
                            onchange="toggleRole()">
                            <option value="">-- Select Role --</option>
                            <option value="employee">👨‍ Job Seeker (Employee)</option>
                            <option value="employer">🏢 Employer (Company)</option>
                        </select>
                    </div>
                </div>

                <!-- Common Fields -->
                <h5 class="section-title">👤 Basic Information</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Create a strong password"
                        required>
                </div>

                <!-- ================= EMPLOYEE FIELDS ================= -->
                <div id="employeeFields" class="hidden">
                    <h5 class="section-title">🎓 Professional Details</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Qualification</label>
                            <input type="text" name="qualification" class="form-control" placeholder="e.g. B.Tech, MBA">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Work Experience</label>
                            <select name="experience" class="form-select">
                                <option>Fresher</option>
                                <option>0–1 Years</option>
                                <option>1–3 Years</option>
                                <option>3–5 Years</option>
                                <option>5+ Years</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-select">
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Skills <small class="text-muted">(Separated by comma)</small></label>
                        <input type="text" name="skills" class="form-control" placeholder="e.g. PHP, Java, Python">
                    </div>

                    <h5 class="section-title">📍 Location & Contact</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>City</label>
                            <input type="text" name="city" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>State</label>
                            <input type="text" name="state" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile" maxlength="10" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Passing Year</label>
                            <input type="number" name="year_of_passing" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>College / University</label>
                        <input type="text" name="college" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Profile Image 🖼️</label>
                        <input type="file" name="profile_img" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label>Upload Resume 📄 (PDF only)</label>
                        <input type="file" name="resume" class="form-control" accept=".pdf">
                    </div>
                </div>

                <!-- ================= EMPLOYER FIELDS ================= -->
                <div id="employerFields" class="hidden">
                    <h5 class="section-title">🏢 Company Details</h5>

                    <div class="mb-3">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Company Email 📧</label>
                            <input type="email" name="company_email" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Company Phone 📞</label>
                            <input type="text" name="company_phone" maxlength="10" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Company Address 🌍</label>
                        <textarea name="company_address" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Website 🌐</label>
                        <input type="text" name="company_website" class="form-control">
                    </div>

                    <h5 class="section-title">👤 HR Contact</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>HR Name</label>
                            <input type="text" name="hr_name" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>HR Phone</label>
                            <input type="text" name="hr_phone" maxlength="10" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>HR Email</label>
                            <input type="email" name="hr_email" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Company Logo 🖼️</label>
                        <input type="file" name="company_logo" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description 📝</label>
                        <textarea name="company_description" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <button class="btn btn-primary w-100 btn-register mt-4 shadow">Create Account</button>

                <p class="text-center mt-3">
                    Already have an account? <a href="../login.php" class="text-decoration-none fw-bold">Login here</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function toggleRole() {
            let role = document.getElementById("role").value;

            // Hide both initially
            document.getElementById("employeeFields").style.display = "none";
            document.getElementById("employerFields").style.display = "none";

            // Show based on selection
            if (role === "employee") {
                document.getElementById("employeeFields").style.display = "block";
            } else if (role === "employer") {
                document.getElementById("employerFields").style.display = "block";
            }
        }
    </script>

</body>

</html>