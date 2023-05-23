<?php
  require_once('lib/nusoap.php');


  $servername = "appserver-01.alunos.di.fc.ul.pt";
  $username = "asw14";
  $password = "asw14asw14asw14";
  $dbname = "asw14";
  
  #phpinfo();  
  $soap = new nusoap_client('localhost/index.php?wsdl&debug=1', 'wsdl');
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
?>


