<?php
ob_start(); // Start output buffering

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Include NuSOAP library
require_once('lib/nusoap.php');

// Include the serverDBConnection script
require_once 'serverBDConnection.php';


$server = new nusoap_server();
$server->configureWSDL("testService");


$server->register('getUserPreferences',
    array('user_id' => 'xsd:int'),
    array('return' => 'xsd:Array'),
    'urn:server',
    'urn:server#getUserPreferences',
    'rpc',
    'encoded',
    'Get user preferences'
);

$server->register('getAllProducts',
    array('user_id' => 'xsd:int'),
    array('return' => 'xsd:Array'),
    'urn:server',
    'urn:server#getAllProducts',
    'rpc',
    'encoded',
    'Get all products'
);

$server->register('getFavoriteProducts',
    array('user_id' => 'xsd:int'),
    array('return' => 'xsd:Array'),
    'urn:server',
    'urn:server#getFavoriteProducts',
    'rpc',
    'encoded',
    'Get favorite products'
);

$server->register('updateFavorite',
    array('user_id' => 'xsd:int', 'product_id' => 'xsd:int', 'is_favorite' => 'xsd:boolean'),
    array('return' => 'xsd:boolean'),
    'urn:server',
    'urn:server#updateFavorite',
    'rpc',
    'encoded',
    'Update favorite'
);

$server->register('CompraProduto',
    array('IDVendedor' => 'xsd:int', 'IDComprador' => 'xsd:int', 'IDProduto' => 'xsd:int'),
    array('return' => 'xsd:string'),
    'urn:server',
    'urn:server#CompraProduto',
    'rpc',
    'encoded',
    'Buy a product'
);
function CompraProduto($IDVendedor, $IDComprador, $IDProduto) {
    // Connect to the database
    global $conn;

    // Check product availability
    $sql_check = "SELECT price, available FROM Products WHERE product_id = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, 'i', $IDProduto);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $row_check = mysqli_fetch_assoc($result_check);

    if (!$row_check) { //: Produto não encontrado.
        return "Não aceite (produto não encontrado)";
    }

    if ($row_check['available'] == 0) { //: Produto não está disponível.
        return "Não aceite (produto não disponível)";
    }

    $price = $row_check['price'];

    // Insert a new transaction
    $sql_insert = "INSERT INTO Transactions (buyer_id, seller_id, product_id, price) VALUES (?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, 'iiid', $IDComprador, $IDVendedor, $IDProduto, $price);
    mysqli_stmt_execute($stmt_insert);

    if (mysqli_stmt_affected_rows($stmt_insert) > 0) {
        // Update product availability
        $sql_update = "UPDATE Products SET available = 0 WHERE product_id = ?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, 'i', $IDProduto);
        mysqli_stmt_execute($stmt_update);

        return "Aceite";
    } else {
        return "Não aceite";
    }
}


function getUserPreferences($user_id) {
    // Connect to the database
    global $conn;

    // SQL query to get user preferences
    $sql_preferences = "SELECT PreferenceTypes.type_id, PreferenceCategories.category_id, PreferenceSizes.size FROM Preferences
    LEFT JOIN PreferenceTypes ON Preferences.preference_id = PreferenceTypes.preference_id
    LEFT JOIN PreferenceCategories ON Preferences.preference_id = PreferenceCategories.preference_id
    LEFT JOIN PreferenceSizes ON Preferences.preference_id = PreferenceSizes.preference_id
    WHERE Preferences.user_id = $user_id";
    $result_preferences = $conn->query($sql_preferences);

    // Fetch the results and return them
    $preferences = [];
    while ($row_preferences = $result_preferences->fetch_assoc()) {
        $preferences[] = $row_preferences;
    }
    return $preferences;
}
function getAllProducts($user_id) {
    // Connect to the database
    global $conn;

    // Get all products if user_id doesn't exist 
    if ($user_id === 0 || $user_id === '0' || $user_id === null || $user_id === -1 || $user_id === '-1') {
        $query = "SELECT *, 0 AS preference_matches FROM Products ORDER BY preference_matches DESC";
    } else {
        // Get user preferences
        $preferences = getUserPreferences($user_id);

        $query = "SELECT *, (";
        $first = true;
        foreach ($preferences as $preference) {
            if (!$first) {
                $query .= " + ";
            }
            $first = false;
            if ($preference['type_id'] !== null) {
                $query .= "IF(type_id = " . $preference['type_id'] . ", 1, 0)";
            }
            if ($preference['category_id'] !== null) {
                $query .= " + IF(category_id = " . $preference['category_id'] . ", 1, 0)";
            }
            if ($preference['size'] !== null) {
                $query .= " + IF(size = '" . $preference['size'] . "', 1, 0)";
            }
        }
        $query .= ") AS preference_matches FROM Products WHERE seller_id != $user_id and available = 1 ORDER BY preference_matches DESC";
    }

    $result = $conn->query($query);

    // Fetch the results and return them
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
   
    return $products;
}

function getFavoriteProducts($user_id) {
    // Connect to the database
    global $conn;
    // SQL query to get favorite products
    $query = "SELECT product_id FROM Favorites WHERE user_id = $user_id";
    $result = $conn->query($query);

    // Fetch the results and return them
    $favorite_products = [];
    while ($row = $result->fetch_assoc()) {
        $favorite_products[] = $row['product_id'];
    }
    return $favorite_products;
}
function updateFavorite($user_id, $product_id, $is_favorite) {
    // Connect to the database
    global $conn;
   //Insert the values into the query
   
    // Add your query here
    if ($is_favorite === 'true') {
        $query = "INSERT INTO Favorites (user_id, product_id) VALUES (?, ?)";
        
    } else {
        $query = "DELETE FROM Favorites WHERE user_id = ? AND product_id = ?";
    }
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        return false;
    }
    else{
            mysqli_stmt_bind_param($stmt, 'ii', $user_id, $product_id);
    }
    
 

    $result = $conn->query($query);

    // Return whether the update was successful
    return $result;
}

@$server->service(file_get_contents("php://input"));
$conn->close();
ob_end_flush();
?>