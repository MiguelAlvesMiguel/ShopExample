
<?php
// include server connection
include 'dbconnection.php';
declare(strict_types=1);
// define variables and set to empty values
$name = $email = $password= "";
$nameErr = $emailErr = $passwordErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Before testing the input, we need to check if the field is empty
    if (empty($name)){
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }
    
        if (empty($email)){
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
        }
        
        if (empty($password)){
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }
    
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    
        // Check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    
        // Check if password is well-formed
        if (!preg_match("/^[a-zA-Z0-9 ]*$/",$password)) {
            $passwordErr = "Only letters and numbers allowed";
        }
        else {$password = password_hash($password, PASSWORD_DEFAULT);}
        //Hash the password
        


        // Check if the user already exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $emailErr = "User already exists";
        } else {
            // Insert the user into the database
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the connection
        $conn->close();

}
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>