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
            
            <? require "incs/header.php";?>

            <ul class="breadcrumb">
                <li><a href="<?=site_url()?>">Home</a> <span class="divider">/</span></li>
                <!-- <li><a href="#">Library</a> <span class="divider">/</span></li> -->
                <li class="active">Meu profile</li>
            </ul>

        </header>



        <section>

            <div class="returnForm"><?php echo validation_errors(); ?></div>   

            <?=form_open('profile/update',  array('class' => 'form-horizontal', 'id' => 'update-profile')  ); ?>
            <!-- <form id="register-form" action="" class="form-horizontal"> -->
                <fieldset>
                    <!-- <legend> Preencha o formulário de cadastro </legend> -->
                    <div class="control-group">
                        <label class="control-label" for="inputName">Nome</label>
                        <div class="controls">
                            <input type="text" id="name" name="name" placeholder="Digite seu nome" class="input-xlarge" value="<?=((isset($name) && $name != '') ? $name : '' )?>">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="mail">E-mail</label>
                        <div class="controls">
                            <input type="email" id="mail" name="mail" class="input-xlarge" value="<?=((isset($mail) && $mail != '') ? $mail : '' )?>" disabled>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="pass">Senha</label>
                        <div class="controls">
                            <input type="password" id="pass" class="input-xlarge" name="pass" placeholder="Atualize sua senha">
                        </div>
                    </div>
                  
                    <div class="form-actions">
                        
                        <button type="reset" class="btn btn-danger">Cancel</button>
                        <button class="btn btn-primary" type="submit">Confirma</button>

                    </div>
                    

                </fieldset>
            </form>
            

        </section>

        <footer>

            <? require "incs/footer.php";?>

        </footer>        
    </body>
</html>
