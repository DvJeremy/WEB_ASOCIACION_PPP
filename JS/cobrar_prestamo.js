document.addEventListener('DOMContentLoaded', function () {
    let dnisCargados = [];

    // Función para cargar los socios desde el backend
    function cargarSocios() {
        const filtro = document.getElementById('filtro').value;

        // Realizar la petición AJAX para obtener los socios con préstamos activos
        fetch(`../ADMINISTRADOR/cobrar_prestamo_backend.php?filtro=${filtro}`)
            .then(response => response.json())
            .then(data => {
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
                        <td><button class="btn btn-primary agregar-btn" data-dni="${socio.dni_socio}">Agregar</button></td>
                    `;
                    tabla.appendChild(tr);
                });

                // Asegurar que los eventos de clic de los botones "Agregar" se asignen correctamente
                document.querySelectorAll('.agregar-btn').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const dni = this.getAttribute('data-dni');
                        agregarSocioPorDni(dni);
                    });
                });
            })
            .catch(error => console.error('Error al cargar los socios:', error));
    }

    // Función para agregar un socio a la lista de seleccionados usando su DNI
    function agregarSocioPorDni(dni) {
        if (!dni) {
            console.error('DNI no válido:', dni);
            return;
        }

        // Realizar la petición AJAX para obtener los datos del socio por el DNI
        fetch(`../ADMINISTRADOR/cobrar_prestamo_backend.php?dni=${dni}`)
            .then(response => response.json())
            .then(socio => {
                if (!socio || !socio.dni_socio) {
                    console.warn('No se encontró un socio con el DNI:', dni);
                    return;
                }

                const cuotaMensual = parseFloat(socio.cuota_mensual).toFixed(2);
                const lista = document.getElementById('selectedSocios');

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
            })
            .catch(error => {
                console.error('Error al obtener los datos del socio:', error);
            });
    }

    // Escuchar los cambios en el filtro para recargar la tabla
    document.getElementById('filterForm').addEventListener('input', function () {
        cargarSocios();
    });

    // Escuchar el evento de envío del formulario para cargar el archivo Excel
    document.getElementById('uploadForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const fileInput = document.getElementById('excelFile');
        const file = fileInput.files[0];
        if (file) {
            leerExcel(file);
        } else {
            console.error('No se ha seleccionado ningún archivo');
        }
    });

    // Función para leer el archivo Excel
    function leerExcel(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const data = e.target.result;
            const workbook = XLSX.read(data, { type: 'binary' });
            const sheet = workbook.Sheets[workbook.SheetNames[0]];
            const dnis = XLSX.utils.sheet_to_json(sheet, { header: 1 }).map(row => row[0]);
            dnis.shift(); // Eliminar el encabezado

            dnisCargados = dnis;
            console.log("DNI Cargados desde Excel:", dnisCargados);

            dnis.forEach(dni => {
                agregarSocioPorDni(dni);
            });
        };
        reader.readAsBinaryString(file);
    }

    // Cargar los socios al inicio
    cargarSocios();
});
