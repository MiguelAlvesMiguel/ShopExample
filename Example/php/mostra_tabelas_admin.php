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

        #titulo{
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #f5b72f;
        color: white;
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
<section class="contact section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <h2 class="mb-4">Tabela de <span>Voluntários: </span></h2>
            </div>
        </div>
        <?php
        echo "<h2 class='mb-4'>Tabela de <span>Voluntários: </span></h2>"
        ?>
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
            //tabela voluntarios
    $sql = "SELECT idvoluntario, nome, email, telefone, datanasc, genero, CC, ncarta, dis, conc, freg, photo FROM voluntario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo "<table id='table'><tr><th>Id Voluntario</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Data de Nascimento</th><th>Género</th><th>Cartão de Cidadão</th><th>Nº Carta de Condução</th><th>Distrito</th><th>Concelho</th><th>Freguesia</th><th>Foto de Perfil</th></tr>";
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
?>
    </div>
</section>
<p></p>


<section class="contact section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <h2 class="mb-4">Tabela de <span>Instituições: </span></h2>
            </div>
        </div>
        <?php
        echo "<h2 class='mb-4'>Tabela de <span>Instituições: </span></h2>"
        ?>
        <?php
    //tabela instituição
    $sql = "SELECT id, nome, email, telefone, morada, conc, freg, descricao FROM instituicao";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    echo "<table id='table'><tr id='titulo'>Tabela Instituições</tr><tr><th>Id Instituição</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Morada</th><th>Concelho</th><th>Freguesia</th><th>Descrição</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]."</td>";
        echo "<td>" . $row["nome"]."</td>";
        echo "<td>" . $row["email"]."</td>"; 
        echo "<td>" . $row["telefone"]."</td>";
        echo "<td>" . $row["morada"]."</td>";
        echo "<td>" . $row["conc"]."</td>";
        echo "<td>" . $row["freg"]."</td>";
        echo "<td>" . $row["descricao"]."</td></tr>";   
    }
    } else {
    echo "Sem Instituições Parceiras";
    }

    mysqli_close($conn);

?>
    </div>
</section>

</body>
</html>
