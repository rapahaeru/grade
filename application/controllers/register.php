<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();

			$this->load->model('User_model','User');
			//$this->load->model('Contact_model', 'Contact');	

	}


	public function index()
	{

		$data['globals_titlePage'] = " Registro";

		$this->load->view('register',$data);

	}


	public function insert(){

		$data['globals_titlePage'] = " Registro";

		//$this->load->helper(array('form'));
		$this->load->library('form_validation');

		/// Regras de validacao do formulario
		$config = array(
		               array(
		                     'field'   => 'name', 
		                     'label'   => 'Nome', 
		                     'rules'   => 'required|trim|xss_clean'
		                  ),
		               array(
		                     'field'   => 'pass', 
		                     'label'   => 'Senha', 
		                     'rules'   => 'required|trim|md5'
		                  ),
		               array(
		                     'field'   => 'repass', 
		                     'label'   => 'Confirme Senha', 
		                     'rules'   => 'trim|required|matches[pass]|md5'
		                  ),   
		               array(
		                     'field'   => 'mail', 
		                     'label'   => 'E-mail', 
		                     'rules'   => 'required|valid_email|is_unique[usr_user.usr_email]'
		                  )
		            );

		/// Efetua a validacao com as regras acima citadas
		$this->form_validation->set_rules($config);

		/// Seta as mensagens de retorno, de acordo com a regra (rule) utilizada
		$this->form_validation->set_message('required', '%s Campo obrigatório');
		$this->form_validation->set_message('matches', 'Senhas divergem');
		$this->form_validation->set_message('is_unique', 'E-mail existente, Tente outro.');

		///Elemento html que abraçará o erro no retorno ao html
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');

		if ($this->form_validation->run() == FALSE) {

			/// NAO PASSOU NA VALIDACAO ////////////////////////////////////////////////////////////
			
			$this->load->view('register',$data);
		
		} else {

			/// PASSOU NA VALIDACAO /////////////////////////////////////////////////////////////////

			$posts = $this->input->post(NULL, TRUE); // returns all POST items with XSS filter 

			//var_dump($posts);
			
			$insertUser = $this->User->save($posts);

			if (!$insertUser){

				$data['ReturnError'] = 'Ocorreu um erro!';

			}

			
			$this->load->view('success',$data);

		}

		

	}
}
