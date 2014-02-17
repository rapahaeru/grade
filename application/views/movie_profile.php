<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <? require "incs/includes.php" ; ?>
      <link rel="stylesheet" href="<?=$this->config->config['base_view']?>/css/jquery.ui/jquery-ui-1.10.0.custom.css">
      <style>
        .ui-widget-header {background: #005580;}
      </style>
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
                <li><a href="<?=site_url("movies")?>">Lista de filmes</a> <span class="divider">/</span></li>
                <li class="active">Filme</li>
            </ul>

        </header>
        <? //debug($averageData);?>
        <? if ($averageData == 'no-average') : ?>
          <section>
            <article>
              <p>Você ainda não avaliou este filme.</p>
            </article>
          </section>

        <? elseif ($averageData == 'no-user') : ?>

        <? elseif ($averageData != 'no-user' &&  $averageData != 'no-average') : ?>        

          <section>
            <article>
                  <div id="average-info">

                    <div class="average">
                      <span class="good">7.6</span>
                      <p>Média</p>
                    </div>

                    <div class="hanking">
                      <span>13º</span>
                      <a href="#">hanking</a>
                    </div>

                    <div class="personal-average">
                      <!-- <span contenteditable="true">4.0</span> -->
                      <span class="bad" id="personal-average">5.0</span>
                      <p>Avaliação</p>
                    </div>

                    <div id="slider-average"></div>

                  </div>  
            </article>
          </section>

        <? endif; ?>
        

        <section>

          <article>
            
            <?php foreach ($profile as $row): ?>
              
              <div id="movie-profile">
              
                  <hgroup>
                    <h1><?=$row->mov_originalname?> (<a href="#"><?=$row->mov_vintage?></a>)</h1>
                    <? if (isset($row->mov_name) && $row->mov_name!= ""){?><small><?=$row->mov_name?></small><?}?>
                    <? if (isset($row->dir_name) && $row->dir_name!= ""){?><h2><a href="#"><?=$row->dir_name?></a></h2> <?}?> 
                  </hgroup>
                    
              
                  
                  <div class="left">

                      <div class="movie-sinopses">
                        <? if (isset($row->mov_sinopses) && $row->mov_sinopses!= ""){?> <?=$row->mov_sinopses?> <?}?>

                      </div>
                      <? ///debug($gender)  ?>
                    <? if (isset($gender) &&  $gender != "") :  ?>
                        <ul class="gender-list">
                          <? foreach ($gender as $key) : ?>
                            <li><a><?=$key->gen_name?></a></li>
                          <? endforeach;?>
                            
                        </ul>
                      <? endif;?>  
                    
                      
                      <? if (isset($row->mov_moreinfo) && $row->mov_moreinfo!= ""){?> <a href="<?=$row->mov_moreinfo?>" class="more-info">Saiba mais</a> <?}?>
                      

                  </div>

                  <div class="right">
                    
                    <div id="movie-poster">
                      <? if (isset($row->mov_poster) && $row->mov_poster!= ""){?><img src="<?=$midia->imageCrop('300','300',$row->mov_poster)?>" alt=""><?}?>  
                    </div>
                    
                  </div>

              </div>
            <?php endforeach ?>            


          </article>

        </section>

        <footer>

            <? require "incs/footer.php";?>
            <script src="<?=$this->config->config['base_view']?>/js/jquery.ui/jquery-ui-1.10.0.custom.min.js"></script>
            
            <script>



                  $(function() {
                    $( "#slider-average" ).slider({
                      range: "max",
                      step: 0.1,
                      min: 0,
                      max: 10,
                      value: 5.1,
                      slide: function( event, ui ) {
                        $( "#personal-average" ).html( ui.value );
                      }
                    });
                    $( "#personal-average" ).html( $( "#slider-average" ).slider( "value" ) );
                  });  

            </script>
        </footer>        
    </body>
</html>
