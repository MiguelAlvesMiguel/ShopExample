<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>2HandCloth</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="fotos/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        
    
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
    </head>
    <body>
    <?php session_start(); ?>
<!-- Navigation-->
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


        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">2HandCloth</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Roupas em segunda mão por um preço acessível.</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <?php
include 'dbConnection.php';

$query = "SELECT * FROM Products";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
        <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($products as $product): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <?php if ($product['type'] == 'Promoção'): ?>
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Promoção</div>
                        <?php endif; ?>
                        <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="..." />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?php echo htmlspecialchars($product['title']); ?></h5>
                                <?php if ($product['type'] == 'Promoção'): ?>
                                    <span class="text-muted text-decoration-line-through"><?php echo htmlspecialchars($product['price']); ?>€</span>
                                    <!-- Calculate the new price based on the desired discount percentage, e.g., 30% -->
                                    <?php $discountedPrice = $product['price'] * (1 - 0.3); ?>
                                    <?php echo htmlspecialchars(number_format($discountedPrice, 2)); ?>€
                                <?php else: ?>
                                    <?php echo htmlspecialchars($product['price']); ?>€
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Carrinho</a></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">2HandCloth</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
