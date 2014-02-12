<?php

# caminho físico do arquivo 
ini_set('display_errors',1);
//$imgPath = '/var/www/dev/cmsv02/application/views/imagens_upload\\';	
$imgPath = '/home/cael/public_html/grade/posters/movies/';	


#explode os parametros enviados
$tmp		= explode("_._",$_GET["params"]);

#caminho fisico onde a imagem está no momento
$caminho	= trim($imgPath).$tmp[0];

# cria a pasta de cache
$cache 		= trim($imgPath).'cache/';

#caminho final 
$image_path = $cache.'cropped'.$tmp[2].'_'.$tmp[1].'_'.$tmp[0];
	

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
	$nw = $tmp[2]; $nh = $tmp[1];
		
	if(strpos(strtolower($caminho),".jpg")>0 || strpos(strtolower($caminho),".jpeg")>0){
		
		$original	= imagecreatefromjpeg($caminho);
	
	} elseif(strpos(strtolower($caminho),".gif")>0){
	
		$original	= imagecreatefromgif($caminho);
	
	} elseif(strpos(strtolower($caminho),".png")>0){
	
		$original	= imagecreatefrompng($caminho);
	
	}

	list($w, $h) = getimagesize($caminho);
	
	$ch = $h; $cw = $w;
	
	// Descobre a constante para proporcao do CROP
	if($nw==$nh) {
		if($w>$h) {
			$ch = $h;
			$cw = $h;
		} else {
			$cw = $w;
			$ch = $w;
		}
	} elseif($nw>$nh) {
		$k = $nw/$nh;
		if($w>$h) {
			$ch = $cw/$k;
		} else {
			$cw = $w;
			$ch = $cw/$k;
		}
	} else {
		$k = $nh/$nw;
		if($h>$w) {
			$cw = $ch/$k;
		} else {
			$ch = $h;
			$cw = $ch/$k;
		}	
	}

	if($ch>$h) {
		$cw = $h*$cw/$ch;
		$ch = $h;
	}
	
	$crop		= imagecreatetruecolor($cw,$ch);
	$thumb		= imagecreatetruecolor($nw,$nh);

	// CROP
	imagecopy($crop,$original, 0, 0, 0, 0, $w, $h);
	imagecopyresampled($thumb, $crop, 0, 0, 0, 0, $nw, $nh, $cw, $ch);
	
	if(strpos(strtolower($caminho),".jpg")>0 || strpos(strtolower($caminho),".jpeg")>0){
		
		imagejpeg($thumb, $image_path, 100);
		
	} elseif(strpos(strtolower($caminho),".gif")>0){

		imagegif($thumb, $image_path, 100);
		
	} elseif(strpos(strtolower($caminho),".png")>0){
		
		imagepng($thumb, $image_path);
		
	}
	
	// Limpa a memoria
	imagedestroy($original);
	imagedestroy($crop);
	imagedestroy($thumb);
	
	readfile($image_path);
}
?>

