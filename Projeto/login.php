<?php

require 'dbConnection.php';
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
if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $valid = true;
    //Window.alert both of these

    if (empty($email) || empty($password)) {
        $valid = false;
        echo "<script>window.alert('Login Failed: All fields are required.');</script>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        echo "<script>window.alert('Login Failed: Invalid email format.');</script>";
    }

    if ($valid) {
        $sql = "SELECT * FROM Users WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['password_hash'])) {
                        session_start();
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['nome_completo'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['morada'] = $row['address'];
                        $_SESSION['localidade'] = $row['city'];
                        $_SESSION['codigo_postal'] = $row['postal_code'];
                        $_SESSION['telefone'] = $row['phone'];
                        $_SESSION['data_nascimento'] = $row['date_of_birth'];
                        $_SESSION['genero'] = $row['gender'];
                        //echo '<script>alert("Login Sucessful")</script>';
                        echo "<script>window.location.href = 'index.php';</script>";

                    } else {
                        echo "<script>window.alert('Login Failed: Invalid email or password.');</script>";
                    }
                } else {
                    echo "<script>window.alert('Login Failed: Invalid email or password.');</script>";
                }
            } else {
                echo "<script>window.alert('Login Failed: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>window.alert('Login Failed: " . $conn->error . "');</script>";
        }
    }

echo "<script>window.location.href = 'SignIn.php';</script>";


}
?>
