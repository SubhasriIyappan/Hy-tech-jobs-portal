<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
  header('Location: ../login.php'); exit;
}
include '../db.php';

/* Delete user if requested */
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $conn->query("DELETE FROM users WHERE id=$id");
  $conn->query("DELETE FROM employee_details WHERE user_id=$id");
  $conn->query("DELETE FROM employer_details WHERE user_id=$id");
  header('Location: manage_users.php'); exit;
}

/* List users */
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h4>Manage Users</h4>

<table class="table table-bordered">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
<?php while($u=$users->fetch_assoc()){ ?>
<tr>
<td><?= $u['id'] ?></td>
<td><?= $u['name'] ?></td>
<td><?= $u['email'] ?></td>
<td><?= $u['role'] ?></td>
<td><a href="?delete=<?= $u['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete user?')">Delete</a></td>
</tr>
<?php } ?>
</table>

</div>
</body>
</html>
