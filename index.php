<?php



include 'dbConnection.php';

session_start();

// Set default user ID if user is not logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : -1;
// Get user preferences if user is logged in
if ($user_id != -1) {
    $result_preferences = $soap->call('getUserPreferences', array('user_id' => $user_id));
    //TODO: Put the code here
}


// Get all products
$products = $soap->call('getAllProducts', array('user_id' => $user_id));


// Get favorite products if user is logged in
$favorite_products = $soap->call('getFavoriteProducts', array('user_id' => $user_id));

echo '<script>window.alert("'.$result.'");</script>';
?>

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
        <!--  IMPORT JSQUERY-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <style>
        .favorite-icon.bi-star-fill {
            color: #FFD700;
        }
    </style>
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
        <form class="d-flex mb-4">
    <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" id="search-bar" />
            <!-- searchsame as above but with 30% width and centered -->



    <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#filter-collapse" aria-expanded="false" aria-controls="filter-collapse">
        <i class="bi bi-funnel"></i>
        Filtros
    </button>
</form>

<div class="collapse" id="filter-collapse">
    <div class="card card-body">
        <form>
            <div class="row">
                <div class="col-4">
                    <label for="type-select" class="form-label">Tipo</label>
                    <select class="form-select" id="type-select">
                        <option value="">Todos</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?php echo $type['type_id']; ?>"><?php echo htmlspecialchars($type['type']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="category-select" class="form-label">Categoria</label>
                    <select class="form-select" id="category-select">
                        <option value="">Todas</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['category']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="size-select" class="form-label">Tamanho</label>
                    <select class="form-select" id="size-select">
                        <option value="">Todos</option>
                        <?php foreach ($sizes as $size): ?>
                            <option value="<?php echo $size['size']; ?>"><?php echo htmlspecialchars($size['size']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">Aplicar filtros</button>
            </div>
        </form>
    </div>
</div>


        <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($products as $product): ?>
                <div class="col mb-5 product-item" data-title="<?php echo htmlspecialchars($product['title']); ?>">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="..." />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- if the user is logged in show the star icon to favorite the product -->
                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <div class="bi <?php echo in_array($product['product_id'], $favorite_products) ? 'bi-star-fill' : 'bi-star'; ?> favorite-icon" data-product-id="<?php echo $product['product_id']; ?>"></div>
                                <?php } ?>
                                <h5 class="fw-bolder"><?php echo htmlspecialchars($product['title']); ?></h5>
                                <?php echo htmlspecialchars($product['price']); ?>€
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <a class="btn btn-outline-dark mt-auto" href="#">Carrinho</a>
                                <?php } else { ?>
                                    <a class="btn btn-outline-dark mt-auto" href="SignIn.php">Carrinho</a>
                                <?php } ?>
                            </div>
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
    
        <script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteIcons = document.querySelectorAll('.favorite-icon');

    favoriteIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const isFavorite = this.classList.contains('bi-star-fill');

            // Toggle the favorite state visually
            this.classList.toggle('bi-star');
            this.classList.toggle('bi-star-fill');

            // Send an AJAX request to update the Favorites table
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_favorite.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`user_id=${encodeURIComponent(<?php echo $user_id; ?>)}&product_id=${encodeURIComponent(productId)}&is_favorite=${encodeURIComponent(!isFavorite)}`);
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('#search-bar');
    const productItems = document.querySelectorAll('.product-item');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        productItems.forEach(item => {
            const title = item.dataset.title.toLowerCase();
            if (title.includes(searchTerm)) {
                item.classList.remove('d-none');
            } else {
                item.classList.add('d-none');
            }
        });
    });
});
</script>

    </body>
</html>
