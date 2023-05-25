<?php
  $servername = "appserver-01.alunos.di.fc.ul.pt";
  $username = "asw14";
  $password = "asw14asw14asw14";
  $dbname = "asw14";

  // Create a new mysqli instance
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
?>
