<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();


	}


	public function index()
	{

		$data['globals_titlePage'] = " Registro";

		$this->load->view('register',$data);

	}
}
