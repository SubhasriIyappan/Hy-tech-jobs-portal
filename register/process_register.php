<?php
session_start();

/* 🔑 VERY IMPORTANT LINE (MISSING BEFORE) */
include '../db.php';   // <-- THIS FIXES $conn ERROR

/* -------------------------
   Basic safety check
--------------------------*/
if (!isset($_POST['role'])) {
    die("Invalid request");
}

$role = $_POST['role'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

/* -------------------------
   1️⃣ Insert into users table
--------------------------*/
/* -------------------------
   0️⃣ Check if email already exists
--------------------------*/
$check = $conn->prepare("SELECT id FROM users WHERE email=?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    header("Location: register.php?error=email_exists");
    exit;
}

/* -------------------------
   1️⃣ Insert into users table
--------------------------*/
$userSql = "INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)";
$stmt = $conn->prepare($userSql);

if (!$stmt) {
    die("User Prepare Failed: " . $conn->error);
}

$stmt->bind_param("ssss", $name, $email, $password, $role);
$stmt->execute();

$user_id = $stmt->insert_id;

/* ================= EMPLOYEE ================= */
if ($role === 'employee') {

    $dob = $_POST['dob'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $gender = $_POST['gender'];
    $skills = $_POST['skills'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $year = $_POST['year_of_passing'];
    $mobile = $_POST['mobile'];
    $college = $_POST['college'];

    /* Resume Upload */
    $resumeName = NULL;
    if (!empty($_FILES['resume']['name'])) {
        $resumeName = time() . '_' . $_FILES['resume']['name'];
        if (!is_dir("../uploads/resumes"))
            mkdir("../uploads/resumes", 0777, true);
        move_uploaded_file(
            $_FILES['resume']['tmp_name'],
            "../uploads/resumes/" . $resumeName
        );
    }

    /* Profile Image Upload */
    $profileImgName = NULL;
    if (!empty($_FILES['profile_img']['name'])) {
        $profileImgName = time() . '_' . $_FILES['profile_img']['name'];
        if (!is_dir("../uploads/images"))
            mkdir("../uploads/images", 0777, true);
        move_uploaded_file(
            $_FILES['profile_img']['tmp_name'],
            "../uploads/images/" . $profileImgName
        );
    }

    $sql = "INSERT INTO employee_details
    (user_id,dob,qualification,experience,gender,skills,city,state,country,year_of_passing,mobile,college,resume_path,profile_img)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Employee Prepare Failed: " . $conn->error);
    }

    $stmt->bind_param(
        "issssssssissss",
        $user_id,
        $dob,
        $qualification,
        $experience,
        $gender,
        $skills,
        $city,
        $state,
        $country,
        $year,
        $mobile,
        $college,
        $resumeName,
        $profileImgName
    );

    $stmt->execute();

    header("Location: ../login.php");
    exit;
}

/* ================= EMPLOYER ================= */
if ($role === 'employer') {

    $company_name = $_POST['company_name'];
    $company_email = $_POST['company_email'];
    $company_phone = $_POST['company_phone'];
    $company_address = $_POST['company_address'];
    $company_website = $_POST['company_website'];

    $hr_name = $_POST['hr_name'];
    $hr_phone = $_POST['hr_phone'];
    $hr_email = $_POST['hr_email'];

    $company_description = $_POST['company_description'];

    /* Logo Upload */
    $logoName = NULL;
    if (!empty($_FILES['company_logo']['name'])) {
        $logoName = time() . '_' . $_FILES['company_logo']['name'];
        move_uploaded_file(
            $_FILES['company_logo']['tmp_name'],
            "../uploads/logos/" . $logoName
        );
    }

    $sql = "INSERT INTO employer_details
    (user_id,company_name,company_email,company_phone,company_address,company_website,
     hr_name,hr_phone,hr_email,company_logo,company_description)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Employer Prepare Failed: " . $conn->error);
    }

    $stmt->bind_param(
        "issssssssss",
        $user_id,
        $company_name,
        $company_email,
        $company_phone,
        $company_address,
        $company_website,
        $hr_name,
        $hr_phone,
        $hr_email,
        $logoName,
        $company_description
    );

    $stmt->execute();

    header("Location: ../login.php");
    exit;
}
?>