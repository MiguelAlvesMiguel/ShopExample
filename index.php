<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
</head>
<body>
    <h1>Users List</h1>
    <?php 
        // Database connection details
        $servername = "appserver-01.alunos.di.fc.ul.pt";
        $username = "asw14";
        $password = "";
        $dbname = "asw14";
 

        #phpinfo();  
        // Create a new connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        #or 
        #$conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Perform the query
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        // Display the results
        if ($result->num_rows > 0) {
            echo "<table border='1'><tr><th>ID</th><th>Username</th><th>Email</th></tr>";

            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["email"] . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "0 results";
        }

        // Close the connection
        $conn->close();
    ?>
</body>
</html>
