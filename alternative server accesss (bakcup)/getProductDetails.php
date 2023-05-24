<?php
include 'dbConnection.php';

$product_id = $_POST['product_id'];

$result = $soap->call('getProductDetails', array('product_id' => $product_id));

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
