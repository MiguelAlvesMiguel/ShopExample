<?php
require_once 'dbConnection.php';
session_start();

// Get the user's chats
$query = "SELECT * FROM Chats WHERE buyer_id = ? OR seller_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ii', $_SESSION['user_id'], $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$chats = [];
while ($row = mysqli_fetch_assoc($result)) {
    $chats[] = $row;
}

foreach ($chats as $chat) {
    // Get the product name
    $query = "SELECT title FROM Products WHERE product_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $chat['product_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);
    $product_name = $product['title'];

    // Get the other user's name
    $other_user_id = $chat['seller_id'] == $_SESSION['user_id'] ? $chat['buyer_id'] : $chat['seller_id'];
    $query = "SELECT name FROM Users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $other_user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $other_user = mysqli_fetch_assoc($result);
    $other_user_name = $other_user['name'];

    echo '<li class="list-group-item"><a href="chat.php?chat_id=' . $chat['chat_id'] . '">Chat about <strong>' . $product_name . '</strong> with <strong>' . $other_user_name . '</strong></a></li>';
}
?>
