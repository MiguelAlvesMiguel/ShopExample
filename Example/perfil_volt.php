<!doctype html>
<html lang="en">
    <head>
        <title>REFOOD</title>
        <link rel="icon" type="image/jpg" href="images/logo.png"/>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
        
    </head>
    
    <body>

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
                                <a class="nav-link" href="products.php">Objetivo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Sobre nós</a>
                            </li>
                            <?php
                                include "php/abreconexao.php";  
                                session_start();
//                                echo isset($_SESSION['utilizador']);
                                if (isset ($_SESSION['utilizador']) > 0) {
                                    if($_SESSION['utilizador'] == 'voluntario'){
                                        echo "<li class='nav-item'>
                                        <a class='nav-link' href='disponibilidade.php'>Disponibilidade</a>
                                        </li>";
                                        echo "<li class='nav-item'>
                                        <a class='nav-link' href='instituicao.php'>Instituições</a>
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
            <?php
        include "php/abreconexao.php";  
        //echo 'ola';
        $sql = "SELECT * FROM voluntario WHERE idvoluntario = " . $_SESSION['id'] . "";
        $resultv = $conn->query($sql);
        if ($resultv->num_rows > 0) {
            $rowv = $resultv->fetch_assoc();
        }

        $sql = "SELECT * FROM pref_volt WHERE id = " . $_SESSION['id'] . "";
        $resultp = $conn->query($sql);
        if ($resultp->num_rows > 0) {
            $rowp = $resultp->fetch_assoc();
            $boolp_existe = TRUE;
        }else{
            $boolp_existe = FALSE;
        }

        $sql = "SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . "";
        $resultd = $conn->query($sql);
        if ($resultd->num_rows > 0) {
            $rowd = $resultd->fetch_assoc();
            $boold_existe = TRUE;
        }else{
            $boold_existe = FALSE;
        }

            
    ?>
            <section class="contact section-padding">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-6 col-12">
                            <h2 class="mb-4">O teu <span>Perfil</span></h2>
                           
                            <div id="pai">

                                <div id="form1">
                                <div class="form-floating">
                                    <h6 class="mb-3">As tuas informações:</h6>
                                </div>

                                <div class="form-floating my-4">
                                    <p class="text-muted"><b>Nome</b>: <?php echo $rowv['nome'];?></p>
                                </div>
                                <div class="form-floating my-4">
                                    <p class="text-muted"><b>Email:</b> <?php echo $rowv['email'];?></p>
                                </div>
                                <div class="form-floating my-4">
                                    <p class="text-muted"><b>Telefone:</b> <?php echo $rowv['telefone'];?></p>
                                </div>
                                <div class="form-floating my-4">
                                    <p class="text-muted"><b>Data de Nascimento:</b> <?php echo $rowv['datanasc'];?></p>
                                </div>
                                <div class="form-floating my-4">
                                    <p class="text-muted"><b>Genero:</b> <?php echo $rowv['genero'];?></p>
                                </div>
                                <div class="form-floating my-4">
                                    <p class="text-muted"><b>Nº CC:</b> <?php echo $rowv['CC'];?></p>
                                </div>
                                <div class="form-floating my-4">
                                    <p class="text-muted"><b>Carta de condução:</b> <?php echo $rowv['ncarta'];?></p>
                                </div>
                                <button class="btn custom-btn form-control mt-4 mb-3" id="button">
                                    Editar Perfil
                                </button>
                                </div>

                                
                                <div id=form2>
                           
                                    <!--  FORM 2 FORM 2 FORM 2 FORM 2 FORM 2 -->

                                    <form action="php/update_p.php" method="post">


                                            <div class="form-floating">
                                                <input type="text" name="telefone" id="telefone" placeholder="Telefone"class="form-control" min="10000000" max="99999999" value = 
                                                <?php 
                                                echo $rowv['telefone'];
                                                ?>>
                                                
                                                <label>Telefone *</label>
                                                <br/>
                                            </div>

                                            <div class="form-floating">
                                                <input type="text" name="CC" id="CC" placeholder="NºCC"class="form-control" min="10000000" max="99999999" value = 
                                                <?php 
                                                echo $rowv['CC'];
                                                ?>>
                                                
                                                <label>CC *</label>
                                                <br/>
                                            </div>
                                            <div class="form-floating">
                                                <input type="text" name="ncarta" id="ncarta" placeholder="NºCarta" class="form-control" value = 
                                                <?php 
                                                echo $rowv['ncarta'];
                                                ?>>
                                                
                                                <label>NºCarta de condução *</label>
                                                <br/>
                                                <button onclick="myFunction()" class="btn custom-btn form-control mt-4 mb-3">
                                                    Submeter
                                                </button>
                                                <!-- <button onclick="myFunction()">Click me</button> -->
                                            </div>
                                    </form> 
                                </div>
                                </div>
                              
                               
                        
                        </div>

                        <div class="col-lg-6 col-12 mt-5 ms-auto">
                            <div class="row">
                                <div class="contact-info">
                                	<h6 class="mb-3"><a href="preferencias.php">Atualize aqui as suas preferências</a></h6>
                                </div>
                                <!-- <button href="preferencias.php"class="btn custom-btn form-control mt-4 mb-3">
                                    Preferencias de Doação
                                </button> -->
                                <div class="col-6 border-end contact-info">
                                    <h6 class="mb-3">Instituição:</h6>
                                    <p><?php if($boolp_existe){echo $rowp['tipoInst'];}?></p>
                                </div>

                                <div class="col-6 contact-info">
                                	<h6 class="mb-3">Doações:</h6>
                                    <p><?php if($boolp_existe){echo $rowp['tipoDoa'];}?></p>
                                </div>

                                
                                <div class="col-6 border-end contact-info">
                                    <h6 class="mb-3">Disponibilidades:</h6>
                                    <p>Dias da semana: <?php if($boold_existe){echo $rowd['dia'];}?></p>
                                    <p>Periodo: <?php if($boold_existe){echo $rowd['hora'];}?></p>
                                </div>

                                <div class="col-6 contact-info">
                                	<h6 class="mb-3">Area da disponibilidade:</h6>
                                    <p> <?php if($boold_existe){echo $rowd['area'];}?></p>
                                </div>
                            </div>
                        </div>
                </div>
            </section>
        </main>
<!-- 
        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-10 me-auto mb-4">
                        <h4 class="text-white mb-3"><a href="index.html">Little</a> Fashion</h4>
                        <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2022 <strong>Little Fashion</strong></p>
                        <br>
                        <p class="copyright-text">Designed by <a href="https://www.tooplate.com/" target="_blank">Tooplate</a></p>
                    </div>

                    <div class="col-lg-5 col-8">
                        <h5 class="text-white mb-3">Sitemap</h5>

                        <ul class="footer-menu d-flex flex-wrap">
                            <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">Story</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Products</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy policy</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">FAQs</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>

                        <ul class="social-icon">

                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>

                            <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>

                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                            <li><a href="#" class="social-icon-link bi-skype"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer> -->




        <style>
            .text-muted{

            }
        </style>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/update_perfil.js"></script>
    </body>
</html>