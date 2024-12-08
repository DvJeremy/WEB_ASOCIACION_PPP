// Esperar a que el documento esté listo
document.addEventListener('DOMContentLoaded', function () {

    // Función para cargar los socios desde el backend
    function cargarSocios() {
        // Obtener el valor del filtro
        const filtro = document.getElementById('filtro').value;

        // Realizar la petición AJAX para obtener los socios con préstamos activos
        fetch(`../ADMINISTRADOR/cobrar_prestamo_backend.php?filtro=${filtro}`)
            .then(response => response.json())
            .then(data => {
                // Limpiar la tabla antes de llenarla con nuevos datos
                const tabla = document.querySelector('#sociosTable tbody');
                tabla.innerHTML = '';

                // Agregar los datos de los socios a la tabla
                data.forEach(socio => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${socio.dni_socio}</td>
                        <td>${socio.nombres}</td>
                        <td>${socio.apellidos}</td>
                        <td>${socio.monto}</td>
                        <td>${socio.cuotas_pendientes}</td>
                        <td><button class="btn btn-primary agregar-btn" data-socio='${JSON.stringify(socio)}'>Agregar</button></td>
                    `;
                    tabla.appendChild(tr);
                });
            })
            .catch(error => console.error('Error al cargar los socios:', error));
    }

    // Función para agregar un socio a la lista de seleccionados
    function agregarSocio(socio) {
        const lista = document.getElementById('selectedSocios');

        // Limitar la cuota mensual a 2 decimales
        const cuotaMensual = parseFloat(socio.cuota_mensual).toFixed(2);

        // Crear un nuevo elemento de lista para el socio
        const li = document.createElement('li');
        li.classList.add('list-group-item');
        li.innerHTML = `${socio.nombres} ${socio.apellidos} (DNI: ${socio.dni_socio}) - Cuota: ${cuotaMensual} 
                        <button class="btn btn-danger btn-sm float-end eliminar-btn">Eliminar</button>`;

        // Añadir el socio a la lista
        lista.appendChild(li);

        // Agregar evento para eliminar el socio
        li.querySelector('.eliminar-btn').addEventListener('click', function () {
            lista.removeChild(li);
        });
    }

    // Delegar el evento de clic al contenedor de la tabla
    document.querySelector('#sociosTable').addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('agregar-btn')) {
            const socio = JSON.parse(event.target.getAttribute('data-socio'));
            agregarSocio(socio);
        }
    });

    // Escuchar los cambios en el filtro para recargar la tabla
    document.getElementById('filterForm').addEventListener('input', function () {
        cargarSocios();
    });

    // Cargar los socios al inicio
    cargarSocios();
});
