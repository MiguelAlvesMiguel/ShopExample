
<?php
include "abreconexao.php";   

//--------------------------------------------------//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//--------------------------------------------------//
$dias = '';
foreach($_POST['checkbox-group'] as $dia){
    $dias = $dias . $dia . ',';
}


$disp = '';
foreach($_POST['checkbox'] as $disponibilidade){
    $disp = $disp . $disponibilidade . ',';
}

session_start();
if($_SESSION['utilizador'] == 'voluntario'){
  $query = "SELECT id FROM disp_volt WHERE id = " . $_SESSION['id'] . "";
  $result = $conn->query($query);
  if ($result->num_rows == 0) {
  $query = "insert into disp_volt(id,dia,hora) values (" . $_SESSION['id'] . ",'" . $dias . "','" . $disp . "','" . $_POST["area"] . "')";
  $res = mysqli_query($conn, $query); 
  // if ($res) {
  //   echo "Um novo registo inserido com sucesso";
  //   // header("Location: ../entrada.php");
  // } else {
  //   echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
  // }
  
  }else{
  $query = "UPDATE disp_volt SET dia = '" . $dias . "' WHERE id = '" . $_SESSION['id'] . "'";
  $res = mysqli_query($conn, $query); 
  $query = "UPDATE disp_volt SET hora = '" . $disp . "' WHERE id = '" . $_SESSION['id'] . "'";
  $res = mysqli_query($conn, $query); 
  $query = "UPDATE disp_volt SET area = '" . $_POST["area"] . "' WHERE id = '" . $_SESSION['id'] . "'";
  $res = mysqli_query($conn, $query);
  //  if ($res) {
  //   echo "Um novo registo inserido com sucesso";
  //   // header("Location: ../entrada.php");
  // } else {
  //   echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
  // }
}
//////////////relacao////////////////////////
  $query="SELECT * FROM disp_inst WHERE area LIKE '%" . $_POST["area"] . "%'";
  $resulti = $conn->query($query);
  $inst1 = "";
  if ($resulti->num_rows > 0) {
    while($rowi = $resulti->fetch_assoc()) {
      $inst = 0;
      foreach($_POST['checkbox-group'] as $dia){
        foreach($_POST['checkbox'] as $disponibilidade){
          $query="SELECT * FROM disp_inst WHERE id = " . $rowi['id'] . " AND dia LIKE '%" . $dia . "%' AND hora LIKE '%" . $disponibilidade . "%'";
          $result = $conn->query($query);
          if ($result->num_rows > 0) {
            $inst += 1;
          }
      }
    } 
    ///////////////////inserir

      if($inst > 0){
        $query="SELECT pref_inst.id FROM pref_inst, pref_volt WHERE pref_inst.id = " . $rowi['id'] . " AND pref_volt.id =" . $_SESSION['id'] . " AND pref_inst.tipoInst = pref_volt.tipoInst AND pref_inst.tipoDoa = pref_volt.tipoDoa";
        $resultpi = $conn->query($query);
        if($resultpi->num_rows > 0){
          $inst1 .= $rowi['id'] . ",";
          $query1="SELECT * FROM rel_inst WHERE id = " . $rowi['id'] . "";
          $result1 = $conn->query($query1);
          if($result1->num_rows > 0){
            $row = $result1->fetch_assoc();
            $query="SELECT * FROM rel_inst WHERE id = " . $rowi['id'] . " AND ids_volt LIKE '%" . $_SESSION['id'] . "%'";
            $result = $conn->query($query);
            if ($result->num_rows == 0) {
              $ids = $row['ids_volt'] . $_SESSION['id'] . ",";
              $query = "UPDATE rel_inst SET ids_volt = '" . $ids . "' WHERE id = '" . $rowi['id'] . "'";
              $res = mysqli_query($conn, $query); 
            }
          }else{
            $query = "insert into rel_inst values (" . $rowi['id'] . ",'" . $_SESSION['id'] . ",')";
            $res = mysqli_query($conn, $query); 
          }
        }
      }
    }///////////////////////inserir
    $query1="SELECT * FROM rel_volt WHERE id = " . $_SESSION['id'] . "";
    $result1 = $conn->query($query1);
    if($result1->num_rows > 0){
      $query = "UPDATE rel_volt SET ids_inst = '" . $inst1 . "' WHERE id = '" . $_SESSION['id'] . "'";
      $res = mysqli_query($conn, $query); 
    }else{
      $query = "insert into rel_volt values (" . $_SESSION['id'] . ",'" . $inst1 . "')";
      $res = mysqli_query($conn, $query); 
    }
    
  }  
////////////////////////////////////////////////////////////////////////////////
}else{
  $query = "SELECT id FROM disp_inst WHERE id = " . $_SESSION['id'] . "";
  $result = $conn->query($query);
  if ($result->num_rows == 0) {
    $query = "insert into disp_inst(id,dia,hora) values (" . $_SESSION['id'] . ",'" . $dias . "','" . $disp . "','" . $_POST["area"] . "')";
    $res = mysqli_query($conn, $query); 
  //   if ($res) {
  //   echo "Um novo registo inserido com sucesso";
  //   header("Location: ../entrada.php");
  // } else {
  //   echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
  // }
} else {
  $query = "UPDATE disp_inst SET dia = '" . $dias . "' WHERE id = '" . $_SESSION['id'] . "'";
  $res = mysqli_query($conn, $query); 
  $query = "UPDATE disp_inst SET hora = '" . $disp . "' WHERE id = '" . $_SESSION['id'] . "'";
  $res = mysqli_query($conn, $query); 
  $query = "UPDATE disp_inst SET area = '" . $_POST["area"] . "' WHERE id = '" . $_SESSION['id'] . "'";
  $res = mysqli_query($conn, $query); 
  // if ($res) {
  //   echo "Um novo registo inserido com sucesso";
  //   header("Location: ../entrada.php");
  // } else {
  //   echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
  // }
}
//////////////relacao////////////////////////
$query="SELECT * FROM disp_volt WHERE area LIKE '%" . $_POST["area"] . "%'";
$resultv = $conn->query($query);
$volt1 = "";
if ($resultv->num_rows > 0) {
  while($rowv = $resultv->fetch_assoc()) {
    $volt = 0;
    foreach($_POST['checkbox-group'] as $dia){
      foreach($_POST['checkbox'] as $disponibilidade){
        $query="SELECT * FROM disp_volt WHERE id = " . $rowv['id'] . " AND dia LIKE '%" . $dia . "%' AND hora LIKE '%" . $disponibilidade . "%'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
          $volt += 1;
        }
    }
  }
    if($volt > 0){
      $query="SELECT pref_inst.id FROM pref_inst, pref_volt WHERE pref_inst.id = " . $_SESSION['id'] . " AND pref_volt.id =" . $rowv['id'] . " AND pref_inst.tipoInst = pref_volt.tipoInst AND pref_inst.tipoDoa = pref_volt.tipoDoa";
      $resultpv = $conn->query($query);
      if($resultpv->num_rows > 0){
      $volt1 .= $rowv['id'] . ",";
      $query1="SELECT * FROM rel_volt WHERE id = " . $rowv['id'] . "";
      $result1 = $conn->query($query1);
      if($result1->num_rows > 0){
        $row = $result1->fetch_assoc();
        $query="SELECT * FROM rel_volt WHERE id = " . $rowv['id'] . " AND ids_inst LIKE '%" . $_SESSION['id'] . "%'";
        $result = $conn->query($query);
        if ($result->num_rows == 0) {
          $ids = $row['ids_inst'] . $_SESSION['id'] . ",";
          $query = "UPDATE rel_volt SET ids_inst = '" . $ids . "' WHERE id = '" . $rowv['id'] . "'";
          $res = mysqli_query($conn, $query); 
        }
      }else{
        $query = "insert into rel_volt values (" . $rowv['id'] . ",'" . $_SESSION['id'] . "')";
        $res = mysqli_query($conn, $query); 
      }
    }
      
    }
  }
  $query1="SELECT * FROM rel_inst WHERE id = " . $_SESSION['id'] . "";
  $result1 = $conn->query($query1);
  if($result1->num_rows > 0){
    $query = "UPDATE rel_inst SET ids_volt = '" . $volt1 . "' WHERE id = '" . $_SESSION['id'] . "'";
    $res = mysqli_query($conn, $query); 
  }else{
    $query = "insert into rel_inst values (" . $_SESSION['id'] . ",'" . $volt1 . "')";
    $res = mysqli_query($conn, $query); 
  }
  
}  
////////////////////////////////////////////////////////////////////////////////



}
header("Location: ../entrada.php");
mysqli_close($conn);
?>