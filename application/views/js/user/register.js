$('#register-form').validate({

rules: {
  name: {
    minlength: 2,
    required: true
  },
  mail: {
    required: true,
    email: true
  },
  pass: {
    required: true,
  },
  repass: {
    required: true,
    equalTo: "#pass"
  }                      

},
messages :{
    repass :{
        equalTo : "Senhas divergem."
    },
    mail :{
        email : "E-mail inválido."
    }                        

},
    highlight: function(element) {
        $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {

        element
        .text('OK!').addClass('valid')
        .closest('.control-group').removeClass('error').addClass('success');
    }
});