<?php 
include 'config.php';
include 'header.php';

// Fetch newly posted books (limit 6)
$sql = "SELECT * FROM books ORDER BY created_at DESC LIMIT 6";
$result = $conn->query($sql);

// Initially fetch the counters
$sqlCountBooks = "SELECT COUNT(*) AS count FROM books";
$resultBooks = $conn->query($sqlCountBooks);
$countBooks = $resultBooks->fetch_assoc()['count'];

$sqlCountOrders = "SELECT COUNT(*) AS count FROM orders";
$resultOrders = $conn->query($sqlCountOrders);
$countOrders = $resultOrders->fetch_assoc()['count'];
?>

<h2 class="mt-4"><b>Recently added:</b></h2>
<div class="row">
  <?php while($row = $result->fetch_assoc()): ?>
    <div class="col-md-4">
      <div class="book-ad">
        <!-- Display the book image via show_image.php -->
        <img src="show_image.php?id=<?php echo $row['id']; ?>" alt="<?php echo $row['title']; ?>" class="img-fluid">
        <h5><?php echo $row['title']; ?></h5>
        <p><?php echo substr($row['description'], 0, 100); ?>...</p>
        <p><strong>Price:</strong> $<?php echo $row['price']; ?></p>
        <a href="order.php?book_id=<?php echo $row['id']; ?>" class="btn btn-primary">Order</a>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<!-- Statistics Section -->
<div class="mt-4">
  <h4><b>Statistics:</b></h4>
  <p><u>Total Books Listed:</u> <span id="booksCount"><?php echo $countBooks; ?></span></p>
  <p><u>Total Books Purchased:</u> <span id="ordersCount"><?php echo $countOrders; ?></span></p>
</div>

<!-- jQuery AJAX script to update counts automatically -->
<script>
  function updateCounts() {
    $.ajax({
      url: 'counts.php',
      method: 'GET',
      dataType: 'json',
      success: function(data) {
        $('#booksCount').text(data.books);
        $('#ordersCount').text(data.orders);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("Error fetching counts: " + textStatus, errorThrown);
      }
    });
  }
  updateCounts();
  setInterval(updateCounts, 10000); // Update every 10 seconds
</script>

<?php include 'footer.php'; ?>
