<?php
include 'dbConnection.php';

function getLatestProductId() {
    global $soap;
    $result = $soap->call('getLatestProductId', array());
    checkSoapError($soap, 'getLatestProductId');
    return $result;
}

echo getLatestProductId();
?>
