
<?php


function createTables($conn)
{

    //Drop tables if they exist
    $conn->query("SET FOREIGN_KEY_CHECKS = 0");
    $tables = ['Users', 'Preferences', 'Products', 'ProductImages', 'Favorites', 'Notifications', 'Chats', 'Messages', 'Transactions', 'Category', 'PreferenceBrands', 'PreferenceSizes', 'PreferenceCategories'];
    foreach ($tables as $table) {
        $sql = "DROP TABLE IF EXISTS $table";
        if (!$conn->query($sql)) {
            echo "Error dropping table $table: " . $conn->error . "\n";
        }
    }
    $conn->query("SET FOREIGN_KEY_CHECKS = 1");

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
        FOREIGN KEY (user_id) REFERENCES Users(user_id)
    )",
        "CREATE TABLE IF NOT EXISTS Products (
        product_id INT AUTO_INCREMENT PRIMARY KEY,
        image_url VARCHAR(255) NOT NULL,
        seller_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        category_id INT NOT NULL,
        type VARCHAR(255) NOT NULL,
        size VARCHAR(10) NOT NULL,
        brand VARCHAR(255),
        registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        /* condition is a reserved keyword!!!!!!!!!!!!! */
        `condition` VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (seller_id) REFERENCES Users(user_id),
        FOREIGN KEY (category_id) REFERENCES Category(id)
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
    )", "CREATE TABLE IF NOT EXISTS PreferenceBrands (
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
    ];

    //Create the tables
    foreach ($createTableQueries as $query) {
        if (!$conn->query($query)) {
            echo "Error creating table: " . $conn->error . "\n";
        } else {
            echo "Table {$query} created successfully\n";
        }
    }

    // Insert simple unisex categories if they don't exist
    $categories = [ 'Accessories','Bottoms' , 'Shoes','Tops'];

    foreach ($categories as $category) {
        $sql = "INSERT IGNORE INTO Category (name) VALUES ('$category')";
        if (!$conn->query($sql)) {
            echo "Error inserting category $category: " . $conn->error . "\n";
        }
    }

    //Insert a single product for testing purposes
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

   // Create a sample user
$sql = "INSERT IGNORE INTO Users (user_id, name, date_of_birth, gender, address, city, postal_code, phone, email, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $userId = 1;
    $name = 'Test NAme';
    $dob = '2000-01-02'; // The format should be 'YYYY-MM-DD'
    $gender = 'Masculino'; // Use 'M' instead of 'Masculino'
    $address = 'Test Address';
    $city = 'Test City';
    $postalCode = 'Test Postal Code';
    $phone = 'Test Phone';
    $email = 'emailemail@gmail.com';
    $passwordHash = 'Password1234';

    $stmt->bind_param("isssssssss", $userId, $name, $dob, $gender, $address, $city, $postalCode, $phone, $email, $passwordHash);

    if ($stmt->execute()) {
        echo "<script>window.alert('Created first user.');</script>";
    } else {
        echo "<script>window.alert('Error Creating first user: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    echo "<script>window.alert('Registration Failed: " . $conn->error . "');</script>";
}


    $stmt = $conn->prepare($sql);
    $image_url= 'https://picsum.photos/id/237/200/300';

    //Create 4 sample different products, from different brands and categories with their corresponding 2 random images:
        $products = [
            ['seller_id' => 1,
               'title' => 'Black T-Shirt',        'description' => 'Black T-Shirt',        'category_id' => 1,        'type' => 'T-Shirt',        'size' => 'M',        'brand' => 'Nike',        'condition' => 'excellent',        'price' => 10.00,],
            ['seller_id' =>1, 
               'title' => 'Blue Jeans',        'description' => 'Blue Jeans',        'category_id' => 2,        'type' => 'Jeans',        'size' => 'L',        'brand' => 'Levis',        'condition' => 'very good',        'price' => 50.00,],
            ['seller_id' => 1,   
               'title' => 'White Sneakers',        'description' => 'White Sneakers',        'category_id' => 3,        'type' => 'Sneakers',        'size' => 'S',        'brand' => 'Adidas',        'condition' => 'good',        'price' => 70.00,],
            ['seller_id' => 1,  
               'title' => 'Leather Belt',        'description' => 'Leather Belt',        'category_id' => 4,        'type' => 'Belt',        'size' => 'XL',        'brand' => 'Gucci',        'condition' => 'satisfactory',        'price' => 100.00,],
        ];
    //Insert the products and their images in ProductImages
    foreach ($products as $product) {
        $sql = "INSERT INTO Products (image_url, seller_id,  title, description, category_id, type, size, brand, `condition`, price) VALUES ('{$image_url}','{$product['seller_id']}', '{$product['title']}', '{$product['description']}', {$product['category_id']}, '{$product['type']}', '{$product['size']}', '{$product['brand']}', '{$product['condition']}', {$product['price']})";
        if (!$conn->query($sql)) {
            echo "Error inserting product: " . $conn->error . "\n";
        } else {
            echo "Product inserted successfully\n";
           
        }
    }
}
?>