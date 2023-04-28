<?php 
include_once 'dbConnection.php';

/*
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
        `condition` VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (seller_id) REFERENCES Users(user_id),
        FOREIGN KEY (category_id) REFERENCES Category(id)
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $genero = $_POST['genero'];
    $size = $_POST['size'];
    $marca = $_POST['marca'];
    $condition = $_POST['condition'];
    $preco = $_POST['preco'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO Products ( image_url, seller_id, title, description, category_id, type, size, brand, `condition`, price) VALUES ('$image_url', 1, '$titulo', '$descricao', '$categoria', '$genero', '$size', '$marca', '$condition', '$preco')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        
        echo "<script>alert('Produto adicionado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao adicionar produto!');</script>";
    }
    header("Location: index.php");
}
?>