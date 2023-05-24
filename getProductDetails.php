<?php
require_once 'dbConnection.php';
session_start();

$product_id = $_POST['product_id'];

$query = "SELECT * FROM Products WHERE product_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$product = mysqli_fetch_assoc($result);

echo json_encode($product);
?>
