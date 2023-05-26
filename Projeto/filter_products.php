<?php
include 'dbConnection.php';

$type = $_POST['type'];
$category = $_POST['category'];
$size = $_POST['size'];

// Fetch all products from the database
$result = $conn->query("SELECT * FROM Products");
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$filtered_products = array_filter($products, function($product) use ($type, $category, $size) {
    return ($type == '' || $product['type_id'] == $type) &&
           ($category == '' || $product['category_id'] == $category) &&
           ($size == '' || $product['size'] == $size);
});

// Display the filtered products.
foreach ($filtered_products as $product) : ?>
    <div class="col mb-5 product-item" id="product-<?php echo $product['product_id']; ?>" data-title="<?php echo htmlspecialchars($product['title']); ?>">
        <div class="card h-100">
            <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="..." />
            <div class="card-body p-4">
                <div class="text-center">
                    <h5 class="fw-bolder"><?php echo htmlspecialchars($product['title']); ?></h5>
                    <?php echo htmlspecialchars($product['price']); ?>€
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
<?php endforeach; ?>
