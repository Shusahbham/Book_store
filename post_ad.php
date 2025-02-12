<?php
include 'config.php';

// Ensure seller is logged in
if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if (isset($_POST['post_ad'])) {
    $seller_id          = $_SESSION['seller_id'];
    $title              = $conn->real_escape_string($_POST['title']);
    $book_name          = $conn->real_escape_string($_POST['book_name']);
    $genre              = $conn->real_escape_string($_POST['genre']);
    $price              = $conn->real_escape_string($_POST['price']);
    $publication_house  = $conn->real_escape_string($_POST['publication_house']);
    $contact_info       = $conn->real_escape_string($_POST['contact_info']);
    $description        = $conn->real_escape_string($_POST['description']);

    // Handle image upload: read file contents and MIME type.
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_type = $_FILES['image']['type'];
    } else {
        $image = '';
        $image_type = '';
    }

    $sql = "INSERT INTO books (seller_id, title, book_name, genre, price, publication_house, contact_info, image, image_type, description) 
            VALUES ('$seller_id', '$title', '$book_name', '$genre', '$price', '$publication_house', '$contact_info', '$image', '$image_type', '$description')";
    if ($conn->query($sql) === TRUE) {
        $message = "Advertisement posted successfully.";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Post New Advertisement</h2>
  <?php if ($message != ''): ?>
    <div class="alert alert-info"><?php echo $message; ?></div>
  <?php endif; ?>
  <form method="post" action="post_ad.php" enctype="multipart/form-data">
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Book Name</label>
      <input type="text" name="book_name" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Genre</label>
      <input type="text" name="genre" class="form-control">
    </div>
    <div class="form-group">
      <label>Price</label>
      <input type="number" step="0.01" name="price" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Publication House</label>
      <input type="text" name="publication_house" class="form-control">
    </div>
    <div class="form-group">
      <label>Contact Information</label>
      <input type="text" name="contact_info" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Book Image</label>
      <input type="file" name="image" class="form-control-file">
    </div>
    <div class="form-group">
      <label>Book Description</label>
      <textarea name="description" class="form-control" rows="5"></textarea>
    </div>
    <button type="submit" name="post_ad" class="btn btn-primary">Post Advertisement</button>
  </form>
</div>
<?php include 'footer.php'; ?>
