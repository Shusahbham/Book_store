<?php
include 'config.php';
$message = '';

// Validate that a book ID is provided
if (!isset($_GET['book_id'])) {
    header("Location: index.php");
    exit();
}

$book_id = intval($_GET['book_id']);

// Fetch book details
$sql = "SELECT * FROM books WHERE id='$book_id'";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    echo "Invalid book.";
    exit();
}
$book = $result->fetch_assoc();

if (isset($_POST['place_order'])) {
    $buyer_name    = $conn->real_escape_string($_POST['buyer_name']);
    $buyer_address = $conn->real_escape_string($_POST['buyer_address']);
    $buyer_phone   = $conn->real_escape_string($_POST['buyer_phone']);
    $buyer_email   = $conn->real_escape_string($_POST['buyer_email']);

    $sql = "INSERT INTO orders (book_id, buyer_name, buyer_address, buyer_phone, buyer_email) 
            VALUES ('$book_id', '$buyer_name', '$buyer_address', '$buyer_phone', '$buyer_email')";
    if ($conn->query($sql) === TRUE) {
        $message = "Congratulations! Your order has been successfully submitted. The seller will contact you as soon as possible.";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Order: <?php echo $book['title']; ?></h2>
  <?php if ($message != ''): ?>
    <div class="alert alert-info"><?php echo $message; ?></div>
  <?php endif; ?>
  <?php if ($message == ''): ?>
    <form method="post" action="order.php?book_id=<?php echo $book_id; ?>">
      <div class="form-group">
        <label>Your Name</label>
        <input type="text" name="buyer_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Your Address</label>
        <input type="text" name="buyer_address" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Your Phone</label>
        <input type="text" name="buyer_phone" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Your Email</label>
        <input type="email" name="buyer_email" class="form-control">
      </div>
      <button type="submit" name="place_order" class="btn btn-primary">Place Order</button>
    </form>
  <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
