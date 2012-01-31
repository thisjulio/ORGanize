<?php
	if ( !(
		(isset($_POST["host"])  and !empty($_POST["host"]))  and 
		(isset($_POST["user"])  and !empty($_POST["user"]))  and 
		(isset($_POST["psw"])   and !empty($_POST["psw"]))   and 
		(isset($_POST["db"])    and !empty($_POST["db"]))    and 
		(isset($_POST["table"]) and !empty($_POST["table"]))
	      )
		){
		echo <<<HTML
<html>
	<head>
		<title>Instalador Organize</title>
	</head>
	<body>
		<form action="" method="POST" >
			<table>
				<tr>
					<td>Host</td><td><input type="text" name="host" /></td>
				</tr>
				<tr>					
					<td>Usuario</td><td><input type="text" name="user" /></td>
				</tr>
				<tr>					
					<td>Senha</td><td><input type="text" name="psw" /></td>
				</tr>
				<tr>					
					<td>DB</td><td><input type="text" name="db" /></td>
				</tr>
				<tr>					
					<td>Table</td><td><input type="text" name="table" /></td>
				</tr>
				<tr>					
					<td rowspan=2><input type="submit" value="INSTALAR" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>
HTML;
	}else{
		$host = $_POST["host"];
		$user = $_POST["user"];
		$psw  = $_POST["psw"];
		$db   = $_POST["db"];
		$table= $_POST["table"];
		$arq = '<?php
	class Conn {
		public $unidade = '.$db.';	//DB
		public $local= '.$table.';		//TABLE
		
		public $usuarios;
		public $tabela;

		private $host = '.$host.';				//HOST DO DB
		private $user = '.$user.';			//USUÁRIO
		private $psw = '.$psw.';			//SENHA
		public $db;
		function __construct(){
			$this->usuarios = $this->unidade.".USER";
			$this->tabela = $this->unidade.".".$this->local;
			$this->db=mysql_connect($this->host,$this->user,$this->psw);
			if(!$this->db){
				echo "Erro: Impossível conectar ao banco de dados.";
				exit;
			}
			@ mysql_set_charset("utf8",$this->db);
		}
		function Disconnect($db){
			mysql_close($db);
		}
		function Query($sql){
			return mysql_query($sql);
		}
		function Rows($query){
			return @ mysql_num_rows($query);
		}
		function Recordset($query){
			return mysql_fetch_array($query);
		}
	}
?>';
		$fl = fopen("includes/php/classes/Conn.php","w+");
		if(fwrite($fl,$arq)){
			echo "<script>alert('Instalação realizada com sucesso!');</script>";
		}else{
			echo "<script>alert('Ocorreu um erro durante a instalação, verifique as permissões de arquivo!');</script>";
		}
		fclose($fl);
		echo '<meta HTTP-EQUIV="refresh" CONTENT="0; URL=index.php">';	
	}
?>
