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
                <li><a href="<?=site_url('register')?>">Cadastro</a> <span class="divider">/</span></li>
                <!-- <li><a href="#">Library</a> <span class="divider">/</span></li> -->
                <li class="active">Confirmação</li>
            </ul> 

        </header>



        <section>

            <div class="returnForm">
                <?
                    if (isset($ReturnError) && $ReturnError ) { ?>

                        <div class="alert alert-error"><?=$ReturnError?></div>
                    
                    <?}else{ ?>

                        <div class="alert alert-success">Cadastro efetuado com sucesso!</div>

                   <? }
                ?>
                
            </div>   

        </section>

        <footer>

            <? require "incs/footer.php";?>

        </footer>        
    </body>
</html>
