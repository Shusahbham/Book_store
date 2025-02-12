<?php
include 'config.php';

// Ensure seller is logged in
if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit();
}

$seller_id = $_SESSION['seller_id'];
$sql = "SELECT * FROM books WHERE seller_id='$seller_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Your Advertisements</h2>
  <?php if ($result->num_rows > 0): ?>
    <div class="row">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="show_image.php?id=<?php echo $row['id']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['title']; ?></h5>
              <p class="card-text"><?php echo substr($row['description'], 0, 100); ?>...</p>
              <p><strong>Price:</strong> $<?php echo $row['price']; ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p>No advertisements posted yet.</p>
  <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
