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

                    <a class="navbar-brand" href="entrada.html">
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
        $sql = "SELECT * FROM instituicao WHERE id = " . $_SESSION['id'] . "";
        $resulti = $conn->query($sql);
        if ($resulti->num_rows > 0) {
            $rowi = $resulti->fetch_assoc();
        }

        $sql = "SELECT * FROM pref_inst WHERE id = " . $_SESSION['id'] . "";
        $resultp = $conn->query($sql);
        if ($resultp->num_rows > 0) {
            $rowp = $resultp->fetch_assoc();
            $boolp_existe = TRUE;
        }else{
            $boolp_existe = FALSE;
        }

        $sql = "SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . "";
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
                            <h2 class="mb-4">A sua <span>Instituição</span></h2>
            
                            <div id="pai">

<div id="form1">
<div class="form-floating">
    <h6 class="mb-3">Informações:</h6>
</div>

<div class="form-floating my-4">
    <p class="text-muted">Nome: <?php echo $rowi['nome'];?></p>
</div>
<div class="form-floating my-4">
    <p class="text-muted">Email: <?php echo $rowi['email'];?></p>
</div>
<div class="form-floating my-4">
    <p class="text-muted">Telefone: <?php echo $rowi['telefone'];?></p>
</div>
<div class="form-floating my-4">
    <p class="text-muted">Morada: <?php echo $rowi['morada'];?></p>
</div>
<div class="form-floating my-4">
    <p class="text-muted">Concelho: <?php echo $rowi['conc'];?></p>
</div>
<div class="form-floating my-4">
    <p class="text-muted">Freguesia: <?php echo $rowi['freg'];?></p>
</div>
<div class="form-floating my-4">
    <p class="text-muted">Descrição: <br><?php echo $rowi['descricao'];?></p>
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
                echo $rowi['telefone'];
                ?>>
                
                <label>Telefone *</label>
                <br/>
            </div>
            
            <div class="form-floating">
                <input type="text" id="morada" class="form-control" name="morada" placeholder="Morada" value = 
                <?php 
                echo $rowi['morada'];
                ?>>
                
                <label>Morada *</label>
                <br/>
            </div>

            <div class="form-floating">
                <input type="text" id="conc" class="form-control" name="conc" placeholder="Concelho" value = 
                <?php 
                echo $rowi['conc'];
                ?>>
                 <br/>
                <label>Concelho *</label>

            </div>

            <div class="form-floating">
                <input type="text" class="form-control" name="freg" id="freg" placeholder="Freguesia" value = 
                <?php 
                echo $rowi['freg'];
                ?>>
                
                <label>Freguesia *</label>
                <br/>
            </div>
            <div class="form-floating">
                <input type="text" name="descricao" id="descricao" placeholder="Descrição" class="form-control" value = 
                <?php 
                echo $rowi['descricao'];
                ?>>
                
                <label>Descrição *</label>
                <br/>

                <button class="btn custom-btn form-control mt-4 mb-3" onclick="myFunction()">
                                    Submeter
                </button>
            </div>
            <hr>
           

    </form> 

    </div>
    </div>
</div>

                        <div class="col-lg-6 col-12 mt-5 ms-auto">
                            <div class="row">
                                <div class="col-6 border-end contact-info">
                                    <h6 class="mb-3">Instituição:</h6>
                                    <p><?php if($boolp_existe){echo $rowp['tipoInst'];}?></p>
                                </div>

                                <div class="col-6 contact-info">
                                	<h6 class="mb-3">Doações:</h6>
                                    <p><?php  if($boolp_existe){echo $rowp['tipoDoa'];}?></p>
                                </div>

                                <div class="col-6 border-end contact-info">
                                	<h6 class="mb-3">Quantidades:</h6>
                                    <p><?php  if($boolp_existe){echo $rowp['quantidade'];}?></p>
                                </div>

                                <div class="col-6 contact-info">
                                	<h6 class="mb-3"><a href="preferencias.php">Atualize aqui as suas Preferences</a></h6>
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