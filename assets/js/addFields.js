var formField = document.getElementById('formField');

function addFields() {
    var newField = document.createElement('input');
    newField.setAttribute('type','text');
    newField.setAttribute('name','product');
    newField.setAttribute('value','');
    formField.appendChild(newField);
}

function remove() {
    var input_tags = formField.getElementsByTagName('input');
    if(input_tags.length > 2) {
        formField.removeChild(input_tags[(input_tags.length) - 1]);
    }
}