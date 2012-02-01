<?php
	class Conn {
		public $unidade = a_julio_cesar;	//DB
		public $local= AUDITORIO;		//TABLE
		
		public $usuarios;
		public $tabela;

		private $host = localhost;				//HOST DO DB
		private $user = a_julio_cesar;			//USUÁRIO
		private $psw = YKH4pSMZFS3EuFJ8;			//SENHA
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
?>