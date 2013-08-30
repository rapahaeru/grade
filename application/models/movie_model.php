<?php

class Movie_model extends CI_Model {


	function getAllGenders(){

		//////////////////////////////////////
		/// Retorna todos os generos
		/////////////////////////////////////

		$this->db->select('gen_id');
		$this->db->select('gen_name');
		$this->db->select('gen_seo');
		$this->db->where('gen_status',1);
		$q = $this->db->get('gen_gender');

		if ($q->num_rows() > 0 ){

			return $q->result_object();

		}else{
			
			return false;
		
		}



	}

	/// REGISTER :: PROFILE

	function save($post){

		if (isset($post['gender']) && $post['gender'] != '' )
			$gender 	= $post['gender'];

		// se existe, retorna ID do diretor
		$director 	= $this->verifyDirector($_POST['director']);

		if (!$director)
			// retorna o ID do novo diretor inserido
			$director = $this->insertDirector($_POST['director']);

		$array = array(
						'mov_status' 			=> 1,
						'mov_created_id'		=> $_COOKIE['GRADE_USER_ID'],
						'mov_date_insert' 		=> date ("Y-m-d H:i:s"),
						'mov_updated_id'		=> $_COOKIE['GRADE_USER_ID'],
						'mov_date_update' 		=> date ("Y-m-d H:i:s"),
						'mov_name' 				=> $post['name'],
						'mov_vintage'			=> formatToSystemDate($post['vintage']),
						'mov_originalname'		=> $post['original-name'],
						'mov_name'				=> $post['name'],
						'mov_seo'				=> stringToURI($post['original-name']),
						'mov_sinopses'			=> $post['sinopses'],
						'mov_in_animation'		=> $post['animation'],
						'mov_trailer'			=> $post['trailer'],
						'mov_moreinfo'			=> $post['moreinfo'],
						'mov_poster'			=> $post['poster'],
						'dir_director_dir_id'	=> $director,
						
					  );		

		
		 $this->db->insert('mov_movie',$array);
		 $movieId = $this->db->insert_id();

		if ( $movieId != '' ){

				$arr_rmg = array();

					for ($i=0; $i < sizeof($gender) ; $i++) { 

						array_push($arr_rmg, array('mov_movie_mov_id' => $movieId, 'gen_gender_gen_id' => $gender[$i] ) );

					}


				$this->db->insert_batch('rmg_moviegender',$arr_rmg);

				return $movieId;	

		}else{
			
		 	return FALSE;

		}


	}


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

			return $q->result_object('dir_id');

		}else{

			return false;
		}

	}

	function insertDirector($director){

		///////////////////////////////////////////////////////////////
		/// INSERE UM NOVO DIRETOR E RETORNA SUA ID
		///////////////////////////////////////////////////////////////
-
		$arr['dir_name'] 	= $director;
		$arr['dir_seo'] 	= stringToURI($director);
		$arr['dir_status']	= 1;

		//$arr = array('dir_name'	=> $director,'dir_seo' => stringToURI($director), 'dir_status'=> 1);

		$this->db->insert('dir_director', $arr);
		$director_id = $this->db->insert_id();

		return $director_id;


	}

	
}
