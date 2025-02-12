<?php
include 'config.php';

// Ensure seller is logged in
if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit();
}

$seller_id = $_SESSION['seller_id'];
$sql = "SELECT orders.*, books.title FROM orders 
        JOIN books ON orders.book_id = books.id 
        WHERE books.seller_id = '$seller_id' 
        ORDER BY orders.order_date DESC";
$result = $conn->query($sql);
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Orders Received</h2>
  <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Book Title</th>
          <th>Buyer Name</th>
          <th>Buyer Address</th>
          <th>Buyer Phone</th>
          <th>Buyer Email</th>
          <th>Order Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['buyer_name']; ?></td>
            <td><?php echo $row['buyer_address']; ?></td>
            <td><?php echo $row['buyer_phone']; ?></td>
            <td><?php echo $row['buyer_email']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No orders received yet.</p>
  <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
