<?php

include 'dbConnection.php';

session_start();

global $soap;
// Set default user ID if user is not logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : -1;

// Get user preferences if user is not logged in
if ($user_id != -1) {
    $result_preferences = $soap->call('getUserPreferences', array('user_id' => $user_id));
    checkSoapError($soap);
}

// Get all products
$products = $soap->call('getAllProducts', array('user_id' => $user_id));
checkSoapError($soap);

// Get favorite products if user is logged in
$favorite_products = $soap->call('getFavoriteProducts', array('user_id' => $user_id));
checkSoapError($soap);

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


// Print everything
echo "<h1>Products</h1>";
echo "<table border='1'>";
echo "<tr><th>Product ID</th><th>Name</th><th>Price</th><th>Favorite</th></tr>";
foreach ($products as $product) {
    $product_id = $product['product_id'];
    $name = $product['name'];
    $price = $product['price'];
    $is_favorite = in_array($product_id, $favorite_products) ? 'true' : 'false';
    echo "<tr><td>$product_id</td><td>$name</td><td>$price</td><td>$is_favorite</td></tr>";
}

echo "</table>";

echo "<h1>Preferences</h1>";
echo "<table border='1'>";
echo "<tr><th>Type ID</th><th>Category ID</th><th>Size</th></tr>";
foreach ($result_preferences as $preference) {
    $type_id = $preference['type_id'];
    $category_id = $preference['category_id'];
    $size = $preference['size'];
    echo "<tr><td>$type_id</td><td>$category_id</td><td>$size</td></tr>";
}

echo "</table>";



?>
