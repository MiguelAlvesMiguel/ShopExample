<?php
    include 'abreconexao.php';
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryV = "SELECT * FROM voluntario WHERE email = '" . $email . "'";
    $queryI = "SELECT * FROM instituicao WHERE email = '" . $email . "'"; 
 
    
    $resultV = mysqli_query($conn, $queryV);
    $resultI = mysqli_query($conn, $queryI);

 

    $row_voluntario = 0;
    $row_instituicao = 0;
    if (mysqli_num_rows($resultV) == 1){
        $row_voluntario = 1;
    }else if(mysqli_num_rows($resultI) == 1){
        $row_instituicao = 2;
    }
    
    if($row_voluntario == 1){
        while ($row1 = $resultV->fetch_assoc()) {
            // echo password_verify($password, $row1['password']);
            if (password_verify($password, $row1['password']) == 1){
                $_SESSION['utilizador'] = "voluntario";
                $_SESSION['id'] =$row1['idvoluntario'];
                echo "entrou-correto";
                header("Location: ../entrada.php");
            }
            else{
                echo '<script src="../js/alert.js"></script><script type="text/javascript">','alert1("Mail ou1 Password Inválido", "../sign-in.html");','</script>';
               

            }
        }
    } else if ($row_instituicao == 2){
        // header("Location: sign-in.html?"); //dúvida como tipo fazer com que entrem, eles usaram o signup = sucess mas nós não programamos essa assim
        while ($row2 = $resultI->fetch_assoc()) {
            echo password_verify($password, $row2['password']);
            if (password_verify($password, $row2['password']) == 1){
                $_SESSION['utilizador'] = "instituicao";
                $_SESSION['id'] = $row2['id'];
                echo "entrou-correto";
                echo session_name();
                header("Location: ../entrada.php");
            }
            else{
                echo '<script src="../js/alert.js"></script><script type="text/javascript">','alert1("Mail ou1 Password Inválido", "../sign-in.html");','</script>';
                

            }
        }
    }else{
        echo '<script src="../js/alert.js"></script><script type="text/javascript">','alert1("Mail ou Password Inválido", "../sign-in.html");','</script>';
    
    }


?>

