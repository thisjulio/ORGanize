<?php
	require_once("Conn.php");
	class Insert extends Conn{
		public $date,$date_event,$time_event,$type,$origem,$content,$db,$base,$sql;
		function __construct($date,$date_event,$time_event,$type,$origem,$content){
			$this->date=$date;
			$this->date_event=$date_event;
			$this->time_event=$time_event;
			$this->data_order="$date_event[6]$date_event[7]$date_event[8]$date_event[9]-$date_event[3]$date_event[4]-$date_event[0]$date_event[1]";
			$this->type=$type;
			$this->origem=$origem;
			$TAG="$this->date | $this->date_event | $this->time_event | $this->type | $this->origem | $this->content";
			
			$this->db= new Conn();

			$tabela = $this->db->tabela;

			if(!$this->db){
				echo "Error: Impossivel conectar ao banco de dados.";
				exit;
			}

			mysql_set_charset('utf8',$this->db->db);

			$this->sql = "INSERT INTO $tabela (ID, DATA_ORDER , DATA , DATA_REALIZACAO, HORA_REALIZACAO, TIPO, ORIGEM, CONTEUDO , TAG) VALUES (NULL, '$this->data_order' , '$this->date' , '$this->date_event' , '$this->time_event' , '$this->type' , '$this->origem', '$this->content' , '$TAG')";
			return $this->db->Query($this->sql);
		}
	}
?>
