<?php
	
	require("classes/Conn.php");
	
	$user = $_POST["user"];
	$psw = $_POST["psw"];
	
	$login = new Conn();
	$usuarios = $login->usuarios;
	$sql="SELECT * FROM $usuarios WHERE USUARIO LIKE '$user' AND SENHA LIKE '$psw'";
	$query=$login->Query($sql);
	
	if ($login->Rows($query)){
		$USER = $login->Recordset($query);	
		
		session_start();
		$_SESSION["islog"] = true;
		$_SESSION["usr"] = $USER["USUARIO"];
		$_SESSION["type"] = $USER["TIPO"];
		
		echo '</script><meta HTTP-EQUIV="refresh" CONTENT="0; URL=../../">';
		exit;
		
	}else{
		echo '<script>alert("USUARIO ou SENHA incorretos!");</script><meta HTTP-EQUIV="refresh" CONTENT="0; URL=../../">';
		exit;
	}

?>
