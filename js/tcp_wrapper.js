$(function(){

$('#add_row').click(function(){
    $.get( "wrapper_template.php", function( data ) {
        $(data).appendTo(".tcp_rules").hide().show('slow');
    });
});

var daemon_names = [
    "ALL",
    "sshd",
    "popd",
    "imapd",
    "in.telnetd",
    "sendmail",
    "vsftpd"
];

var rules = [
    "allow",
    "deny"
];

$(document.body).on('focus', '.daemon' ,function(){
    $(this).autocomplete({
        source: function( request, response ) {
            // delegate back to autocomplete, but extract the last term
            response( $.ui.autocomplete.filter(
            daemon_names, extractLast( request.term ) ) );
        },
        change: function (event, ui) {
            if (ui.item == null || ui.item == undefined)
                $(this).val("");
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push("");
            this.value = terms.join(", ");
            return false;
        }
    });
});

function split( val ) {
    return val.split( /,\s*/ );
}
function extractLast( term ) {
    return split( term ).pop();
}

$(document.body).on('focus', '.action' ,function(){
    $(this).autocomplete({
        source: rules,
        change: function (event, ui) {
            if (ui.item == null || ui.item == undefined)
                $(this).val("");
        }
    });
});

$(document.body).on('click', '.delete_row' ,function(){
    $(this).parents('.tcp_wrapper_template_row').fadeOut("slow", function(){
        $(this).remove();
    })
});

});