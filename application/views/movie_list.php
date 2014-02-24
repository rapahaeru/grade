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
                <li class="active">Lista de filmes <?=(($this->uri->segment(2) == "approval") ? "a serem aprovados" : "" )?></li>
            </ul>

        </header>
        <? if (isset($returnInfo) && $returnInfo != "") :?>
            <section>
                <p class="informative"><?=$returnInfo?></p>
            </section>        
        <? endif;?>
        <section>
            
            <? if ($this->uri->segment(2) != "approval" ) : ?>
                
                <?if ($UserAdm == true) :?>
                    <p><a href="<?=site_url('movies/approval')?>">lista de filmes a serem aprovados</a></p>
                <? endif;?>
            
            <? endif;?>

            <table class="table table-bordered" id="list-movies">
                <thead>
                    <th width="5%">Média</th>
                    <th width="7%">Hanking</th>
                    <th width="7%">Ano</th>
                    <th>Nome</th>
                    <th>Diretor</th>
                </thead>
                <tbody>
                    <? 
                    if (isset($datamovies) && $datamovies != "") :

                        foreach ($datamovies as $row) : ?>
                            
                            <tr>
                                <td><?=((isset($row->mov_average) && $row->mov_average != NULL) ? $row->mov_average : 'N/A'  )?></td>
                                <td><a href="#"></a></td>                        
                                <td><?=((isset($row->mov_yearvintage) && $row->mov_yearvintage != '') ? $row->mov_yearvintage : 'N/A'  )?></td>
                                <td>
                                    <? if (isset($UserAdm) && $UserAdm === true) : ?><a href="<?=site_url('movie/update-info/'.$row->mov_seo)?>" title="Editar"><i class="icon-cog"></i></a> <?endif;?>
                                    <? if (isset($UserAdm) && $UserAdm === true) : ?><a href="#remove-modal" id="<?=$row->mov_id?>" class="remove-item" title="Remover" data-toggle="modal"> <i class="icon-remove"></i></a> <?endif;?><? //=site_url('movie/remove/'.$row->mov_seo)?>
                                    
                                    <? if($this->uri->segment(2) == "approval") :?>
                                    
                                    <a href="<?=site_url('movie/profile/'.$row->mov_seo)?>" title="preview"> <i class="icon-zoom-in"></i></a>

                                        <?=$row->mov_name?> (<?=$row->mov_originalname?>)
                                    <?else :?>
                                        <a href="<?=site_url('movie/profile/'.$row->mov_seo)?>"><?=$row->mov_name?> (<?=$row->mov_originalname?>)</a> 
                                    <? endif;?>
                                    
                                </td>
                                <td><?=((isset($row->dir_name) && $row->dir_name != '') ? $row->dir_name : 'N/A'  )?></td>
                            </tr>                    
                            
                     <? endforeach;
                        
                    endif; ?>


                </tbody>
            </table>  
            
            <input type="hidden" name="remove-set-id" value="" />
            <input type="hidden" name="remove-set-seo" value="" />
            
            <div class="pagination"><?=$this->pagination->create_links();?></div>

        </section>

        <!-- MODAL CONFIRMA EXCLUSAO -->
        <div id="remove-modal" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Confirmação</h3>
            </div>
            <div class="modal-body">
                <p>tem certeza que deseja remover esse filme ?</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Não tenho!</a>
                <a href="#" class="btn btn-primary remove-confirm">Sim</a>
            </div>
        </div>
        <!-- FIM MODAL CONFIRMA EXCLUSAO -->        

        <!-- MODAL CONFIRMA INFORMATIVO -->
        <div id="informative-modal" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Informativo</h3>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary informative-confirm">Ok</a>
            </div>
        </div>
        <!-- FIM MODAL CONFIRMA INFORMATIVO --> 

        <footer>

            <? require "incs/footer.php";?>

        </footer> 

        <script>


        $(document).ready(function(){

            var base_url        = $('input[name=base_url]').val();
            var base_view       = $('input[name=base_view]').val();            

            ///////////////////////////////////////////////
            // SETA ID DO ITEM A SER EXCLUIDO EM NO
            // INPUT HIDDEN (remove-set-id) PARA
            // SER UTILIZADO DEPOIS DA CONFIRMACAO NO MODAL
            $('.remove-item').click(function(){
                $id  = $(this).attr('id');
                $('input[name=remove-set-id]').val($id);
            });
            ///////////////////////////////////////////////


            $('.remove-confirm').click(function(){
                
                $movieid = $('input[name=remove-set-id]').val();
                
                if ($movieid != ""){

                    $.ajax({
                        data : {movieid : $movieid},
                        type : "POST",
                        url  : base_url + "movie/remove/",
                        success : function (retorno){

                            $('#remove-modal').modal('hide');

                            $('#informative-modal .modal-body p').html(retorno);
                            $('#informative-modal').modal('show');

                            $('.informative-confirm').click(function(){

                                $('#informative-modal').modal('hide');
                                window.location.href = base_url + "movies";

                            });

                        }

                    });

                }

            });

        });
        </script>       
    </body>
</html>
