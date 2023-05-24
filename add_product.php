<?php 
include_once 'dbConnection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $tipo = $_POST['tipo'];
    $size = $_POST['size'];
    $marca = $_POST['marca'];
    $condition = $_POST['condition'];
    $preco = $_POST['preco'];
    $image_url = $_POST['image_url'];
    
    $user_id = $_SESSION['user_id'];
    
    if($user_id	== null){
        echo "<script>window.alert('Por favor faça login!');</script>";
        header("Location: login.php");
        exit;
    }
    echo "<script>window.alert('".$tipo."');</script>";
    $query = "INSERT INTO Products (available, image_url, seller_id, title, description, category_id, `type_id`, size, brand, `condition`, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "isisssisssd", $available, $image_url, $user_id, $titulo, $descricao, $categoria, $tipo, $size, $marca, $condition, $preco);
        
        $available = 1; // this is after because it's a boolean 
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>window.alert('Produto adicionado com sucesso!');</script>";
        } else {
            echo "<script>window.alert('Erro ao adicionar produto.');</script>";
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    header("Location: index.php");
}

?>