function customerChange(id) {
    $.ajax ({
        type:       'post',
        data:       {'id': id},
        url:        'newOrder.php',
        dataType:   'json',
        success:    function(res){
            alert(res)
        },
        error: function(res){
            $('#message').text('Error!');
            $('.dvLoading').hide();
        }
    })
}
