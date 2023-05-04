<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/bootstrap@3.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap@3.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
    <link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="css/navbar.css" rel="stylesheet" />
    <script src="js/prefs.js" defer></script>
    <link href="css/styles.css" rel="stylesheet" />

    <title>Preferências De Utilizador</title>


    <!-- Custom CSS -->
    <style>
        select {
            width: 150px;
        }

        .select-checkbox option::before {
            content: "\2610";
            width: 1.3em;
            text-align: center;
            display: inline-block;
        }

        .select-checkbox option:checked::before {
            content: "\2611";
        }

        .select-checkbox-fa option::before {
            font-family: FontAwesome;
            content: "\f096";
            width: 1.3em;
            display: inline-block;
            margin-left: 2px;
        }

        .select-checkbox-fa option:checked::before {
            content: "\f046";
        }
    </style>
</head>

<body>

<?php
    session_start();
    require 'dbConnection.php';

    $user_id = $_SESSION['user_id'];
    $preferences = [
        'types' => [],
        'sizes' => [],
        'brands' => [],
        'categories' => [],
    ];

    // Get user preferences
    $sql_pref = "SELECT preference_id FROM Preferences WHERE user_id = $user_id";
    $result_pref = $conn->query($sql_pref);

    if ($result_pref->num_rows > 0) {
        $row_pref = $result_pref->fetch_assoc();
        $preference_id = $row_pref['preference_id'];

        // Get preference types
        $sql_types = "SELECT type_id FROM PreferenceTypes WHERE preference_id = $preference_id";
        $result_types = $conn->query($sql_types);

        while ($row_types = $result_types->fetch_assoc()) {
            $preferences['types'][] = $row_types['type_id'];
        }

        // Get preference categories
$sql_categories = "SELECT Category.name as category_name FROM PreferenceCategories INNER JOIN Category ON PreferenceCategories.category_id = Category.id WHERE PreferenceCategories.preference_id = $preference_id";
$result_categories = $conn->query($sql_categories);

while ($row_categories = $result_categories->fetch_assoc()) {
    $preferences['categories'][] = $row_categories['category_name'];
}


        // Get preference sizes
        $sql_sizes = "SELECT size FROM PreferenceSizes WHERE preference_id = $preference_id";
        $result_sizes = $conn->query($sql_sizes);

        while ($row_sizes = $result_sizes->fetch_assoc()) {
            $preferences['sizes'][] = $row_sizes['size'];
        }

        // Get preference brands
        $sql_brands = "SELECT brand FROM PreferenceBrands WHERE preference_id = $preference_id";
        $result_brands = $conn->query($sql_brands);

        while ($row_brands = $result_brands->fetch_assoc()) {
            $preferences['brands'][] = $row_brands['brand'];
        }
    }
?>

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

    <div class="container mt-5">
        <h1>Preferências De Utilizador</h1>
        <form method="POST" action="save_preferences.php">

            <!-- Types -->
            <div class="form-group">
                <label for="types">Types:</label>
                <?php
                $sql_types = "SELECT * FROM Types";
                $result_types = $conn->query($sql_types);
                if ($result_types->num_rows > 0) {
                    // Output data of each row
                    while ($row_types = $result_types->fetch_assoc()) {
                        $type_id = $row_types["id"];
                        $type_name = htmlspecialchars($row_types["name"]);
                        $checked = in_array($type_id, $preferences['types']) ? 'checked' : '';
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="checkbox" name="types[]" value="' . $type_id . '" id="type_' . $type_id . '" ' . $checked . '>';
                        echo '<label class="form-check-label" for="type_' . $type_id . '">' . $type_name . '</label>';
                        echo '</div>';
                    }
                } else {
                    echo "<script>window.alert('No types found!');</script>";
                }
                ?>
            </div>

            <!-- Categories -->
            <div class="form-group">
                <label for="categories">Categories:</label>
                <?php
                $categories = ['Mulher', 'Homem', 'Criança', 'Unisexo'];
                foreach ($categories as $category) {
                    $checked = in_array($category, $preferences['categories']) ? 'checked' : '';
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" name="categories[]" value="' . $category . '" id="' . strtolower($category) . '" ' . $checked . '>';
                    echo '<label class="form-check-label" for="' . strtolower($category) . '">' . $category . '</label>';
                    echo '</div>';
                }
                ?>
            </div>




            <!-- Sizes -->
            <div class="form-group">
                <label for="sizes">Sizes:</label>
                <?php
                $sql_sizes = "SELECT DISTINCT size FROM Products";
                $result_sizes = $conn->query($sql_sizes);
                if ($result_sizes->num_rows > 0) {
                    // Output data of each row
                    while ($row_sizes = $result_sizes->fetch_assoc()) {
                        $size = htmlspecialchars($row_sizes["size"]);
                        $checked = in_array($size, $preferences['sizes']) ? 'checked' : '';
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="checkbox" name="sizes[]" value="' . $size . '" id="' . strtolower($size) . '" ' . $checked . '>';
                        echo '<label class="form-check-label" for="' . strtolower($size) . '">' . $size . '</label>';
                        echo '</div>';
                    }
                } else {
                    echo "<script>window.alert('No sizes found!');</script>";
                }
                ?>
            </div>

            <!-- Brands -->
            <h3>Brands</h3>
            <select name="brands[]" multiple="true" class="form-control select-checkbox" size="5" style="width: 20%;">
                <?php
                $sql = "SELECT DISTINCT brand FROM Products";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $brand = htmlspecialchars($row["brand"]);
                        $selected = in_array($brand, $preferences['brands']) ? 'selected' : '';
                        echo '<option value="' . $brand . '" ' . $selected . '>' . $brand . '</option>';
                    }
                } else {
                    echo "<script>window.alert('No brands found!');</script>";
                }
                ?>
            </select>

            <br>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Preferences</button>

        </form>
        <br>
        <br>
        <!-- Logout Button -->
        <a href="logout.php" class="btn btn-danger">Logout</a>

    </div>

</body>

</html>