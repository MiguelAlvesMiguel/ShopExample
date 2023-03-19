<?php

$plaintext_password = $_POST["password"];
$hash_pass = password_hash($plaintext_password,PASSWORD_DEFAULT);

$phone = " " . $_POST["phone-input1"] . $_POST["phone-input2"] . $_POST["phone-input3"] . $_POST["phone-input4"] . $_POST["phone-input5"] . $_POST["phone-input6"] . $_POST["phone-input7"] . $_POST["phone-input8"] . $_POST["phone-input9"] ;

if ($_POST["account"] == "voluntarios"){
  $query = "SELECT idvoluntario FROM voluntario";
  $result = $conn->query($query);
  $query = "insert into voluntario values (" . $result->num_rows . ",'" . $_POST["nome"] . "','" . $_POST["email"] ."',".$phone .",". $_POST["dateNasc"] .",'"  . $_POST["gender"] . "'," . $_POST["ncc"] . ",'" . $_POST["ncarta"] . "','" . $_POST["distrito"] . "','" . $_POST["concelho"] . "','" . $_POST["freguesia"] . "','" . $_FILES["uploadfile"]["name"] . "','" . $hash_pass . "')";
}else{ 
    $query = "SELECT id FROM instituicao";
    $result = $conn->query($query);
    echo $result->num_rows;
    $query = "insert into instituicao values (" . $result->num_rows . ",'" . $_POST["nome"] . "','" . $_POST["email"] . "'," . $phone . ",'" . $_POST["address"] . "','" . $_POST["concelho"] . "','" . $_POST["freguesia"] . "','" . $_POST["descricao"] ."','". $hash_pass ."')";

}
$res = mysqli_query($conn, $query); if ($res) {
  echo "Um novo registo inserido com sucesso";
  if ($_POST["account"] == "voluntarios"){
    header("Location: ../preferencias.php");
  }
  elseif ($_POST["account"] == "instituicoes")
   header("Location: ../preferencias.php");
} else {
  echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>