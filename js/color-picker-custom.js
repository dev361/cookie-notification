(function( $ ) {
    $(function() {

        // Add Color Picker to all inputs that have 'cookie-color-picker' class
        $( '.cookie-color-picker' ).wpColorPicker({
            // set  total width
            width : 200,
            // show a group of common colors beneath the square
            // or, supply an array of colors to customize further
            palettes: ['#293550','#c8d0e3','#e41b22','#0861b8','#F9DE0E','#111111','#EEEEDD']
        });

    });
})( jQuery );