<?php

  $servername = "appserver-01.alunos.di.fc.ul.pt";
  $username = "asw14";
  $password = "";
  $dbname = "asw14";
  
  #phpinfo();  
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
?>


