// Función para obtener datos y actualizar los contadores
function cargarContadores() {
    fetch('../ADMINISTRADOR/COMPONENTES_INFORMES/contadores_cbackend.php')
        .then(response => response.json())
        .then(data => {
            if (data.total_recaudado !== 'Error' && data.total_contribuyentes !== 'Error') {
                // Actualizar contadores en el DOM
                document.getElementById('contadorRecaudado').innerText = `S/ ${parseFloat(data.total_recaudado).toFixed(2)}`;
                document.getElementById('contadorContribuyentes').innerText = data.total_contribuyentes;
            } else {
                console.error("Error al cargar los datos");
            }
        })
        .catch(error => console.error("Error en la conexión con el backend:", error));
}

// Llamar la función al cargar la página
document.addEventListener('DOMContentLoaded', cargarContadores);
