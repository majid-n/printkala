
// File Input customization
function fileInput() {
    $( 'input[type="file"]' ).each( function() {
        var $input   = $( this ),
            $label   = $( 'input[type="text"].fileInputText' ),
            labelVal = $label.val();
        $input.on( 'change', function( event ) {
            var fileName = '';
            if( this.files && this.files.length > 1 ) 
                fileName = ( $(this).data( 'multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else if( event.target.value )
                fileName = event.target.value.split( '\\' ).pop();
            if( fileName )
                $label.val( fileName );
            else
                $label.val( labelVal );
        });
        // Firefox bug fix
        $input
        .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
        .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
    });
}