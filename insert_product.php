<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>2HandCloth</title>

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/login.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <!-- include js/scripts.js-->
    <script src="js/scripts.js"></script>

    <style>
        .form {
            max-width: 700px;
            margin: 30px auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>

</head>


<body>
<?php session_start(); ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">2HandCloth</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" href="index.php" aria-current="page">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="preferences.php">Preferências</a></li>
                    <li class="nav-item"><a class="nav-link" href="insert_product.php">Vender Produto</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span>Bem-vindo, <?php echo $_SESSION['nome_completo']; ?></span>
                    </div>
                    <a class="btn btn-outline-dark" href="preferences.php">
                        <i class="bi bi-gear"></i>
                        Preferências
                    </a>
                </div>
            <?php } else { ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" href="index.php" aria-current="page">Home</a></li>
                </ul>
                <a class="btn btn-outline-dark" href="SignIn.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login / Inscreva-se
                </a>
            <?php } ?>
        </div>
    </div>
</nav>

<?php
$nameErr = $emailErr = $passwordErr = $cityErr = $postalErr = $phoneErr = $nifErr = "";
?>
    <div class="form">
      <!--A informação de perfil deve incluir o nome, data de nascimento, género 
(F/M/Outro), morada, localidade e código postal, telefone, e-mail e password-->
        <div class="tab-content">
          <div id="signup">   
            <h1>Faça o seu Anúncio</h1>
            <br> <br>
            <form action="add_product.php" method="post">
            
              <div class="field-wrap">
                <label for="titulo">Título do Anúncio:</label>
                <input type="text" id="titulo" name="titulo" required>
                <span class="error"><?php echo $nameErr;?></span>
              </div>
             
              <br>    
            <div class="field-wrap">
                <label for="descricao">Descrição do Anúncio:</label>
                <textarea id="descricao" name="descricao" required></textarea>
              <span class="error"><?php echo $emailErr;?></span>
            </div>
            <br>
            
            <div class="field-wrap">
                <label for="categoria" style="position: initial;">Categoria:</label>
             
                <select id="categoria" name="categoria" required>
                  
                    <option value="1">Mulher</option>
                    <option value="2">Homem</option>
                    <option value="3">Criança</option>
                    <option value="4">Unisexo</option>
</select>
              <span class="error"><?php echo $passwordErr;?></span>
            </div>

            <br>    
            <div class="field-wrap">
                <label for="tipo" style="position: initial;">Tipo:</label>
             
                <select id="tipo" name="tipo" required>
                  <?php
                      $types = [ 'Calças', 'Casacos' , 'Camisolas' , 'Camisas' , 'T-Shirts' , 'Calçado' , 'Acessórios' , 'Vestidos' , 'Saias' , 'Calções' , 'Fatos de Banho' , 'Roupa Interior' , 'Outros' ];
                      foreach ($types as $type) {
                          echo "<option value='$type'>$type</option>";
                      }

                    ?>
                </select>
        
            </div>
            <div class="field-wrap">
                <label for="size" style="position: initial;">Size:</label>
             
                <select id="size" name="size" required>
                
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
        
            </div>
          <br>    
      
          <br>    
          <div class="field-wrap">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>
              <span class="error"><?php echo $postalErr;?></span>

          </div>
          <br>    
          
          <br>    
          <div class="field-wrap">
            <label for="condition">Estado:</label>
            <input type="text" id="condition" name="condition" required>
             

          </div>
          <br>    
          <div class="field-wrap">
            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" required>
              <span class="error"><?php echo $phoneErr;?></span>

          </div>
          <div class="field-wrap">
            <label for="image_url"  style="position: initial;">Foto URL:</label>
            <input type="text" id="foto" name="image_url" required>
       

          </div>
 
        </div>

     <br><br>

            <button type="submit" class="button button-block">Publicar Artigo</button>
            
            </form>
  
          </div>
          
         
        
  </div> <!-- /form -->

<script>
$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

</script>


</body>