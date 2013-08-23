<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();

			$this->load->model('User_model','User');
			//$this->load->model('Contact_model', 'Contact');	

	}


	public function index()
	{

		$data['globals_titlePage'] = " Login";

		$this->load->view('login',$data);

	}


	public function proccess() {

		$ano = time()+(24*60*60*365);

		$data['globals_titlePage'] = " Login";

		$posts = $this->input->post(NULL, TRUE); // returns all POST items with XSS filter 


		$returnLogin = $this->User->login($posts);

		if ($returnLogin){

			foreach ($returnLogin as $row) {

				$returnAccess = $this->User->updateAccess($row->usr_id);

				setcookie('GRADE_USER_ID',$row->usr_id,$ano,'/');
				setcookie('GRADE_USER_NAME',$row->usr_name,$ano,'/');
				setcookie('GRADE_USER_EMAIL',$row->usr_email,$ano,'/');
				setcookie('GRADE_USER_LASTACCESS',formatToBrazilDate($row->usr_lastaccess),$ano,'/');

				if ($returnAccess){

					setcookie('GRADE_USER_NUMBERACCESS',$returnAccess['usr_numberaccess'],$ano,'/');
					

				}


			}

			ir(site_url('dashboard'));
			//$this->load->view('dashboard',$data);

		}else{
			
			$data['mensagem'] = "Usuário ou senha inválido.";

			$this->load->view('login',$data);
		
		}



	}

	function logout(){

		$data['globals_titlePage'] = " dashboard";

		setcookie('GRADE_USER_ID',NULL,time()-1000,'/');
		setcookie('GRADE_USER_NAME',NULL,time()-1000,'/');
		setcookie('GRADE_USER_EMAIL',NULL,time()-1000,'/');
		setcookie('GRADE_USER_NUMBERACCESS',NULL,time()-1000,'/');
		setcookie('GRADE_USER_LASTACCESS',NULL,time()-1000,'/');

		ir(site_url('dashboard'));
		//$this->load->view('dashboard',$data);

	}


}
