
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

</head>

<body>
    <?php $nameErr = $emailErr = $passwordErr = $addressErr = $cityErr = $postalErr = $phoneErr = $nifErr = $dateErr = "";?>
   <!-- Navigation-->
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">2HandCloth</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" onclick="window.location.href='index.php'" aria-current="page">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="preferences.php">Preferências</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.html">Perfil</a></li> 
            </ul>
                <button class="btn btn-outline-dark"  onclick="function login(){window.location.href='SignIn.php';}login()">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login / Inscreva-se
                    <!--<span class="badge bg-dark text-white ms-1 rounded-pill">0</span>-->
                </button>
        </div>
    </div>
</nav>
    <div class="form">
      <!--A informação de perfil deve incluir o nome, data de nascimento, género 
(F/M/Outro), morada, localidade e código postal, telefone, e-mail e password-->
        <ul class="tab-group">
          <li class="tab active"><a href="#signup">Inscreva-se</a></li>
          <li class="tab"><a href="#login">Login</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="signup">   
            <h1>Inscreva-se gratuitamente</h1>
            <br> <br>
            <form action="register.php" method="post">
            
              <div class="field-wrap">
                <label>
                  Nome<span class="req"></span>
                </label>
                <input type="text" name="name"   autocomplete="off"/>
                <span class="error"><?php echo $nameErr;?></span>
              </div>
             
              <br>    
            <div class="field-wrap">
              <label>
                Email
              </label>
              <input type="email" name="email" autocomplete="off"/>
              <span class="error"><?php echo $emailErr;?></span>
            </div>
            <br>
            <div class="field-wrap">
              <label>
                Password<span class="req"></span>
              </label>
              <input type="password" name="password" autocomplete="off"/>
              <span class="error"><?php echo $passwordErr;?></span>
            </div>

            <br>    

          <div class="field-wrap">
              <label>
                Morada
              </label>
              <input type="text" name="address" autocomplete="off"/>
              <span class="error"><?php echo $addressErr;?></span>

          </div>
          <br>    
          <div class="field-wrap">
              <label>
                Localidade
              </label>
              <input type="text" name="city" autocomplete="off"/>
              <span class="error"><?php echo $cityErr;?></span>

          </div>
          <br>    
          <div class="field-wrap">
              <label>
                Código Postal
              </label>
              <input type="text" name="postal" autocomplete="off"/>
              <span class="error"><?php echo $postalErr;?></span>

          </div>
          <br>    
          <div class="field-wrap">
              <label>
                Telemóvel
              </label>
              <input type="text" name="phone" autocomplete="off"/>
              <span class="error"><?php echo $phoneErr;?></span>

          </div>
          <br>    
          
          <div class="field-wrap">
            <label>
              Género
            </label>
           
          <select name="gender" id="gender" class="dropdown">
            <option value="Male">Masculino </option>
            <option value="Female" selected>Feminino</option>
            <option value="Other">Outro</option>
        </select>
         <div class="dOfBirth" >
          <label>
            Data de Nascimento
          </label>
          <input type="date" class="dropdown" name="date" autocomplete="off"/>
          <span class="error"> <?php echo $dateErr; ?> </span>

      </div>
 
        </div>
            <br><br>
            <button type="submit" class="button button-block">Seguinte</button>
            
            </form>
  
          </div>
          
          <div id="login">   
            <h1>Bem Vindo!</h1>
            <br>    
            <form action="login.php" method="post">
            
              <div class="field-wrap">
              <label>
                Email<span class="req">*</span>
              </label>
              <input type="email"  name='email' autocomplete="off" />
            </div>
            <br>
            <div class="field-wrap">
              <label>
                Password<span class="req">*</span>
              </label>
              <input type="password" name='password'  autocomplete="off"/>
            </div>
            
            <p class="forgot"><a href="#">Esqueceu-se da sua password?</a></p>
            
            <button  type="submit" class="button button-block">Login</button>

            
            </form>
  
          </div>
          
        </div><!-- tab-content -->
        
  </div> <!-- /form -->
  ?>
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

