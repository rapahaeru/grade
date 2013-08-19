            <p class="text-right">Versão 0.1 Beta</p>

            <!-- script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script -->
            <script src="<?=$this->config->config['base_view']?>/js/vendor/jquery-1.9.1.min.js"></script>
            
            <script src="<?=$this->config->config['base_view']?>/js/plugins.js"></script>
            <script src="<?=$this->config->config['base_view']?>/bootstrap/js/bootstrap.js"></script>
            <script src="<?=$this->config->config['base_view']?>/js/main.js"></script>
            <script src="<?=$this->config->config['base_view']?>/js/jquery.validate/jquery.validate.min.js"></script>

            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
            <script>
                var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
                (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                g.src='//www.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g,s)}(document,'script'));
            </script>
            <script>
            
                $('.dropdown-toggle').dropdown()

              //   $('#register-form').validate({
                
              //   rules: {
              //     name: {
              //       minlength: 2,
              //       required: true
              //     },
              //     mail: {
              //       required: true,
              //       email: true
              //     },
              //     pass: {
              //       required: true,
              //     },
              //     repass: {
              //       required: true,
              //       equalTo: "#pass"
              //     }                      

              //   },
              //   messages :{
              //       repass :{
              //           equalTo : "Senhas divergem."
              //       },
              //       mail :{
              //           email : "E-mail inválido."
              //       }                        

              //   },
              //       highlight: function(element) {
              //           $(element).closest('.control-group').removeClass('success').addClass('error');
              //       },
              //       success: function(element) {

              //           element
              //           .text('OK!').addClass('valid')
              //           .closest('.control-group').removeClass('error').addClass('success');
              //       }
              // });

            </script>