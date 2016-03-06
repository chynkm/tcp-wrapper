$(function(){
    $('#add_row').click(function(){
        $.get( "wrapper_template.php", function( data ) {
            $(data).appendTo(".tcp_rules").hide().show('slow');
        });
    });
});