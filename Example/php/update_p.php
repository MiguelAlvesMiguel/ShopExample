<?php
    include 'abreconexao.php';

    session_start();

    if($_SESSION['utilizador'] == 'voluntario'){

    $query = "UPDATE voluntario SET telefone = " . $_POST["telefone"] . " WHERE idvoluntario = " . $_SESSION['id'] . "";
    $res = mysqli_query($conn, $query);

    $query = "UPDATE voluntario SET CC = '" . $_POST["CC"] . "' WHERE idvoluntario = " . $_SESSION['id'] . "";
    $res = mysqli_query($conn, $query);

    $query = "UPDATE voluntario SET ncarta = '" . $_POST["ncarta"] . "' WHERE idvoluntario = " . $_SESSION['id'] . "";
    $res = mysqli_query($conn, $query);

    header("Location: ../perfil_volt.php");

    // echo "Hello world!<br>";

    
    
    } else {
        $query = "UPDATE instituicao SET telefone = '" . $_POST["telefone"] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query);
    
        $query = "UPDATE instituicao SET morada = '" . $_POST["morada"] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query);
    
        $query = "UPDATE instituicao SET conc = '" . $_POST["conc"] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query);
    
        $query = "UPDATE instituicao SET freg = '" . $_POST["freg"] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query);
    
        $query = "UPDATE instituicao SET descricao = '" . $_POST["descricao"] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query);

        header("Location: ../perfil_inst.php");
    }


?>