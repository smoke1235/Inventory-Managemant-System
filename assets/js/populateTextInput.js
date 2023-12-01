function populateTextInput() {
    var selectedOption = document.getElementById("customer-select");
    var selectedValue = selectedOption.value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);

            document.getElementById("customer_number").value = data['number'];
            document.getElementById("customer_email").value = data['email'];

            document.getElementById("shipping_name").value = data['first_name'] + " " + data['last_name'];
            document.getElementById("shipping_company").value = data['company_name'];
            document.getElementById("shipping_street").value = data['street'];
            document.getElementById("shipping_postalcode").value = data['postcode'];
            document.getElementById("shipping_city").value = data['city'];
            document.getElementById("shipping_country").value = data['country'];

            document.getElementById("billing_name").value = data['first_name'] + " " + data['last_name'];
            document.getElementById("billing_company").value = data['company_name'];
            document.getElementById("billing_street").value = data['street'];
            document.getElementById("billing_postalcode").value = data['postcode'];
            document.getElementById("billing_city").value = data['city'];
            document.getElementById("billing_country").value = data['country'];
        }
    };

    xhr.open("GET", "../src/get-customers.php?selectedValue=" + selectedValue, true);
    xhr.send();
}