<?php
include_once "db_conn.php";


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$item_id = $_GET['item_id'];
$sql = "DELETE FROM products WHERE item_id = $item_id";

if (mysqli_query($conn, $sql)) {
    header("location: index.php?record deleted successfully");
} else {
    header("location: index.php?error deleting record");
}

mysqli_close($conn);
?>