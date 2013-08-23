<?php

// Redirecionador
function ir($url) {
	header("Location: $url");
}

// Formata a data no formato Sistema.
function formatToSystemDate($date){
	if(!empty($date) && strrpos($date, "/")){
		$date = explode('/',$date);
		$day = $date[0];
		$month = $date[1];
		$year = $date[2];
		$date = date_create($year.'-'.$month.'-'.$day)->format('Y-m-d');
	}else
		$date = '0000-00-00';
	return $date;
}

// Formata a data no formato Sistema. Y-m-d HH:mm:ss
function formatToSystemDateTime($dateC){
	if(!empty($dateC) && strrpos($dateC, " ")){

		$dateC = explode(' ',$dateC);
		$data = $dateC[0];
		$time = $dateC[1];

			if(!empty($data) && strrpos($data, "/")){// data

				$data = explode('/',$data);
				$day = $data[0];
				$month = $data[1];
				$year = $data[2];

				$newData = date_create($year.'-'.$month.'-'.$day)->format('Y-m-d');
			}else{
				$newData = '0000-00-00';
			}	

			if(!empty($time) && strrpos($time, ":")){// time

				$time = explode(':', $time);
				$hour = $time[0];
				$minute = $time[1];
				$second = $time[2];

				$newTime = date_create($hour.':'.$minute.':'.$second)->format('H:m:s');
			}else{
				$newTime = '00:00:00';
			}	

		$date = date_create($newData.' '.$newTime)->format('Y-m-d H:m:s');
	}else
		$date = '0000-00-00 00:00:00';
	return $date;
}

// Formata a data no formato Brasil.
function formatToBrazilDate($date){
	if($date!="0000-00-00 00:00:00" && !empty($date)){
		$date = date_create($date);
		return date_format($date, 'd/m/Y');
	}else 
		return '';
}

// Formata a data no formato Brasil. d/m/Y HH:mm:ss
function formatToBrazilDateTime($date){
	if($date!="0000-00-00 00:00:00" && !empty($date)){
		$date = date_create($date);
		return date_format($date, 'd/m/Y H:m:s');
	}else 
		return '';
}

// Limita os caracteres de cada string.
function limitaString($string, $maxsize, $close = '...'){
	if(strlen($string) < $maxsize){
		return $string;
	}else{
   		$string = substr($string, 0, $maxsize);
   		return substr($string, 0, strrpos($string, ' ')).$close;
	}

}

// remove acentos de uma string.
function RemoveAcentos($string){

	$a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ";
	// $a = todas as letras e os tipos de acentos que quero remover.

	$b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr";
	// $b = mesma ordem, mas sem acentos.

	$str = utf8_decode(trim($string));
	//Aqui eu pego a string e coverto para ISO-8859-1.

	$strtr = strtr($str, utf8_decode($a), $b); //substitui letras acentuadas por "normais"

	$preg_string = preg_replace('/[ -]+/' , '-' , $strtr); // retira espaco

	$return_string = strtolower($preg_string); // passa tudo para minusculo

	return utf8_encode($return_string); //finaliza, gerando uma saída para a funcao
}

