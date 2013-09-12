<?php

class User_model extends CI_Model {


	/// REGISTER :: PROFILE

	function save($post, $id = 0){

		if ($id != 0){
			//////////// :: UPDATE :: ////////////////////////////////////////

			$array = array(
							'usr_date_update' 		=> date ("Y-m-d H:i:s"),
							'usr_name' 				=> $post['name'],
						  );				

			if ($post['pass'] != 0){

				array_push($array, array('usr_pass' => $post['pass']));

			}

			$this->db->where('usr_id',$id);
			$this->db->update('usr_user',$array);

			if ($this->db->affected_rows() > 0){
				$ano = time()+(24*60*60*365);
				//setcookie('GRADE_USER_NAME',$post['name'],0,'/');
				setcookie('GRADE_USER_NAME',$post['name'],$ano,'/');
				return true;
			}else{
				return false;	
			}
	

		}else{
			//////////// :: INSERT :: ////////////////////////////////////////

			$array = array(
							'usr_date_insert' 		=> date ("Y-m-d H:i:s"),
							'usr_date_update' 		=> date ("Y-m-d H:i:s"),
							'usr_name' 				=> $post['name'],
							'usr_pass' 				=> $post['pass'],
							'usr_email' 			=> $post['mail'],
							'usr_status' 			=> 1
						  );		

			$this->db->insert('usr_user',$array);
			$userId = $this->db->insert_id();

			if ( $userId != '' ){
			
				return $userId;
				
			}else{
				
				return FALSE;
			}			

		}




	}


	function login($arr_posts){

		$this->db->select('usr_id');
		$this->db->select('usr_name');
		$this->db->select('usr_email');
		$this->db->select('usr_numberaccess');
		$this->db->select('usr_lastaccess');

		$this->db->where('usr_email',trim($arr_posts['mail']) );
		$this->db->where('usr_pass',md5($arr_posts['pass']));			


		$q = $this->db->get('usr_user');

		if ($q->num_rows() > 0){

			return $q->result_object();

		}else{

			return FALSE;
		}

	}

	function updateAccess($user_id){

		//echo $user_id;

		$this->db->select('usr_numberaccess');
		$this->db->select('usr_lastaccess');

		$this->db->where('usr_id', $user_id);

		$q = $this->db->get('usr_user');

		if ($q->num_rows() > 0){

			$returnUserData 	= $q->result_array();
			$numberAccessTotal 	= $returnUserData[0]['usr_numberaccess'] + 1;

			$array = array('usr_lastaccess' => date("Y-m-d H:i:s"), 'usr_numberaccess' => $numberAccessTotal);

			$this->db->where('usr_id',$user_id);
			$this->db->update('usr_user',$array);

			return $array;
			

		}else{

			return FALSE;

		}

	}


	function ReturnMyProfileById($user_id){

		$this->db->select('usr_name');
		$this->db->select('usr_email');
		$this->db->where('usr_id',$user_id);
		$q = $this->db->get('usr_user');

		if ($q->num_rows() > 0){
			return $q->result_object();
		}else{
			return false;
		}

	}

	
}
