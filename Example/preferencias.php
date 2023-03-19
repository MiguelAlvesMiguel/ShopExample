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
        <style>
            

select {

/* styling */
background-color: white;
border: thin solid black;
border-radius: 4px;
display: inline-block;
font: inherit;
line-height: 1.5em;
padding: 0.5em 3.5em 0.5em 1em;
width:400px;

/* reset */

margin: 10px;      
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
-webkit-appearance: none;
-moz-appearance: none;
}



/* arrows */

select.classic {

background-position:
  calc(100% - 20px) calc(1em + 2px),
  calc(100% - 15px) calc(1em + 2px),
  100% 0;
background-size:
  5px 5px,
  5px 5px,
  2.5em 2.5em;
background-repeat: no-repeat;
}

select.classic:focus {
background-image:
  linear-gradient(45deg, white 50%, transparent 50%),
  linear-gradient(135deg, transparent 50%, white 50%),
  linear-gradient(to right, gray, gray);
background-position:
  calc(100% - 15px) 1em,
  calc(100% - 20px) 1em,
  100% 0;
background-size:
  5px 5px,
  5px 5px,
  2.5em 2.5em;
background-repeat: no-repeat;
border-color: grey;
outline: 0;
}


select:hover{
    background-color:  #f5b72f;

}

select.round {
background-image:
  linear-gradient(45deg, transparent 50%, gray 50%),
  linear-gradient(135deg, gray 50%, transparent 50%),
  radial-gradient(#ddd 70%, transparent 72%);
background-position:
  calc(100% - 20px) calc(1em + 2px),
  calc(100% - 15px) calc(1em + 2px),
  calc(100% - .5em) .5em;
background-size:
  5px 5px,
  5px 5px,
  1.5em 1.5em;
background-repeat: no-repeat;
}

select.round:focus {
background-image:
  linear-gradient(45deg, white 50%, transparent 50%),
  linear-gradient(135deg, transparent 50%, white 50%),
  radial-gradient(gray 70%, transparent 72%);
background-position:
  calc(100% - 15px) 1em,
  calc(100% - 20px) 1em,
  calc(100% - .5em) .5em;
background-size:
  5px 5px,
  5px 5px,
  1.5em 1.5em;
background-repeat: no-repeat;
border-color: green;
outline: 0;
}



input{
    box-sizing: border-box;
    background-color: #f5b72f;
    /* styling */
background-color: white;
border: thin solid black;
border-radius: 4px;
display: inline-block;
font: inherit;
line-height: 1.5em;
padding: 0.5em 3.5em 0.5em 1em;
width:400px;

/* reset */

margin: 10px;      
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
-webkit-appearance: none;
-moz-appearance: none;
}
input:hover{
    background-color: #f5b72f;
    margin-top: 2px;
}


select.minimal {
background-image:
  linear-gradient(45deg, transparent 50%, gray 50%),
  linear-gradient(135deg, gray 50%, transparent 50%),
  linear-gradient(to right, #ccc, #ccc);
background-position:
  calc(100% - 20px) calc(1em + 2px),
  calc(100% - 15px) calc(1em + 2px),
  calc(100% - 2.5em) 0.5em;
background-size:
  5px 5px,
  5px 5px,
  1px 1.5em;
background-repeat: no-repeat;
}

select.minimal:focus {
background-image:
  linear-gradient(45deg, green 50%, transparent 50%),
  linear-gradient(135deg, transparent 50%, green 50%),
  linear-gradient(to right, #ccc, #ccc);
background-position:
  calc(100% - 15px) 1em,
  calc(100% - 20px) 1em,
  calc(100% - 2.5em) 0.5em;
background-size:
  5px 5px,
  5px 5px,
  1px 1.5em;
background-repeat: no-repeat;
border-color: green;
outline: 0;
}


select:-moz-focusring {
color: transparent;
text-shadow: 0 0 0 #000;
}

body {


padding: 2em 0;
text-align: center;
}
h1 {
color: white;
line-height: 120%;
margin: 0 auto 2rem auto;
max-width: 30rem;
}


        </style>
   
   
   
<!--

Tooplate 2127 Little Fashion

https://www.tooplate.com/view/2127-little-fashion

-->
    </head>
    
    <body>


        <section class="sign-in-form section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto col-12">
                        <h1 class="hero-title text-center mb-5" style="color: #000;">Defina as suas <span style="color: #f5b72f;">preferencias<span></h1>
                        <div class="social-login d-flex flex-column w-50 m-auto">
                            <div class="main-block">
                                
                                
                                <form action="php/preferencias.php" method="post" id="main" enctype="multipart/form-data">
                                    <div class="form-floating">
                                    </n>
                                        <select name="tipoInst" id="tipoInst">
                                            <option value="Cafe">Café</option>
                                            <option value="Restaurante">Restaurante</option>
                                            <option value="Refeitorio">Refeitorio</option>
                                            <option value="Supermercado">Supermercado</option>
                                          </select>
                                        <select name="tipoDoa" id="tipoDoa">
                                            <option value="Bens alimentares de longa duracao">Bens alimentares de longa duração </option>
                                            <option value="Bens alimentares de curta duracao">Bens alimentares de curta duração</option>
                                        </select>
                                        <?php
                                        session_start();
                                        if (isset ($_SESSION['utilizador']) > 0) {
                                          if($_SESSION['utilizador'] == 'instituicao'){
                                            echo "<input type='text' name='quantidade'  placeholder='Quantidade em Peso'  required/>";
                                          }
                                        }
                                        ?>
                                          <!-- <input type="text" name="quantidade"  placeholder="Quantidade em Peso"  required/> -->
                                
                                    </div>


                                    

                                    <div class="btn-block" id="submit">
                                        <hr>
                                      <button type="submit" href="perfil_volt.php" class=" custom-btn form-control ">Submeter</button>
                                    </div>

                                  </form>
                                  
                        
                    </div>

                </div>
            </div>
                </div>
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



