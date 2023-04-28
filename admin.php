<?php
    require 'dbConnection.php';

    function getUsers($conn) {
        $sql = "SELECT * FROM Users";
        $result = mysqli_query($conn, $sql);

        $users = [];

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }

        return $users;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
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

<div class="container">
    <h1>User Information</h1>
    <div class="row">
        <div class="col">
            <form>
                <div class="form-group">
                    <label for="search">Search:</label>
                    <input type="text" class="form-control" id="search" placeholder="Search...">
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender">
                        <option value="">All</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="age">Age Range:</label>
                    <select class="form-control" id="age">
                        <option value="">All</option>
                        <option value="18-25">18-25</option>
                        <option value="26-35">26-35</option>
                        <option value="36-45">36-45</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    
    <br>

    <br>


    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Location</th>
            <th>Zip Code</th>
            <th>Gender</th>
            <th>Age Range</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $users = getUsers($conn);
            foreach ($users as $user) {
                $birthDate = new DateTime($user['date_of_birth']);
                $now = new DateTime();
                $age = $now->diff($birthDate)->y;

                if ($age >= 18 && $age <= 25) {
                    $ageRange = "18-25";
                } elseif ($age >= 26 && $age <= 35) {
                    $ageRange = "26-35";
                } elseif ($age >= 36 && $age <= 45) {
                    $ageRange = "36-45";
                } else {
                    $ageRange = "Other";
                }
        ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['city']; ?></td>
                <td><?php echo $user['postal_code']; ?></td>
                <td><?php echo $user['gender']; ?></td>
                <td><?php echo $ageRange; ?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>

    <script>
       $(document).ready(function () {
    // Activate table search
    $('#search').on('keyup', function () {
        var value = $(this).val().toLowerCase();
        $('tbody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Activate gender filter
    $('#gender').on('change', function () {
        var value = $(this).val().toLowerCase();
        $('tbody tr').filter(function () {
            if (value === '') {
                return true;
            } else {
                return $(this).find('td:nth-child(5)').text().toLowerCase() === value;
            }
        }).toggle();
    });

    // Activate age range filter
    $('#age').on('change', function () {
        var value = $(this).val().toLowerCase();
        $('tbody tr').filter(function () {
            if (value === '') {
                return true;
            } else {
                return $(this).find('td:nth-child(6)').text().toLowerCase() === value;
            }
        }).toggle();
    });
});

    </script>
    </body>
    </html>