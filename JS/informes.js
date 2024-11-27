document.addEventListener("DOMContentLoaded", () => {
    cargarContadores();
    cargarTablaSocios();
    cargarHistorialActividad();

    // Escuchar el cambio en los filtros
    document.getElementById("orden").addEventListener("change", filtrarYOrdenarTabla);
    document.getElementById("busqueda").addEventListener("input", filtrarYOrdenarTabla);

    // Cargar los contadores
    function cargarContadores() {
        fetch("../ADMINISTRADOR/informes_backend.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "accion=obtener_contadores"
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("dineroPrestado").textContent = `S/ ${data.prestado.toFixed(2)}`;
            document.getElementById("dineroRecaudado").textContent = `S/ ${data.recaudado.toFixed(2)}`;
            document.getElementById("sociosTotales").textContent = data.sociosTotales;
            document.getElementById("sociosActivosInactivos").textContent = `${data.activos}/${data.inactivos}`;
        })
        .catch(error => console.error("Error al cargar los contadores:", error));
    }

    // Cargar la tabla de socios y aportes
    function cargarTablaSocios() {
        filtrarYOrdenarTabla();  // Asegura que la tabla de aportes se cargue inicialmente
    }

    // Función para renderizar la tabla de socios y aportes
    function renderizarTabla(data) {
        const tablaBody = document.querySelector("#tabla-socios tbody");
        tablaBody.innerHTML = '';  // Limpiar las filas de la tabla

        const filas = data.map(socio => {
            return `
                <tr>
                    <td>${socio.dni_socio}</td>      <!-- DNI -->
                    <td>${socio.nombres}</td>        <!-- Nombre -->
                    <td>${socio.apellidos}</td>      <!-- Apellido -->
                    <td>${socio.total_aportes.toFixed(2)}</td> <!-- Total Aportes -->
                </tr>`;
        }).join('');  // Crear todas las filas y unirlas en un solo string

        tablaBody.innerHTML = filas;  // Insertar las filas al mismo tiempo
    }

    // Función para renderizar el historial de actividad
    function renderizarHistorial(data) {
        const tablaBody = document.querySelector("#tabla-historial tbody");
        tablaBody.innerHTML = '';  // Limpiar las filas de la tabla

        const filas = data.map(actividad => {
            return `
                <tr>
                    <td>${actividad.dni_socio}</td>      <!-- DNI -->
                    <td>${actividad.nombres}</td>        <!-- Nombre -->
                    <td>${actividad.apellidos}</td>      <!-- Apellido -->
                    <td>${actividad.fecha_pago}</td>     <!-- Fecha de pago -->
                    <td>${actividad.monto.toFixed(2)}</td> <!-- Monto -->
                </tr>`;
        }).join('');  // Crear todas las filas y unirlas en un solo string

        tablaBody.innerHTML = filas;  // Insertar las filas al mismo tiempo
    }

    // Función que se activa con los filtros (ordenar y búsqueda)
    function filtrarYOrdenarTabla() {
        const busqueda = document.getElementById("busqueda").value; // Obtener el texto de búsqueda
        const orden = document.getElementById("orden").value; // Obtener el tipo de orden

        // Cargar la tabla de aportes
        fetch("../ADMINISTRADOR/informes_backend.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `accion=obtener_socios_aportes&busqueda=${busqueda}&orden=${orden}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.estado === "ok") {
                renderizarTabla(data.data);  // Renderizar la tabla de aportes
            } else {
                console.error("Error al cargar los datos de la tabla:", data.mensaje);
            }
        })
        .catch(error => console.error("Error al cargar la tabla:", error));

        // Cargar el historial de actividad
        cargarHistorialActividad();  // Recargar el historial al mismo tiempo
    }

    // Función para cargar el historial de actividad
    function cargarHistorialActividad() {
        const busqueda = document.getElementById("busqueda").value; // Obtener el texto de búsqueda

        fetch("../ADMINISTRADOR/informes_backend.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `accion=obtener_historial_actividad&busqueda=${busqueda}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.estado === "ok") {
                renderizarHistorial(data.data);  // Renderizar el historial de actividad
            } else {
                console.error("Error al cargar el historial de actividad:", data.mensaje);
            }
        })
        .catch(error => console.error("Error al cargar el historial:", error));
    }
});
