load_data();

function load_data(query = ' ') {
    var form_data = new FormData();
    form_data.append('query',query);

    var ajax_request = new XMLHttpRequest();
    ajax_request.open('POST', '../src/liveSearch.php');
    ajax_request.send(form_data);
    ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 && ajax_request.status == 200) {
            var response = JSON.parse(ajax_request.responseText);
            var html = '';

            var serial_no = 1;
            if (response.length > 0) {
                for(var count = 0; count < response.length; count++) {
                    html += '<tr>';
                    html += '<td>'+serial_no+'</td>';
                    html += '<td>'+response[count].id+'</td>';
                    html += '<td>'+response[count].product_name+'</td>';
                    html += '<td>'+response[count].product_description+'</td>';
                    html += '<td>'+response[count].product_quantity+'</td>';
                    html += '<td>'+response[count].product_price+'</td>';
                    html += '</tr>'
                    serial_no ++;
                }
            } else {
                html += '<tr><td colspan="3" class="text-center">No Data Found</td></tr>';
            }
            document.getElementById('post_data').innerHTML = html;
            document.getElementById('total_data').innerHTML = response.length;
        }
    }
}