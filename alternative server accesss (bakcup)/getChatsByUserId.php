<?php
include 'dbConnection.php';
global $soap;

$user_id = $_SESSION['user_id'];

$result = $soap->call('getChatsByUserId', array('user_id' => $user_id));

if ($soap->fault) {
    echo 'Fault';
    print_r($result);
} else {
    $error = $soap->getError();
    if ($error) {
        echo 'Error: ' . $error;
    } else {
        echo json_encode($result);
    }
}
?>
