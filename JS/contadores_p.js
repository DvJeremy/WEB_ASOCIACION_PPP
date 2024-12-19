// Función para cargar los contadores
function cargarContadores() {
    fetch('../ADMINISTRADOR/COMPONENTES_INFORMES/contadores_pbackend.php')
        .then(response => response.json())
        .then(data => {
            if (data.monto_total_prestado !== undefined) {
                document.getElementById('montoTotalPrestado').innerText = `S/ ${parseFloat(data.monto_total_prestado).toFixed(2)}`;
            } else {
                console.error('No se recibió monto_total_prestado');
            }

            if (data.prestamos_activos !== undefined) {
                document.getElementById('prestamosActivos').innerText = data.prestamos_activos;
            } else {
                console.error('No se recibió prestamos_activos');
            }

            if (data.beneficio_total !== undefined) {
                document.getElementById('beneficioTotal').innerText = `S/ ${parseFloat(data.beneficio_total).toFixed(2)}`;
            } else {
                console.error('No se recibió beneficio_total');
            }

            if (data.prestamos_finalizados !== undefined) {
                document.getElementById('prestamosFinalizados').innerText = data.prestamos_finalizados;
            } else {
                console.error('No se recibió prestamos_finalizados');
            }
        })
        .catch(error => console.error('Error al cargar los contadores:', error));
}

// Llamar a la función al cargar la página
document.addEventListener('DOMContentLoaded', cargarContadores);
