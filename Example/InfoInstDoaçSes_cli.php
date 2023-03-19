<html>
<header>
    <link rel="stylesheet" href="css/tabelaInst.css">
</header>
<body>
<?php
require_once "lib/nusoap.php";
$ID= $_POST['id'];

$client = new nusoap_client(
    'http://appserver-01.alunos.di.fc.ul.pt/~asw27/projeto/InfoInstDoações_serv.php'
);
$error = $client->getError();
$result = $client->call('InfoInstDoacoes', array('ID' => $ID));	//handle errors

//echo "<h2>Pedido</h2>";
//echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
//echo "<h2>Resposta</h2>";
//echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";

if ($client->fault)
{   //check faults
}
else {    $error = $client->getError();		 //handle errors
   		 echo "<h2>$result</h2>";
        
        
         
}
?>
<body>
</html>