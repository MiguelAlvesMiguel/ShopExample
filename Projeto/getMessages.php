<?php
require_once 'dbConnection.php';
session_start();

$chat_id = $_GET['chat_id'];

// Get the messages in the chat
$query = "SELECT * FROM Messages WHERE chat_id = ? ORDER BY message_id";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $chat_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

foreach ($messages as $message) {
    // Get the other user's name
    $other_user_id = $message['sender_id'] == $_SESSION['user_id'] ? $message['receiver_id'] : $message['sender_id'];
    $query = "SELECT name FROM Users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $other_user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $other_user = mysqli_fetch_assoc($result);
    $other_user_name = $other_user['name'];

    echo '<li class="list-group-item"><strong>' . ($message['sender_id'] == $_SESSION['user_id'] ? 'You' : $other_user_name) . ':</strong> ' . $message['content'] . '</li>';
}
?>
