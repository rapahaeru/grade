<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();


	}


	public function index()
	{

		$data['globals_titlePage'] = " Dashboard";
		$this->load->view('dashboard',$data);

	}
}
