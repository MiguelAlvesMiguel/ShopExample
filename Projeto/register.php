<?php 
include_once 'dbConnection.php';
/*
Users table:

user_id: Integer, Auto-increment, Primary Key
name: String (max length 255), Not Null
date_of_birth: Date, Not Null
gender: Enum ('F', 'M', 'Other'), Not Null
address: String (max length 255), Not Null
city: String (max length 255), Not Null
postal_code: String (max length 10), Not Null
phone: String (max length 20), Not Null
email: String (max length 255), Not Null, Unique
password_hash: String (max length 255), Not Null
Category table:

id: Integer, Auto-increment, Primary Key
name: String (max length 255), Not Null, Unique
Preferences table:

preference_id: Integer, Auto-increment, Primary Key
user_id: Integer, Not Null, Foreign Key (Users table)
category: Integer, Foreign Key (Category table)
size: String (max length 10)
brand: String (max length 255
*/

// Check if the form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve the form data
    $nome_completo = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $morada = trim($_POST['address']);
    $localidade = trim($_POST['city']);
    $codigo_postal = trim($_POST['postal']);
    $telefone = trim($_POST['phone']);
    $data_nascimento = trim($_POST['date']);
    $genero = trim($_POST['gender']);

    // Validate the data
    $valid = true;
    if (empty($nome_completo) || empty($email) || empty($password) || empty($morada) || empty($localidade) || empty($codigo_postal) || empty($telefone) || empty($data_nascimento)) {
        $valid = false;
        echo "<script>window.alert('Registration Failed: All fields are required.');</script>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        echo "<script>window.alert('Registration Failed: Invalid email format.');</script>";
    }
    // Add more validation rules as needed, e.g., for password strength, phone number format, etc.

    if ($valid) {
        //See if user already exists
        $sql = "SELECT * FROM Users WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $valid = false;
                    echo "<script>window.alert('User already exists')</script>";
                }
            } else {
                echo "<script>window.alert('Registration Failed: " . $stmt->error . "');</script>,";
            }
            $stmt->close();
        } else {
            
        }

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the data into the 'utilizador' table
        $sql = "INSERT INTO Users ( name, date_of_birth, gender, address, city, postal_code, phone, email, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssssss", $nome_completo, $data_nascimento, $genero, $morada, $localidade, $codigo_postal, $telefone, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>window.alert('Registration Successful.');</script>";
            } else {
                echo "<script>window.alert('Registration Failed: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>window.alert('Registration Failed: " . $conn->error . "');</script>";
        }
    }
}

echo "<script>window.location.href = 'SignIn.php';</script>";

// Close the database connection
$conn->close();
?>
