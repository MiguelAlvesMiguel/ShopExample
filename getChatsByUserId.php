<?php
require_once 'dbConnection.php';
session_start();

$user_id = $_POST['user_id'];

$query = "SELECT * FROM Chats WHERE buyer_id = ? OR seller_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ii', $user_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$chats = [];
while ($row = mysqli_fetch_assoc($result)) {
    $chats[] = $row;
}

echo json_encode($chats);
?>
