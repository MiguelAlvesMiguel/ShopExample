<?php
include 'dbConnection.php';

$user_id = $_POST['user_id'];
$product_id = $_POST['product_id'];
$is_favorite = $_POST['is_favorite'];

if ($is_favorite === 'true') {
    $query = "INSERT INTO Favorites (user_id, product_id) VALUES (?, ?)";
} else {
    $query = "DELETE FROM Favorites WHERE user_id = ? AND product_id = ?";
}

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ii', $user_id, $product_id);
mysqli_stmt_execute($stmt);
?>