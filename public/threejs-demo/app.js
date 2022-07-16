$( function() {
  $( "#width-slider-range-max" ).slider({
    range: "max",
    min: 1,
    max: 10,
    value: 2,
    slide: function( event, ui ) {
      $( "#width" ).val( ui.value );
      changeStyle();
    }
  });
  $( "#width" ).val( $( "#width-slider-range-max" ).slider( "value" ) );

  $( "#height-slider-range-max" ).slider({
    range: "max",
    min: 1,
    max: 10,
    value: 2,
    slide: function( event, ui ) {
      $( "#height" ).val( ui.value );
      changeStyle();
    }
  });
  $( "#height" ).val( $( "#height-slider-range-max" ).slider( "value" ) );


  $( "#depth-slider-range-max" ).slider({
    range: "max",
    min: 1,
    max: 10,
    value: 2,
    slide: function( event, ui ) {
      $( "#depth" ).val( ui.value );
      changeStyle();
    }
  });
  $( "#depth" ).val( $( "#depth-slider-range-max" ).slider( "value" ) );
} );