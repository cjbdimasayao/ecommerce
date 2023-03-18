<?php
// Connect to database
include_once 'db_conn.php';

// Retrieve form data
$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$products = $_POST['quantity'];

// Calculate order total
$total = 0;
foreach ($products as $id => $quantity) {
  $sql = "SELECT prod_price FROM products WHERE prod_id = '$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $price = $row['prod_price'];
  $total += $price * $quantity;
}

// Insert order into database
$sql = "INSERT INTO orders (name, address, email, total) VALUES ('$name', '$address', '$email', $total)";
mysqli_query($conn, $sql);
$order_id = mysqli_insert_id($conn);

// Insert order details into database
foreach ($products as $id => $quantity) {
  if ($quantity > 0) {
    $sql = "INSERT INTO order_details (order_id, prod_id, quantity) VALUES ($order_id, $id, $quantity)";
    mysqli_query($conn, $sql);
  }
}

// Close the database connection
$conn->close();
?>


<html>
<head>
	<title>My Shop</title>
</head>
<body>
	<h1>ORDER PLACED!</h1>
	<form action="order_list.php" method="post">
	<input type="submit" value="View Order">
	</form>

</body>
</html>
