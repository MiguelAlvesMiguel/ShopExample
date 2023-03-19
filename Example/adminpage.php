<!doctype html>
<html lang="en">
    <head>
        <title>REFOOD</title>
        <link rel="icon" type="image/jpg" href="images/logo.png"/>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Tooplate's Little Fashion - Sign In Page</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
        
        <link href="css/tabela_admin.css" rel="stylesheet">
<!--

Tooplate 2127 Little Fashion

https://www.tooplate.com/view/2127-little-fashion

-->
    </head>
    
    <body>
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
  
      $query = "SELECT * FROM admin WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["password"] . "'";
        $result = $conn->query($query);
        $existe = $result->num_rows;
        $bool_val = number_format($existe) == 0;
    //    echo $bool_val ? 'true' : 'false';
        if(!$bool_val){ ?>
          <section class='preloader'>
            <div class='spinner'>
                <span class='sk-inner-circle'></span>
            </div>
          </section>

          <main>
          <section class='sign-in-form section-padding'>
            <div class='container'>
              <div class='row'>
                <div class='col-lg-8 mx-auto col-12'>
                  <h1 class='hero-title text-center mb-5'>Tabelas</h1>
                  <div class='row'>
                    <div class='col-lg-8 col-11 mx-auto'>
                      <form role='form' method='get' action='tabelas_voluntarios.php'>
                        <button type='submit' class='btn custom-btn form-control mt-4 mb-3'> Voluntários </button>
                      </form>
                      <form role='form' method='get' action='tabelas_instituicoes.php'>
                        <button type='submit' class='btn custom-btn form-control mt-4 mb-3'> Instituições </button>
                      </form>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
          </section>
        </main>

        <?php }
        else{
          header("Location: admin.html");
        }
          ?>



        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
