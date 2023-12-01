var formField = document.getElementById('formField');

function addFields() {
    var newField = document.createElement('input');
    newField.setAttribute('type','text');
    newField.setAttribute('name','product');
    newField.setAttribute('value','');
    formField.appendChild(newField);
}

