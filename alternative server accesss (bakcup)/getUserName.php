<?php
include 'dbConnection.php';

function getUsername($user_id) {
    global $soap;
    $result = $soap->call('getUsername', array('user_id' => $user_id));
    checkSoapError($soap, 'getUsername');
    return $result;
}

if (isset($_POST['user_id'])) {
    echo json_encode(getProductById($_POST['user_id']));
}
?>
