<?php
include 'dbConnection.php';
session_start();

// Set default user ID if user is not logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : -1;

// Get all products
$products = $soap->call('getAllProducts', array('user_id' => $user_id));
checkSoapError($soap, 'getAllProducts');

// Return the products as JSON
header('Content-Type: application/json');
echo json_encode($products);
?>
