<html>
    <head>
		<title>ORGanize</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="stylesheet" type="text/css" href="style/css/style.css" />
		
		<script type="text/javascript" lenguage="javascript" src="style/js/jQuery.js"></script>
		<script type="text/javascript" lenguage="javascript" src="style/js/jQueryFunc.js"></script>
	</head>
	<body>
		<center>

<?php require("includes/php/topo.php"); ?>

		<div id="content" >
        ﻿<?php
	require("includes/php/classes/Conn.php");
	$search=new Conn();
	
	if (!isset($_POST["consulta"])) {
		echo  <<<HTML
			<span id="title">Consultar</span><hr/>
			<form id="consult" method="post" action="#">
				<input type="text" name="consulta" id="searchbox" />
				<input type="image" id="search-button" src="style/img/search.png" />
			</form>
			
HTML;

	}else{
		
		$busca=$_POST["consulta"];
		$tabela = $search->tabela;
		$sql="SELECT DATA,DATA_REALIZACAO,HORA_REALIZACAO,ORIGEM,TIPO,CONTEUDO FROM $tabela WHERE TAG LIKE '%$busca%' ORDER BY DATA_ORDER DESC";
		$query=$search->Query($sql);
		echo <<<HTML
		<table id="result">
			<tr>
				<th colspan="6">
					<h3>
						Sua consulta obteve <b>{$search->Rows($query)}</b> resultados!
					</h3>
				</th>
			</tr>
HTML;
		echo <<<HTML
			<tr>
				<th>Data Liberação</th>
				<th>Data Realização</th>
				<th>Hora Realização</th>
				<th>Origem</th>
				<th>Tipo</th>
				<th>Conteudo</th>
			</tr>
HTML;
		$query=$search->Query($sql);
		while ($campo = $search->Recordset($query)){
			echo <<<HTML
	<tr>
	<td>{$campo["DATA"]}</td>
	<td>{$campo["DATA_REALIZACAO"]}</td>
	<td>{$campo["HORA_REALIZACAO"]}</td>
	<td>{$campo["ORIGEM"]}</td>
	<td>{$campo["TIPO"]}</td>
	<td>{$campo["CONTEUDO"]}</td>
	</tr>
HTML;
		}
	
		echo <<<HTML
</table>
HTML;
		
		}

?>
    	</div>

<?php require("includes/php/rodape.php"); ?>

		</center>
	</body>
</html>
