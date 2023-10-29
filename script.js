var valorFinal = "";

function validate() {
  var formato = document.getElementById("formato").value;
  var vformato = "";
  var prazo = document.getElementById("prazo").value;
  var valorTotal = "";
  var numberOfChecked = $("input:checkbox:checked").length;
  var extras = numberOfChecked * 400;
  var nome = document.getElementById("name");
  var apelido = document.getElementById("lName");
  var numero = document.getElementById("number");

  nome.addEventListener("input", function (n) {
    var patern = /^[\w]{3,15}$/g;
    var currentV = n.target.value;
    var valid = patern.test(currentV);
    console.log(currentV);
    if (valid) {
      document.getElementById("ok").style.display = "inline-block";
      document.getElementById("notok").style.display = "none";
    } else {
      document.getElementById("ok").style.display = "none";
      document.getElementById("notok").style.display = "inline-block";
    }
  });

  apelido.addEventListener("input", function (n) {
    var patern = /^[\w]{3,15}$/g;
    var currentV = n.target.value;
    var valid = patern.test(currentV);
    console.log(currentV);
    if (valid) {
      document.getElementById("ok1").style.display = "inline-block";
      document.getElementById("notok1").style.display = "none";
    } else {
      document.getElementById("ok1").style.display = "none";
      document.getElementById("notok1").style.display = "inline-block";
    }
  });

  numero.addEventListener("input", function (n) {
    var patern =
      /^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/g;
    var currentV = n.target.value;
    var valid = patern.test(currentV);
    console.log(currentV);
    if (valid) {
      document.getElementById("ok2").style.display = "inline-block";
      document.getElementById("notok2").style.display = "none";
    } else {
      document.getElementById("ok2").style.display = "none";
      document.getElementById("notok2").style.display = "inline-block";
    }
  });

  if (formato == 0) {
    vformato = 300;
  } else if (formato == 1) {
    vformato = 400;
  } else if (formato == 2) {
    vformato = 500;
  } else if (formato == 3) {
    vformato = 900;
  }

  if (prazo == 1) {
    valorTotal = vformato + extras;
    valorTotal = (valorTotal * 0.95) / 12;
    valorFinal = parseFloat(valorTotal.toFixed(2));
    document.getElementById("total").innerHTML =
      valorFinal + "€/mês (inclui desconto de 5%)";
  } else if (prazo == 2) {
    valorTotal = vformato + extras;
    valorTotal = (valorTotal * 0.9) / 12;
    valorFinal = parseFloat(valorTotal.toFixed(2));
    document.getElementById("total").innerHTML =
      valorFinal + "€/mês (inclui desconto de 10%)";
  } else if (prazo == 3) {
    valorTotal = vformato + extras;
    valorTotal = (valorTotal * 0.85) / 12;
    valorFinal = parseFloat(valorTotal.toFixed(2));
    document.getElementById("total").innerHTML =
      valorFinal + "€/mês (inclui desconto de 15%)";
  } else if (prazo >= 4) {
    valorTotal = vformato + extras;
    valorTotal = (valorTotal * 0.8) / 12;
    valorFinal = parseFloat(valorTotal.toFixed(2));
    document.getElementById("total").innerHTML =
      valorFinal + "€/mês (inclui desconto de 20%)";
  }
  var valorInput = document.getElementById("total").textContent;
  document.getElementById("inputValor").value = valorInput;
}

function carregarMapa() {
  var ponto = new google.maps.LatLng(38.733573, -9.14114);

  var opcoes = {
    zoom: 12,
    center: ponto,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  var m = new google.maps.Map(document.getElementById("myMap"), opcoes);

  var marca = new google.maps.Marker({
    position: ponto,
    map: m,
  });

  var caixa = new google.maps.InfoWindow({
    content: "Somos a <b>MasterD</b><br/>Faça-nos uma visita!",
  });
  google.maps.event.addListener(marca, "click", function () {
    caixa.open(m, marca);
  });
}
function geo() {
  var geocoder = new google.maps.Geocoder();
  var direccao = $("#direccao").val();
  var ponto = new google.maps.LatLng(38.733573, -9.14114);

  var opcoes = {
    zoom: 12,
    center: ponto,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  var m = new google.maps.Map(document.getElementById("myMap"), opcoes);

  var marca = new google.maps.Marker({
    position: ponto,
    map: m,
  });

  var caixa = new google.maps.InfoWindow({
    content: "Somos a <b>MasterD</b><br/>Faça-nos uma visita!",
  });
  google.maps.event.addListener(marca, "click", function () {
    caixa.open(m, marca);
  });

  geocoder.geocode({ address: direccao }, function (results, status) {
    if (status == "OK") {
      m.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: m,
        position: results[0].geometry.location,
      });
    } else {
      alert("Morada não encontrada: " + status);
    }
  });
}
