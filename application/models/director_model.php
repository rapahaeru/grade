<?php

class Director_model extends CI_Model {


	function returnDirectorsByAutocompleteName($chars){

		////////////////////////////////////////////////////////////////////
		/// Retorna os Diretores pelo autocomplete do formulario de filmes
		////////////////////////////////////////////////////////////////////

		$this->db->select('dir_id as value');
		$this->db->select('dir_name as label');
		$this->db->like('dir_name',$chars,'both');
		$this->db->limit(20);
		$q = $this->db->get('dir_director');
		//echo $this->db->last_query();
		if($q->num_rows() > 0){

			return $q->result_object();

		}else{

			return false;
		}

	}

	function verifyDirector($directorName){

		////////////////////////////////////////////////////////////////
		/// VERIFICA SE O DIRETOR JA EXISTE, SE SIM, RETORNA SEU ID
		/// SE ÑAO, RETORNA FALSE
		////////////////////////////////////////////////////////////////

		$this->db->select('dir_id');
		$this->db->where('dir_seo',stringToURI($directorName));
		$q = $this->db->get('dir_director');

		//echo $this->db->last_query();

		if ($q->num_rows() > 0){

			//echo $q->result_object('dir_id');
			foreach ($q->result_object() as $value) {
				$dir_id = $value->dir_id;
			}

			return $dir_id;

		}else{

			return false;
		}			

	}

	function insertDirector($director){

		///////////////////////////////////////////////////////////////
		/// INSERE UM NOVO DIRETOR E RETORNA SUA ID
		///////////////////////////////////////////////////////////////

		$arr['dir_name'] 	= $director;
		$arr['dir_seo'] 	= stringToURI($director);
		$arr['dir_status']	= 1;

		//$arr = array('dir_name'	=> $director,'dir_seo' => stringToURI($director), 'dir_status'=> 1);

		$this->db->insert('dir_director', $arr);
		///echo $this->db->last_query();
		$director_id = $this->db->insert_id();

		return $director_id;	

	}

	
}
