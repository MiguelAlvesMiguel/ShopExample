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
         <link href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" rel="stylesheet">
        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
                        <style>
/* DEMO STYLES */
body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100vw;
  height: 100vh;
  font-family: sans-serif;
}
body > * {
  margin: 0.5rem;
}
* {
  margin: 0;
  padding: 0;
  flex-shrink: 0;
  box-sizing: border-box;
}

/* END DEMO STYLES */

/* MAIN STYLES */

.checkbox {
  display: flex;
  align-items: center;
  font-size: 2rem;
  cursor: pointer;
  width: 20rem;
}
.checkbox input {
  display: none;
}
.checkbox input:checked ~ .checkbox__mark svg {
  opacity: 1;
  transform: translate(-50%, -50%) scale(1);
}
.checkbox__mark {
  margin-right: 0.5rem;
  position: relative;
  width: 2rem;
  height: 2rem;
  border: 0.2rem solid #000;
}
.checkbox__mark svg {
  position: absolute;

  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.5);
  width: 80%;
  height: auto;
  transition: all ease 0.2s;
  opacity: 0;
}
.checkbox--disabled {
  color: grey;
  pointer-events: none;
}
.checkbox--disabled .checkbox__mark {
  border-color: grey;
}
.checkbox--disabled .checkbox__mark {
  border-color: grey;
}

.float-container {
    border: 3px solid #fff;
    padding: 20px;
}

.float-child {
    width: 50%;
    float: left;
    padding: 20px;
}  


                            
        </style>

    </head>
    
    <body>
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
                        <a class="nav-link" href="about.php">Sobre nós</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="products.php">Objetivo</a>
                    </li>
                    <?php
                                include "php/abreconexao.php";  
                                session_start();
                                if (isset ($_SESSION['utilizador']) > 0) {
                                    if($_SESSION['utilizador'] == 'voluntario'){
                                        echo "<li class='nav-item'>
                                        <a class='nav-link active' href='disponibilidade.php'>Disponibilidade</a>
                                        </li>";
                                        echo "<li class='nav-item'>
                                        <a class='nav-link' href='instituicao.php'>Instituições</a>
                                        </li>";
                                    }else{
                                        echo "<li class='nav-item'>
                                        <a class='nav-link active' href='disponibilidade.php'>Disponibilidade</a>
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

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>
          <div class="float-container" style="margin-top: 15%;">

            <div class="float-child">
              <div class="col-lg-8 mx-auto col-12">
                <h1 class="hero-title text-center mb-5">Adira ao <span style="color: #f5b72f;">voluntariado<span></h1>
              </div>
            </div>
            
            <div class="float-child">
              <div class="row">

                        
                <div class="col-lg-8 col-11 mx-auto">
                    <form role="form" action="php/disponibilidade.php" method="post">

                        <div class="form-floating mb-4 p-0">
                            <input type="text" name="area" class="form-control" placeholder="Area Geográfica(Distrito,Concelho,Freguesia)" value=
                            <?php 
                        if($_SESSION['utilizador'] == 'voluntario'){
                          $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . "";
                            $resultv = $conn->query($query);
                            if ($resultv->num_rows > 0) {
                              $rowv = $resultv->fetch_assoc();
                              echo $rowv['area'];
                            }else{
                              echo '';
                            }
                          }else{
                            $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . "";
                            $resulti = $conn->query($query);
                            if ($resulti->num_rows > 0) {
                              $rowi = $resulti->fetch_assoc();
                              echo $rowi['area'];
                            }else{
                              echo '';
                            }
                          }
                              ?> required>

                            <label for="area">Area Geográfica</label>
                        </div>
                        <!-- MAIN MARKUP-->
                        <label for="checkbox-1" class="checkbox">
                          <input id="checkbox-1" value="segunda" name="checkbox-group[]" type="checkbox" 
                          <?php 
                          if($_SESSION['utilizador'] == 'voluntario'){
                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%segunda%'";
                              $resultv = $conn->query($query);
                              if ($resultv->num_rows > 0) {
                                echo 'checked';
                              }
                            }else{
                              $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%segunda%'";
                              $resulti = $conn->query($query);
                              if ($resulti->num_rows > 0) {
                                echo 'checked';
                              }
                            }
                              ?>>
                          <span class="checkbox__mark">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13449 12.7269L22.2809 0L25 2.64085L9.13449 18L0 9.15702L2.71912 6.51624L9.13449 12.7269Z" fill="#000000" />
                            </svg>

                          </span>
                          Segunda-Feira
                        </label>

                        <label for="checkbox-2" class="checkbox">
                          <input id="checkbox-2" value="terca" name="checkbox-group[]" type="checkbox"
                          <?php 
                          if($_SESSION['utilizador'] == 'voluntario'){
                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%terca%'";
                              $resultv = $conn->query($query);
                              if ($resultv->num_rows > 0) {
                                echo 'checked';
                              }
                            }else{
                              $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%terca%'";
                              $resulti = $conn->query($query);
                              if ($resulti->num_rows > 0) {
                                echo 'checked';
                              }
                            }
                              ?>>
                          <span class="checkbox__mark">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13449 12.7269L22.2809 0L25 2.64085L9.13449 18L0 9.15702L2.71912 6.51624L9.13449 12.7269Z" fill="#000000" />
                            </svg>

                          </span>
                          Terça-Feira
                        </label>

                        <label for="checkbox-3" class="checkbox">
                          <input id="checkbox-3" value="quarta" name="checkbox-group[]" type="checkbox"
                          <?php 
                          if($_SESSION['utilizador'] == 'voluntario'){
                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%quarta%'";
                              $resultv = $conn->query($query);
                              if ($resultv->num_rows > 0) {
                                echo 'checked';
                              }
                            }else{
                              $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%quarta%'";
                              $resulti = $conn->query($query);
                              if ($resulti->num_rows > 0) {
                                echo 'checked';
                              }
                            }
                              ?>>
                          <span class="checkbox__mark">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13449 12.7269L22.2809 0L25 2.64085L9.13449 18L0 9.15702L2.71912 6.51624L9.13449 12.7269Z" fill="#000000" />
                            </svg>

                          </span>
                          Quarta-Feira
                        </label>
                        <label for="checkbox-4" class="checkbox">
                          <input id="checkbox-4" value="quinta" name="checkbox-group[]" type="checkbox"
                          <?php 
                          if($_SESSION['utilizador'] == 'voluntario'){
                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%quinta%'";
                              $resultv = $conn->query($query);
                              if ($resultv->num_rows > 0) {
                                echo 'checked';
                              }
                            }else{
                              $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%quinta%'";
                              $resulti = $conn->query($query);
                              if ($resulti->num_rows > 0) {
                                echo 'checked';
                              }
                            }
                              ?>>
                          <span class="checkbox__mark">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13449 12.7269L22.2809 0L25 2.64085L9.13449 18L0 9.15702L2.71912 6.51624L9.13449 12.7269Z" fill="#000000" />
                            </svg>

                          </span>
                          Quinta-Feira
                        </label>
                        <label for="checkbox-5" class="checkbox">
                          <input id="checkbox-5" value="sexta" name="checkbox-group[]" type="checkbox"
                          <?php 
                          if($_SESSION['utilizador'] == 'voluntario'){
                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%sexta%'";
                              $resultv = $conn->query($query);
                              if ($resultv->num_rows > 0) {
                                echo 'checked';
                              }
                            }else{
                              $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND dia LIKE '%sexta%'";
                              $resulti = $conn->query($query);
                              if ($resulti->num_rows > 0) {
                                echo 'checked';
                              }
                            }
                              ?>>
                          <span class="checkbox__mark">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13449 12.7269L22.2809 0L25 2.64085L9.13449 18L0 9.15702L2.71912 6.51624L9.13449 12.7269Z" fill="#000000" />
                            </svg>

                          </span>
                          Sexta-Feira
                        </label>

                        <hr>
                                                                
                                                                
                        <label for="checkbox-8" class="checkbox">
                          <input id="checkbox-8" value="manha" name="checkbox[]" type="checkbox"
                          <?php 
                          if($_SESSION['utilizador'] == 'voluntario'){
                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%manha%'";
                              $resultv = $conn->query($query);
                              if ($resultv->num_rows > 0) {
                                echo 'checked';
                              }
                            }else{
                              $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%manha%'";
                              $resulti = $conn->query($query);
                              if ($resulti->num_rows > 0) {
                                echo 'checked';
                              }
                            }
                              ?>>
                          <span class="checkbox__mark">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13449 12.7269L22.2809 0L25 2.64085L9.13449 18L0 9.15702L2.71912 6.51624L9.13449 12.7269Z" fill="#000000" />
                            </svg>

                          </span>
                          Manha
                        </label>
                        <label for="checkbox-9" class="checkbox">
                          <input id="checkbox-9" value="tarde" name="checkbox[]" type="checkbox"
                          <?php 
                          if($_SESSION['utilizador'] == 'voluntario'){
                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%tarde%'";
                              $resultv = $conn->query($query);
                              if ($resultv->num_rows > 0) {
                                echo 'checked';
                              }
                            }else{
                              $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%tarde%'";
                              $resulti = $conn->query($query);
                              if ($resulti->num_rows > 0) {
                                echo 'checked';
                              }
                            }
                              ?>>
                          <span class="checkbox__mark">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13449 12.7269L22.2809 0L25 2.64085L9.13449 18L0 9.15702L2.71912 6.51624L9.13449 12.7269Z" fill="#000000" />
                            </svg>

                          </span>
                          Tarde
                        </label>
                        <label for="checkbox-10" class="checkbox">
                          <input id="checkbox-10" value="noite" name="checkbox[]" type="checkbox"
                          <?php 
                          if($_SESSION['utilizador'] == 'voluntario'){
                            $query="SELECT * FROM disp_volt WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%noite%'";
                              $resultv = $conn->query($query);
                              if ($resultv->num_rows > 0) {
                                echo 'checked';
                              }
                            }else{
                              $query="SELECT * FROM disp_inst WHERE id = " . $_SESSION['id'] . " AND hora LIKE '%noite%'";
                              $resulti = $conn->query($query);
                              if ($resulti->num_rows > 0) {
                                echo 'checked';
                              }
                            }
                              ?>>
                          <span class="checkbox__mark">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13449 12.7269L22.2809 0L25 2.64085L9.13449 18L0 9.15702L2.71912 6.51624L9.13449 12.7269Z" fill="#000000" />
                            </svg>

                          </span>
                          Noite
                        </label>
                      
                        <button type="submit" class="btn custom-btn form-control mt-4 mb-3">
                            Submeter
                        </button>
                    </form>
                </div>
            </div>
            
        </div>

    </div>
            </div>
            
          </div>
            <section class="sign-in-form section-padding">
                <div class="container">
                    
                </div>
            </section>

        </main>


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
