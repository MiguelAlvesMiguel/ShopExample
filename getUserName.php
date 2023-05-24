<?php
require_once 'dbConnection.php';
session_start();

$user_id = $_POST['user_id'];

$query = "SELECT name FROM Users WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

echo json_encode($user);
?>
