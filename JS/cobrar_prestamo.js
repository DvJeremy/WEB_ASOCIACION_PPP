document.addEventListener('DOMContentLoaded', function () {

    // Función para cargar socios desde el backend
    function cargarSocios() {
        const filtro = document.getElementById('filtro').value;

        fetch(`../ADMINISTRADOR/cobrar_prestamo_backend.php?filtro=${filtro}`)
            .then(response => response.json())
            .then(data => {
                const tabla = document.querySelector('#sociosTable tbody');
                tabla.innerHTML = '';

                data.forEach(socio => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${socio.dni_socio}</td>
                        <td>${socio.nombres}</td>
                        <td>${socio.apellidos}</td>
                        <td>${socio.monto}</td>
                        <td>${socio.cuotas_pendientes}</td>
                        <td><button class="btn btn-primary agregar-btn" data-socio='${JSON.stringify(socio)}'>Agregar</button></td>
                        <td><button class="btn btn-danger cancelar-btn" data-id_prestamo="${socio.id_prestamo}">Cancelar Préstamo</button></td>
                    `;
                    tabla.appendChild(tr);
                });
            })
            .catch(error => console.error('Error al cargar los socios:', error));
    }

    // Función para cancelar préstamo
    function cancelarPrestamo(id_prestamo) {
        fetch(`../ADMINISTRADOR/cobrar_prestamo_backend.php?accion=cancelar&id_prestamo=${id_prestamo}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    cargarSocios(); // Recargar la lista de socios
                } else {
                    alert('Error al cancelar el préstamo');
                }
            })
            .catch(error => console.error('Error al cancelar el préstamo:', error));
    }

    // Evento para cancelar préstamo
    document.querySelector('#sociosTable').addEventListener('click', event => {
        if (event.target && event.target.classList.contains('cancelar-btn')) {
            const id_prestamo = event.target.getAttribute('data-id_prestamo');
            cancelarPrestamo(id_prestamo);
        }
    });

    // Función para agregar socio por DNI (cuando se hace clic en "Agregar" o desde el Excel)
    function agregarSocioPorDNI(dni) {
        fetch(`../ADMINISTRADOR/cobrar_prestamo_backend.php?dni=${dni}`)
            .then(response => response.json())
            .then(data => {
                const lista = document.getElementById('selectedSocios');

                data.forEach(socio => {
                    const existe = [...lista.children].some(item => 
                        item.getAttribute('data-dni') === socio.dni_socio &&
                        item.getAttribute('data-id') === socio.id_prestamo.toString()
                    );

                    if (!existe) {
                        const li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.setAttribute('data-dni', socio.dni_socio);
                        li.setAttribute('data-id', socio.id_prestamo);
                        li.innerHTML = `
                            ${socio.nombres} ${socio.apellidos} (DNI: ${socio.dni_socio}) - Cuota: ${parseFloat(socio.cuota_mensual).toFixed(2)}
                            <button class="btn btn-danger btn-sm float-end eliminar-btn">Eliminar</button>
                        `;
                        li.querySelector('.eliminar-btn').addEventListener('click', () => {
                            lista.removeChild(li);
                        });
                        lista.appendChild(li);
                    }
                });
            })
            .catch(error => console.error('Error al agregar socio por DNI:', error));
    }

    // Función para procesar el archivo Excel
    function procesarExcel(file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            const sheetName = workbook.SheetNames[0];
            const sheet = workbook.Sheets[sheetName];
            const rows = XLSX.utils.sheet_to_json(sheet);

            rows.forEach(row => {
                if (row.DNI) {
                    agregarSocioPorDNI(row.DNI);
                }
            });
        };

        reader.readAsArrayBuffer(file);
    }

    // Evento para agregar socio desde la tabla de préstamos
    document.querySelector('#sociosTable').addEventListener('click', event => {
        if (event.target && event.target.classList.contains('agregar-btn')) {
            const socio = JSON.parse(event.target.getAttribute('data-socio'));
            agregarSocioPorDNI(socio.dni_socio);
        }
    });

    // Evento para procesar el archivo Excel
    document.getElementById('uploadForm').addEventListener('submit', event => {
        event.preventDefault();
        const file = document.getElementById('excelFile').files[0];
        if (file) {
            procesarExcel(file);
        }
    });

    // Evento para filtrar los socios
    document.getElementById('filterForm').addEventListener('input', cargarSocios);

    // Cargar los socios al inicio
    cargarSocios();
});
