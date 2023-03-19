<?php
require_once "lib/nusoap.php";

function InfoInstDoacoes($ID)
{
	$dbhost="appserver-01.alunos.di.fc.ul.pt";
	$dbuser="asw27";	$dbpass="dafonsohenriques";	$dbname="asw27";
	//Cria a ligação à BD
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}
	
	$sql="SELECT pref_inst.tipoInst, instituicao.telefone, instituicao.conc , instituicao.freg , pref_inst.tipoDoa, pref_inst.quantidade, disp_inst.hora, disp_inst.dia FROM instituicao, pref_inst , disp_inst WHERE instituicao.id = \"".$ID."%\" AND pref_inst.id = \"".$ID."%\" AND disp_inst.id = \"".$ID."%\""  ;
	$result=mysqli_query($conn,$sql);
	//$result = $conn->query($sql);
    //$row = $result->fetch_assoc();


	while($row = $result->fetch_assoc())
	{
		$html[]="<tr><td>".implode("</td><td>",$row)."</td></tr>";
		
	}
		$html="<table><thead>
		<tr>
		  <th>Tipo de Intituição</th>
		  <th>Telefone</th>
		  <th>Distrito</th>
		  <th>Concelho</th>
		  <th>Freguesia</th>
		  <th>Tipo de Doação</th>
		  <th>Quantidade</th>
		  <th>Hora de Recolha</th>
		  <th>Periodicidade</th>
		</tr>
	  </thead>".implode("\n",$html).
	  "</table>";
	// echo $html;
	mysqli_close($conn);
	return $html;
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("InfoInstDoacoes", // nome metodo
array('nome' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#InfoInstDoacoes', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>
