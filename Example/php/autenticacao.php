
<?php
include "abreconexao.php";   

//--------------------------------------------------//

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//--------------------------------------------------//~
$bool_val_carta ;
$bool_val_email ;

echo $_POST["account"];

if ($_POST["account"] == "voluntarios"){
    $query_carta = "SELECT * FROM voluntario WHERE voluntario.ncarta = '" . $_POST["ncarta"] . "'";
    $query_email = "SELECT * FROM voluntario WHERE voluntario.email = '" . $_POST["email"] . "'";

    $result_carta=mysqli_query($conn, $query_carta);
    $existe_carta = $result_carta->num_rows;

    $result_email=mysqli_query($conn, $query_email);
    $existe_email = $result_email->num_rows;

    $bool_val_carta = number_format($existe_carta) == 0;

    $bool_val_email = number_format($existe_email) == 0;
}
elseif ($_POST["account"] == "instituicoes"){
    $query_email = "SELECT * FROM instituicao WHERE instituicao.email = '" . $_POST["email"] . "'";

    $result_email=mysqli_query($conn, $query_email);
    $existe_email = $result_email->num_rows;

    $bool_val_email = (number_format($existe_email) == 0) ? 'Yes' : 'No'; 

    if ($bool_val_email == 'Yes'){
        include "registo.php";
    }
    else{
        echo '<script src="../js/alert.js"></script><script type="text/javascript">','alert1("Já exite um voluntario com a carta escolhida.\n Por favor escolha outra!");','</script>';
    }
}

echo $bool_val_email;

if($bool_val_carta and $bool_val_email){
    include "registo.php";
}elseif($bool_val_carta){
    echo '<script src="../js/alert.js"></script><script type="text/javascript">','alert1("Já exite um utilizador com o email escolhido.\n Por favor escolha outro!");','</script>';
}elseif($bool_val_email){
    echo '<script src="../js/alert.js"></script><script type="text/javascript">','alert1("Já exite um voluntario com a carta escolhida.\n Por favor escolha outra!");','</script>';
}else{
    echo '<script src="../js/alert.js"></script><script type="text/javascript">','alert1("Já exite um utilizador com a carta e email escolhido.\n Por favor escolha outros!");','</script>';
}
?>
