<?php

class Average_model extends CI_Model {


	function getMovieAverageByUser($idUser){
	///////////////////////////////////////
	// ENTRADA : ID DO USUARIO
	// RETORNO : TODOS OS DADOS DE NOTA 
	///////////////////////////////////////

		
		$this->db->where('usr_user_usr_id', $idUser);
		$q = $this->db->get('mog_moviegrade');

		if ($q->num_rows() > 0){

			return $q->result_object();

		}else{

			return false;

		}

	}


	
}
