<?php
include 'config.php';
$message = '';

if (isset($_POST['login'])) {
    $email    = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM sellers WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['seller_id'] = $row['id'];
            $_SESSION['seller_username'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No account found with that email.";
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Seller Login</h2>
  <?php if ($message != ''): ?>
    <div class="alert alert-danger"><?php echo $message; ?></div>
  <?php endif; ?>
  <form method="post" action="login.php">
    <div class="form-group">
      <label>Email address</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="login" class="btn btn-primary">Login</button>
  </form>
</div>
<?php include 'footer.php'; ?>
