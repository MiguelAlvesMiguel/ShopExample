<html>
<head>
<title>REFOOD</title>
    <link rel="icon" type="image/jpg" href="images/logo.png"/>
    <style type="text/css">
        #table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #table td, #th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #table tr:nth-child(even){background-color: #d0d1d1;}

        #table tr:hover {background-color: #717275;}

        #table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #f5b72f;
        color: white;
        }

        #caption{
          caption-side:top;
          text-align:left;
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/slick.css"/>

    <link href="css/tooplate-little-fashion.css" rel="stylesheet">
</head>
<body>

<?php
  $dbhost = "appserver-01.alunos.di.fc.ul.pt";
  $dbuser = "asw27";
  $dbpass = "dafonsohenriques";
  $dbname = "asw27";

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  // Cria a ligação à BD
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Verifica a ligação à BD
  if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
  }
?>


<section class="contact section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-12">
        <h2 class="mb-4">Tabelas <span>Voluntários: </span></h2>
      </div>
    </div>
<?php
  //tabela voluntario
  $sql = "SELECT idvoluntario, nome, email, telefone, datanasc, genero, CC, ncarta, dis, conc, freg, photo FROM voluntario";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
  echo "<table id='table'><caption id='caption' class='mb-4'>Voluntários</caption><tr><th>Id Voluntário</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Data de Nascimento</th><th>Género</th><th>CC</th><th>Carta de Condução</th><th>Distrito</th><th>Concelho</th><th>Freguesia</th><th>Foto</th></tr>";
  echo "<p></p>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["idvoluntario"]."</td>";
    echo "<td>" . $row["nome"]."</td>";
    echo "<td>" . $row["email"]."</td>"; 
    echo "<td>" . $row["telefone"]."</td>";
    echo "<td>" . $row["datanasc"]."</td>";
    echo "<td>" . $row["genero"]."</td>";
    echo "<td>" . $row["CC"]."</td>";
    echo "<td>" . $row["ncarta"]."</td>";
    echo "<td>" . $row["dis"]."</td>";
    echo "<td>" . $row["conc"]."</td>";
    echo "<td>" . $row["freg"]."</td>";
    echo "<td>" . $row["photo"]."</td></tr>";   
  }
  } else {
  echo "Sem Voluntários";
  }

  //tabela disponibilidades voluntario
  $sql = "SELECT id, dia, hora, area FROM disp_volt";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
  echo "<table id='table'><caption id='caption' class='mb-4'>Disponibilidades Voluntário</caption><tr><th>Id Voluntário</th><th>Dia</th><th>Hora</th><th>Area</th></tr>";
  echo "<p></p>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]."</td>";
    echo "<td>" . $row["dia"]."</td>";
    echo "<td>" . $row["hora"]."</td>"; 
    echo "<td>" . $row["area"]."</td></tr>";   
  }
  } else {
  echo "Sem Disponibilidades de Voluntários";
  }

  //tabela preferencias voluntario
  $sql = "SELECT id, tipoInst, tipoDoa FROM pref_volt";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
  echo "<table id='table'><caption id='caption' class='mb-4'>Preferências Instituições</caption><tr><th>Id Instituição</th><th>Tipo de Instituição</th><th>Tipo da Doação</th></tr>";
  echo "<p></p>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]."</td>";
    echo "<td>" . $row["tipoInst"]."</td>";
    echo "<td>" . $row["tipoDoa"]."</td></tr>";   
  }
  } else {
  echo "Sem Preferências de Voluntários";
  }

  //tabela relacoes voluntario-instituicao
  $sql = "SELECT id, ids_inst FROM rel_volt";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
  echo "<table id='table'><caption id='caption' class='mb-4'>Relações Voluntário - Instituição</caption><tr><th>Id Voluntário</th><th>Id das Instituições</th></tr>";
  echo "<p></p>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]."</td>";
    echo "<td>" . $row["ids_inst"]."</td></tr>";   
  }
  } else {
  echo "Sem Relações Voluntário - Instituição";
  }

  mysqli_close($conn);
?>

  </div>
</section>
</body>
</html>

