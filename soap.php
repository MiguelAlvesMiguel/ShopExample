<?php
require_once('lib/nusoap.php');

$client = new nusoap_client('http://localhost/soap_server.php?wsdl', 'wsdl');


$products = $client->call('getProducts');
?>
