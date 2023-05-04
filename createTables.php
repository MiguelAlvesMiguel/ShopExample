
<?php


function createTables($conn)
{

    //Drop tables if they exist
    $conn->query("SET FOREIGN_KEY_CHECKS = 0");
    $tables = ['Types','Users', 'Preferences', 'Products', 'ProductImages', 'Favorites', 'Notifications', 'Chats', 'Messages', 'Transactions', 'Category', 'PreferenceBrands', 'PreferenceSizes', 'PreferenceCategories'];
    foreach ($tables as $table) {
        $sql = "DROP TABLE IF EXISTS $table";
        if (!$conn->query($sql)) {
            echo "Error dropping table $table: " . $conn->error . "\n";
        }
    }
    $conn->query("SET FOREIGN_KEY_CHECKS = 1");

    // Create tables
    $createTableQueries = [
        "CREATE TABLE IF NOT EXISTS Types (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL UNIQUE
        )",
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
            type_id INT NOT NULL,
            size VARCHAR(10) NOT NULL,
            brand VARCHAR(255),
            registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `condition` VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            FOREIGN KEY (seller_id) REFERENCES Users(user_id),
            FOREIGN KEY (category_id) REFERENCES Category(id),
            FOREIGN KEY (type_id) REFERENCES Types(id)
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
        "CREATE TABLE IF NOT EXISTS PreferenceTypes (
        preference_id INT NOT NULL,
        type_id INT NOT NULL,
        PRIMARY KEY (preference_id, type_id),
        FOREIGN KEY (preference_id) REFERENCES Preferences(preference_id),
        FOREIGN KEY (type_id) REFERENCES Types(id)
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
    $categories = [ 'Mulher','Homem' , 'Criança','Unisexo'];

    foreach ($categories as $category) {
        $sql = "INSERT IGNORE INTO Category (name) VALUES ('$category')";
        if (!$conn->query($sql)) {
            echo "Error inserting category $category: " . $conn->error . "\n";
        }
    }
    // Create Types ( Calças, Casacos , Camisolas , Camisas , T-Shirts , Calçado , Acessórios , Vestidos , Saias , Calções , Fatos de Banho , Roupa Interior , Outros )
    $types = [ 'Calças', 'Casacos' , 'Camisolas' , 'Camisas' , 'T-Shirts' , 'Calçado' , 'Acessórios' , 'Vestidos' , 'Saias' , 'Calções' , 'Fatos de Banho' , 'Roupa Interior' , 'Outros' ];

    foreach ($types as $type) {
        $sql = "INSERT IGNORE INTO Types (name) VALUES ('$type')";
        if (!$conn->query($sql)) {
            echo "Error inserting type $type: " . $conn->error . "\n";
        }
    }

    $image_url= 'https://picsum.photos/id/237/200/300';

    //Create 4 sample different products, from different brands and categories with their corresponding 2 random images:
        $products = [
             [
        'seller_id' => 1,
        'title' => 'Blue Jeans',
        'description' => 'Blue Jeans for women',
        'category_id' => 1,
        'type_id' => 1,
        'size' => 'M',
        'brand' => 'Levis',
        'condition' => 'excellent',
        'price' => 50.00,
        //'image_url' => 'Metam aqui o link da imagem',
    ],
    [
        'seller_id' => 1,
        'title' => 'Men\'s Black T-Shirt',
        'description' => 'Black T-Shirt for men',
        'category_id' => 2,
        'type_id' => 5,
        'size' => 'L',
        'brand' => 'Nike',
        'condition' => 'very good',
        'price' => 20.00,
    ],
    [
        'seller_id' => 1,
        'title' => 'Children\'s White Sneakers',
        'description' => 'White Sneakers for children',
        'category_id' => 3,
        'type_id' => 6,
        'size' => 'S',
        'brand' => 'Adidas',
        'condition' => 'good',
        'price' => 30.00,
    ],
    [
        'seller_id' => 1,
        'title' => 'Unisex Leather Belt',
        'description' => 'Leather Belt for all',
        'category_id' => 4,
        'type_id' => 7,
        'size' => 'XL',
        'brand' => 'Gucci',
        'condition' => 'satisfactory',
        'price' => 100.00,
    ],
     // Mulher
     [
        'seller_id' => 1,
        'title' => 'Women\'s Red Coat',
        'description' => 'Stylish red coat for women',
        'category_id' => 1,
        'type_id' => 2,
        'size' => 'M',
        'brand' => 'Zara',
        'condition' => 'excellent',
        'price' => 80.00,
    ],
    // Homem
    [
        'seller_id' => 1,
        'title' => 'Men\'s Striped Sweater',
        'description' => 'Comfortable striped sweater for men',
        'category_id' => 2,
        'type_id' => 3,
        'size' => 'L',
        'brand' => 'H&M',
        'condition' => 'very good',
        'price' => 40.00,
    ],
    // Criança
    [
        'seller_id' => 1,
        'title' => 'Children\'s Polka Dot Dress',
        'description' => 'Cute polka dot dress for children',
        'category_id' => 3,
        'type_id' => 8,
        'size' => 'S',
        'brand' => 'Carter\'s',
        'condition' => 'good',
        'price' => 25.00,
    ],
    // Unisexo
    [
        'seller_id' => 1,
        'title' => 'Unisex White Beanie',
        'description' => 'Warm and cozy white beanie for all',
        'category_id' => 4,
        'type_id' => 7,
        'size' => 'One size',
        'brand' => 'GAP',
        'condition' => 'satisfactory',
        'price' => 15.00,
    ],
    [
        'seller_id' => 1,
        'title' => 'Men\'s Plaid Shirt',
        'description' => 'Casual plaid shirt for men',
        'category_id' => 2,
        'type_id' => 4,
        'size' => 'L',
        'brand' => 'Tommy Hilfiger',
        'condition' => 'excellent',
        'price' => 35.00,
    ],
    [
        'seller_id' => 1,
        'title' => 'Women\'s Floral Skirt',
        'description' => 'Beautiful floral skirt for women',
        'category_id' => 1,
        'type_id' => 9,
        'size' => 'M',
        'brand' => 'Forever 21',
        'condition' => 'very good',
        'price' => 20.00,
    ],
    [
        'seller_id' => 1,
        'title' => 'Men\'s Khaki Shorts',
        'description' => 'Comfortable khaki shorts for men',
        'category_id' => 2,
        'type_id' => 10,
        'size' => 'L',
        'brand' => 'Old Navy',
        'condition' => 'good',
        'price' => 25.00,
    ],
        ];
        
// Like above but with different products and with seller_id = 2
$products2 = [
    [
        'seller_id' => 2,
        'title' => 'Women\'s Black Leather Boots',
        'description' => 'Stylish black leather boots for women',
        'category_id' => 1,
        'type_id' => 1,
        'size' => '8',
        'brand' => 'Steve Madden',
        'condition' => 'excellent',
        'price' => 120.00,
    ],
    [
        'seller_id' => 2,
        'title' => 'Men\'s Denim Jacket',
        'description' => 'Cool denim jacket for men',
        'category_id' => 2,
        'type_id' => 3,
        'size' => 'M',
        'brand' => 'Calvin Klein',
        'condition' => 'very good',
        'price' => 75.00,
    ],
    [
        'seller_id' => 2,
        'title' => 'Children\'s Yellow Raincoat',
        'description' => 'Bright yellow raincoat for children',
        'category_id' => 3,
        'type_id' => 6,
        'size' => '4T',
        'brand' => 'Columbia',
        'condition' => 'good',
        'price' => 35.00,
    ],
    [
        'seller_id' => 2,
        'title' => 'Unisex Aviator Sunglasses',
        'description' => 'Classic aviator sunglasses for all',
        'category_id' => 4,
        'type_id' => 7,
        'size' => 'One size',
        'brand' => 'Ray-Ban',
        'condition' => 'satisfactory',
        'price' => 80.00,
    ],
];







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
            //Insert the products and their images in ProductImages
            foreach ($products as $product) {
                $title = $conn->real_escape_string($product['title']);
                $description = $conn->real_escape_string($product['description']);
                $size = $conn->real_escape_string($product['size']);
                $brand = $conn->real_escape_string($product['brand']);
            
                $sql = "INSERT INTO Products (image_url, seller_id, title, description, category_id, type_id, size, brand, `condition`, price) VALUES ('{$image_url}','{$product['seller_id']}', '{$title}', '{$description}', {$product['category_id']}, {$product['type_id']}, '{$size}', '{$brand}', '{$product['condition']}', {$product['price']})";
                
                if (!$conn->query($sql)) {
                    echo "Error inserting product: " . $conn->error . "\n";
                } else {
                    echo "Product inserted successfully\n";
                }
            }
            
            

    } else {
        echo "<script>window.alert('Error Creating first user: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    echo "<script>window.alert('Registration Failed: " . $conn->error . "');</script>";
}


    $stmt = $conn->prepare($sql);
  
}
?>