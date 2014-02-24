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