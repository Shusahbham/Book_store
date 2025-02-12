<?php
include 'config.php';

// Get total number of books listed
$sqlCountBooks = "SELECT COUNT(*) AS count FROM books";
$resultBooks = $conn->query($sqlCountBooks);
$countBooks = $resultBooks->fetch_assoc()['count'];

// Get total number of orders (books purchased)
$sqlCountOrders = "SELECT COUNT(*) AS count FROM orders";
$resultOrders = $conn->query($sqlCountOrders);
$countOrders = $resultOrders->fetch_assoc()['count'];

// Return the counts as JSON
header('Content-Type: application/json');
echo json_encode(array(
    'books' => $countBooks,
    'orders' => $countOrders
));
?>
