<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>REFOOD</title>

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




      	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="css/tabelaInst.css">

        <link rel="stylesheet" href="css/butaoIncrever.css">
        <link rel="stylesheet" href="css/butaoDesinscrever.css">





        <!-- <style>
        
 


/*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */

/*# sourceMappingURL=table.css.map*/


        </style> -->

    </head>
    
    <body>

    <?php
        include "php/abreconexao.php";  
        session_start();
        $sql = "SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . "";
        $result = $conn->query($sql);
        $rowd = $result->fetch_assoc();
        $dias = explode(",",$rowd['dia']);
        $horas = explode(",",$rowd['hora']);
        array_pop($dias);
        array_pop($horas);
        $sql = "SELECT * FROM rel_volt WHERE id = " . $_SESSION['id'] . "";
        $result = $conn->query($sql);
        echo "<script src='js/constroi_inst.js'></script>";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ids_inst = explode(",",$row['ids_inst']);
            array_pop($ids_inst);
            foreach($ids_inst as $id){
                foreach($dias as $dia){
                    foreach($horas as $hora){
                        $query="SELECT * FROM disp_inst WHERE id = " . $id . " AND dia LIKE '%" . $dia . "%' AND hora LIKE '%" . $hora . "%'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            $query="SELECT * FROM disp_inst WHERE id = " . $id . " AND checks LIKE '%" . $dia . "%' AND checks LIKE '%" . $hora . "%' AND checks LIKE '%" . $_SESSION['id'] . "%'";
                            $result = $conn->query($query);
                            $check = 'false';
                            if ($result->num_rows > 0) {
                                $check = 'true';
                            }
                            $query1="SELECT * FROM instituicao WHERE id = " . $id . "";
                            $result1 = $conn->query($query1);
                            $row1 = $result1->fetch_assoc();
                            $query2="SELECT * FROM pref_inst WHERE id = " . $id . "";
                            $result2 = $conn->query($query2);
                            $row2 = $result2->fetch_assoc();
                            echo "<script type='text/javascript'> insereVolt_inst(['" . $row1["nome"] . "','" . $row1["email"] . "'," . $row1["telefone"] . ",'" . $row1["morada"] . "','" . $rowd["area"] . "','" . $row1["freg"] . "','" . $row1["descricao"] . "','" . $row2["tipoInst"] . "','" . $row2["tipoDoa"] . "','" . $row2["quantidade"] . "','" . $dia . "','" . $hora ."','" . $check . "','" . $row['id'] . "']); </script>";
                        }
                    }
                }
            }
        }
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
                        <a href="sign-in.html" class="bi-person custom-icon me-3"></a>

                        
                    </div>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="entrada.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Sobre nós</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="products.php">Objetivo</a>
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
                                        <a class='nav-link' href='voluntario.php'>Voluntários</a>
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
                                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%segunda%'";
                                            $resultv = $conn->query($query);
                                            if ($resultv->num_rows == 0) {
                                                echo 'disabled ';
                                            }
                                        ?>checked>
                                        <label for="one">
                                        <span></span>
                                      Segunda-Feira
                                        </label>
                                        <input id="two" type="radio" name="radio_circle" value="option_2" onclick="registoDisponibilidade('terca')"
                                        <?php
                                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%terca%'";
                                            $resultv = $conn->query($query);
                                            if ($resultv->num_rows == 0) {
                                                echo 'disabled ';
                                            }
                                        ?>>
                                        <label for="two">
                                        <span></span>
                                      Terça-Feira
                                        </label>
                                        <input id="three" type="radio" name="radio_circle" value="option_3" onclick="registoDisponibilidade('quarta')"
                                        <?php
                                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%quarta%'";
                                            $resultv = $conn->query($query);
                                            if ($resultv->num_rows == 0) {
                                                echo 'disabled ';
                                            }
                                        ?>>
                                        <label for="three">
                                        <span></span>
                                      Quarta-Feira
                                        </label>
                                        <input id="four" type="radio" name="radio_circle" value="option_4" onclick="registoDisponibilidade('quinta')"
                                        <?php
                                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%quinta%'";
                                            $resultv = $conn->query($query);
                                            if ($resultv->num_rows == 0) {
                                                echo 'disabled ';
                                            }
                                        ?>>
                                        <label for="four">
                                        <span></span>
                                      Quinta-Feira
                                        </label>
                                        <input id="five" type="radio" name="radio_circle" value="option_5" onclick="registoDisponibilidade('sexta')"
                                        <?php
                                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%sexta%'";
                                            $resultv = $conn->query($query);
                                            if ($resultv->num_rows == 0) {
                                                echo 'disabled ';
                                            }
                                        ?>>
                                        <label for="five">
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
                            </div>
                            <div id='periodo'>
                            <input type="button" style="width: 100%;font-size: 100%;" onclick="inserirRetirarPeriodo()" value='Periodo'> 
                        
                            
                            <div id='periodo_op'>
                            <form id='radio'>
                                        <input id="onee" type="radio" name="radio_circle" value="option_1" onclick = "registoPeriodo('manha')"
                                        <?php
                                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%manha%'";
                                            $resultv = $conn->query($query);
                                            if ($resultv->num_rows == 0) {
                                                echo 'disabled ';
                                            }
                                        ?>checked>
                                        <label for="onee">
                                        <span></span>
                                      Manha
                                        </label>
                                        <input id="twoo" type="radio" name="radio_circle" value="option_2"onclick = "registoPeriodo('tarde')"
                                        <?php
                                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%tarde%'";
                                            $resultv = $conn->query($query);
                                            if ($resultv->num_rows == 0) {
                                                echo 'disabled ';
                                            }
                                        ?>>
                                        <label for="twoo">
                                        <span></span>
                                      Tarde
                                        </label>
                                        <input id="threee" type="radio" name="radio_circle" value="option_3" onclick = "registoPeriodo('noite')"
                                        <?php
                                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%noite%'";
                                            $resultv = $conn->query($query);
                                            if ($resultv->num_rows == 0) {
                                                echo 'disabled ';
                                            }
                                        ?>>
                                        <label for="threee">
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
                        
                    <section class="ftco-section">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12"> 
                            <div class="table-wrap">
                              <table class="table myaccordion table-hover" id="accordion">
                                <thead>
                                  <tr>
                                    <th>Nome</th>
                                    <th>Tipo de Instituição</th>
                                    <th>Tipo de Doação</th>
                                    <th>Area</th>
                                    <th>Inscrito</th>
                                  <th>&nbsp;</th>
                                  </tr>
                                </thead>
                                <tbody id="teste">                         
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                </div>
</section>

</div>

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
        <div id="pai_descricao">
        </div>

        <script src="js/jquery.min.js"></script>
       <script src="js/bootstrap.min.js"></script>

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
        cria_inst();
        </script>
       
        
        

    </body>
</html>

 

