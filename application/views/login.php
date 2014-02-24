<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <? require "incs/includes.php" ; ?>

    </head>
    <body>

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- Add your site or application content here -->

        <header>
            
            <? //require "incs/header.php";?>

<? // if (!isset($_COOKIE['GRADE_USER_ID']) || $_COOKIE['GRADE_USER_ID'] == '') ir(site_url('/login')); ?>

            <ul id="login">

                <?if (isset($_COOKIE['GRADE_USER_NAME'])) {?>

                    <li><i class="icon-user"></i> <a href="<?=site_url('myprofile')?>" title="Acessou <?=$_COOKIE['GRADE_USER_NUMBERACCESS']?> vezes e seu último acesso foi em <?=$_COOKIE['GRADE_USER_LASTACCESS']?>"><?=$_COOKIE['GRADE_USER_NAME']?></a> | <a href="<?=site_url('logout')?>">sair</a></li>

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


                </ul>

              </div>

            </div>
            <!-- BOOTSTRAP ::::: MENU COM DROPDOWN  -->

            
            <ul class="breadcrumb">
                <li><a href="<?=site_url()?>">Home</a> <span class="divider">/</span></li>

                <li class="active">Login</li>
            </ul>
        
        </header>

        <section>

            <? if (isset($mensagem)) { ?>

            <div class="alert alert-error"><?=$mensagem?></div>
            <?}?>
    
            <?=form_open('login/proccess',  array('class' => 'form-horizontal', 'id' => 'login-form')  ); ?>
            
                <fieldset>
                    
                    
                    <div class="control-group">
                        <label class="control-label" for="mail">E-mail</label>
                        <div class="controls">
                            <input type="email" id="mail" name="mail" placeholder="Digite seu e-mail" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pass">Senha</label>
                        <div class="controls">
                            <input type="password" id="pass" name="pass" placeholder="Digite sua senha">
                        </div>
                    </div>                    

                    <button class="btn btn-primary" type="submit">Acesse</button>

                </fieldset>

            </form>


        </section>

        <footer>

            <? require "incs/footer.php";?>

            <script src="<?=$this->config->config['base_view']?>/js/login.js"></script>
        </footer>        
    </body>
</html>
