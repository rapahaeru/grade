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
                <li class="active">Cadastrar um novo filme</li>
            </ul>            

        </header>

        <section>
    
            <div class="returnForm"><?php echo validation_errors(); ?></div>   

            <?=form_open('movie/insert',  array('class' => 'form-horizontal', 'id' => 'movie-form')  ); ?>
            <!-- <form id="register-form" action="" class="form-horizontal"> -->
                <fieldset>


                    <div class="control-group">
                        <label class="control-label" for="animation">Animação</label>
                        <div class="controls">
                            <select name="animation" class="span2" id="animation">
                                
                                <option value="0">Não</option>
                                <option value="1">Sim</option>


                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="vintage">Exibição</label>
                        <div class="controls">
                            <input type="text" id="vintage" name="vintage" placeholder="Data de exibição" class="input-xlarge" value="<?=set_value('vintage')?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="name">Nome do filme</label>
                        <div class="controls">
                            <input type="text" id="name" name="name" placeholder="filme" class="input-xlarge" value="<?=set_value('name')?>">
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="original-name">Nome original do filme</label>
                        <div class="controls">
                            <input type="text" id="original-name" name="original-name" placeholder="Digite seu nome" class="input-xlarge" value="<?=set_value('original-name')?>">
                        </div>
                    </div>                    
  
                    <div class="control-group">
                        <label class="control-label" for="director">Diretor</label>
                        <div class="controls">
                            <input type="text" id="director" name="director" placeholder="Diretor" class="input-xlarge" value="<?=set_value('director')?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="trailer">Trailer (link embed)</label>
                        <div class="controls">
                            <input type="text" id="trailer" name="trailer" placeholder="Trailer" class="input-xlarge" value="<?=set_value('trailer')?>">
                        </div>
                    </div>                    

                    <div class="control-group">
                        <label class="control-label" for="sinopses">Sinopse</label>
                        <div class="controls">
                            <textarea name="sinopses" id="sinopses" class="input-xlarge" rows="10"><?=set_value('sinopses')?></textarea>
                        </div>
                    </div> 

                    <div class="control-group">
                        <label class="control-label" for="moreinfo">Link Extra (IMDB)</label>
                        <div class="controls">
                            <input type="text" id="moreinfo" name="moreinfo" class="input-xlarge" placeholder="Link com informações completas do filme" value="<?=set_value('moreinfo')?>">
                        </div>
                    </div>                       
                   
                    <div class="form-actions">
                        
                        <button class="btn btn-primary" type="submit">Confirma</button>
                        <button type="reset" class="btn btn-danger">Cancela</button>    
                    </div>
                    

                </fieldset>
            </form>    


        </section>

        <footer>

            <? require "incs/footer.php";?>

        </footer>        
    </body>
</html>
