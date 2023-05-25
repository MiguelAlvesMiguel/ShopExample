<?php
include 'dbConnection.php';

function getProductById($product_id) {
    global $soap;
    $result = $soap->call('getProductById', array('product_id' => $product_id));
    checkSoapError($soap, 'getProductById');
    return $result;
}

if (isset($_POST['product_id'])) {
    echo json_encode(getProductById($_POST['product_id']));
}
?>
