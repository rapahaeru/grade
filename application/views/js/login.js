$('#login-form').validate({

rules: {
  mail: {
    required: true,
    email: true
  },
  pass: {
    required: true,
  }

},
messages :{

    mail :{
        email : " ",
        required : " "
    },

    pass:{
        required : " "
    }                        

}
    // highlight: function(element) {
    //     $(element).closest('.control-group').removeClass('success').addClass('error');
    // },
    // success: function(element) {

    //     element
    //     .text('OK!').addClass('valid')
    //     .closest('.control-group').removeClass('error').addClass('success');
    // }
});