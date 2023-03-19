<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>REFOOD</title>
        <link rel="icon" type="image/jpg" href="images/logo.png"/>


        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tabelas_template.css" rel="stylesheet">

        <link href="css/radioButtom.css" rel="stylesheet">
      
        <link href="css/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
        <style>
/*
.normal{
    margin: 20px auto;
    width: 300px;
}
*/
.holder1, .holder2 , .holder3{
    margin:  auto;
    width: 80%;
}
/*
.holder1 div , .holder2 div, .holder3 div , .normal div{
    padding: 10px;
    background-color: #eee;
    margin-bottom: 5px;
    width: 300px;
}
*/
.holder1 div input[type="checkbox"] , .holder2 div input[type="checkbox"],.holder3 div input[type="checkbox"] {
    appearance: none;
}
.holder1 div label,.holder2 div label , .holder3 div label{
    position: relative;
    padding-left: 10px;
}
.holder1 div label::before , .holder2 div label::before , .holder3 div label::before{
    content: "";
    background-color: #ddd;
    position: relative;
    width: 20px;
    height: 20px;
    display: inline-block;
    border: 1px solid #ccc;
    top: 6px;
    right: 9px;
}
.holder3 div label::before {
    border-radius: 50%;
}
.holder1 div input[type="checkbox"]:checked + label::after {
    font-family: FontAwesome;
    content: "\f00c";
    position: absolute;
    color: forestgreen;
    font-size: 30px;
    top: -7px;
    left: 5px;
}
.holder2 div label::after{
    content: "";
    width: 20px;
    height: 20px;
    position: absolute;
    top: -1px;
    left: 2px;
    background-color: green;
    transform: scale(0);
    transition: transform 0.3s ease-in-out;
}
.holder2 div input[type="checkbox"]:checked + label::after {
    transform: scale(1) ;
}
.holder3 div input[type="checkbox"]:checked + label::after {
    font-family: "FontAwesome";
    content: "\f170";
    position: absolute;
    color: green;
    font-size: 24px;
    top: -3px;
    left: 1px;
    background-color: hotpink;
    border-radius: 50%;
}
#pai{
    display: flex;
    flex-wrap: wrap;
}
.voluntario{
    flex: 1 1 300px;
    padding: 10px;
}
/*
.main{
    column-count: 3;
    column-rule: solid 1px black;
}
*/
        </style>
<!--

Tooplate 2127 Little Fashion

https://www.tooplate.com/view/2127-little-fashion

-->
    </head>
    
    <body>
    
    <?php
        include "php/abreconexao.php";  
        session_start();
        $sql = "SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . "";
        $result = $conn->query($sql);
        $rowd = $result->fetch_assoc();
        $dias = explode(",",$rowd['dia']);
        $horas = explode(",",$rowd['hora']);
        array_pop($dias);
        array_pop($horas);
        $sql = "SELECT * FROM rel_inst WHERE id = " . $_SESSION['id'] . "";
        $result = $conn->query($sql);
        echo "<script src='js/constroi_volt.js'></script>";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ids_volt = explode(",",$row['ids_volt']);
            array_pop($ids_volt);
            foreach($ids_volt as $id){
                foreach($dias as $dia){
                    foreach($horas as $hora){
                        $query="SELECT * FROM disp_volt WHERE id = " . $id . " AND dia LIKE '%" . $dia . "%' AND hora LIKE '%" . $hora . "%'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            $query1="SELECT * FROM voluntario WHERE idvoluntario = " . $id . "";
                            $result1 = $conn->query($query1);
                            $rowv = $result1->fetch_assoc();
                            echo "<script type='text/javascript'> insereVolt([" . $rowv["idvoluntario"],",'" . $rowv["nome"] . "'," . $rowv["telefone"] . ",'" . $rowv["email"] . "','" . $rowv["genero"] . "'," . $rowv["CC"] . ",'" . $rowv["ncarta"] . "','" . $rowv["dis"] . "','"  . $rowv["conc"] . "','" . $rowv["freg"] . "','"  . $rowv["photo"] . "','" . $rowd["area"] . "','" . $dia . "','" . $hora . "']); </script>";
                        }
                    }
                }
            }
        }
        // $dias = explode(",",$row['dia']);
        // $horas = explode(",",$row['hora']);
        // array_pop($dias);
        // array_pop($horas);
        // echo $result->num_rows . "<br>";
        // if ($result->num_rows > 0) {
        //     foreach($dias as $dia){
        //         foreach($horas as $hora){
                    
        //             $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%" . $dia . "%' AND hora LIKE '%" . $hora . "%'";
        //             $result = $conn->query($query);
        //             if ($result->num_rows > 0) {
        //                 echo "teste<br>";
        //                 // echo "<script type='text/javascript'> insereVolt([" . $rowv["idvoluntario"],",'" . $rowv["nome"] . "'," . $rowv["telefone"] . ",'" . $rowv["email"] . "','" . $rowv["genero"] . "'," . $rowv["CC"] . ",'" . $rowv["ncarta"] . "','" . $rowv["dis"] . "','"  . $rowv["conc"] . "','" . $rowv["freg"] . "','"  . $rowv["photo"] . "','" . $rowd["area"] . "','" . $dia . "','" . $hora . "']); </script>";
        //             }
        //         }
        //     }
        //     // echo "<script type='text/javascript'> insereVolt([" . $rowv["idvoluntario"],",'" . $rowv["nome"] . "'," . $rowv["telefone"] . ",'" . $rowv["email"] . "','" . $rowv["genero"] . "'," . $rowv["CC"] . ",'" . $rowv["ncarta"] . "','" . $rowv["dis"] . "','"  . $rowv["conc"] . "','" . $rowv["freg"] . "','"  . $rowv["photo"] . "','" . $rowv["area"] . "','" . $rowv["dia"] . "','" . $rowv["periodo"] . "']); </script>";
        //     echo 'ola';
        // }
    
             
    ?>

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>

        <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <a class="navbar-brand" href="entrada.php">
                        <strong><span>RE</span> FOOD</strong>
                    </a>

                    <div class="d-lg-none">
                        <a href="sign-in.php" class="bi-person custom-icon me-3"></a>

                       
                    </div>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="entrada.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="products.php">Objetivo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Sobre nós</a>
                            </li>
                            <?php
                                include "php/abreconexao.php";  
//                                echo isset($_SESSION['utilizador']);
                                if (isset ($_SESSION['utilizador']) > 0) {
                                    if($_SESSION['utilizador'] == 'voluntario'){
                                        echo "<li class='nav-item'>
                                        <a class='nav-link' href='disponibilidade.php'>Disponibilidade</a>
                                        </li>";
                                        echo "<li class='nav-item'>
                                        <a class='nav-link active' href='instituicao.php'>Instituições</a>
                                        </li>";
                                    }else{
                                        echo "<li class='nav-item'>
                                        <a class='nav-link' href='disponibilidade.php'>Disponibilidade</a>
                                        </li>";
                                        echo "<li class='nav-item'>
                                        <a class='nav-link active' href='voluntario.php'>Voluntários</a>
                                        </li>";
                                    }
                                }
                                ?>
                            

                        </ul> 
                        <?php
                        if (isset ($_SESSION['utilizador']) > 0) {
                            if($_SESSION['utilizador'] == 'voluntario'){
                                echo '<div class="d-none d-lg-block">
                                            <a href="perfil_volt.php" class="bi-person custom-icon me-3"></a> 
                                        </div>
                                        <div class="d-none d-lg-block">
                                            <a href="php/logout.php"  class="bi bi-door-closed" id="log_out" style="font-size: 145%;"> </a>
                                        </div>';
                            }else{
                                echo '<div class="d-none d-lg-block">
                                            <a href="perfil_inst.php" class="bi-person custom-icon me-3"></a> 
                                        </div>
                                        <div class="d-none d-lg-block">
                                            <a href="php/logout.php"  class="bi bi-door-closed" id="log_out" style="font-size: 145%;"> </a>
                                        </div>';
                        }
                        }else{
                            echo '<div class="d-none d-lg-block">
                            <a href="sign-in.html" class="bi-person custom-icon me-3"></a> 
                        </div>';
                        }
                        ?>
                    </div>
                </div>
            </nav>

</div>

            <section class="team section-padding">
                <div class="container">
                <div class="row" id="filtro">

                    <div class="col-12">
                        <h2 class="mb-5">Conheça as nossos <span>instituições parceiras</span></h2>
                    </div>

                    <div style="display: grid;grid-template-columns: 25% 25% 25% 25%;">
                        <div id='disponibilidade'>

                            <input type="button" style="width: 100%;font-size: 100%;" onclick="inserirRetirarDisponibilidade()" value='Disponibilidade'>   
                            <div id ='disponibilidade_op'>
                                <form id='radio'>
                                    <input id="one" type="radio" name="radio_circle" value="option_1" onclick="registoDisponibilidade('segunda')"
                                    <?php
                                        $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%segunda%'";
                                        $resultv = $conn->query($query);
                                        if ($resultv->num_rows == 0) {
                                            echo 'disabled ';
                                        }
                                    ?>checked>
                                    <label for="one" <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?>>
                                    <span></span>
                                Segunda-Feira
                                    </label>
                                    <input id="two" type="radio" name="radio_circle" value="option_2" onclick="registoDisponibilidade('terca')"
                                    <?php
                                        $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%terca%'";
                                        $resultv = $conn->query($query);
                                        if ($resultv->num_rows == 0) {
                                            echo 'disabled ';
                                        }
                                    ?>>
                                    <label for="two" <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?> <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?>>
                                    <span></span>
                                Terça-Feira
                                    </label>
                                    <input id="three" type="radio" name="radio_circle" value="option_3" onclick="registoDisponibilidade('quarta')"
                                    <?php
                                        $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%quarta%'";
                                        $resultv = $conn->query($query);
                                        if ($resultv->num_rows == 0) {
                                            echo 'disabled ';
                                        }
                                    ?>>
                                    <label for="three" <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?>>
                                    <span></span>
                                Quarta-Feira
                                    </label>
                                    <input id="four" type="radio" name="radio_circle" value="option_4" onclick="registoDisponibilidade('quinta')"
                                    <?php
                                        $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%quinta%'";
                                        $resultv = $conn->query($query);
                                        if ($resultv->num_rows == 0) {
                                            echo 'disabled ';
                                        }
                                    ?>>
                                    <label for="four" <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?>>
                                    <span></span>
                                Quinta-Feira
                                    </label>
                                    <input id="five" type="radio" name="radio_circle" value="option_5" onclick="registoDisponibilidade('sexta')"
                                    <?php
                                        $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%sexta%'";
                                        $resultv = $conn->query($query);
                                        if ($resultv->num_rows == 0) {
                                            echo 'disabled ';
                                        }
                                    ?>>
                                    <label for="five" <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?>>
                                    <span></span>
                                Sexta-Feira
                                    </label>
                                    
                                    <div class="circle_animation">
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                </div>
                                </form>
                            </div>
                            <!-- <div class="holder1" id='disponibilidade_op'>
                                <div>
                                    <input type="checkbox" name="" onclick="registoDisponibilidade('segunda')" id="check11">
                                    <label for="check11">Segunda-Feira</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="" onclick="registoDisponibilidade('terca')" id="check12">
                                    <label for="check12">Terca-Feira</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="" onclick="registoDisponibilidade('quarta')" id="check13">
                                    <label for="check13">Quarta-Feira</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="" onclick="registoDisponibilidade('quinta')" id="check14">
                                    <label for="check14">Quinta-Feira</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="" onclick="registoDisponibilidade('sexta')" id="check15">
                                    <label for="check15">Sexta-Feira</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="" onclick="registoDisponibilidade('sabado')" id="check16">
                                    <label for="check16">Sabado</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="" onclick="registoDisponibilidade('domingo')" id="check17">
                                    <label for="check17">Domingo</label>
                                </div>
                            </div> -->
                        </div>
                        <div id='periodo'>
                        <input type="button" style="width: 100%;font-size: 100%;" onclick="inserirRetirarPeriodo()" value='Periodo'> 

                        
                        <div id='periodo_op'>
                        <form id='radio'>
                                    <input id="onee" type="radio" name="radio_circle" value="option_1" onclick = "registoPeriodo('manha')" 
                                    <?php
                                        $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%manha%'";
                                        $resultv = $conn->query($query);
                                        if ($resultv->num_rows == 0) {
                                            echo 'disabled ';
                                        }
                                    ?>checked>
                                    <label for="onee" <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?>>
                                    <span></span>
                                Manha
                                    </label>
                                    <input id="twoo" type="radio" name="radio_circle" value="option_2" onclick = "registoPeriodo('tarde')"
                                    <?php
                                        $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%tarde%'";
                                        $resultv = $conn->query($query);
                                        if ($resultv->num_rows == 0) {
                                            echo 'disabled ';
                                        }
                                    ?>>
                                    
                                    <label for="twoo" <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?>>
                                    <span></span>
                                Tarde
                                    </label>
                                    <input id="threee" type="radio" name="radio_circle" value="option_3" onclick = "registoPeriodo('noite')"
                                    <?php
                                        $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%noite%'";
                                        $resultv = $conn->query($query);
                                        if ($resultv->num_rows == 0) {
                                            echo 'disabled ';
                                        }
                                    ?>>
                                    <label for="threee" <?php if ($resultv->num_rows == 0) {echo 'style="color:grey;"';}?>>
                                    <span></span>
                                Noite
                                    </label>

                                    <div class="circle_animation">
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                    <div class="circle_animation__segment"></div>
                                </div>
                                </form>
                        </div>
                        </div>
                    <div class="center query"><input id="txt_input1"  style="width: 100%;font-size: 100%;"placeholder="Nome"></div>
                    <div class="center query"><input id="txt_input"  style="width: 100%;font-size: 100%;"placeholder="Area"></div>
                    </div>
                    </div>
                    
                        <div id='pai'>
                        </div>
                    </div>
                </div>
            </section>

            <section class="testimonial section-padding">
                <div class="container">
                   

                       
                  
                    
                </div>
            </section>

       

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    

                   

                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>

                        <ul class="social-icon">

                            <li><a href="https://www.youtube.com/watch?v=obsSP2AdE98&t=23s&ab_channel=E2" class="social-icon-link bi-youtube"></a></li>

        

                            <li><a href="https://www.instagram.com/refood_official/" class="social-icon-link bi-instagram"></a></li>

                            <li><a href="https://www.facebook.com/refoodportugal" class="social-icon-link bi-facebook"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>

     

        <!-- TEAM MEMBER MODAL -->
        <div id="pai_info">
        </div>
        

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>
        <!-- <script src="js/constroi_volt.js"></script> -->
        <script type='text/javascript'>
        inicio();

        cria_voluntario();
        </script>
        
        

    </body>
</html>

 

