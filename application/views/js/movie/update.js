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

            });


            $('.approval-confirm').click(function (){

                var $mov_id = $('input[name=mov_id]').val();

                $.ajax({

                    data: {approval: true, mov_id: $mov_id},
                    url: base_url + "/movie/approval-confirm",
                    type: "POST",
                    beforeSend : function (){

                    }, 
                    success : function (retorno) {

                        $('#approval-modal').modal('hide');
                        window.location.href = base_url + "/movies";
                    }
                });

                
            });  