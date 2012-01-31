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
	
		session_start();
		if ($_SESSION["type"] == "admin") {
			echo "<meta HTTP-EQUIV='refresh' CONTENT='1; URL=consulta-admin.php'>";
			exit;
		} else {
			echo "<meta HTTP-EQUIV='refresh' CONTENT='1; URL=consulta-aux.php'>";
			exit;
		}
				
	
	?>
    	</div>

<?php require("includes/php/rodape.php"); ?>

		</center>
	</body>
</html>
