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
           $(document).ready(function() {
            var maxInputs = 50;
            var inputField = $("#item_results");

            var inputFloat = $("input[type=float]").length;
            var inputHidden = $("input[type=hidden]").length;
            var inputnmbr = $("input[type=number]").length;
            var fieldCount = 1;

            $(document).ready(function() {
                if ()
            })
           })
        },
        error:      function(xhr, status, error) {
            console.error('error:', error);
        }
    });
}