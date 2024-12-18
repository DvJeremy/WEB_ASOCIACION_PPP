// Función para cargar las tablas
function cargarTablas() {
    const search = document.getElementById('search').value;
    const orderBy = document.getElementById('orderBy').value;
    const orderDate = document.getElementById('orderDate').value;

    const limitHistorial = document.getElementById('limitHistorial').value;
    const offsetHistorial = document.getElementById('offsetHistorial').value || 0;

    // Cargar aportes
    fetch(`../ADMINISTRADOR/COMPONENTES_INFORMES/tablas_cbackend.php?search_aportes=${search}&orderBy=${orderBy}`)
        .then(response => response.json())
        .then(data => {
            if (data.aportes) actualizarTablaAportes(data.aportes);
        });

    // Cargar historial
    fetch(`../ADMINISTRADOR/COMPONENTES_INFORMES/tablas_cbackend.php?search_historial=${search}&limit=${limitHistorial}&offset=${offsetHistorial}&orderDate=${orderDate}`)
        .then(response => response.json())
        .then(data => {
            if (data.historial) {
                actualizarTablaHistorial(data.historial);
                actualizarPaginacion(data.total_historial, limitHistorial, offsetHistorial);
            }
        });
}

// Actualizar tabla de aportes
function actualizarTablaAportes(aportes) {
    const tbody = document.getElementById('tablaAportesBody');
    tbody.innerHTML = aportes.map(aporte => `
        <tr>
            <td>${aporte.dni_socio}</td>
            <td>${aporte.nombre_completo}</td>
            <td>S/ ${aporte.aporte_total}</td>
        </tr>
    `).join('');
}

// Actualizar tabla de historial
function actualizarTablaHistorial(historial) {
    const tbody = document.getElementById('tablaHistorialBody');
    tbody.innerHTML = historial.map(record => `
        <tr>
            <td>${record.nombres} ${record.apellidos}</td>
            <td>${record.fecha_pago}</td>
            <td>S/ ${record.monto}</td>
        </tr>
    `).join('');
}

// Actualizar paginación
function actualizarPaginacion(totalRegistros, limit, currentOffset) {
    const offsetSelect = document.getElementById('offsetHistorial');
    offsetSelect.innerHTML = '';

    const totalPages = Math.ceil(totalRegistros / limit);
    for (let i = 0; i < totalPages; i++) {
        const option = document.createElement('option');
        option.value = i * limit;
        option.textContent = `Página ${i + 1}`;
        offsetSelect.appendChild(option);
    }

    // Establecer el valor actual en el combobox
    offsetSelect.value = currentOffset;
}

// Listeners
document.addEventListener('DOMContentLoaded', () => {
    cargarTablas();
    document.getElementById('search').addEventListener('input', cargarTablas);
    document.getElementById('orderBy').addEventListener('change', cargarTablas);
    document.getElementById('orderDate').addEventListener('change', cargarTablas);
    document.getElementById('limitHistorial').addEventListener('change', cargarTablas);
    document.getElementById('offsetHistorial').addEventListener('change', cargarTablas);
});
