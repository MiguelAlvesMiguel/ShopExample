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

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
        
<!--

Tooplate 2127 Little Fashion

https://www.tooplate.com/view/2127-little-fashion

-->
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
                                <a class="nav-link active" href="about.php">Sobre nós</a>
                            </li>
                           <?php
                                include "php/abreconexao.php";  
                                session_start();
                                // echo isset($_SESSION['utilizador']);
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

            <header class="site-header section-padding-img site-header-image">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 header-info">
                            <h1>
                                <span class="d-block text-primary">Quem </span>
                                <span class="d-block text-dark">Somos</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <img src="images/creating-a-programming-to-do-list.jpg" class="header-image img-fluid" alt="">
            </header>

            <section class="team section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <h2 class="mb-5">Conhece a nossa <span>equipa</span></h2>
                        </div>

                        <div class="col-lg-4 mb-4 col-12">
                            <div class="team-thumb d-flex align-items-center">
                                <img src="images/afonso.jpg" class="img-fluid custom-circle-image team-image me-4" alt="">

                                <div class="team-info">
                                    <h5 class="mb-0">Afonso Santos</h5>
                                    <strong class="text-muted">nº56900</strong>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#don">
                                      <i class="bi-plus-circle-fill"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-lg-0 mb-4 col-12">
                            <div class="team-thumb d-flex align-items-center">
                                <img src="images/daniel.jpg" class="img-fluid custom-circle-image team-image me-4" alt="">

                                <div class="team-info">
                                    <h5 class="mb-0">Daniel Ribeiro</h5>
                                    <strong class="text-muted">nº53744</strong>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#marie">
                                      <i class="bi-plus-circle-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4 col-12">
                            <div class="team-thumb d-flex align-items-center">
                                <img src="images/f1.jpg" class="img-fluid custom-circle-image team-image me-4" alt="">

                                <div class="team-info">
                                    <h5 class="mb-0">Daniela Farinha</h5>
                                    <strong class="text-muted">nº54558</strong>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#kelly">
                                      <i class="bi-plus-circle-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-lg-0 mb-4 col-12">
                            <div class="team-thumb d-flex align-items-center">
                                <img src="images/henrique.jpg" class="img-fluid custom-circle-image team-image me-4" alt="">

                                <div class="team-info">
                                    <h5 class="mb-0">Henrique Rosado</h5>
                                    <strong class="text-muted">nº54433</strong>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#henri">
                                      <i class="bi-plus-circle-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-lg-0 mb-4 col-12">
                            <div class="team-thumb d-flex align-items-center">
                                <img src="images/rafa.png" class="img-fluid custom-circle-image team-image me-4" alt="">

                                <div class="team-info">
                                    <h5 class="mb-0">Rafael Marques</h5>
                                    <strong class="text-muted">nº51167</strong>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn custom-modal-btn" data-bs-toggle="modal" data-bs-target="#rafa">
                                      <i class="bi-plus-circle-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="testimonial section-padding">
                <div class="container">
                   

                       
                  
                    
                </div>
            </section>

        </main>

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
        <div class="modal fade" id="don" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column">
                        <h3 class="modal-title" id="exampleModalLabel">Afonso Silva Santos</h3>

                        <h6 class="text-muted">aluno nº56900</h6>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <h5 class="mb-4">Faculdade de Ciências da Universidade de Lisboa</h5>

                        <div class="row mb-4">
                            <div class="col-lg-6 col-12">
                                <p>Trabalho no ambito da disciplina Aplicações e Serviços na Web</p>
                            </div>

                            <div class="col-lg-6 col-12">
                                <p></p>
                            </div>
                        </div>

                        <ul class="social-icon">
                            <li class="me-3"><strong>56900@alunos.fc.ul.pt</strong></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- TEAM MEMBER MODAL -->
        <div class="modal fade" id="kelly" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column">
                        <h3 class="modal-title" id="exampleModalLabel">Daniela Mouquinho</h3>

                        <h6 class="text-muted">aluno nº54558</h6>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <h5 class="mb-4">Faculdade de Ciências da Universidade de Lisboa</h5>

                        <div class="row mb-4">
                            <div class="col-lg-6 col-12">
                                <p>Trabalho no ambito da disciplina Aplicações e Serviços na Web</p>
                            </div>

                            <div class="col-lg-6 col-12">
                                <p></p>
                            </div>
                        </div>

                        <ul class="social-icon">
                            <li class="me-3"><strong>54558@alunos.fc.ul.pt</strong></li>

                        </ul>
                    </div>

            </div>
            </div>
        </div>

        <!-- TEAM MEMBER MODAL -->
        <div class="modal fade" id="marie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column">
                        <h3 class="modal-title" id="exampleModalLabel">Daniel Ribeiro</h3>

                        <h6 class="text-muted">aluno nº53744</h6>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <h5 class="mb-4">Faculdade de Ciências da Universidade de Lisboa</h5>

                        <div class="row mb-4">
                            <div class="col-lg-6 col-12">
                                <p>Trabalho no ambito da disciplina Aplicações e Serviços na Web</p>
                            </div>

                            <div class="col-lg-6 col-12">
                                <p></p>
                            </div>
                        </div>

                        <ul class="social-icon">
                            <li class="me-3"><strong>53744@alunos.fc.ul.pt</strong></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- TEAM MEMBER MODAL -->
        <div class="modal fade" id="henri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column">
                        <h3 class="modal-title" id="exampleModalLabel">Henrique Rosado</h3>

                        <h6 class="text-muted">aluno nº54433</h6>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <h5 class="mb-4">Faculdade de Ciências da Universidade de Lisboa</h5>

                        <div class="row mb-4">
                            <div class="col-lg-6 col-12">
                                <p>Trabalho no ambito da disciplina Aplicações e Serviços na Web</p>
                            </div>

                            <div class="col-lg-6 col-12">
                                <p></p>
                            </div>
                        </div>

                        <ul class="social-icon">
                            <li class="me-3"><strong>54433@alunos.fc.ul.pt</strong></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- TEAM MEMBER MODAL -->
        <div class="modal fade" id="rafa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header flex-column">
                        <h3 class="modal-title" id="exampleModalLabel">Rafael Marques</h3>

                        <h6 class="text-muted">aluno nº51167</h6>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <h5 class="mb-4">Faculdade de Ciências da Universidade de Lisboa</h5>

                        <div class="row mb-4">
                            <div class="col-lg-6 col-12">
                                <p>Trabalho no ambito da disciplina Aplicações e Serviços na Web</p>
                            </div>

                            <div class="col-lg-6 col-12">
                                <p></p>
                            </div>
                        </div>

                        <ul class="social-icon">
                            <li class="me-3"><strong>51167@alunos.fc.ul.pt</strong></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
