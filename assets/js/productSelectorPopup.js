var modal = $('#myModal');
var btn = $('#btn');

$(document).ready(function() {
    btn.on('click',function() {
        modal.show();
    });
});

$('body').bind('click', function(e) {
    if ($(e.target).hasClass("modal")) {
        modal.fadeOut();
    }
});

function item(id) {
    $.ajax({
        type:       "POST",
        url:        "../src/addInvoiceItem.php",
        data:       {id: id},
        success:    function(data) {
            console.log(data);
            alert(data + 'added.');
            modal.fadeOut();
            
        },
        error:      function(xhr, status, error) {
            console.error('error:', error);
        }
    });
}