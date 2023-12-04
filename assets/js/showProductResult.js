$(document).ready(function(){
    function load_data(query) {
        $.ajax({
            url:            "../src/liveSearch.php",
            methode:        "POST",
            data:           {query:query},
            success:        function(data)
            {
                $('#result').html('');
                $('#result').html(data);
            }
        });
    }
    $('#search').keyup(function(){
        var search = $(this).val();
        if (search != '') {
            load_data(search);
        } else {
            load_data();
        }
    });
});