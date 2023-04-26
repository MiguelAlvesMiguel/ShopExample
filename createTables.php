
<?php
/*
DATABASE SCHEME:
 "CREATE TABLE IF NOT EXISTS Users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        date_of_birth DATE NOT NULL,
        gender ENUM('F', 'M', 'Other') NOT NULL,
        address VARCHAR(255) NOT NULL,
        city VARCHAR(255) NOT NULL,
        postal_code VARCHAR(10) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS Category (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE
    )",
    "CREATE TABLE IF NOT EXISTS Preferences (
        preference_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        category INT,
        size VARCHAR(10),
        brand VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES Users(user_id),
        FOREIGN KEY (category) REFERENCES Category(id)
    )",
    "CREATE TABLE IF NOT EXISTS Products (
        product_id INT AUTO_INCREMENT PRIMARY KEY,
        seller_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        category_id INT NOT NULL,
        type VARCHAR(255) NOT NULL,
        size VARCHAR(10) NOT NULL,
        brand VARCHAR(255),
        registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        condition ENUM('excellent', 'very good', 'good', 'satisfactory') NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (seller_id) REFERENCES Users(user_id),
        FOREIGN KEY (category_id) REFERENCES Category(id)
    )",
    "CREATE TABLE IF NOT EXISTS ProductImages (
        image_id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        image_url VARCHAR(255) NOT NULL,
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )",
    "CREATE TABLE IF NOT EXISTS Favorites (
        favorite_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES Users(user_id),
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )",
    "CREATE TABLE IF NOT EXISTS Notifications (
        notification_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES Users(user_id),
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )",
    "CREATE TABLE IF NOT EXISTS Chats (
        chat_id INT AUTO_INCREMENT PRIMARY KEY,
        buyer_id INT NOT NULL,
        seller_id INT NOT NULL,
        product_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (buyer_id) REFERENCES Users(user_id),
        FOREIGN KEY (seller_id) REFERENCES Users(user_id),
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )",
    "CREATE TABLE IF NOT EXISTS Messages (
        message_id INT AUTO_INCREMENT PRIMARY KEY,
        chat_id INT NOT NULL,
        sender_id INT NOT NULL,
        content TEXT NOT NULL,
        FOREIGN KEY (chat_id) REFERENCES Chats(chat_id),
        FOREIGN KEY (sender_id) REFERENCES Users(user_id)
    )",
    "CREATE TABLE IF NOT EXISTS Transactions (
        transaction_id INT AUTO_INCREMENT PRIMARY KEY,
        buyer_id INT NOT NULL,
        product_id INT NOT NULL,
        purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (buyer_id) REFERENCES Users(user_id),
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
*/

function createTables($conn) {

// Drop tables if they exist
$tables = ['Users', 'Preferences', 'Products', 'ProductImages', 'Favorites', 'Notifications', 'Chats', 'Messages', 'Transactions', 'Category'];
foreach ($tables as $table) {
    $sql = "DROP TABLE IF EXISTS $table";
    if (!$conn->query($sql)) {
        echo "Error dropping table $table: " . $conn->error . "\n";
    }
}

// Create tables
$createTableQueries = [
    "CREATE TABLE IF NOT EXISTS Users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        date_of_birth DATE NOT NULL,
        gender ENUM('Feminino', 'Masculino', 'Outro') NOT NULL,
        address VARCHAR(255) NOT NULL,
        city VARCHAR(255) NOT NULL,
        postal_code VARCHAR(10) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS Category (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE
    )",
    "CREATE TABLE IF NOT EXISTS Preferences (
        preference_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        category INT,
        size VARCHAR(10),
        brand VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES Users(user_id),
        FOREIGN KEY (category) REFERENCES Category(id)
    )",
    "CREATE TABLE IF NOT EXISTS Products (
        product_id INT AUTO_INCREMENT PRIMARY KEY,
        seller_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        category_id INT NOT NULL,
        type VARCHAR(255) NOT NULL,
        size VARCHAR(10) NOT NULL,
        brand VARCHAR(255),
        registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        condition ENUM('excellent', 'very good', 'good', 'satisfactory') NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (seller_id) REFERENCES Users(user_id),
        FOREIGN KEY (category_id) REFERENCES Category(id)
    )",
    "CREATE TABLE IF NOT EXISTS ProductImages (
        image_id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        image_url VARCHAR(255) NOT NULL,
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )",
    "CREATE TABLE IF NOT EXISTS Favorites (
        favorite_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES Users(user_id),
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )",
    "CREATE TABLE IF NOT EXISTS Notifications (
        notification_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES Users(user_id),
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )",
    "CREATE TABLE IF NOT EXISTS Chats (
        chat_id INT AUTO_INCREMENT PRIMARY KEY,
        buyer_id INT NOT NULL,
        seller_id INT NOT NULL,
        product_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (buyer_id) REFERENCES Users(user_id),
        FOREIGN KEY (seller_id) REFERENCES Users(user_id),
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )",
    "CREATE TABLE IF NOT EXISTS Messages (
        message_id INT AUTO_INCREMENT PRIMARY KEY,
        chat_id INT NOT NULL,
        sender_id INT NOT NULL,
        content TEXT NOT NULL,
        FOREIGN KEY (chat_id) REFERENCES Chats(chat_id),
        FOREIGN KEY (sender_id) REFERENCES Users(user_id)
    )",
    "CREATE TABLE IF NOT EXISTS Transactions (
        transaction_id INT AUTO_INCREMENT PRIMARY KEY,
        buyer_id INT NOT NULL,
        product_id INT NOT NULL,
        purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (buyer_id) REFERENCES Users(user_id),
        FOREIGN KEY (product_id) REFERENCES Products(product_id)
    )"];

    //Create the tables
    foreach ($createTableQueries as $query) {
        if (!$conn->query($query)) {
            echo "Error creating table: " . $conn->error . "\n";
        }
        else {
            echo "Table {$query} created successfully\n";
        }
    }

    // Insert simple unisex categories if they don't exist
    $categories = ['Tops', 'Bottoms', 'Shoes', 'Accessories'];

    foreach ($categories as $category) {
        $sql = "INSERT IGNORE INTO Category (name) VALUES ('$category')";
        if (!$conn->query($sql)) {
            echo "Error inserting category $category: " . $conn->error . "\n";
        }
    }

}
    
?>