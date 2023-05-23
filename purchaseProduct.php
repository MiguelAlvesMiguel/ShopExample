<?php
include 'dbConnection.php';
session_start();
global $soap;
if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}


$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
$seller_id = isset($_POST['seller_id']) ? $_POST['seller_id'] : null;

if ($product_id === null || $seller_id === null) {
    echo "Error: No product selected or seller ID missing.";
    exit();
}

// Call the CompraProduto function
// CompraProduto(IDVendedor, IDComprador, IDProduto)
$result = $soap->call('CompraProduto', array('IDVendedor' => $seller_id, 'IDComprador' => $user_id, 'IDProduto' => $product_id));
checkSoapError($soap);
// Output the result
echo $result;

function checkSoapError($soap) {
    // Check for a fault
    if ($soap->fault) {
        echo '<h2>Fault</h2><pre>';
        print_r($soap->fault);
        echo '</pre>';
    } else {
        // Check for errors
        $error = $soap->getError();
        if ($error) {
            // Display the error
            echo '<h2>Error</h2><pre>' . $error . '</pre>';
        }
    }
}
?>
