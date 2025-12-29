<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employer') {
    header('Location: ../login.php');
    exit;
}
include '../db.php';

$id = $_SESSION['user_id'];
$q = $conn->query("SELECT * FROM employer_details WHERE user_id=$id");
$data = $q->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5 mb-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Edit Company Profile</h3>
            <a href="company_profile.php" class="btn btn-secondary">Back to Profile</a>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <form method="post" action="process_edit_company.php" enctype="multipart/form-data">

                <h5 class="text-primary border-bottom pb-2 mb-3">Company Details</h5>

                <div class="mb-3">
                    <label>Company Name</label>
                    <input type="text" name="company_name" class="form-control"
                        value="<?= htmlspecialchars($data['company_name']) ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Company Email</label>
                        <input type="email" name="company_email" class="form-control"
                            value="<?= htmlspecialchars($data['company_email']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Company Phone</label>
                        <input type="text" name="company_phone" class="form-control"
                            value="<?= htmlspecialchars($data['company_phone']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Website</label>
                    <input type="text" name="company_website" class="form-control"
                        value="<?= htmlspecialchars($data['company_website']) ?>">
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="company_address" class="form-control"
                        rows="2"><?= htmlspecialchars($data['company_address']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="company_description" class="form-control"
                        rows="4"><?= htmlspecialchars($data['company_description']) ?></textarea>
                </div>

                <h5 class="text-primary border-bottom pb-2 mb-3 mt-4">HR Contact</h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>HR Name</label>
                        <input type="text" name="hr_name" class="form-control"
                            value="<?= htmlspecialchars($data['hr_name']) ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>HR Email</label>
                        <input type="email" name="hr_email" class="form-control"
                            value="<?= htmlspecialchars($data['hr_email']) ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>HR Phone</label>
                        <input type="text" name="hr_phone" class="form-control"
                            value="<?= htmlspecialchars($data['hr_phone']) ?>">
                    </div>
                </div>

                <h5 class="text-primary border-bottom pb-2 mb-3 mt-4">Logo</h5>

                <div class="mb-3">
                    <label>Update Logo (Optional)</label>
                    <input type="file" name="company_logo" class="form-control">
                    <?php if (!empty($data['company_logo'])): ?>
                        <div class="mt-2">
                            <small>Current Logo:</small><br>
                            <img src="../uploads/logos/<?= $data['company_logo'] ?>" height="50">
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Save Changes</button>
            </form>
        </div>
    </div>

</body>

</html>