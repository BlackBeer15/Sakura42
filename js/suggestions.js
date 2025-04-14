// Замените на свой API-ключ
var token = "75dc07d57cefbef4e4d7c2386f3ff84ca3a0cb37";

var type = "ADDRESS";
var $settlement = $("#settlement");
var $street = $("#street");

function showPostalCode(suggestion) {
  $("#postal_code").val(suggestion.data.postal_code);
}

function clearPostalCode() {
  $("#postal_code").val("");
}

// geolocateCity($city);

// город и населенный пункт
$settlement.suggestions({
  token: token,
  type: type,
  hint: false,
  bounds: "settlement",
  constraints: { 
    locations: {
      region: "Кемеровская область - Кузбасс",
      city: "Новокузнецк",
    },
  }, 
  onSelect: showPostalCode,
  onSelectNothing: clearPostalCode
});

// улица
$street.suggestions({
  token: token,
  type: type,
  hint: false,
  bounds: "street",
  constraints: $settlement,
  onSelect: showPostalCode,
  onSelectNothing: clearPostalCode
});
