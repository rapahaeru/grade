<?php
	///////////////////////////	
	// Author: Renato Mendes //
	// Last Update: 06/12/12 //
	///////////////////////////


	ini_set('display_errors',1);

	#caminho físico da imagem
	//$imgPath = $_SESSION['upload_fisico'];	
	$imgPath = '/home/cael/public_html/grade/posters/movies/';	

	#explode os parametros enviados
	$tmp		= explode("_._",$_GET["params"]);

	#caminho fisico onde a imagem está no momento
	$caminho	= trim($imgPath).$tmp[0];
	
	// Novo tamanho
	$w 	= $tmp[1];
	$h 	= $tmp[2];
	$nw = $tmp[1];
	$nh = $tmp[2];

	#pasta onde sera salvo o arquivo reajustado
	$cache 		= trim($imgPath).'cache/';
	
	// echo '-----'.$cache;

	#path completo do novo local + imagem
	$image_path	 	= $cache.'Resized'.$tmp[1].'_'.$tmp[2].'_'.$tmp[0];

	# reconhece o tipo do arquivo
	if(strpos(strtolower($caminho),".jpg")>0 || strpos(strtolower($caminho),".jpeg")>0){
		
		header("Content-Type: image/jpeg");
	
	} elseif(strpos(strtolower($caminho),".gif")>0){

		header("Content-Type: image/gif");
	
	} elseif(strpos(strtolower($caminho),".png")>0){

		header("Content-Type: image/png");
	
	}
	
	# baixa o arquivo
	//header("Content-Disposition: attachment; filename=".$tmp[0]);

	if (file_exists($image_path)) {
	
		readfile($image_path);

	
	} else {

		# define novo tamanho da imagem
		
		list($ow, $oh) = getimagesize($caminho);
		
		if($ow>$oh)
			$h = round($oh * $nw / $ow);
		else
			$w = round($ow * $nh / $oh);
		
		if($h>$nh) {
			$h = $nh;
			$w = round($ow * $h / $oh);
		}
		
		if($w>$nw) {
			$w = $nw;
			$h = round($oh * $w / $ow);
		}	
		
		$new = imagecreatetruecolor($w, $h);

		# cria a nova imagem
		if(strpos(strtolower($caminho),".jpg")>0 || strpos(strtolower($caminho),".jpeg")>0){
			
			$img = imagecreatefromjpeg($caminho);
			imagecopyresampled($new, $img, 0, 0, 0, 0, $w, $h, $ow, $oh);
			imagejpeg($new, $image_path, 100);
		
		} elseif(strpos(strtolower($caminho),".gif")>0){

			$img = imagecreatefromgif($caminho);
			imagecopyresampled($new, $img, 0, 0, 0, 0, $w, $h, $ow, $oh);
			imagegif($new, $image_path, 100);
		
		} elseif(strpos(strtolower($caminho),".png")>0){

			$img = imagecreatefrompng($caminho);
			imagecopyresampled($new, $img, 0, 0, 0, 0, $w, $h, $ow, $oh);
			imagepng($new, $image_path, 100);
		
		}
		// Limpa a memoria
		imagedestroy($new);
		imagedestroy($img);
		
		# lê o arquivo
		readfile($image_path);
	
}	
?>