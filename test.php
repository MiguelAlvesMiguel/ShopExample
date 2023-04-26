<?php
/*Remember this is the database scheme:
E TABLE IF NOT EXISTS Products (
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

    "CREATE TABLE IF NOT EXISTS Messages (
        message_id INT AUTO_INCREMENT PRIMARY KEY,
        chat_id INT NOT NULL,
        sender_id INT NOT NULL,
        content TEXT NOT NULL,
        FOREIGN KEY (chat_id) REFERENCES Chats(chat_id),
        FOREIGN KEY (sender_id) REFERENCES Users(user_id)
    )",
   

    
    */
include 'dbConnection.php';
include 'createTables.php';
echo "Hello World!";

createTables($conn);

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
?>