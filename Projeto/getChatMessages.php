<?php
require_once 'dbConnection.php';
session_start();

$chat_id = $_POST['chat_id'];

$query = "SELECT * FROM Messages WHERE chat_id = ? ORDER BY message_id";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $chat_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
