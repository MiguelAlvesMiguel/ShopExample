<?php
include "abreconexao.php";  
$sql = "SELECT id_voluntario, dia, periodo, area FROM disponibilidade";
$result = $conn->query($sql);
echo "<script src='../js/constroi_volt.js'></script>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sql1 = "SELECT voluntario.idvoluntario, voluntario.CC, voluntario.nome, voluntario.datanasc, voluntario.ncarta, voluntario.telefone, voluntario.genero, voluntario.conc, voluntario.dis, voluntario.freg, voluntario.photo, voluntario.email FROM voluntario, disponibilidade WHERE disponibilidade.id_voluntario = " . $row["id_voluntario"] . " AND voluntario.idvoluntario = " . $row["id_voluntario"] . " ";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                echo "<script type='text/javascript'> insereVolt([" . $row1["idvoluntario"],",'" . $row1["nome"] . "'," . $row1["telefone"] . ",'" . $row1["email"] . "','" . $row1["genero"] . "'," . $row1["CC"] . ",'" . $row1["ncarta"] . "','" . $row1["dis"] . "','"  . $row1["conc"] . "','" . $row1["freg"] . "','"  . $row1["photo"] . "','" . $row["area"] . "','" . $row["dia"] . "','" . $row["periodo"] . "']); </script>";
            }
        }
    }
    echo "<script type='text/javascript'> criar(''); </script>";
}

?>