<? // if (!isset($_COOKIE['GRADE_USER_ID']) || $_COOKIE['GRADE_USER_ID'] == '') ir(site_url('/login')); ?>
			<input type="hidden" name="base_url" value="<?=site_url()?>">
			<input type="hidden" name="base_view" value="<?=$this->config->config['base_view']?>">
            <ul id="login">

                <?if (isset($_COOKIE['GRADE_USER_NAME'])) {?>

					<li><i class="icon-user"></i> <a href="#" title="Acessou <?=$_COOKIE['GRADE_USER_NUMBERACCESS']?> vezes e seu último acesso foi em <?=$_COOKIE['GRADE_USER_LASTACCESS']?>"><?=$_COOKIE['GRADE_USER_NAME']?></a> | <a href="<?=site_url('logout')?>">sair</a></li>
					<? //site_url('myprofile')?>
                <?} else {?>
                
	                <li><i class="icon-user"></i> <a href="<?=site_url('register')?>">Cadastre-se</a> | <a href="<?=site_url('login')?>">Logar</a></li>
	                

                <?}?>
            </ul>

			<!-- BOOTSTRAP ::::: MENU COM DROPDOWN  -->
			<div class="navbar">
			  <div class="navbar-inner">
			    <a class="brand" href="#">Grade !</a>
			    <ul class="nav ">
			      <li class="active"><a href="#">Home</a></li>
			      <li class="list">
			      		<a href="#" class="dropdown-toggle" id="listLabel" role="button" data-toggle="dropdown" data-target="#">Lista <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="listLabel">
						    <li><a href="#">Séries</a></li>
						    <li><a href="#">Filmes</a></li>
						    <!-- <li><a href="#">Livros</a></li> -->
						</ul>

			      	</li>

				<? if (isset($_COOKIE['GRADE_USER_ID']) ) : ?>			      	
			      
			      <li  class="rate">
					
					<a  href="#" class="dropdown-toggle"  id="rateLabel" role="button" data-toggle="dropdown" data-target="#">Avalie aqui! <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="rateLabel">
					    <li><a href="<?=site_url('series')?>">Série</a></li>
					    <li><a href="<?=site_url('movies')?>">Filme</a></li>
					    <!-- <li><a href="#">Livros</a></li> -->
					</ul>			      	

			      </li>

			  	<? endif;?>
			    </ul>

				<? if (isset($_COOKIE['GRADE_USER_ID']) ) : ?>
					<!-- BOOTSTRAP ::::: CADASTROS -->
					<div class="btn-group ">
					  <button class="btn btn-action">Cadastre</button>
					  <button class="btn dropdown-toggle btn-info" data-toggle="dropdown">
					    <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
							<li><a href="#">Séries</a></li>
							<li><a href="<?=site_url('movies/insert')?>">Filmes</a></li>
							<!-- <li><a href="#">Livros</a></li> -->
					  </ul>
					</div>
				<? endif;?>	
			  </div>



			</div>
			<!-- BOOTSTRAP ::::: MENU COM DROPDOWN  -->
	