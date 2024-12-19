// Función para capturar el clic en los botones "Más Información"
document.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('more-info-btn')) {
        const idPrestamo = e.target.getAttribute('data-id');
        const tipo = e.target.getAttribute('data-tipo');
        console.log(`Cargando información para el ID: ${idPrestamo}, Tipo: ${tipo}`); // Depuración
        cargarInformacionPrestamo(idPrestamo, tipo);
    }
});

// Función para cargar la información del préstamo
function cargarInformacionPrestamo(idPrestamo, tipo) {
    // Realizamos la solicitud al backend para obtener la información
    fetch(`../ADMINISTRADOR/COMPONENTES_INFORMES/info_pbackend.php?id=${idPrestamo}&tipo=${tipo}`)
        .then(response => {
            console.log('Respuesta del servidor:', response); // Depuración
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error(data.error);
                alert('No se pudo cargar la información del préstamo');
            } else {
                mostrarDetallesPrestamo(data, tipo);
            }
        })
        .catch(error => {
            console.error('Error al cargar la información del préstamo:', error);
            alert('Error al cargar la información del préstamo');
        });
}

// Función para mostrar los detalles del préstamo en el modal
function mostrarDetallesPrestamo(data, tipo) {
    const modal = document.getElementById('prestamoModal');

    // Verificar si el modal existe
    if (!modal) {
        console.error('El modal no se encontró en el DOM.');
        return;
    }

    let modalTitle = '';
    let modalBody = '';

    // Si es un préstamo activo
    if (tipo === 'activo') {
        modalTitle = `Información del Préstamo Activo`;

        // Verificar que los valores sean correctos
        const monto = data.monto || 0;
        const cuotaMensual = data.cuota_mensual || 0;
        const cuotasPagadas = data.cuotas_pagadas || 0;
        const interes = data.interes || 0; // Asegurarse que el interés esté definido
        const saldoPendiente = monto - (cuotaMensual * cuotasPagadas);

        modalBody = `
            <p><strong>Monto:</strong> S/ ${monto}</p>
            <p><strong>Fecha de Emisión:</strong> ${data.fecha_emision}</p>
            <p><strong>Cuota Mensual:</strong> S/ ${cuotaMensual}</p>
            <p><strong>Amortización:</strong> S/ ${data.amortizacion}</p>
            <p><strong>Interés:</strong> S/ ${interes}</p>
            <p><strong>Historial de Pagos:</strong></p>
            <ul>
                ${data.historial_pagos && data.historial_pagos.length > 0 ? 
                    data.historial_pagos.map(pago => 
                        `<li>Cuota ${pago.numero_cuota} - Fecha de Cobro: ${pago.fecha_cobro}</li>`
                    ).join('') :
                    '<li>No se han realizado pagos.</li>'}
            </ul>
            <p><strong>Saldo Pendiente:</strong> S/ ${saldoPendiente}</p>
            <p><strong>Cuotas Restantes:</strong> ${data.cuotas_restantes}</p>
        `;
    } else if (tipo === 'cancelado') {
        modalTitle = `Información del Préstamo Cancelado`;
        
        // Mostrar correctamente el historial de pagos y los intereses
        modalBody = `
            <p><strong>Monto:</strong> S/ ${data.monto}</p>
            <p><strong>Fecha de Emisión:</strong> ${data.fecha_emision}</p>
            <p><strong>Fecha de Finalización:</strong> ${data.fecha_finalizacion}</p>
            <p><strong>Interés:</strong> S/ ${data.interes}</p>
            <p><strong>Amortización:</strong> S/ ${data.amortizacion}</p>
            <p><strong>Historial de Pagos:</strong></p>
            <ul>
                ${data.historial_pagos && data.historial_pagos.length > 0 ? 
                    data.historial_pagos.map(pago => 
                        `<li>Cuota ${pago.numero_cuota} - Fecha de Cobro: ${pago.fecha_cobro}</li>`
                    ).join('') :
                    '<li>No se han realizado pagos.</li>'}
            </ul>
            <p><strong>Total Pagado:</strong> S/ ${data.total_pagado}</p>
        `;
    }

    // Actualizar el contenido del modal
    modal.querySelector('.modal-title').innerText = modalTitle;
    modal.querySelector('.modal-body').innerHTML = modalBody;

    // Eliminar el backdrop (capa opaca) para evitar bloqueo de la página
    const modalInstance = new bootstrap.Modal(modal, {
        backdrop: false, // Desactivar completamente el backdrop
        keyboard: false // Desactivar cierre por teclado
    });

    // Mostrar el modal
    modalInstance.show();
}
