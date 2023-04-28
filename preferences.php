<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/bootstrap@3.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@3.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
<link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet"/>
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

		
		<!-- Categories -->
		<div class="form-group">
			<label for="categories">Categories:</label>
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="categories[]" value="Tops" id="tops">
				<label class="form-check-label" for="tops">Tops</label>
			</div>

			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="categories[]" value="Bottoms" id="bottoms">
				<label class="form-check-label" for="bottoms">Bottoms</label>
			</div>
            
            <div class="form-check">
				<input class="form-check-input" type="checkbox" name="categories[]" value="Shoes" id="bottoms">
				<label class="form-check-label" for="bottoms">Shoes</label>
			</div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="categories[]" value="Acessories" id="dresses">
                <label class="form-check-label" for="dresses">Acessories</label>
            </div>
            
            


	
		<!-- Sizes -->
<div class="form-group">
    <label for="sizes">Sizes:</label>
    <?php
           require 'dbConnection.php';
        $sql_sizes = "SELECT DISTINCT size FROM Products";
        $result_sizes = $conn->query($sql_sizes);
        if ($result_sizes->num_rows > 0) {
            // Output data of each row
            while($row_sizes = $result_sizes->fetch_assoc()) {
                $size = htmlspecialchars($row_sizes["size"]);
                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" name="sizes[]" value="' . $size . '" id="' . strtolower($size) . '">';
                echo '<label class="form-check-label" for="' . strtolower($size) . '">' . $size . '</label>';
                echo '</div>';
            }
        }
    ?>
</div>
		<!-- Brands -->
<h3>Brands</h3>
<select name="brands[]" multiple="true" class="form-control select-checkbox" size="5" style="width: 20%;">
<?php
    require 'dbConnection.php';
  
    $sql = "SELECT DISTINCT brand FROM Products";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<option>' . htmlspecialchars($row["brand"]) . '</option>';
        }
    }
    else {
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