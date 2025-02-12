<?php
include 'config.php';
$message = '';

if (isset($_POST['submit_help'])) {
    $name    = $conn->real_escape_string($_POST['name']);
    $email   = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $msg     = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO help_tickets (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$msg')";
    if ($conn->query($sql) === TRUE) {
        $message = "Your help request has been submitted.";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Help & Support</h2>
  <?php if ($message != ''): ?>
    <div class="alert alert-info"><?php echo $message; ?></div>
  <?php endif; ?>
  <form method="post" action="help.php">
    <div class="form-group">
      <label>Your Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Your Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Subject</label>
      <input type="text" name="subject" class="form-control">
    </div>
    <div class="form-group">
      <label>Message</label>
      <textarea name="message" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" name="submit_help" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php include 'footer.php'; ?>
