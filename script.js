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

document.getElementById('valorTotal').innerHTML = valorFinal||0;
document.getElementById('formTotal').value = valorFinal||0; 
}

function estadoOnChange (event, vendasID) {
    var estado = event.target.value;

    $.ajax('atualizarEstado.php', {
        data: {
            estado: estado,
            vendasID: vendasID, 
        },
        method: 'POST',
    });
}

function onCheckoutSuccess() {
    if (window.location.search.includes('checkout=success')) {
        window.alert('Compra efetuada com sucesso.');
    }
}

function onInvalidLogin() {
    if (window.location.search.includes('invalidLogin')) {
        window.alert('Dados de acesso inválidos.');
    }
}