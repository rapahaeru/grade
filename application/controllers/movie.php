<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends CI_Controller {

	public function __construct(){
		parent::__construct();

			$this->load->model('User_model','User');
			//$this->load->model('Contact_model', 'Contact');	

	}


	public function index()	{

		$data['globals_titlePage'] = " Filmes";

		$this->load->view('movie_list',$data);

	}


	public function insert(){
		
		$data['globals_titlePage'] = " Cadastrar novo Filme";

		$this->load->library('form_validation');

		/// Regras de validacao do formulario
		$config = array(
		               array(
		                     'field'   => 'animation', 
		                     'label'   => 'Animação', 
		                     'rules'   => 'required'
		                     //'rules'   => 'required|trim|xss_clean'
		                  ),
		               array(
		                     'field'   => 'vintage', 
		                     'label'   => 'Exibição', 
		                     'rules'   => 'trim|xss_clean'
		                  ),
		               array(
		                     'field'   => 'name', 
		                     'label'   => 'Nome', 
		                     'rules'   => 'trim|required|xss_clean'
		                  ),   
		               array(
		                     'field'   => 'original-name', 
		                     'label'   => 'Nome original', 
		                     'rules'   => 'trim|required|xss_clean'
		                  ),
		               array(
		                     'field'   => 'director', 
		                     'label'   => 'Diretor', 
		                     'rules'   => 'trim|required|xss_clean'
		                  ),
		               array(
		                     'field'   => 'trailer', 
		                     'label'   => 'Trailer', 
		                     'rules'   => 'trim|xss_clean'
		                  ),
		               array(
		                     'field'   => 'sinopses', 
		                     'label'   => 'Sinopse', 
		                     'rules'   => 'trim|xss_clean'
		                  ),
		               array(
		                     'field'   => 'moreinfo', 
		                     'label'   => 'Link Extra', 
		                     'rules'   => 'trim|xss_clean'
		                  )

		            );

		/// Efetua a validacao com as regras acima citadas
		$this->form_validation->set_rules($config);

		/// Seta as mensagens de retorno, de acordo com a regra (rule) utilizada
		$this->form_validation->set_message('required', '%s Campo obrigatório');
		//$this->form_validation->set_message('is_unique', 'E-mail existente, Tente outro.');

		///Elemento html que abraçará o erro no retorno ao html
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');

		if ($this->form_validation->run() == FALSE) {

			/// NAO PASSOU NA VALIDACAO ////////////////////////////////////////////////////////////
			
			$this->load->view('movie_insert',$data);
		
		} else {

			/// PASSOU NA VALIDACAO /////////////////////////////////////////////////////////////////

			//$posts = $this->input->post(NULL, TRUE); // returns all POST items with XSS filter 

			//var_dump($posts);
			
			//$insertUser = $this->User->save($posts);

			// if (!$insertUser){

			// 	$data['ReturnError'] = 'Ocorreu um erro!';

			// }

			
			$this->load->view('success',$data);

		}

		//$this->load->view('movie_insert',$data);

	}

}
