<?php
include 'config.php';

$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';
$sql = "SELECT * FROM books WHERE title LIKE '%$query%' OR book_name LIKE '%$query%' OR genre LIKE '%$query%'";
$result = $conn->query($sql);
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Search Results for "<?php echo $query; ?>"</h2>
  <?php if ($result->num_rows > 0): ?>
    <div class="row">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="book-ad">
            <img src="show_image.php?id=<?php echo $row['id']; ?>" alt="<?php echo $row['title']; ?>" class="img-fluid">
            <h5><?php echo $row['title']; ?></h5>
            <p><?php echo substr($row['description'], 0, 100); ?>...</p>
            <p><strong>Price:</strong> $<?php echo $row['price']; ?></p>
            <a href="order.php?book_id=<?php echo $row['id']; ?>" class="btn btn-primary">Order</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p>No books found matching your query.</p>
  <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
