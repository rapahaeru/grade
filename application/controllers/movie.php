<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends CI_Controller {

	public function __construct(){
		parent::__construct();

			$this->load->model('User_model','User');
			$this->load->model('Movie_model','Movie');
			$this->load->model('Average_model','Average');

			$this->load->helper('midia');

			
			//$this->load->model('Contact_model', 'Contact');	

	}


	public function index()	{

		$data['globals_titlePage'] = " Filmes";

		
		if (isset($_COOKIE['GRADE_USER_ID']) && $_COOKIE['GRADE_USER_ID'] != ""){
			
			$UserAdm 			= $this->User->userIsAdm($_COOKIE['GRADE_USER_ID']);
			$data['UserAdm'] 	= $UserAdm;

		}else{
			
			$data['UserAdm'] 	= false;
		
		}


		/////////// :: Biblioteca de paginação :: ///////////////
		$this->load->library('pagination');

		if ($this->uri->segment(3) === FALSE){
		 	$page = 1;
		} else {
			//die ("entrou");
			$page = $this->uri->segment(3);
		}			

		$config['base_url'] 	= base_url('movies/page');
		$config['total_rows'] 	= $this->Movie->getTotalMovies('1'); // ativos
		$config['per_page'] 	= 3; 

		$config["uri_segment"] 			= 3;
		$num_links 						= $config["total_rows"] / $config["per_page"];
    	$config["num_links"] 			= round($num_links);
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= FALSE;

		$this->pagination->initialize($config);

		$datamovies = $this->Movie->getMovies('latest',$config['per_page'],$page);

		if ($datamovies){

			foreach ($datamovies as $row) {
				
				$row->mov_yearvintage = date('Y',strtotime($row->mov_vintage));

			}

			$data['datamovies'] = $datamovies;

		}
			

		$this->load->view('movie_list',$data);

	}


	public function insert(){
		
		$data['globals_titlePage'] = " Cadastrar novo Filme";

		/// GENERO //////////////////////////////////////

		$genderList = $this->Movie->getAllGenders();
		
		if ($genderList)
			$data['genders'] = $genderList;

		/// FIM GENERO //////////////////////////////////////

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
		                     'rules'   => 'trim|required|xss_clean'
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

			$posts = $this->input->post(NULL, TRUE); // returns all POST items with XSS filter 

			// ADICIONA A ARRAY OS VALORES DO SELECT (GENERO)
			if (isset($_POST['gender']) && $_POST['gender'] != '' )
				array_push($posts, $_POST['gender']);
			
			$insertMovie = $this->Movie->save($posts);

			 if (!$insertMovie){

			 	$data['ReturnError'] = '<strong>Erro</strong> Houve uma falha na inserção!';

			 }

			
			$this->load->view('success',$data);

		}

		//$this->load->view('movie_insert',$data);

	}

	function ajaxdirectors(){
		///////////////////////////////////////////////
		// Utilizada em views/movie_insert.php
		// Retorna o nome dos diretores dos filmes
		// Ajax autocomplete
		///////////////////////////////////////////////

		

		if ($_GET['term']){

			//echo $_GET['term'];

			$return = $this->Movie->returnDirectorsByAutocompleteName($_GET['term']);

			//var_dump($return);

			if ($return){

				//var_dump($return);

				echo json_encode($return);

			}

		}

		

	}

	// UPLOAD DE IMAGEM VIA AJAX PELO PLUPLOAD
	function poster(){

		$config['upload_path'] 		= $GLOBALS['physical_path_movieposter']; //variavel em index.php
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['file_name'] 		= md5(date('Ymdhis',time()));
		//$config['max_size']			= '10000';
		// $config['max_width']  = '1024';
		// $config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('poster_file'))
		{
			$error = array('error' => $this->upload->display_errors());

			echo json_encode($error);
		}
		else
		{
			$name 	= $this->upload->data();

			$data 	= array(
						'name' 			=> $name['file_name'],
						'client_name' 	=> $name['client_name'],
						'width'			=> $name['image_width'],
						'height'		=> $name['image_height'],
						'path' 			=> site_url() . 'posters/movies/',
						'fullpath' 		=> site_url() . 'posters/movies/' . $name['file_name']);
			
			echo json_encode($data);
		}

	}

	// PARTE SERVER SIDE DE CROPAR IMAGEM ENVIADA PELO JCROP
	function posterCrop(){

		$targ_w = $targ_h = 140; // medida da imagem
		$quality = 90; 

		// caminho fisico da imagem
		$fullPhysicalPath 	= $GLOBALS['physical_path_movieposter'] . "/thumbs/" . $_POST['name'];
		// caminho http
		$fullThumbPath 			= $GLOBALS['domain'] . $GLOBALS['base_path'] . $GLOBALS['movies_image_folder'] . "/thumbs/" . $_POST['name'];

		//caminho completo da imagem original
		$src 		= $_POST['src'];

		 // prepara a imagem
		 if(strpos(strtolower($src),".jpg")>0 || strpos(strtolower($src),".jpeg")>0){
		 	$img_r 		= imagecreatefromjpeg($src);
		} else if (strpos(strtolower($src),".gif")>0){
			$img_r 		= imagecreatefromgif($src);
		}else if(strpos(strtolower($src),".png")>0) {
			$img_r 		= imagecreatefrompng($src);
		}

		// cria a imagem
		$dst_r 		= ImageCreateTrueColor( $targ_w, $targ_h );

		// faz uma copia dlea na memoria
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);

		//header('Content-type: image/jpeg');

		// grava nova imagem
		 if(strpos(strtolower($src),".jpg")>0 || strpos(strtolower($src),".jpeg")>0){
		 	imagejpeg($dst_r,$fullPhysicalPath,$quality);
		} else if (strpos(strtolower($src),".gif")>0){
			imagegif($dst_r,$fullPhysicalPath,$quality);
		}else if(strpos(strtolower($src),".png")>0) {
			imagepng($dst_r,$fullPhysicalPath,0);
		}		

		$array = array('fullPath' => $fullThumbPath);
		
		echo json_encode($array);
		


	}


	function profile(){
		if ($this->uri->segment(3) != ""){

			
			$data['midia'] = new Midia();

			//echo $midia->baseView;
			//echo $midia->imageResize(1,2,3);

			$movie_seo = $this->uri->segment(3);
			
			/// DADOS DO FILME
			$returnMovieProfile = $this->Movie->getMovieBySeoName($movie_seo);

			//debug($returnMovieProfile);
			

			if ($returnMovieProfile){
			
				foreach ($returnMovieProfile as $key) {

					$key->mov_vintage = returnYearFromDate($key->mov_vintage);
					
				}
				$data['profile'] = $returnMovieProfile;
			
			}else{

				ir(site_url("movies"));
			}

			///GENEROS DO FILME
			$returnMovieGender = $this->Movie->getGenderByMovieSeoName($movie_seo);
			if ($returnMovieGender)
				$data['gender'] = $returnMovieGender;
			
			
			// AVERAGE
			if (isset($_COOKIE['GRADE_USER_ID']) && $_COOKIE['GRADE_USER_ID'] > 0){
				
				$returnMovieGrade = $this->Average->getMovieAverageByUser($_COOKIE['GRADE_USER_ID']);
				if ($returnMovieGrade)
					$data['averageData'] = $returnMovieGrade;
				else
					$data['averageData'] = "no-average";
			
			}else{

				$data['averageData'] = "no-user";

			}
				
			//debug($data['averageData']);

			$data['globals_titlePage'] = $returnMovieProfile[0]->mov_name;

			$this->load->view('movie_profile',$data);


		}else{

			ir(site_url('movies'));

		}


	}


	function infoUpdate(){

		if ($this->uri->segment(3) != "" && isset($_COOKIE['GRADE_USER_ID']) && $_COOKIE['GRADE_USER_ID'] != ""){

			$data['midia'] = new Midia();

			if (isset($_COOKIE['GRADE_USER_ID']) && $_COOKIE['GRADE_USER_ID'] != ""){
				
				$UserAdm 			= $this->User->userIsAdm($_COOKIE['GRADE_USER_ID']);
				$data['UserAdm'] 	= $UserAdm;

			}else{
				
				$data['UserAdm'] 	= false;
			
			}

			if (!$UserAdm)
				ir(site_url("movies"));

			$movieName = $this->uri->segment(3);

			$data['globals_titlePage'] = " Update : ". $movieName;

			$MovieData = $this->Movie->getMovieBySeoName($movieName);

			if ($MovieData)
				$data['movieData'] = $MovieData;
			else 
				ir(site_url("movies"));
			
			//debug($MovieData);


			/// GENERO //////////////////////////////////////

			$genderList = $this->Movie->getAllGenders();
			
			if ($genderList)
				$data['genders'] = $genderList;

			foreach ($MovieData as $value) {
				$genderMovie 	= 	$this->Movie->getGenderByMovieid($value->mov_id);
				$approvalMovie 	= $value->mov_approval;
			}

			/////////////////////////////////////////////
			// FILME APROVADO OU EM ESPERA DE APROVACAO
			if ($approvalMovie == 0)
				$data['needApproval'] = true;
			else
				$data['needApproval'] = false;
			/////////////////////////////////////////////

			if ($genderMovie)
				$data['genderMovie'] = $genderMovie;
			
			/////////////////////////////////////////////////////////////
			// Na view, já chega com a listagem dos generos pertencentes
			// fo filme, marcados como "selected = true"
			foreach ($genderList as $key) {
				
				foreach ($genderMovie as $key2) {
					
					if ($key->gen_id == $key2->gen_id){
						$key->selected = true;
					}

				}

			}
			//////////////////////////////////////////////////////////////

			/// FIM GENERO //////////////////////////////////////

			$this->load->view('movie_update',$data);

		}

	}

	function update(){

		if ($this->uri->segment(3) != "" && isset($_COOKIE['GRADE_USER_ID']) && $_COOKIE['GRADE_USER_ID'] != ""){

			$data['midia'] = new Midia();

			$movieName = $this->uri->segment(3);

			$UserLevel = $this->User->userIsAdm($_COOKIE['GRADE_USER_ID']);

			if (!$UserLevel)
				ir(site_url("movies"));


			$data['globals_titlePage'] = " Update : ". $movieName;

			$MovieData = $this->Movie->getMovieBySeoName($movieName);

			if ($MovieData)
				$data['movieData'] = $MovieData;
			
			//debug($MovieData);


			/// GENERO //////////////////////////////////////

			$genderList = $this->Movie->getAllGenders();
			
			if ($genderList)
				$data['genders'] = $genderList;

			foreach ($MovieData as $value) {
				$genderMovie = 	$this->Movie->getGenderByMovieid($value->mov_id);
			}

			if ($genderMovie)
				$data['genderMovie'] = $genderMovie;
			
			/////////////////////////////////////////////////////////////
			// Na view, já chega com a listagem dos generos pertencentes
			// fo filme, marcados como "selected = true"
			foreach ($genderList as $key) {
				
				foreach ($genderMovie as $key2) {
					
					if ($key->gen_id == $key2->gen_id){
						$key->selected = true;
					}

				}

			}
			//////////////////////////////////////////////////////////////

			/// FIM GENERO //////////////////////////////////////

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
			                     'rules'   => 'trim|required|xss_clean'
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
				
				$this->load->view('movie_update',$data);
			
			} else {

				/// PASSOU NA VALIDACAO /////////////////////////////////////////////////////////////////

				$posts = $this->input->post(NULL, TRUE); // returns all POST items with XSS filter 

				// ADICIONA A ARRAY OS VALORES DO SELECT (GENERO)
				if (isset($_POST['gender']) && $_POST['gender'] != '' )
					array_push($posts, $_POST['gender']);
				
				//debug($posts);

				$updateMovieData = $this->Movie->save($posts,$_POST['mov_id']);
				debug($updateMovieData);

				 // if (!$insertMovie){

				 // 	$data['ReturnError'] = '<strong>Erro</strong> Houve uma falha na inserção!';

				 // }

				
				$this->load->view('success',$data);

			}

		}


	}


	function approval(){

		$data['globals_titlePage'] = " Filmes a serem aprovados";

		if (isset($_COOKIE['GRADE_USER_ID']) && $_COOKIE['GRADE_USER_ID'] != ""){
			
			$UserAdm 			= $this->User->userIsAdm($_COOKIE['GRADE_USER_ID']);
			$data['UserAdm'] 	= $UserAdm;

		}else{
			
			$data['UserAdm'] 	= false;
		
		}
		

		$UserAdm = $this->User->userIsAdm($_COOKIE['GRADE_USER_ID']);

		if (!$UserAdm)
			ir(site_url("movies"));

		

		/////////// :: Biblioteca de paginação :: ///////////////
		$this->load->library('pagination');

		if ($this->uri->segment(4) === FALSE){
		 	$page = 1;
		} else {
			//die ("entrou");
			$page = $this->uri->segment(4);
		}			

		$config['base_url'] 	= base_url('movies/approval/page');
		$config['total_rows'] 	= $this->Movie->getTotalMovies('1'); // ativos
		$config['per_page'] 	= 3; 

		$config["uri_segment"] 			= 4;
		$num_links 						= $config["total_rows"] / $config["per_page"];
    	$config["num_links"] 			= round($num_links);
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= FALSE;

		$this->pagination->initialize($config);

		$datamovies = $this->Movie->getMovies('latest',$config['per_page'],$page,'0');

		if ($datamovies){

			foreach ($datamovies as $row) {
				
				$row->mov_yearvintage = date('Y',strtotime($row->mov_vintage));

			}

			$data['datamovies'] = $datamovies;

		}
			

		$this->load->view('movie_list',$data);

	}


}
