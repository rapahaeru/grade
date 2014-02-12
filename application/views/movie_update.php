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
                <!-- <li><a href="#">Library</a> <span class="divider">/</span></li> -->
                <li class="active">Editar dados do filme</li>
            </ul>            

        </header>
        <? if (isset($needApproval) && $needApproval === false) :?>
            <section>
                <p class="informative">Filme na lista de aprovação, <a href="#">aprovar</a> ?</p>
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


        </section>

        <footer>

            <? require "incs/footer.php";?>


        <script src="<?=$this->config->config['base_view']?>/js/jquery.ui/jquery-ui-1.10.0.custom.min.js"></script>        
        <script src="<?=$this->config->config['base_view']?>/js/plupload/plupload.full.js"></script>        
        <script src="<?=$this->config->config['base_view']?>/js/jcrop/jquery.Jcrop.min.js"></script>
        <script src="<?=$this->config->config['base_view']?>/js/jcrop/jquery.color.js"></script>
        <!-- script src="<?=$this->config->config['base_view']?>/bootstrap/js/bootstrap-datepicker.js"></script -->


        <script>

            var base_url = $('input[name=base_url]').val();
            var base_view = $('input[name=base_view]').val();

            /// DATEPICKER /////////////////////////////////////////////////////////////

            $("#vintage").datepicker({

                 dateFormat : "dd/mm/yy"
                
            });
            
            /// AUTOCOMPLETE DIRECTOR //////////////////////////////////////////////////////////
            $( "#director" ).autocomplete({
              source: base_url + "movies/ajaxdirectors",
              minLength: 2,
               select: function( event, ui ) {
                 $( "#director" ).val( ui.item.label );
              //   $( "#director" ).val( ui.item.value );
              //   $( "#project-description" ).html( ui.item.desc );
              //   $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
         
                 return false;
               }

            });


            /// PLUPLOAD DO POSTER ////////////////////////////////////////////////////////////

            $(function() {


                var uploader = new plupload.Uploader({
                    runtimes : 'gears,html5,flash,silverlight,browserplus',
                    file_data_name: 'poster_file', //nome do arquivo que ira pro server side
                    browse_button : 'poster', //de onde será acionado o upload
                    container : 'container',
                    max_file_size : '2mb',
                    url : base_url + '/movie/poster',
                    flash_swf_url : base_view + '/js/plupload.flash.swf',
                    silverlight_xap_url : base_view + '/js/plupload.silverlight.xap',
                    filters : [
                        {title : "Image files", extensions : "jpg,gif,png"},
                        {title : "Zip files", extensions : "zip"}
                    ],
                    //resize : {width : 320, height : 240, quality : 90}
                    init :{
                        FileUploaded: function(up, file, info) {
                        // Chamado quando termina o upload do arquivo

                           var obj = jQuery.parseJSON(info.response);
                           //console.log('nome : ' + obj.name);
                           $('#poster-name').val(obj.name);
                           $('.poster-movie').attr('src',obj.fullpath);

                            //$('#image-crop-target').attr('style','display: none; visibility: hidden; width: ' + obj.width + 'px;height: ' + obj.height + 'px;');

                            $('#image-crop-target').attr('width',obj.width).attr('height',obj.height);
                            //$('.jcrop-holder').attr('style', 'width: ' + obj.width + 'px;height: ' + obj.height + 'px;position : relative' );
                            //$('.jcrop-holder img').attr('src',obj.fullpath);
                            //$('.jcrop-holder img').attr('width',obj.width).attr('height',obj.height);
                            //$('.jcrop-holder img').attr('style', 'width: ' + obj.width + 'px;height: ' + obj.height + ';' );
                            

                           $('#crop-group').css('display','inherit');

                            /// JCROP ////////////////////////////////////////////////////////////
                           $('#image-crop-target').Jcrop({
                              aspectRatio: 1,
                              onSelect: updateCoords
                           }); // carregar somente depois da imagem montada

                        }

                    }
                });

                /// ao carregar o JS ele avalia qual o runtime e escreve na div
                uploader.bind('Init', function(up, params) {
                    //$('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
                });

                uploader.init();

                /// ONDE ACIONA O UPLOAD
                uploader.bind('FilesAdded', function(up, files) {


                        setTimeout(function(){

                            $('#imageModal').modal('show');
                            uploader.start();
                            //e.preventDefault();
                        },1000);

                    //up.refresh(); // Reposition Flash/Silverlight
                });

                // ONDE ATUALIZA A BARRA DE PROGRESSO
                uploader.bind('UploadProgress', function(up, file) {
                    $('#image-bar .bar').attr('style', 'width:'+ file.percent + '%');
                    $('#imageModal').modal('hide');

                });

                uploader.bind('Error', function(up, err) {
                    $('#errorModal').modal('show');
                    $('#return-error').append("Erro : " + err.code + " | Mensagem : " + err.message + (err.file ? " | Arquivo : " + err.file.name : ""));
                    //$('#return-error').append(err.message + "! Limite de 2mb");

                    up.refresh(); // Reposition Flash/Silverlight
                });

            });

            /// JCROP ////////////////////////////////////////////////////////////

              function updateCoords(c)
              {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
              };

            /// complemento do jcrop, ajax do modal de juste de imagem
            $('#crop-image').click(function(){


            var _src = $('#image-crop-target').attr('src');
            var _x = $('input[name=x]').val();
            var _y = $('input[name=y]').val();
            var _w = $('input[name=w]').val();
            var _h = $('input[name=h]').val();
            var _name = $('#poster-name').val();

            $.ajax({
               data      : {src: _src, x: _x, y: _y, w: _w, h: _h, name: _name  },
               url       : base_url + "/movie/posterCrop/",
               type      : "POST",
               
               beforeSend: function () {
               
               },
               success   : function(retorno){
                
                var rtn = jQuery.parseJSON(retorno);
                $('#cropModal').modal('hide');
                $('.poster-movie').attr('src',rtn.fullPath);



                }

            });                
            })

        </script>

        </footer>        
    </body>
</html>
