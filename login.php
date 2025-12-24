<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Job Portal</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body{
      background:#eef1f4;
      font-family: Arial, sans-serif;
    }
    .login-box{
      max-width:420px;
      margin:80px auto;
      background:#fff;
      padding:30px;
      border-radius:10px;
      box-shadow:0 5px 15px rgba(0,0,0,0.1);
    }
    .login-box h4{
      text-align:center;
      margin-bottom:25px;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h4>User Login</h4>

    <form method="post" action="process_login.php">

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">
        Login
      </button>

    </form>

    <p class="text-center mt-3">
      New user?
      <a href="register/register.php">Register here</a>
    </p>
  </div>

</body>
</html>
