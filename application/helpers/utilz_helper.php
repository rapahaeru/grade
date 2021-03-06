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
		//echo "data=" . date_create($year.'-'.$month.'-'.$day);exit();
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

function stringToURI($title, $id = null, $sep = '/') {
	$title = strtolower($title);
	$title = str_replace(array('_', ' '), array('-', '-'), normalizeStr($title));
	$title = preg_replace('![^\w_-]!', '', $title);
	$title = preg_replace('!-{2,}!', '-', $title);
	$title = preg_replace('!^-+|-+$!', '', $title);
	return $title . (is_null($id) ? '' : $sep . $id);
}

function normalizeStr($str) {
	$str = htmlentities($str);
	$str = preg_replace('/&((?i)[a-z]{1,2})(?:grave|accent|acute|circ|tilde|uml|ring|lig|cedil|slash);/', '$1', $str);
	$str = str_replace(array('&ETH;', '&eth;', '&THORN;', '&thorn;'), array('dh', 'd', 'TH', 'th'), $str);
	return $str;
}

function returnYearFromDate($date){
//////////////////////////////////////////////////
// Recebe data inteira e retorna apenas o ano
// Utilizada em :
// Movie->profile()
//////////////////////////////////////////////////

	$year = date('Y', strtotime($date));

	return $year;

}

function debug($value){

	echo "<pre>";
	var_dump($value);
	echo "</pre>";

}

// in_object method
// to check if a value in an object exists.
function in_object($value,$object) {
if (is_object($object)) {
  foreach($object as $key => $item) {
    if ($value==$item) return $key;
  }
}
return false;
}

