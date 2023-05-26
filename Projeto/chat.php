<?php
require_once 'dbConnection.php';
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: SignIn.php');
    exit;
}

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

// If a chat_id is present in the URL, get the chat and its messages
if (isset($_GET['product_id']) && isset($_GET['seller_id'])) {
    // Get the product_id and seller_id from the URL
    $product_id = $_GET['product_id'];
    $seller_id = $_GET['seller_id'];

    // Check if a chat already exists between the logged-in user (buyer) and the seller for this product
    $query = "SELECT * FROM Chats WHERE buyer_id = ? AND seller_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'iii', $_SESSION['user_id'], $seller_id, $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $chat = mysqli_fetch_assoc($result);

    // If a chat does not already exist, create one
    if (!$chat) {
        $query = "INSERT INTO Chats (buyer_id, seller_id, product_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'iii', $_SESSION['user_id'], $seller_id, $product_id);
        mysqli_stmt_execute($stmt);

        // Get the ID of the newly created chat
        $chat_id = mysqli_insert_id($conn);
    }
    else {
        // If a chat does exist, get its ID
        $chat_id = $chat['chat_id'];
    }

    // Redirect to the new or existing chat
    header("Location: chat.php?chat_id=$chat_id");
    exit;
}

if (isset($_GET['chat_id'])) {
    $chat_id = $_GET['chat_id'];

    // Get the chat
    $query = "SELECT * FROM Chats WHERE chat_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $chat_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $chat = mysqli_fetch_assoc($result);

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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <!-- Add your CSS here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">2HandCloth</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="index.php" aria-current="page">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="preferences.php">Preferences</a></li>
                        <li class="nav-item"><a class="nav-link" href="insert_product.php">Sell Product</a></li>
                        <li class="nav-item"><a class="nav-link  active" href="chat.php">Chats</a></li>
                        <li class="nav-item"><a class="nav-link" href="MyListings.php">My Listings</a></li>
                        <li class="nav-item"><a class="nav-link" href="favorites.php">My Favorites</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span>Welcome, <?php echo $_SESSION['nome_completo']; ?></span>
                        </div>
                        <a class="btn btn-outline-dark" href="preferences.php">
                            <i class="bi bi-gear"></i>
                            Preferences
                        </a>
                    </div>
                <?php } else { ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" href="index.php" aria-current="page">Home</a></li>
                    </ul>
                    <a class="btn btn-outline-dark" href="SignIn.php">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login / Sign-Up
                    </a>
                <?php } ?>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if (empty($chats)): ?>
            <div class="alert alert-info" role="alert">
                You have no open chats.
            </div>
        <?php else: ?>
            <h2>Your Chats</h2>
            <ul class="list-group" id="chats">
                <?php foreach ($chats as $chat): ?>
                    <?php
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
                    ?>
                    <li class="list-group-item">
                        <a href="chat.php?chat_id=<?= $chat['chat_id'] ?>">
                            Chat about <strong><?= $product_name ?></strong> with <strong><?= $other_user_name ?></strong>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (isset($chat_id)): ?>
            <div class="mt-5">
                <h3>Messages</h3>
                <?php if (empty($messages)): ?>
                    <p>No messages yet.</p>
                <?php else: ?>
                    <ul class="list-group" id="messages">
                        <?php foreach ($messages as $message): ?>
                            <li class="list-group-item">
                                <strong><?= $message['sender_id'] == $_SESSION['user_id'] ? 'You' : $other_user_name ?>:</strong> <?= $message['content'] ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form action="sendMessage.php" method="post" class="mt-3">
                    <input type="hidden" name="chat_id" value="<?= $chat_id ?>">
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="3" placeholder="Type your message here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <script>
$(document).ready(function() {
    // Update chats every 5 seconds
    setInterval(function() {
        $.ajax({
            url: 'getChats.php',
            success: function(data) {
                $('#chats').html(data);
            }
        });
    }, 5000);

    // If a chat is open, update messages every 2 seconds
    <?php if (isset($chat_id)): ?>
    setInterval(function() {
        $.ajax({
            url: 'getMessages.php?chat_id=<?= $chat_id ?>',
            success: function(data) {
                $('#messages').html(data);
            }
        });
    }, 2000);
    <?php endif; ?>
});
</script>


</body>
</html>
