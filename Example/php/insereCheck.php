<?php
include "abreconexao.php";   

//--------------------------------------------------//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//--------------------------------------------------//
session_start();
echo $_SESSION['id_i'];
$query1="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id_i'] . "";
$result1 = $conn->query($query1);
$row = $result1->fetch_assoc();
if($row['checks'] == 'false'){
    $checks = $_SESSION['dia'] . "," . $_SESSION['hora'] . "," . $_SESSION['dia'] . ";";
    echo $checks;
    $query = "UPDATE disp_inst SET checks = '" . $checks . "' WHERE id = '" . $_SESSION['id_i'] . "'";
    $res = mysqli_query($conn, $query); 
}else{
    $checks = $row['checks'] . $_SESSION['dia'] . "," . $_SESSION['hora'] . "," . $_SESSION['dia'] . ";";
    echo $checks;
    $query = "UPDATE disp_inst SET checks = '" . $dias . "' WHERE id = '" . $_SESSION['id_i'] . "'";
    $res = mysqli_query($conn, $query); 
}

?>