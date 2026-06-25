
var _listesCompletes = {};

function filtrer(inputId, selectId) {
    var sel = document.getElementById(selectId);

    if (!_listesCompletes[selectId]) {
        _listesCompletes[selectId] = [];
        for (var i = 0; i < sel.options.length; i++) {
            _listesCompletes[selectId].push({ value: sel.options[i].value, text: sel.options[i].text });
        }
    }

    var filtre = document.getElementById(inputId).value.toLowerCase();
    sel.innerHTML = '';                       // on vide le select
    _listesCompletes[selectId].forEach(function (o) {   // on remet ce qui matche
        if (o.text.toLowerCase().indexOf(filtre) !== -1) {
            var opt = document.createElement('option');
            opt.value = o.value;
            opt.text = o.text;
            sel.appendChild(opt);
        }
    });
}