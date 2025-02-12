<?php
include 'config.php';

// Redirect to login if not logged in
if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include 'header.php'; ?>
<div class="container mt-4">
  <h2>Welcome, <?php echo $_SESSION['seller_username']; ?></h2>
  <div class="list-group">
    <a href="post_ad.php" class="list-group-item list-group-item-action">Post New Advertisement</a>
    <a href="view_ads.php" class="list-group-item list-group-item-action">View Your Ads</a>
    <a href="view_orders.php" class="list-group-item list-group-item-action">View Orders</a>
    <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
  </div>
</div>
<?php include 'footer.php'; ?>
