<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Midia {


	function __construct() {

        $this->baseUrl  = config_item('base_url');

    }

	function imageResize($w,$h,$image){
		
	    $url_full = $this->baseUrl.'/midia/imgResize.php?params='.$image.'_._'. $h .'_._'.$w;
	    return $url_full;
     
	}

	function imageCrop($w,$h,$image){

    	$url_full = $this->baseUrl.'/midia/imgCrop.php?params='.$image.'_._'. $h .'_._'.$w;
    	return $url_full;
    }

}


    
   		
?>

