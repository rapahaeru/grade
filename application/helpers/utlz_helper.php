<?php

// Redirecionador
function ir($url) {
	header("Location: $url");
}


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

function formatToBrazilDate($date){
	if($date!="0000-00-00 00:00:00" && !empty($date)){
		$date = date_create($date);
		return date_format($date, 'd/m/Y');
	}else 
		return '';
}