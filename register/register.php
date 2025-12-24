<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Job Portal</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body{
      background:#f4f6f8;
    }
    .box{
      max-width:900px;
      margin:40px auto;
      background:#fff;
      padding:30px;
      border-radius:10px;
    }
    .hidden{
      display:none;
    }
  </style>
</head>
<body>

<div class="box">
  <h3 class="mb-4 text-center">User Registration</h3>

  <form method="post" action="process_register.php" enctype="multipart/form-data">

    <!-- ROLE SELECT -->
    <div class="mb-3">
      <label class="form-label">Register As</label>
      <select name="role" id="role" class="form-select" required onchange="toggleRole()">
        <option value="">-- Select Role --</option>
        <option value="employee">Employee</option>
        <option value="employer">Employer</option>
      </select>
    </div>

    <!-- COMMON FIELDS -->
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="col-md-6 mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <!-- ================= EMPLOYEE FIELDS ================= -->
    <div id="employeeFields" class="hidden">
      <hr>
      <h5>Employee Details</h5>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label>DOB</label>
          <input type="date" name="dob" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
          <label>Qualification</label>
          <input type="text" name="qualification" class="form-control">
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
        <label>Skills</label>
        <input type="text" name="skills" class="form-control">
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Location</label>
          <input type="text" name="location" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
          <label>Year of Passing</label>
          <input type="number" name="year_of_passing" class="form-control">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Mobile Number</label>
          <input type="text" name="mobile" maxlength="10" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
          <label>College / University</label>
          <input type="text" name="college" class="form-control">
        </div>
      </div>
    </div>

    <!-- ================= EMPLOYER FIELDS ================= -->
    <div id="employerFields" class="hidden">
      <hr>
      <h5>Company Details</h5>

      <div class="mb-3">
        <label>Company Name</label>
        <input type="text" name="company_name" class="form-control">
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Company Email</label>
          <input type="email" name="company_email" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
          <label>Company Phone</label>
          <input type="text" name="company_phone" maxlength="10" class="form-control">
        </div>
      </div>

      <div class="mb-3">
        <label>Company Address</label>
        <textarea name="company_address" class="form-control"></textarea>
      </div>

      <div class="mb-3">
        <label>Company Website (optional)</label>
        <input type="text" name="company_website" class="form-control">
      </div>

      <h6>HR Details</h6>

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
        <label>Company Logo (optional)</label>
        <input type="file" name="company_logo" class="form-control">
      </div>

      <div class="mb-3">
        <label>Company Description</label>
        <textarea name="company_description" class="form-control"></textarea>
      </div>
    </div>

    <button class="btn btn-primary w-100 mt-3">Register</button>
  </form>
</div>

<script>
function toggleRole(){
  let role = document.getElementById("role").value;

  document.getElementById("employeeFields").style.display =
    role === "employee" ? "block" : "none";

  document.getElementById("employerFields").style.display =
    role === "employer" ? "block" : "none";
}
</script>

</body>
</html>
