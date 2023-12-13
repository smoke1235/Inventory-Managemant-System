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
            onSuccess(data);
        },
        error:      function(xhr, status, error) {
            console.error('error:', error);
        },
    });
    function onSuccess(data) {
        var results = $.parseJSON(data);

        $('#item_results').prepend(
            '<tr>'
            + '<td><a href="#" id="remove_btn">Remove</a></td>'
            + '<td><p>' + data['product_name'] + '</p></td>'
            + '</tr>'
        );
        modal.fadeOut();
    }

}