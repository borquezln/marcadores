// Referencia al botón de geolocalización
var localizacionBoton = document.getElementById('localizacionBoton');
// Referencia a los textarea
var latitudTextarea = document.getElementById('latitudTextarea');
var longitudTextarea = document.getElementById('longitudTextarea');

// Agregar controlador de eventos al hacer clic en el botón
localizacionBoton.addEventListener('click', function() {
    // Solicitar geolocalización al hacer clic en el botón
    navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;

        // Enviar los valores a los textarea
        latitudTextarea.value = lat;
        longitudTextarea.value = long;
    }, function(error) {
        alert('Se produjo un error al obtener tu ubicación: ' + error.message);
    });
});