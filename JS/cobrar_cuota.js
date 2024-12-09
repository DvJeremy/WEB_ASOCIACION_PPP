document.addEventListener('DOMContentLoaded', function () {

    // Función para cobrar la cuota
    document.getElementById('cobrarCuotaBtn').addEventListener('click', function () {
        const lista = document.getElementById('selectedSocios');
        const sociosSeleccionados = [...lista.children];

        if (sociosSeleccionados.length === 0) {
            alert('Debe seleccionar al menos un socio.');
            return;
        }

        // Mostrar mensaje de confirmación antes de cobrar
        const confirmacion = confirm('¿Desea cobrar la cuota de los préstamos de los socios seleccionados?');

        if (!confirmacion) {
            return; // Si el usuario cancela, no hacemos nada
        }

        // Variables para acumular los mensajes de éxito y error
        let mensajeExito = '';
        let mensajeError = '';
        let prestamosCancelados = 0;
        let cuotasCanceladas = 0;

        // Recorrer todos los socios seleccionados
        sociosSeleccionados.forEach(socio => {
            const idPrestamo = socio.getAttribute('data-id');
            const dniSocio = socio.getAttribute('data-dni');

            // Realizar la petición para cobrar la cuota
            fetch('../ADMINISTRADOR/cobrar_cuota_backend.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    id_prestamo: idPrestamo,
                    dni_socio: dniSocio
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cuotasCanceladas++; // Acumular número de cuotas cobradas
                    if (data.prestamo_cancelado) {
                        prestamosCancelados++; // Contabilizar los préstamos cancelados
                    }
                } else {
                    mensajeError += `Error al cobrar la cuota del préstamo ${idPrestamo}: ${data.message || 'No se pudo completar la operación.'} `;
                }

                // Después de procesar todos los socios seleccionados, mostrar mensaje general
                if (sociosSeleccionados.indexOf(socio) === sociosSeleccionados.length - 1) {
                    if (cuotasCanceladas > 0) {
                        mensajeExito = `Se cobraron ${cuotasCanceladas} cuota(s) en total.`;
                    }

                    if (prestamosCancelados > 0) {
                        mensajeExito += ` ${prestamosCancelados} préstamo(s) ha(n) sido cancelado(s).`;
                    }

                    if (mensajeExito) {
                        alert(mensajeExito);
                    }

                    if (mensajeError) {
                        alert('Errores: ' + mensajeError);
                    }

                    // Recargar la lista de socios seleccionados después de cobrar la cuota
                    lista.innerHTML = ''; // Limpiar la lista de socios seleccionados
                    location.reload(); // Recargar la página para reflejar los cambios
                }
            })
            .catch(error => {
                console.error('Error al procesar la solicitud:', error);
                alert('Hubo un error al procesar el cobro.');
            });
        });
    });
});
