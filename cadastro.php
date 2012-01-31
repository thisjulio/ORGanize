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
        <span >Cadastro</span><hr/>

<?php 
	session_start();
	if (!$_SESSION["islog"]) {
		echo '<meta HTTP-EQUIV="refresh" CONTENT="0; URL=index.php">';
		exit;
	}

	if (!isset($_POST["Data"])) {
		echo <<<HTML
<form action="" method="POST">
				<table width="341" height="209" border="0" align="center">
					<tr>
						<td width="176">
							<span >DATA LIBERAÇÃO:</span>
						</td>
						<td width="155">
								<input type="text" name="Data" />
						</td>
					</tr>
					<tr>
						<td><span class="title">DATA REALIZAÇÃO:</span></td>
						<td>
								<input type="text" name="Data_Realização" />
						</td>
					</tr>
					<tr>
						<td><span class="title">HORA REALIZAÇÃO: </span></td>
						<td>
								<input type="text" name="Hora_Realização" />
						</td>
					</tr>
					<tr>
						<td><span class="title">TIPO: </span></td>
						<td>
								<input type="text" name="Tipo" />
						</td>
					</tr>
					<tr>
						<td><span class="title">ORIGEM: </span></td>
						<td>
								<input type="text" name="Origem" />
						</td>
					</tr>
					<tr>
						<td><span class="title">CONTEÚDO: </span></td>
						<td colspan="2">
							<center>
								<textarea name="Conteudo"></textarea>
							</center>
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2">
								<input align="center"  value="Cadastrar" type="submit" />
						</td>
					</tr>
				</table>
			</form>
HTML;
	}elseif ((isset($_POST["id"])) and ($_SESSION["type"]=="admin")) {
	require_once("includes/php/classes/Conn.php");
	$update = new Conn();
	$sql='UPDATE  CT.AUDITORIO SET  DATA =  \''.$_POST["Data"].'\', DATA_REALIZACAO =  \''.$_POST["Data_Realização"].'\', HORA_REALIZACAO =  \''.$_POST["Hora_Realização"].'\', TIPO =  \''.$_POST["Tipo"].'\', ORIGEM =  \''.$_POST["Origem"].'\', CONTEUDO =  \''.$_POST["Conteudo"].'\' WHERE  AUDITORIO.ID = \''.$_POST["id"].'\'';
	$query=$update->Query($sql);
	echo ' <h1> Cadastro Atualizado com sucesso! </h1>
		<script>
			alert("Cadastro atualizado com sucesso!");
		</script>';
	echo '<meta HTTP-EQUIV="refresh" CONTENT="0; URL=index.php">';
	} else {
	require_once("includes/php/classes/Insert.php");
	$registro=new Insert($_POST["Data"],$_POST["Data_Realização"],$_POST["Hora_Realização"],$_POST["Tipo"],$_POST["Origem"],$_POST["Conteudo"]);
	echo ' <h1> Cadastro realizado com sucesso! </h1>
		<script>
			alert("Cadastro realizado com sucesso!");
		</script>';
	echo '<meta HTTP-EQUIV="refresh" CONTENT="0; URL=index.php">';
		}
?>
    	</div>

<?php require("includes/php/rodape.php"); ?>

		</center>
	</body>
</html>
