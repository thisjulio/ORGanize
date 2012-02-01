<?php
	require("classes/Conn.php");
	$search=new Conn();
	$busca=$_POST["Search"];
	$sql="SELECT DATA,DATA_REALIZACAO,HORA_REALIZACAO,ORIGEM,TIPO,CONTEUDO FROM CT.AUDITORIO WHERE TAG LIKE '%$busca%' ORDER BY DATA_ORDER DESC";
	$query=$search->Query($sql);
	if($search->Rows($query)){
		?>
		<table border="1" width="645" height="338" align="center" text-align="center" style="font-size: 13px">
			<tr>
				<th>Data Autorização</th>
				<th>Data Realização</th>
				<th>Horário solicitádo</th>
				<th>Origem</th>
				<th>Tipo</th>
				<th>Conteúdo</th>
			</tr>
		<?php
		while($rs=$search->Recordset($query)){
			?>
				<tr>
					<td><?php echo $rs['DATA']; ?></td>
					<td><?php echo $rs['DATA_REALIZACAO']; ?></td>
					<td><?php echo $rs['HORA_REALIZACAO']; ?></td>
					<td><?php echo $rs['ORIGEM']; ?></td>
					<td><?php echo $rs['TIPO']; ?></td>
					<td><?php echo $rs['CONTEUDO']; ?></td>
				</tr>
			<?php
		}
		echo '</table>';
	}
	else{
		echo "Não há dados para a consulta desejada. $sql";
	}
?>
