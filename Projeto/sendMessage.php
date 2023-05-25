<?php
require_once 'dbConnection.php';
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: SignIn.php');
    exit;
}

// Check if the form data is present
if (!isset($_POST['chat_id']) || !isset($_POST['message'])) {
    header('Location: chat.php');
    exit;
}

$chat_id = $_POST['chat_id'];
$content = $_POST['message'];

// Insert the new message into the Messages table
$query = "INSERT INTO Messages (chat_id, sender_id, content) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'iis', $chat_id, $_SESSION['user_id'], $content);
mysqli_stmt_execute($stmt);

//CHeck if the message was inserted successfully
if (mysqli_stmt_affected_rows($stmt) == 0) {
    header('Location: chat.php?chat_id=' . $chat_id);
    exit;
}
else{

}

// Redirect back to the chat
header('Location: chat.php?chat_id=' . $chat_id);
exit;
?>