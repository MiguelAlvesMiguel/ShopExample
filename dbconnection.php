<?php
  require_once('lib/nusoap.php');


  $servername = "appserver-01.alunos.di.fc.ul.pt";
  $username = "asw14";
  $password = "asw14asw14asw14";
  $dbname = "asw14";
  
  #phpinfo();  
  $soap = new nusoap_client('http://127.0.0.1/index.php?wsdl&debug=1', 'wsdl');
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  function checkSoapError($soap,$additional_message = null) {
    // Check for a fault
    if ($soap->fault) {
        echo '<h2>Fault</h2><pre>';
        print_r($soap->fault);
        echo '</pre>';
    } else {
        // Check for errors
        $error = $soap->getError();
        if ($error) {
            // Display the error
            echo '<h2>Error</h2><pre>' . $error . '</pre>';
            if ($additional_message != null) {
                echo '<h2>Additional message</h2><pre>' . $additional_message . '</pre>';
            }
        }
      
    }
}
?>


