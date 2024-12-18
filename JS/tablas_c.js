// Función para obtener y mostrar los datos en las tablas
function cargarTablas() {
    const limit = document.getElementById('limit').value;
    const offset = document.getElementById('offset').value;
    const search = document.getElementById('search').value;

    // Obtener valores para los filtros adicionales
    const orderBy = document.getElementById('orderBy').value; // Orden de aportes
    const orderDate = document.getElementById('orderDate').value; // Orden de fecha

    // Obtener los datos de aportes
    fetch(`../ADMINISTRADOR/COMPONENTES_INFORMES/tablas_cbackend.php?limit=${limit}&offset=${offset}&search_aportes=${search}&search_historial=${search}&orderBy=${orderBy}&orderDate=${orderDate}`)
        .then(response => response.json())
        .then(data => {
            if (data.aportes && data.historial) {
                // Actualizar tabla de aportes
                actualizarTablaAportes(data.aportes);
                // Actualizar tabla de historial
                actualizarTablaHistorial(data.historial);
            } else {
                console.error("Error al cargar los datos");
            }
        })
        .catch(error => console.error("Error en la conexión con el backend:", error));
}

// Función para actualizar la tabla de aportes
function actualizarTablaAportes(aportes) {
    const tbody = document.getElementById('tablaAportesBody');
    tbody.innerHTML = ''; // Limpiar la tabla antes de agregar nuevos datos

    aportes.forEach(aporte => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${aporte.dni_socio}</td>
            <td>${aporte.nombre_completo}</td>
            <td>S/ ${aporte.aporte_total}</td>
        `;
        tbody.appendChild(row);
    });
}

// Función para actualizar la tabla de historial de cuotas
function actualizarTablaHistorial(historial) {
    const tbody = document.getElementById('tablaHistorialBody');
    tbody.innerHTML = ''; // Limpiar la tabla antes de agregar nuevos datos

    historial.forEach(record => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${record.nombres} ${record.apellidos}</td>
            <td>${record.fecha_pago}</td>
            <td>S/ ${record.monto}</td>
        `;
        tbody.appendChild(row);
    });
}

// Función para manejar el filtro y paginación
document.addEventListener('DOMContentLoaded', () => {
    // Inicializar la tabla cuando la página se cargue
    cargarTablas();

    // Manejo de la búsqueda
    document.getElementById('search').addEventListener('input', () => {
        cargarTablas(); // Recargar tablas cuando cambia el filtro de búsqueda
    });

    // Manejo del orden de los aportes
    document.getElementById('orderBy').addEventListener('change', () => {
        cargarTablas(); // Recargar tablas cuando cambia el orden de los aportes
    });

    // Manejo del orden de las fechas
    document.getElementById('orderDate').addEventListener('change', () => {
        cargarTablas(); // Recargar tablas cuando cambia el orden de las fechas
    });

    // Manejo de la paginación
    document.getElementById('limit').addEventListener('change', () => {
        cargarTablas(); // Recargar tablas cuando cambia el límite de registros por página
    });

    document.getElementById('offset').addEventListener('change', () => {
        cargarTablas(); // Recargar tablas cuando cambia el desplazamiento de la paginación
    });
});
