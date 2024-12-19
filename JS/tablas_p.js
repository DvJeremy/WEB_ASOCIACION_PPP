let historial = []; // Para almacenar todos los registros
let currentPage = 1;
const recordsPerPage = 10; // Limitar a 15 registros por página

// Función para cargar los datos de la tabla
function cargarTablas() {
    const filter = document.getElementById('filterInput').value;

    // Realizar la solicitud al backend
    fetch(`../ADMINISTRADOR/COMPONENTES_INFORMES/tablas_pbackend.php?filter=${filter}`)
        .then(response => response.json())
        .then(data => {
            historial = data.historial; // Guardamos todos los registros
            mostrarPaginas();
            cargarHistorialPagos();
        })
        .catch(error => console.error('Error al cargar los datos:', error));
}

// Función para cargar el historial de cobros (solo cuotas abonadas)
function cargarHistorialPagos() {
    const tablaHistorial = document.getElementById('tablaHistorial');
    tablaHistorial.innerHTML = '';  // Limpiar tabla antes de agregar datos

    // Ordenar los pagos por fecha de cobro (más reciente primero)
    historial.sort((a, b) => new Date(b.fecha_cobro) - new Date(a.fecha_cobro));

    // Calcular los índices de inicio y fin para la paginación
    const startIndex = (currentPage - 1) * recordsPerPage;
    const endIndex = startIndex + recordsPerPage;

    // Obtener los registros de la página actual
    const pagosPagina = historial.slice(startIndex, endIndex);

    // Mostrar los registros de la página actual
    pagosPagina.forEach(pago => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${pago.dni_socio}</td>
            <td>${pago.numero_cuota}</td>
            <td>${pago.fecha_cobro}</td>
            <td>S/ ${pago.cuota_abonada}</td>
        `;
        tablaHistorial.appendChild(row);
    });
}

// Función para mostrar la paginación
function mostrarPaginas() {
    const totalPages = Math.ceil(historial.length / recordsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Limpiar paginación existente

    // Crear botones de paginación
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        const link = document.createElement('a');
        link.classList.add('page-link');
        link.href = "#"; // Establecer # para evitar que salte a la parte superior
        link.textContent = i;

        // Añadir evento para cambiar la página sin hacer scroll hacia arriba
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevenir el comportamiento predeterminado (desplazamiento)
            cambiarPagina(i); // Cambiar la página
        });

        li.appendChild(link);
        pagination.appendChild(li);
    }
}


// Función para cambiar la página
function cambiarPagina(page) {
    currentPage = page;
    cargarHistorialPagos();
}

// Llamar a la función cuando se carga la página
document.addEventListener('DOMContentLoaded', cargarTablas);

// Función para actualizar los datos cuando el filtro cambia
document.getElementById('filterInput').addEventListener('input', cargarTablas);
