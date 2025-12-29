<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employee') {
    header('Location: ../login.php');
    exit;
}
include '../db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT u.name, u.email, ed.* 
        FROM users u 
        JOIN employee_details ed ON u.id = ed.user_id 
        WHERE u.id = $user_id";
$res = $conn->query($sql);
$user = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Edit Profile</h3>
            <a href="my_profile.php" class="btn btn-secondary">Back to Profile</a>
        </div>

        <div class="card p-4">
            <form method="post" action="process_edit_profile.php" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email (cannot change)</label>
                        <input type="email" class="form-control" value="<?= $user['email'] ?>" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="<?= $user['mobile'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="<?= $user['dob'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" value="<?= $user['city'] ?? '' ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>State</label>
                        <input type="text" name="state" class="form-control" value="<?= $user['state'] ?? '' ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control" value="<?= $user['country'] ?? '' ?>">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Qualification</label>
                        <input type="text" name="qualification" class="form-control"
                            value="<?= $user['qualification'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>College</label>
                        <input type="text" name="college" class="form-control" value="<?= $user['college'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Experience</label>
                        <select name="experience" class="form-select">
                            <option <?= $user['experience'] == 'Fresher' ? 'selected' : '' ?>>Fresher</option>
                            <option <?= $user['experience'] == '0–1 Years' ? 'selected' : '' ?>>0–1 Years</option>
                            <option <?= $user['experience'] == '1–3 Years' ? 'selected' : '' ?>>1–3 Years</option>
                            <option <?= $user['experience'] == '3–5 Years' ? 'selected' : '' ?>>3–5 Years</option>
                            <option <?= $user['experience'] == '5+ Years' ? 'selected' : '' ?>>5+ Years</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Year of Passing</label>
                        <input type="number" name="year_of_passing" class="form-control"
                            value="<?= $user['year_of_passing'] ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Skills</label>
                    <input type="text" name="skills" class="form-control" value="<?= $user['skills'] ?>">
                </div>

                <div class="mb-3">
                    <label>Update Profile Image (JPG/PNG)</label>
                    <input type="file" name="profile_img" class="form-control" accept="image/*">
                    <?php if (!empty($user['profile_img'])): ?>
                        <div class="mt-2">
                            <small>Current Image:</small><br>
                            <img src="../uploads/images/<?= $user['profile_img'] ?>" width="60" height="60"
                                class="rounded-circle" style="object-fit:cover;">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label>Update Resume (PDF) - <small>Leave empty to keep current</small></label>
                    <input type="file" name="resume" class="form-control" accept=".pdf">
                    <?php if (!empty($user['resume_path'])): ?>
                        <small class="text-success">Current: <a href="../uploads/resumes/<?= $user['resume_path'] ?>"
                                target="_blank">View Resume</a></small>
                    <?php endif; ?>
                </div>

                <button class="btn btn-primary w-100 mt-3">Update Profile</button>
            </form>
        </div>
    </div>
</body>

</html>