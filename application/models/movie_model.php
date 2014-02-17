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

	function save($post,$id = 0){

		if (isset($post['gender']) && $post['gender'] != '' )
			$gender 	= $post['gender'];


		// se existe, retorna ID do diretor
		if ($_POST['director']!= ""){

			$director 	= $this->verifyDirector($_POST['director']);

			if (!$director)
				// retorna o ID do novo diretor inserido
				$director = $this->insertDirector($_POST['director']);			

		}else{
			$director = null;
		}


		
		$array = array(
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



		if ($id != 0){
			
			//////////////////////////////////////////////////////////////////////////////////////////////////
			// UPDATE

			 $this->db->where('mov_id',$id);
			 $this->db->update('mov_movie',$array);
			 $num_mov = $this->db->affected_rows();


			 //echo $q->num_rows();

			$arr_rmg = array();

			//apaga os generos para a inserção de um novo
			$this->db->delete('rmg_moviegender', array('mov_movie_mov_id' => $id));
			
			//insere os generos novos
			for ($i=0; $i < sizeof($gender) ; $i++) { 

				array_push($arr_rmg, array('mov_movie_mov_id' => $id, 'gen_gender_gen_id' => $gender[$i] ) );

			}

			$this->db->insert_batch('rmg_moviegender',$arr_rmg);

			
			return $num_mov;

		}else{

			///////////////////////////////////////////////////////////////////////////////////////////////////
			// INSERT
			//array_push($array, array('mov_status' => 1));
			$array['mov_status'] 		= 1;
			$array['mov_created_id'] 	= $_COOKIE['GRADE_USER_ID'];
			$array['mov_date_insert'] 	= date ("Y-m-d H:i:s");


			// debug($array);
			// exit();
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



	function getMovies($par,$num = 10,$ini = 0,$status = 1){

		/////////////////////////////////////////////////////////////////////////////////////////////////////////
		/// PAR : contém o filtro da busca, por exemplo os filmes inseridos na ultima semana => latest
		/// NUM : Numero rows de retorno
		/// STATUS : De padrão é = 1, ou seja, traz apenas os filmes já aprovados, caso queira os em filma
		/// de espera para aprovacao, setar = 0, caso queira todos, = 'ALL'
		/////////////////////////////////////////////////////////////////////////////////////////////////////////


		$this->db->select('mov_movie.mov_id');
		$this->db->select(',mov_movie.mov_date_insert');
		$this->db->select('mov_movie.mov_vintage');
		$this->db->select('mov_movie.mov_originalname');
		$this->db->select('mov_movie.mov_name');
		$this->db->select('mov_movie.mov_seo');
		//$this->db->select('mov_movie.mov_sinopses');
		$this->db->select('mov_movie.mov_in_animation');
		//$this->db->select('mov_movie.mov_trailer');
		//$this->db->select('mov_movie.mov_moreinfo');
		$this->db->select('mov_movie.mov_poster');
		$this->db->select('mov_movie.mov_average');
		$this->db->select('dir_director.dir_name');
		$this->db->select('dir_director.dir_seo');
		$this->db->select('usr_user.usr_id');
		$this->db->select('usr_user.usr_name');
		$this->db->select('usr_user.usr_email');

		//$this->db->join('rmg_moviegender','rmg_moviegender.mov_movie_mov_id = mov_movie.mov_id','left');
		//$this->db->join('gen_gender','gen_gender.gen_id = rmg_moviegender.gen_gender_gen_id','left');
		$this->db->join('dir_director', 'dir_director.dir_id = mov_movie.dir_director_dir_id', 'left');
		$this->db->join('usr_user','usr_user.usr_id = mov_movie.mov_created_id','inner');

		if ($status != 'ALL')
			$this->db->where('mov_movie.mov_approval',$status);

		if ($par == 'latest'){
			$this->db->order_by('mov_date_insert','DESC');
		
		}
		
		$this->db->limit($num,$ini);
		$this->db->group_by('mov_movie.mov_id');
		$q = $this->db->get('mov_movie');

		//echo $this->db->last_query();

		if ($q->num_rows() > 0){
			return $q->result_object();
		}else{
			return false;
		}


	}

	function getMovieBySeoName($seo){


		$this->db->select('mov_movie.mov_id');
		$this->db->select('mov_movie.mov_created_id');
		$this->db->select('mov_movie.mov_approval');
		$this->db->select('mov_movie.mov_date_insert');
		$this->db->select('mov_movie.mov_vintage');
		$this->db->select('mov_movie.mov_originalname');
		$this->db->select('mov_movie.mov_name');
		$this->db->select('mov_movie.mov_seo');
		$this->db->select('mov_movie.mov_sinopses');
		$this->db->select('mov_movie.mov_in_animation');
		$this->db->select('mov_movie.mov_trailer');
		$this->db->select('mov_movie.mov_moreinfo');
		$this->db->select('mov_movie.mov_poster');
		$this->db->select('mov_movie.mov_average');
		$this->db->select('dir_director.dir_name');
		$this->db->select('dir_director.dir_seo');
		$this->db->select('usr_user.usr_id');
		$this->db->select('usr_user.usr_name');
		$this->db->select('usr_user.usr_email');

		$this->db->join('dir_director', 'dir_director.dir_id = mov_movie.dir_director_dir_id', 'left');
		$this->db->join('usr_user','usr_user.usr_id = mov_movie.mov_created_id','inner');
		// $this->db->join('rmg_moviegender','rmg_moviegender.mov_movie_mov_id = mov_movie.mov_id','left');
		// $this->db->join('mog_moviegrade','mog_moviegrade.mog_id = rmg_moviegender.gen_gender_gen_id','left');
		
		$this->db->where('mov_movie.mov_seo',$seo);
		$this->db->where('mov_movie.mov_status',1);
		//$this->db->order_by('mov_id','DESC');
		$this->db->limit(1);
		$q = $this->db->get('mov_movie');

		if ($q->num_rows() > 0){
			return $q->result_object();
		}else{
			return false;
		}
	}
	

	function getGenderByMovieSeoName($movie_seo){


		$this->db->select('gen_gender.gen_id');
		$this->db->select('gen_gender.gen_name');
		$this->db->select('gen_gender.gen_seo');

		$this->db->join('rmg_moviegender','rmg_moviegender.mov_movie_mov_id = mov_movie.mov_id','left');
		$this->db->join('gen_gender','gen_gender.gen_id = rmg_moviegender.gen_gender_gen_id','left');
		$this->db->where('mov_movie.mov_seo',$movie_seo);
		$this->db->where('mov_movie.mov_status',1);
		$q = $this->db->get('mov_movie');

		if ($q->num_rows() > 0){
			return $q->result_object();
		}else{
			return false;
		}

	}

	function getGenderByMovieid($movie_id){


		$this->db->select('gen_gender.gen_id');
		$this->db->select('gen_gender.gen_name');
		$this->db->select('gen_gender.gen_seo');

		$this->db->join('rmg_moviegender','rmg_moviegender.mov_movie_mov_id = mov_movie.mov_id','left');
		$this->db->join('gen_gender','gen_gender.gen_id = rmg_moviegender.gen_gender_gen_id','left');
		$this->db->where('mov_movie.mov_id',$movie_id);
		//$this->db->where('mov_movie.mov_status',1);
		$q = $this->db->get('mov_movie');

		if ($q->num_rows() > 0){
			return $q->result_object();
		}else{
			return false;
		}

	}


	function getTotalMovies($type = 1){

		//////////////////////////////////////////////////////////////////////////////
		/// TYPE : recebe os parametros ('1' = ativos / '0' = inativos / 'ALL' = todos)
		//////////////////////////////////////////////////////////////////////////////		

		if ($type != 'ALL')
			$this->db->where('mov_approval',$type);

		$q = $this->db->get('mov_movie');

		return $q->num_rows();
	}


	function setMovieApproval ($idMovie){

		$array = array('mov_approval' => 1);

		$this->db->where('mov_id',$idMovie);
		$this->db->update('mov_movie',$array);

		$num_mov = $this->db->affected_rows();
		if ($num_mov > 0){
			return true;
		}else{
			return false;
		}
		
	}

}
