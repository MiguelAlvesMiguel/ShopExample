<?php
/*Remember this is the database scheme:
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
        FOREIGN KEY (user_id) REFERENCES Users(user_id)
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

        `condition` ENUM('excellent', 'very good', 'good', 'satisfactory') NOT NULL,
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
    )","CREATE TABLE IF NOT EXISTS PreferenceBrands (
        preference_id INT NOT NULL,
        brand VARCHAR(255) NOT NULL,
        PRIMARY KEY (preference_id, brand),
        FOREIGN KEY (preference_id) REFERENCES Preferences(preference_id)
    )",
    "CREATE TABLE IF NOT EXISTS PreferenceSizes (
        preference_id INT NOT NULL,
        size VARCHAR(10) NOT NULL,
        PRIMARY KEY (preference_id, size),
        FOREIGN KEY (preference_id) REFERENCES Preferences(preference_id)
    )",
    "CREATE TABLE IF NOT EXISTS PreferenceCategories (
        preference_id INT NOT NULL,
        category_id INT NOT NULL,
        PRIMARY KEY (preference_id, category_id),
        FOREIGN KEY (preference_id) REFERENCES Preferences(preference_id),
        FOREIGN KEY (category_id) REFERENCES Category(id)
    )",

    
    */
include 'dbConnection.php';
include 'createTables.php';
echo "Hello World!";

//createTables($conn);

// Print all users
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of all rows
    
    while($row = $result->fetch_assoc()) {
        //Unhash the password
        echo "id: " . $row["user_id"]. " - Name: " . $row["name"]. " - Email" . $row["email"]. " - Password" . $row["password_hash"]. "<br>";
    }
} else {
    echo "0 results";
}

// Print all products
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

  
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["product_id"] . " - Seller: " . $row["seller_id"] . " - Title: " . $row["title"] . " - Description: " . $row["description"] . " - Category: " . $row["category_id"] . " - Type: " . $row["type"] . " - Size: " . $row["size"] . " - Brand: " . $row["brand"] . " - Condition: " . $row["condition"] . " - Price: " . $row["price"] . "<br>";
    }

//Print all user preferences
$sql = "SELECT * FROM Preferences";
$result = $conn->query($sql);

  
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["preference_id"] . " - User: " . $row["user_id"] . "<br>";
    }

//Print all user preferences
$sql = "SELECT * FROM PreferenceBrands";
$result = $conn->query($sql);

  
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["preference_id"] . " - Brand: " . $row["brand"] . "<br>";
    }

//Print all user preferences
$sql = "SELECT * FROM PreferenceSizes";
$result = $conn->query($sql);

  
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["preference_id"] . " - Size: " . $row["size"] . "<br>";
    }

//Print all user preferences
$sql = "SELECT * FROM PreferenceCategories";
$result = $conn->query($sql);

  
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["preference_id"] . " - Category: " . $row["category_id"] . "<br>";
    }

//Print all user preferences


?>