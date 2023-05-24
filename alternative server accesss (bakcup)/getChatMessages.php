<?php
include 'dbConnection.php';
global $soap;

$chat_id = $_POST['chat_id'];

$result = $soap->call('getChatMessages', array('chat_id' => $chat_id));

if ($soap->fault) {
    echo 'Fault';
    print_r($result);
} else {
    $error = $client->getError();
    if ($error) {
        echo 'Error: ' . $error;
    } else {
        echo json_encode($result);
    }
}
?>
