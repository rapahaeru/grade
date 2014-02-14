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
                                    <? if (isset($UserAdm) && $UserAdm === true) : ?><a href="<?=site_url('movies/update-info/'.$row->mov_seo)?>" title="Editar"><i class="icon-cog"></i></a> <?endif;?>
                                    <? if($this->uri->segment(2) == "approval") :?>
                                    
                                    <a href="<?=site_url('movies/profile/'.$row->mov_seo)?>" title="preview"> <i class="icon-zoom-in"></i></a>

                                        <?=$row->mov_name?> (<?=$row->mov_originalname?>)
                                    <?else :?>
                                        <a href="<?=site_url('movies/profile/'.$row->mov_seo)?>"><?=$row->mov_name?> (<?=$row->mov_originalname?>)</a> 
                                    <? endif;?>
                                    
                                </td>
                                <td><?=((isset($row->dir_name) && $row->dir_name != '') ? $row->dir_name : 'N/A'  )?></td>
                            </tr>                    
                            
                     <? endforeach;
                        
                    endif; ?>


                </tbody>
            </table>            
            
            <div class="pagination"><?=$this->pagination->create_links();?></div>

        </section>

        <footer>

            <? require "incs/footer.php";?>

        </footer>        
    </body>
</html>
