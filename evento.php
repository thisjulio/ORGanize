<?php
    function Evento($id){
        require("includes/php/classes/Conn.php");
        $con=new Conn();
	$tabela = $con->tabela;
        $sql="SELECT ID,DATA_REALIZACAO,HORA_REALIZACAO,ORIGEM,CONTEUDO FROM $tabela WHERE ID=$id";
        $query=$con->Query($sql);
        $rows=$con->Rows($query);
        if($rows){
            while($rs=$con->Recordset($query)){
                echo <<<HTML
                    <h2 id="title">{$rs['DATA_REALIZACAO']}</h2>
                    <ul>
                        <li><b>Horário:</b>{$rs['HORA_REALIZACAO']}</li>
                        <li><b>Requerente:</b>{$rs['ORIGEM']}</li>
                        <li><b>Conteúdo:</b>{$rs['CONTEUDO']}</li>
                    </ul>
HTML;
            }
        }
        else{
            echo "Erro.";    
        }
    }
?>
﻿<html>
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
            <?php Evento($_GET['id']); ?>
        </div>
        <?php require("includes/php/rodape.php"); ?>
		</center>
	</body>
</html>
