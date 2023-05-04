<?php
require 'dbConnection.php';

//First print the values of  sizes, brands and categories
echo "<h3>Categories</h3>";
if (!empty($_POST['categories'])) {
    foreach ($_POST['categories'] as $category_name) {
        echo $category_name . "<br>";
    }
} else {
    echo "No categories selected";
}
echo "<h3>Sizes</h3>";
if (!empty($_POST['sizes'])) {
    foreach ($_POST['sizes'] as $size) {
        echo $size . "<br>";
    }
} else {
    echo "No sizes selected";
}
echo "<h3>Brands</h3>";
if (!empty($_POST['brands'])) {
    foreach ($_POST['brands'] as $brand) {
        echo $brand . "<br>";
    }
} else {
    echo "No brands selected";
}

session_start();
$user_id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete existing preferences
// Check if there's a record in the Preferences table for the user
$sql_check = "SELECT preference_id FROM Preferences WHERE user_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $user_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
if ($result_check->num_rows > 0) {
    $row_check = $result_check->fetch_assoc();
    $preference_id = $row_check['preference_id'];
} else {
    // Create a new record for the user in the Preferences table
    $sql_insert_pref = "INSERT INTO Preferences (user_id) VALUES (?)";
    $stmt_insert_pref = $conn->prepare($sql_insert_pref);
    $stmt_insert_pref->bind_param("i", $user_id);
    $stmt_insert_pref->execute();
    $preference_id = $stmt_insert_pref->insert_id;
}
// Delete existing PreferenceTypes
$sql_delete_types = "DELETE FROM PreferenceTypes WHERE preference_id = ?";
$stmt_delete_types = $conn->prepare($sql_delete_types);
$stmt_delete_types->bind_param("i", $preference_id);
$stmt_delete_types->execute();

// Add types
if (!empty($_POST['types'])) {
    foreach ($_POST['types'] as $type_id) {
        $type_id = intval($type_id);
        $sql_insert = "INSERT INTO PreferenceTypes (preference_id, type_id) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ii", $preference_id, $type_id);
        $stmt_insert->execute();
    }
}
// Delete existing preferences
$sql_delete_brands = "DELETE FROM PreferenceBrands WHERE preference_id = ?";
$sql_delete_sizes = "DELETE FROM PreferenceSizes WHERE preference_id = ?";
$sql_delete_categories = "DELETE FROM PreferenceCategories WHERE preference_id = ?";
$stmt_delete_brands = $conn->prepare($sql_delete_brands);
$stmt_delete_sizes = $conn->prepare($sql_delete_sizes);
$stmt_delete_categories = $conn->prepare($sql_delete_categories);
$stmt_delete_brands->bind_param("i", $preference_id);
$stmt_delete_sizes->bind_param("i", $preference_id);
$stmt_delete_categories->bind_param("i", $preference_id);
$stmt_delete_brands->execute();
$stmt_delete_sizes->execute();
$stmt_delete_categories->execute();

// Insert new preferences
if (!empty($_POST['categories'])) {
    foreach ($_POST['categories'] as $category_name) {
        $category_name = $conn->real_escape_string($category_name);
        $sql_category_id = "SELECT id FROM Category WHERE name = ?";
        $stmt_category_id = $conn->prepare($sql_category_id);
        $stmt_category_id->bind_param("s", $category_name);
        $stmt_category_id->execute();
        $result_category_id = $stmt_category_id->get_result();
        $row_category_id = $result_category_id->fetch_assoc();
        $category_id = $row_category_id['id'];

        
echo '<script>window.alert("Category id is '.$category_id.'");</script>';


$sql_insert = "INSERT INTO PreferenceCategories (preference_id, category_id) VALUES (?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ii", $preference_id, $category_id);


        $stmt_insert->execute();
    }
}

if (!empty($_POST['sizes'])) {
    foreach ($_POST['sizes'] as $size) {
        $size = $conn->real_escape_string($size);
        $sql_insert = "INSERT INTO PreferenceSizes (preference_id, size) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("is", $preference_id, $size);
        $stmt_insert->execute();
    }
}

if (!empty($_POST['brands'])) {
    foreach ($_POST['brands'] as $brand) {
        $brand = $conn->real_escape_string($brand);
        $sql_insert = "INSERT INTO PreferenceBrands (preference_id, brand) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("is", $preference_id, $brand);
        $stmt_insert->execute();
    }
}
header("Location: index.php");
}

?>