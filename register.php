<?php
include 'config.php';
$message = '';

if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email    = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $sql = "SELECT * FROM sellers WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $message = "Email already registered.";
    } else {
        $sql = "INSERT INTO sellers (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $message = "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Seller Registration</h2>
  <?php if ($message != ''): ?>
    <div class="alert alert-info"><?php echo $message; ?></div>
  <?php endif; ?>
  <form method="post" action="register.php">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Email address</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="register" class="btn btn-primary">Register</button>
  </form>
</div>
<?php include 'footer.php'; ?>
