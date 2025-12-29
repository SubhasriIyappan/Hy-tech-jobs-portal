<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employer') {
    die("Unauthorized");
}

$user_id = $_SESSION['user_id'];

$company_name = $_POST['company_name'];
$company_email = $_POST['company_email'];
$company_phone = $_POST['company_phone'];
$company_website = $_POST['company_website'];
$company_address = $_POST['company_address'];
$company_description = $_POST['company_description'];

$hr_name = $_POST['hr_name'];
$hr_email = $_POST['hr_email'];
$hr_phone = $_POST['hr_phone'];

/* Update Logo if uploaded */
if (!empty($_FILES['company_logo']['name'])) {
    $logoName = time() . '_' . $_FILES['company_logo']['name'];
    if (!is_dir("../uploads/logos"))
        mkdir("../uploads/logos", 0777, true);
    move_uploaded_file($_FILES['company_logo']['tmp_name'], "../uploads/logos/" . $logoName);

    $stmt = $conn->prepare("UPDATE employer_details SET company_logo=? WHERE user_id=?");
    $stmt->bind_param("si", $logoName, $user_id);
    $stmt->execute();
}

/* Update Other Details */
$sql = "UPDATE employer_details SET 
        company_name=?, company_email=?, company_phone=?, company_website=?, 
        company_address=?, company_description=?, 
        hr_name=?, hr_email=?, hr_phone=?
        WHERE user_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssssi",
    $company_name,
    $company_email,
    $company_phone,
    $company_website,
    $company_address,
    $company_description,
    $hr_name,
    $hr_email,
    $hr_phone,
    $user_id
);

if ($stmt->execute()) {
    header("Location: company_profile.php?msg=updated");
} else {
    echo "Error updating profile: " . $conn->error;
}
?>