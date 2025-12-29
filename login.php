<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login | Job Portal</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-header h3 {
      font-weight: 700;
      color: #333;
    }

    .form-control {
      border-radius: 50px;
      padding: 12px 20px;
      background: #f8f9fa;
      border: none;
    }

    .form-control:focus {
      background: #fff;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .btn-login {
      border-radius: 50px;
      padding: 12px;
      font-weight: 600;
      background: #007bff;
      border: none;
      transition: 0.3s;
    }

    .btn-login:hover {
      background: #0056b3;
      transform: translateY(-2px);
    }
  </style>
</head>

<body>

  <div class="login-card">
    <div class="login-header">
      <h3>👋 Welcome Back</h3>
      <p class="text-muted">Please login to your account</p>
    </div>

    <form method="post" action="process_login.php">

      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="📧  Enter your email" required>
      </div>

      <div class="mb-4">
        <input type="password" name="password" class="form-control" placeholder="🔒  Enter your password" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 btn-login shadow">Login</button>

    </form>

    <div class="text-center mt-4">
      <small class="text-muted">Don't have an account?</small><br>
      <a href="register/register.php" class="text-decoration-none fw-bold">Create an Account</a>
    </div>

    <div class="text-center mt-3">
      <a href="index.php" class="text-muted small text-decoration-none">← Back to Home</a>
    </div>
  </div>

</body>

</html>