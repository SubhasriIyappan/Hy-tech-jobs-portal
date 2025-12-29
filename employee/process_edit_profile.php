<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee') {
    die("Unauthorized");
}

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$qualification = $_POST['qualification'];
$college = $_POST['college'];
$experience = $_POST['experience'];
$year = $_POST['year_of_passing'];
$skills = $_POST['skills'];

/* Update Users Table (Name) */
$stmt = $conn->prepare("UPDATE users SET name=? WHERE id=?");
$stmt->bind_param("si", $name, $user_id);
$stmt->execute();

/* Update Resume if uploaded */
/* Update Resume if uploaded */
if (!empty($_FILES['resume']['name'])) {
    $resumeName = time() . '_' . $_FILES['resume']['name'];
    if (!is_dir("../uploads/resumes"))
        mkdir("../uploads/resumes", 0777, true);
    move_uploaded_file($_FILES['resume']['tmp_name'], "../uploads/resumes/" . $resumeName);

    $stmt = $conn->prepare("UPDATE employee_details SET resume_path=? WHERE user_id=?");
    $stmt->bind_param("si", $resumeName, $user_id);
    $stmt->execute();
}

/* Update Profile Image if uploaded */
if (!empty($_FILES['profile_img']['name'])) {
    $imgName = time() . '_' . $_FILES['profile_img']['name'];
    if (!is_dir("../uploads/images"))
        mkdir("../uploads/images", 0777, true);
    move_uploaded_file($_FILES['profile_img']['tmp_name'], "../uploads/images/" . $imgName);

    $stmt = $conn->prepare("UPDATE employee_details SET profile_img=? WHERE user_id=?");
    $stmt->bind_param("si", $imgName, $user_id);
    $stmt->execute();
}

/* Update details */
$sql = "UPDATE employee_details SET 
        mobile=?, dob=?, city=?, state=?, country=?, qualification=?, 
        college=?, experience=?, year_of_passing=?, skills=? 
        WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssisi",
    $mobile,
    $dob,
    $city,
    $state,
    $country,
    $qualification,
    $college,
    $experience,
    $year,
    $skills,
    $user_id
);

if ($stmt->execute()) {
    header("Location: my_profile.php?msg=updated");
} else {
    echo "Error updating profile: " . $conn->error;
}
?>