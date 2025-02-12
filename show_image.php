<?php
include 'config.php';

if (!isset($_GET['id'])) {
    exit('No image specified.');
}

$book_id = intval($_GET['id']);
$sql = "SELECT image, image_type FROM books WHERE id='$book_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (!empty($row['image'])) {
        header("Content-Type: " . $row['image_type']);
        echo $row['image'];
    } else {
        header("Content-Type: image/jpeg");
        readfile("images/default-book.jpg");
    }
} else {
    exit('Image not found.');
}
?>
