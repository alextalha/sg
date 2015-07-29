<?php
App::uses('AppModel', 'Model');

class DiaUtil extends AppModel {
public $useTable=false;
function dataPascoa($ano=false, $form="d/m/Y") {
	$ano=$ano?$ano:date("Y");
	if ($ano<1583) { 
		$A = ($ano % 4);
		$B = ($ano % 7);
		$C = ($ano % 19);
		$D = ((19 * $C + 15) % 30);
		$E = ((2 * $A + 4 * $B - $D + 34) % 7);
		$F = (int)(($D + $E + 114) / 31);
		$G = (($D + $E + 114) % 31) + 1;
		return date($form, mktime(0,0,0,$F,$G,$ano));
	}
	else {
		$A = ($ano % 19);
		$B = (int)($ano / 100);
		$C = ($ano % 100);
		$D = (int)($B / 4);
		$E = ($B % 4);
		$F = (int)(($B + 8) / 25);
		$G = (int)(($B - $F + 1) / 3);
		$H = ((19 * $A + $B - $D - $G + 15) % 30);
		$I = (int)($C / 4);
		$K = ($C % 4);
		$L = ((32 + 2 * $E + 2 * $I - $H - $K) % 7);
		$M = (int)(($A + 11 * $H + 22 * $L) / 451);
		$P = (int)(($H + $L - 7 * $M + 114) / 31);
		$Q = (($H + $L - 7 * $M + 114) % 31) + 1;
		return date($form, mktime(0,0,0,$P,$Q,$ano));
	}
}



// dataCarnaval(ano, formato);
// Autor: Yuri Vecchi
//
// Funcao para o calculo do Carnaval
// Retorna o dia do Carnaval no formato desejado ou false.
//
// ######################ATENCAO###########################
// Esta funcao sofre das limitacoes de data de mktime()!!!
// ########################################################
//
// Possui dois parametros, ambos opcionais
// ano = ano com quatro digitos
//	 Padrao: ano atual
// formato = formatacao da funcao date() http://br.php.net/date
//	 Padrao: d/m/Y

function dataCarnaval($ano=false, $form="d/m/Y") {
	$ano=$ano?$ano:date("Y");
	$a=explode("/", $this->dataPascoa($ano));
	return date($form, mktime(0,0,0,$a[1],$a[0]-47,$a[2]));
}




// dataCorpusChristi(ano, formato);
// Autor: Yuri Vecchi
//
// Funcao para o calculo do Corpus Christi
// Retorna o dia do Corpus Christi no formato desejado ou false.
//
// ######################ATENCAO###########################
// Esta funcao sofre das limitacoes de data de mktime()!!!
// ########################################################
//
// Possui dois parametros, ambos opcionais
// ano = ano com quatro digitos
//	 Padrao: ano atual
// formato = formatacao da funcao date() http://br.php.net/date
//	 Padrao: d/m/Y

function dataCorpusChristi($ano=false, $form="d/m/Y") {
	$ano=$ano?$ano:date("Y");
	$a=explode("/", $this->dataPascoa($ano));
	return date($form, mktime(0,0,0,$a[1],$a[0]+60,$a[2]));
}


// dataSanta(ano, formato);
// Autor: Yuri Vecchi
//
// Funcao para o calculo da ---ta-feira santa ou da Paixao.
// Retorna o dia da ---ta-feira santa ou da Paixao no formato desejado ou false.
//
// ######################ATENCAO###########################
// Esta funcao sofre das limitacoes de data de mktime()!!!
// ########################################################
//
// Possui dois parametros, ambos opcionais
// ano = ano com quatro digitos
// Padrao: ano atual
// formato = formatacao da funcao date() http://br.php.net/date
// Padrao: d/m/Y

function dataSanta($ano=false, $form="d/m/Y") {
	$ano=$ano?$ano:date("Y");
	$a=explode("/", $this->dataPascoa($ano));
	return date($form, mktime(0,0,0,$a[1],$a[0]-2,$a[2]));
} 

function somar_dias_uteis($str_data,$int_qtd_dias_somar) {

	// Caso seja informado uma data do MySQL do tipo DATETIME - aaaa-mm-dd 00:00:00
	// Transforma para DATE - aaaa-mm-dd

   $str_data = substr($str_data,0,10);

	// Se a data estiver no formato brasileiro: dd/mm/aaaa
	// Converte-a para o padrão americano: aaaa-mm-dd

	if ( preg_match("@/@",$str_data) == 1 ) {

		$str_data = implode("-", array_reverse(explode("/",$str_data)));

	}
	
	
	// chama a funcao que calcula a pascoa	
	$pascoa_dt = $this->dataPascoa(date('Y'));
	$aux_p = explode("/", $pascoa_dt);
	$aux_dia_pas = $aux_p[0];
	$aux_mes_pas = $aux_p[1];
	$pascoa = "$aux_mes_pas"."-"."$aux_dia_pas"; // crio uma data somente como mes e dia
	
	
	// chama a funcao que calcula o carnaval	
	$carnaval_dt =$this-> dataCarnaval(date('Y'));
	$aux_carna = explode("/", $carnaval_dt);
	$aux_dia_carna = $aux_carna[0];
	$aux_mes_carna = $aux_carna[1];
	$carnaval = "$aux_mes_carna"."-"."$aux_dia_carna"; 

	
	// chama a funcao que calcula corpus christi	
	$CorpusChristi_dt = $this->dataCorpusChristi(date('Y'));
	$aux_cc = explode("/", $CorpusChristi_dt);
	$aux_cc_dia = $aux_cc[0];
	$aux_cc_mes = $aux_cc[1];
	$Corpus_Christi = "$aux_cc_mes"."-"."$aux_cc_dia"; 

	
	// chama a funcao que calcula a ---ta feira santa	
	$ta_santa_dt =$this->dataSanta(date('Y'));
	$aux = explode("/", $ta_santa_dt);
	$aux_dia = $aux[0];
	$aux_mes = $aux[1];
	$ta_santa = "$aux_mes"."-"."$aux_dia"; 

	
   // COLOCAR ESSES ARRAYS PRA VIR DO BANCO DE DADOS
   $feriados = array("01-01"
                   , $carnaval
                   , $ta_santa
                   , $pascoa
                   , $Corpus_Christi
                   , "04-21", "04-23"
                   , "05-01"
                   , "06-12" 
                   , "09-07"
                   , "10-12"
                   , "11-02"
                   , "11-15"
                   , "12-25"
                   , "12-31");

        $recessos = array("2014-12-22", "2014-12-23", "2014-12-24","2014-12-26","2014-12-29","2014-12-30"
                         ,"2015-01-02","2015-01-20"
                         ,"2015-02-16","2015-02-18"
                         ,"2015-06-05"
                         );
	$array_data = explode('-', $str_data);
	$count_days = 0;
	$int_qtd_dias_uteis = 0;

	$semana = array('domingo'=>'0','segunda'=>'1','terca'=>'2','quarta'=>'3','quinta'=>'4','sexta'=>'5','sabado'=>'6');


	while ( $int_qtd_dias_uteis < $int_qtd_dias_somar ) {
		$count_days++;
		$data_final_dias_corridos = strtotime('+'.$count_days.'day',strtotime($str_data));
		$mes_dia = date('m-d',$data_final_dias_corridos); 
                $ano_mes_dia = date('Y-m-d',$data_final_dias_corridos); 
		$dia_da_semana = date('w', $data_final_dias_corridos);
		if($dia_da_semana != $semana['domingo'] && $dia_da_semana != $semana['sabado'] && !in_array($mes_dia,$feriados)  && !in_array($ano_mes_dia,$recessos)) {
		  $int_qtd_dias_uteis++;
                  //$int_qtd_dias_uteis=$int_qtd_dias_uteis+10;
		}

	}

	 return date('Y-m-d',strtotime('+'.$count_days.' days',strtotime($str_data)));

}

	

}
