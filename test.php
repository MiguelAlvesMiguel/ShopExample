<?php
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
include 'dbConnection.php';
echo "Hello World!";

// Print all users
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of all rows
    
    while($row = $result->fetch_assoc()) {
        //Unhash the password
        echo "id: " . $row["user_id"]. " - Name: " . $row["name"]. " - Email" . $row["email"]. " - Password" . $row["password_hash"]. "<br>";
    }
} else {
    echo "0 results";
}
?>