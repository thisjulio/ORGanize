<?php
/* Creditos para Rubens Ribeiro: http://rubsphp.blogspot.com/ */
/**
 * Gera um calendario na forma de tabela HTML
 * @param int $mes Mes desejado (1 = Janeiro, 12 = Dezembro)
 * @param int $ano Ano desejado
 * @param bool $preencher_dias Preencher os dias extras com numeros ou nao
 * @return string Calendario na forma de tabela HTML
 */

function gerar_calendario($mes,$ano,$preencher_dias=true){
    $time_primeiro_dia=mktime(0,0,0,$mes,1,$ano);
    $time_ultimo_dia=mktime(0,0,0,$mes+1,0,$ano);
    $primeiro_dia_semana=(int)strftime('%u',$time_primeiro_dia);
    $ultimo_dia=(int)strftime('%d',$time_ultimo_dia);
    $ultimo_dia_semana=(int)strftime('%u',$time_ultimo_dia);

    // Obter nome do mes
    $nome_mes=strftime('%B',$time_primeiro_dia);
    // Obter nomes dos dias da semana
    for($i=1;$i<=7;$i++){
        $time=mktime(0,0,0,$mes,$i-$primeiro_dia_semana,$ano);
        $nome_dia[$i]=strftime('%A',$time);
        $nome_abreviado_dia[$i]=strftime('%a',$time);
    }
    // Determinar dias a serem exibidos
    $dias=array();
    if($primeiro_dia_semana>1){
        $time_ultimo_dia_mes_passado=mktime(0,0,0,$mes,0,$ano);
        $ultimo_dia_mes_passado=(int)strftime('%d',$time_ultimo_dia_mes_passado);
        for($i=$primeiro_dia_semana-1;$i>=0;$i--){
            $dias[]=$preencher_dias ? $ultimo_dia_mes_passado-$i : '';
        }
    }
    $posicao_antes=count($dias);;
    for($i=1;$i<=$ultimo_dia;$i++){
        $dias[]=$i;
    }
    $posicao_depois=count($dias);
    if($ultimo_dia_semana<7){
        $max=7-$ultimo_dia_semana;
        for($i=1;$i<$max;$i++){
            $dias[]=$preencher_dias ? $i : '';
        }
    }
    $tabela = <<<HTML
<h1>{$nome_mes}, {$ano}</h1>
<table class="calendario">
<thead>
<tr>
  <th scope="col" id="CalWeek"><abbr title="{$nome_dia[1]}">{$nome_abreviado_dia[1]} |</abbr></th>
  <th scope="col" id="CalWeek"><abbr title="{$nome_dia[2]}">{$nome_abreviado_dia[2]} |</abbr></th>
  <th scope="col" id="CalWeek"><abbr title="{$nome_dia[3]}">{$nome_abreviado_dia[3]} |</abbr></th>
  <th scope="col" id="CalWeek"><abbr title="{$nome_dia[4]}">{$nome_abreviado_dia[4]} |</abbr></th>
  <th scope="col" id="CalWeek"><abbr title="{$nome_dia[5]}">{$nome_abreviado_dia[5]} |</abbr></th>
  <th scope="col" id="CalWeek"><abbr title="{$nome_dia[6]}">{$nome_abreviado_dia[6]} |</abbr></th>
  <th scope="col" id="CalWeek"><abbr title="{$nome_dia[7]}">{$nome_abreviado_dia[7]}</abbr></th>
</tr>
</thead>
<tbody>
HTML;

    $coluna=1;
	require_once("classes/Conn.php");
	$con=new Conn();
	$tab = $con->tabela;
	$query=$con->Query("SELECT ID,DAY(DATA_ORDER) AS dia,MONTH(DATA_ORDER) AS mes,YEAR(DATA_ORDER)AS ano FROM $tab WHERE MONTH(DATA_ORDER)=$mes AND YEAR(DATA_ORDER)=$ano ORDER BY DATA_ORDER");
	$rows=$con->Rows($query);
	$day=array();
	while($rs=$con->Recordset($query)){
		$day[$rs['dia']]=$rs['ID'];
	}
	foreach($dias as $i => $dia){
		if($coluna == 1){
			$tabela .= '<tr>';
		}
		$class=$i<$posicao_antes || $i>=$posicao_depois ? '"extra"':'"dia"';
			if($class=='"dia"' AND isset($day[$dia])){
				$tabela.='<td class='.$class.'><a href="evento.php?id='.$day[$dia].'">'.$dia.'</a></td>';
			}
			else{
				$tabela.='<td class='.$class.'>'.$dia.'</td>';
			}
		$coluna+=1;
		if($coluna==8){
			$tabela.='</tr>';
			$coluna=1;
		}
	}
    $tabela .= <<<HTML
</tbody>
</table>
HTML;
    return $tabela;
}
setlocale(LC_TIME, 'pt_BR.UTF-8');
@ $ano= !isset($_GET["ano"]) ? date("Y") : $_GET["ano"];
@ $mes= !isset($_GET["mes"]) ? date("m") : $_GET["mes"];
 $ano= $mes > 12 ? $ano+1 : $ano;
 $mes= $mes > 12 ? 1: $mes;
 $ano= $mes <= 0 ? $ano-1 : $ano;
 $mes= $mes <= 0 ? 12: $mes;
echo @ gerar_calendario($mes,$ano);
echo "<a href='?mes=".($mes-1)."&ano=$ano'><< </a> | <a href='?mes=".($mes+1)."&ano=$ano'> >> </a>";
?>
