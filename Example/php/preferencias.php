
<?php
include "abreconexao.php";   

//--------------------------------------------------//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//--------------------------------------------------//
session_start();
if($_SESSION['utilizador'] == 'voluntario'){
    $query="SELECT * FROM pref_volt WHERE id = " . $_SESSION['id'] . "";
    $result = $conn->query($query);
    if($result->num_rows == 0){
        $query = "insert into pref_volt values ( " . $_SESSION['id'] . ",'" . $_POST['tipoInst'] . "','" . $_POST['tipoDoa'] . "')";
        $res = mysqli_query($conn, $query); 
    }else{
        $query = "UPDATE pref_volt SET tipoInst = '" . $_POST['tipoInst'] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query); 
        $query = "UPDATE pref_volt SET tipoDoa = '" . $_POST['tipoDoa'] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query); 
    }
}else{
    $query="SELECT * FROM pref_inst WHERE id = " . $_SESSION['id'] . "";
    $result = $conn->query($query);
    if($result->num_rows == 0){
        $query = "insert into pref_inst values ( " . $_SESSION['id'] . ",'" . $_POST['tipoInst'] . "','" . $_POST['tipoDoa'] . "','" . $_POST['quantidade'] . "')";
        $res = mysqli_query($conn, $query); 
    }else{
        $query = "UPDATE pref_inst SET tipoInst = '" . $_POST['tipoInst'] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query); 
        $query = "UPDATE pref_inst SET tipoDoa = '" . $_POST['tipoDoa'] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query); 
        $query = "UPDATE pref_inst SET quantidade = '" . $_POST['quantidade'] . "' WHERE id = " . $_SESSION['id'] . "";
        $res = mysqli_query($conn, $query); 
    }
}
header("Location: ../entrada.php");
mysqli_close($conn);
?>