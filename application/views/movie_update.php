<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <? require "incs/includes.php" ; ?>

        <link rel="stylesheet" href="<?=$this->config->config['base_view']?>/css/jquery.ui/jquery-ui-1.10.0.custom.css" />
        <link rel="stylesheet" href="<?=$this->config->config['base_view']?>/bootstrap/css/datepicker.css">
        <link rel="stylesheet" href="<?=$this->config->config['base_view']?>/css/jcrop/jquery.Jcrop.min.css">

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

                <? if (isset($needApproval) && $needApproval === true) :?>
                    <li><a href="<?=site_url("movies/approval")?>">Lista de filmes a serem aprovados</a> <span class="divider">/</span></li>
                <?else :?>
                    <li><a href="<?=site_url("movies")?>">Lista de filmes</a> <span class="divider">/</span></li>
                <?endif;?>

                <li class="active">Editar dados do filme</li>
            </ul>            

        </header>
        <? if (isset($needApproval) && $needApproval === true) :?>
            <section>
                <p class="informative">Filme na lista de aprovação, <a href="#approval-modal" data-toggle="modal" title="Aprovar este filme!">aprovar</a> ?</p>
            </section>
        <?endif;?>

        <section>
    
            <div class="returnForm"><?php echo validation_errors(); ?></div>   

            <?=form_open('movie/update/' . $this->uri->segment(3),  array('class' => 'form-horizontal', 'id' => 'movie-form')  ); ?>
            <!-- <form id="register-form" action="" class="form-horizontal"> -->
                <fieldset>

                    <? foreach ($movieData as $val) : ?>

                        <div class="control-group">
                            <label class="control-label" for="poster">Poster</label>
                            <div class="controls">
                                <div id="container">
                                    <a href="#" id="poster"><img src="<?=(($val->mov_poster != "") ? $midia->imageCrop('140','140',$val->mov_poster) : "" )?>" class="img-polaroid poster-movie" alt="" width="140" height="140"></a>
                                    <input type="hidden" name="poster" id="poster-name">
                                </div>
                                <div id="crop-group">
                                    <i class="icon-edit"></i>
                                    <a href="#cropModal" id="crop-image-link" data-toggle="modal">Ajustar imagem</a>
                                </div>

                            </div>
                        </div>
                        
                       <div class="control-group">
                            <label class="control-label" for="animation">Animação</label>
                            <div class="controls">
                                <select name="animation" class="span2" id="animation">
                                   
                                    <option value="0" <?=(($val->mov_in_animation == '0') ? 'selected' : '')?> >Não</option>
                                    <option value="1" <?=(($val->mov_in_animation == '1') ? 'selected' : '')?> >Sim</option>


                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="vintage">Exibição</label>
                            <div class="controls">
                                <input type="text" id="vintage" name="vintage" placeholder="Data de exibição" class="input-xlarge" value="<?=(($val->mov_vintage != "") ? formatToBrazilDate($val->mov_vintage) : set_value('vintage') )?>">
                                <span class="add-on">
                                    <i class="icon-calendar"></i>
                                </span>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="name">Nome do filme</label>
                            <div class="controls">
                                <input type="text" id="name" name="name" placeholder="filme" class="input-xlarge" value="<?=(($val->mov_name != "") ? $val->mov_name : set_value('name') )?>">
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="original-name">Nome original do filme</label>
                            <div class="controls">
                                <input type="text" id="original-name" name="original-name" placeholder="Digite seu nome" class="input-xlarge" value="<?=(($val->mov_originalname != "") ? $val->mov_originalname : set_value('original-name') )?>">
                            </div>
                        </div>                    
      
                        <div class="control-group">
                            <label class="control-label" for="director">Diretor</label>
                            <div class="controls">
                                <input type="text" id="director" name="director" placeholder="Diretor" class="input-xlarge" value="<?=(($val->dir_name != "") ? $val->dir_name : set_value('director') )?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="trailer">Trailer (link embed)</label>
                            <div class="controls">
                                <input type="text" id="trailer" name="trailer" placeholder="Trailer" class="input-xlarge" value="<?=(($val->mov_trailer != "") ? $val->mov_trailer : set_value('trailer') )?>">
                            </div>
                        </div>                    

                        <div class="control-group">
                            <label class="control-label" for="sinopses">Sinopse</label>
                            <div class="controls">
                                <textarea name="sinopses" id="sinopses" class="input-xlarge" rows="10"><?=(($val->mov_sinopses != "") ? $val->mov_sinopses : set_value('sinopses') )?></textarea>
                            </div>
                        </div> 

                        <div class="control-group">
                            <label class="control-label" for="moreinfo">Link Extra (IMDB)</label>
                            <div class="controls">
                                <input type="text" id="moreinfo" name="moreinfo" class="input-xlarge" placeholder="Link com informações completas do filme" value="<?=(($val->mov_moreinfo != "") ? $val->mov_moreinfo : set_value('moreinfo') )?>">
                            </div>
                        </div> 


                        <div class="control-group">
                            <label class="control-label" for="gender">Genero</label>
                            <div class="controls">
                                <select name="gender[]" class="span4" id="gender" multiple="multiple">
                                    <?
                                    foreach ($genders as $row) : ?>                                   
                                            
                                        <option value="<?=$row->gen_id?>" <?=((isset($row->selected) && $row->selected === true ) ? 'selected' :'' )?> ><?=$row->gen_name?></option>    
                                        
                                    <? endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="mov_id" value="<?=$val->mov_id?>">

                    <? endforeach;?>                   
                    <div class="form-actions">
                        
                        <button class="btn btn-primary" type="submit">Confirma</button>
                        <button type="reset" class="btn btn-danger">Cancela</button>    
                    </div>
                    

                </fieldset>
            </form> 


            <!-- AREA MODAL PRO UPLOAD DE IMAGEM -->
             <div id="imageModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="imageModalLabel">Enviando imagem ...</h3>
              </div>
              <div class="modal-body">
                <div id="image-bar" class="progress">
                    <div class="bar" style="width: 0%;"></div>
                </div>
              </div>
            </div>
            <!-- FIM AREA MODAL -->            

            <!-- AREA MODAL PARA RETORNO DE ERRO NO UPLOAD DE IMAGEM -->
             <div id="errorModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="imageModalLabel">Erro</h3>
              </div>
              <div class="modal-body">
                <p id="return-error" class="text-error"></p>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
              </div>
            </div>
            <!-- FIM AREA MODAL -->

            <!-- AREA MODAL PARA CROP -->
             <div id="cropModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="imageModalLabel">Ajuste de imagem</h3>
              </div>
              <div class="modal-body">
                <img id="image-crop-target" src="" class="img-polaroid poster-movie" width="140" height="140">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
                <button class="btn btn-inverse" id="crop-image">Crop!</button>
              </div>
            </div>
            <!-- FIM AREA MODAL -->            

            <!-- MODAL CONFIRMA APROVACAO -->
            <div id="approval-modal" class="modal hide fade">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Confirmação</h3>
              </div>
              <div class="modal-body">
                <p>Confirma a aprovação deste filme ?</p>
              </div>
              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Não, desisto!</a>
                <a href="#" class="btn btn-primary approval-confirm">Sim</a>
              </div>
            </div>
            <!-- FIM MODAL CONFIRMA APROVACAO -->

        </section>

        <footer>

            <? require "incs/footer.php";?>


        <script src="<?=$this->config->config['base_view']?>/js/jquery.ui/jquery-ui-1.10.0.custom.min.js"></script>        
        <script src="<?=$this->config->config['base_view']?>/js/plupload/plupload.full.js"></script>        
        <script src="<?=$this->config->config['base_view']?>/js/jcrop/jquery.Jcrop.min.js"></script>
        <script src="<?=$this->config->config['base_view']?>/js/jcrop/jquery.color.js"></script>
        <!-- script src="<?=$this->config->config['base_view']?>/bootstrap/js/bootstrap-datepicker.js"></script -->

        <script src="<?=$this->config->config['base_view']?>/js/movie/update.js"></script>
        </footer>        
    </body>
</html>
