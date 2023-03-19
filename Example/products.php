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
                                <a class="nav-link active" href="products.php">Objetivo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Sobre nós</a>
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
            <header class="site-header section-padding d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-10 col-12">
                            <h1>
                                <span class="d-block text-primary">RE FOOD</span>
                                <span class="d-block text-dark">Aproveitar para alimentar</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </header>

            <section class="products section-padding">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-12">
                            <h2 class="mb-5">Objetivo</h2>
                            <p class="product-p">A Re-food é uma organização de actuação micro-local, criada para re-aproveitar excedentes alimentares e re-alimentar quem mais precisa.</p>
                            <br>
                            <hr>

                        </div>

                        <div class="col-lg-4 col-12 mb-3">
                            <div class="product-thumb">
                                <a href="https://re-food.org/">
                                    <img src="images/logo.png" class="img-fluid product-image" alt="">
                                </a>

                                <div class="product-top d-flex">
                                    <span class="product-alert me-auto">Logo </span>

                                    <a href="#" class="bi-heart-fill product-icon"></a>
                                </div>

                                <div class="product-info d-flex">
                                    <div>
                                        <h5 class="product-title mb-0">
                                            <a href="product-detail.php" class="product-title-link">O Projeto consiste:</a>
                                        </h5>

                                        <p class="product-p">O projeto Re-food é um esforço eco humanitário, 100% voluntário, efetuado para e pelos cidadãos ao nível micro-local, com o objetivo de acabar com a fome nos bairros urbanos. Ao mesmo tempo, procura acabar com o desperdício de alimentos preparados, reforçando os laços comunitários locais.
                                        </p>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-lg-4 col-12">
                            <div class="product-thumb">
                                <a href="https://re-food.org/doar/">
                                    <img src="images/ajuda.png" class="img-fluid product-image" alt="">
                                </a>

                                <div class="product-top d-flex">
                                    <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                                </div>

                                <div class="product-info d-flex">
                                    <div>
                                        <h5 class="product-title mb-0">
                                            <a href="product-detail.php" class="product-title-link"></a>
                                        </h5>

                                        <p class="product-p">Tentamos criar uma ponte humana que liga quem tem uma sobra diária a quem tem uma necessidade diária.
                                            A visão global consiste em replicar este conceito em todos os bairros de Lisboa (tornando Lisboa na primeira cidade do mundo sem desperdício de alimentos preparados) e, quem sabe, em todos os bairros do país ou do mundo</p>
                                    </div>

          
                                </div>
                            </div>
                        </div>
                     
                        <div class="col-12">
                            <h2 class="mb-5">3 Pilares da RE <span style="color:#f5b72f";>FOOD</span> </h2>
                        </div>

                        <div class="col-lg-4 col-12 mb-3">
                            <div class="product-thumb">
                                <a>
                                    <img src="images/impact.jpg" class="img-fluid product-image" alt="">
                                </a>

                                <div class="product-top d-flex">
                                    <span class="product-alert">Trending</span>

                                    <a  class="bi-heart-fill product-icon ms-auto"></a>
                                </div>

                                <div class="product-info d-flex">
                                    <div>
                                        <h5 class="product-title mb-0">
                                            <a class="product-title-link">Impacto</a>
                                        </h5>

                                        <p class="product-p">A ação diária do Movimento Refood tem efeitos imediatos: a boa comida não é desperdiçada, as pessoas não passam fome, os cidadãos podem doar uma pequena parte do seu tempo para mudar o mundo na sua vizinhança, as empresas locais podem ativar o seu dever de responsabilidade social e ambiental e todos podem participar ativamente numa economia circular que produz um bem social na sua própria comunidade local.

                                            Os resultados quantitativos e qualitativos produzidos são visíveis tanto nos números, sempre em crescimento, como na vida de todas as pessoas envolvidas. No seu conjunto, tecem uma rede de benefícios que une uma diversidade de membros da comunidade – jovens e velhos, ricos e pobres, residentes de longa data e recém-chegados, pessoas necessitadas e pessoas que sentem necessidade de ajuda. O impacto Refood é mobilizar, unir e transformar a comunidade.</p>
                                    </div>

                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mb-3">
                            <div class="product-thumb">
                                <a >
                                    <img src="images/susten.jpg" class="img-fluid product-image" alt="">
                                </a>

                                <div class="product-top d-flex">
                                    <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                                </div>

                                <div class="product-info d-flex">
                                    <div>
                                        <h5 class="product-title mb-0">
                                            <a class="product-title-link" >Sustentabilidade</a>
                                        </h5>

                                        <p class="product-p">A sustentabilidade social vem de um convite sincero a toda a comunidade local, desafiando cada voluntário a participar com apenas duas horas, uma vez por semana. Invariavelmente, essa experiência gera um retorno sobre o investimento (traduzido em felicidade), e resultando numa vontade de continuar.

                                            Da mesma forma, a experiência dos gestores-voluntários (pela própria dinâmica interpessoal de uma democracia participativa), geram um sentido de propósito que facilita o trabalho e garante a continuidade da equipa gestora.
                                            
                                            A sustentabilidade ambiental está no seio do nosso modelo operacional, pois cada refeição resgatada não só protege o ambiente que nos rodeia, como ainda está presente em todas as escolhas conscientes e informadas que contribuem para neutralizar a nossa pegada de carbono e completar a nossa economia circular.
                                            
                                            A sustentabilidade financeira é assegurada pela eficiência económica do nosso modelo operacional único, de baixo custo e alta produtividade (milhões de refeições resgatadas, a 0,10€ cada), juntamente com o nosso modelo de abordagem e inclusão da comunidade (contactando, convidando e incluindo pessoas, empresas, instituições locais, etc.) para participar com o seu tempo, alimentos ou outro suporte material – um processo que garante os custos operacionais de cada Núcleo local.</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mb-3">
                            <div class="product-thumb">
                                <a>
                                    <img src="images/ino.jpg" class="img-fluid product-image" alt="">
                                </a>

                                <div class="product-top d-flex">
                                    <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                                </div>

                                <div class="product-info d-flex">
                                    <div>
                                        <h5 class="product-title mb-0">
                                            <a class="product-title-link">Inovação</a>
                                        </h5>

                                        <p class="product-p">A inovação do Movimento REFOOD é transformadora, convertendo resíduos de alimentos em nutrição para acabar com a fome e, no processo, transformando a indiferença em solidariedade nas comunidades locais. Sem inovação, não haveria REFOOD.</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
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

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
