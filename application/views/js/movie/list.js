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