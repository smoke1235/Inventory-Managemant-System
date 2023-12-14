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
            '<tr id="item">'
            + '<td><a href="#" onclick="removeItem()">Remove</a></td>'
            + '<td><input type="hidden" name="invoice_name" value="' + results['id'] + '"'
            + '<p>' + results['product_name'] + '</p></td>'
            + '<td><p>' + results['product_description'] + '</p></td>'
            + '<td><input type="number" name="invoice_qty" id="input-qty" value="1"></td>'
            + '<td><input type="float" name="invoice_price" id="input-price" value="' + results['product_price'] + '"'
            + '</tr>'
        );
        modal.fadeOut();
    }

}

function removeItem() {
    const item =  document.getElementById("item");
    item.remove();
}