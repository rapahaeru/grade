<?php

class User_model extends CI_Model {


	/// REGISTER :: PROFILE

	function insert($post){

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
