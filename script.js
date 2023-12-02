function valorTotal(){
var valor = 0;

var todos = document.getElementsByClassName('amount');
for (var i = 0; i < todos.length; i++) {
    var element = todos.item(i);
    var amount = parseInt(element.textContent);
    var esteValor = parseFloat(element.parentNode.querySelector('.valor').textContent.replace(',', '.'));
    valor = valor + (amount * esteValor);
    var valorFinal = valor.toFixed(2);
}

document.getElementById('valorTotal').innerHTML = valorFinal;
document.getElementById('formTotal').value = valorFinal; 
}