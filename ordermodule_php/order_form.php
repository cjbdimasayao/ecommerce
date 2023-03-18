<?php
// Connect to database
include_once 'db_conn.php';



// Retrieve product data from database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Create order form
echo '<form action="submit_order.php" method="post">';
echo '<table>';
echo '<tr><th>Product</th><th>Quantity</th><th>Price</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
  echo '<tr>';
  echo '<td>' . $row["prod_name"] . '</td>';
  echo '<td><input type="number" name="quantity[' . $row["prod_id"] . ']" value="0"></td>';
  echo '<td>$' . $row["prod_price"] . '</td>';
  echo '</tr>';
}

echo '</table>';

echo '<label for="name">Name:</label>';
echo '<input type="text" name="name" required>';

echo '<label for="address">Address:</label>';
echo '<input type="text" name="address" required>';

echo '<label for="email">Email:</label>';
echo '<input type="email" name="email" required>';

echo '<input type="submit" value="Submit Order">';
echo '</form>';

mysqli_close($conn);
?>