// When the user clicks on div, open the popup
function myFunction(n) {
  var nombre="Popupalimentos"+n;
  var popup = document.getElementById(nombre);
  popup.classList.toggle("show");
}

function FunctionAlerg(k) {
	var nombre2="Popupalerg"+k;
  var popup = document.getElementById(nombre2);
  popup.classList.toggle("show");
}