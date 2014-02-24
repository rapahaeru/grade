<?php

class Gender_model extends CI_Model {

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
	

	
}
