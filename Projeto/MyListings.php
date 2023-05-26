<?php
include 'dbConnection.php';

session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : -1;

if ($user_id == -1) {
    // Redirect to login page or show a message if the user is not logged in
    die("Please login to view your listings.");
}

// Fetch all categories and types just like you did in index.php
$categories = [];
$types = [];

$result = $conn->query("SELECT * FROM Category");
while ($row = $result->fetch_assoc()) {
    $categories[$row['id']] = $row['name'];
}

$result = $conn->query("SELECT * FROM Types");
while ($row = $result->fetch_assoc()) {
    $types[$row['id']] = $row['name'];
}

// Fetch all products posted by the current user
$myProducts = [];
$result = $conn->query("SELECT * FROM Products WHERE seller_id = " . $user_id);
while ($row = $result->fetch_assoc()) {
    $myProducts[] = $row;
}
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        .favorite-icon.bi-star-fill {
            color: #FFD700;
        }
    </style>
    <script>
        $('.form').find('input, textarea').on('keyup blur focus', function(e) {

            var $this = $(this),
                label = $this.prev('label');

            if (e.type === 'keyup') {
                if ($this.val() === '') {
                    label.removeClass('active highlight');
                } else {
                    label.addClass('active highlight');
                }
            } else if (e.type === 'blur') {
                if ($this.val() === '') {
                    label.removeClass('active highlight');
                } else {
                    label.removeClass('highlight');
                }
            } else if (e.type === 'focus') {

                if ($this.val() === '') {
                    label.removeClass('highlight');
                } else if ($this.val() !== '') {
                    label.addClass('highlight');
                }
            }

        });

        $('.tab a').on('click', function(e) {

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
                        <li class="nav-item"><a class="nav-link" href="index.php" aria-current="page">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="preferences.php">Preferences</a></li>
                        <li class="nav-item"><a class="nav-link" href="insert_product.php">Sell Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="chat.php">Chats</a></li>
                        <li class="nav-item"><a class="nav-link active" href="MyListings.php">My Listings</a></li>
                        <li class="nav-item"><a class="nav-link" href="favorites.php">My Favorites</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span>Welcome, <?php echo $_SESSION['nome_completo']; ?></span>
                        </div>
                        <a class="btn btn-outline-dark" href="preferences.php">
                            <i class="bi bi-gear"></i>
                            Preferences
                        </a>
                    </div>
                <?php } else { ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" href="index.php" aria-current="page">Home</a></li>
                    </ul>
                    <a class="btn btn-outline-dark" href="SignIn.php">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login / Sign-Up
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
    <br><br>
    <form class="d-flex mb-4" style="justify-content: center;">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-bar" />
        <!-- searchsame as above but with 30% width and centered -->
   
    </form>


    <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($myProducts as $product) : ?>
                    <div class="col mb-5 product-item" id="product-<?php echo $product['product_id']; ?>" data-title="<?php echo htmlspecialchars($product['title']); ?>">
                        <div class="card h-100">
                            <div class="col mb-5 product-item" id="product-<?php echo $product['product_id']; ?>" data-title="<?php echo htmlspecialchars($product['title']); ?>">
                                <div class="card h-100">
                                    <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- if the user is logged in show the star icon to favorite the product -->
                                            <?php if (isset($_SESSION['user_id'])) { ?>
                                                <div class="bi <?php echo in_array($product['product_id'], $favorite_products) ? 'bi-star-fill' : 'bi-star'; ?> favorite-icon" style="cursor: pointer;" data-product-id="<?php echo $product['product_id']; ?>"></div>
                                            <?php } ?>
                                            <h5 class="fw-bolder"><?php echo htmlspecialchars($product['title']); ?></h5>
                                            <?php echo htmlspecialchars($product['price']); ?>€
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">

                                                <?php if ($_SESSION['user_id'] != $product['seller_id']) { ?>
                                                    <a class="btn btn-outline-dark mt-auto chat-button" href="chat.php?product_id=<?php echo $product['product_id']; ?>&seller_id=<?php echo $product['seller_id']; ?>">Chat</a>
                                                <?php } ?>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-dark mt-auto" data-toggle="modal" data-target="#productModal-<?php echo $product['product_id']; ?>">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Modal -->
                    <div class="modal fade" id="productModal-<?php echo $product['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="productModalLabel-<?php echo $product['product_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel-<?php echo $product['product_id']; ?>"><?php echo htmlspecialchars($product['title']); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Product details go here -->
                                    <!-- Product details go here -->
                                    <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="..." />
                                    <p class="mt-3"><?php echo htmlspecialchars($product['description']); ?></p>
                                    <p>Category: <?php echo htmlspecialchars($categories[$product['category_id']]); ?></p>
                                    <p>Type: <?php echo htmlspecialchars($types[$product['type_id']]); ?></p>

                                    <p>Size: <?php echo htmlspecialchars($product['size']); ?></p>
                                    <p>Brand: <?php echo htmlspecialchars($product['brand']); ?></p>
                                    <p>Condition: <?php echo htmlspecialchars($product['condition']); ?></p>
                                    <p>Price: <?php echo htmlspecialchars($product['price']); ?>€</p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        <div class="container">
            <p class="m-0 text-center text-white">2HandCloth</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".carrinho-button").click(function() {
                var product_id = $(this).data('product-id');
                var seller_id = $(this).data('seller-id');
                $.ajax({
                    url: 'purchaseProduct.php',
                    type: 'post',
                    data: {
                        product_id: product_id,
                        seller_id: seller_id
                    },
                    success: function(response) {
                        var responseStr = String(response).trim();
                        if (responseStr == "Aceite") {
                            // Remove the product from the page
                            alert("Aceite");

                            $("#product-" + product_id).remove();
                        } else {
                            // Show an error message
                            alert("Não Aceite");
                            alert(responseStr);
                        }
                    }
                });

            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const favoriteIcons = document.querySelectorAll('.favorite-icon');

            favoriteIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    event.stopPropagation();

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