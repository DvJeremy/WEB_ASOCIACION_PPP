// ------ INICIO CONTADORES ------
document.addEventListener("DOMContentLoaded", () => {
    // Cargar los contadores
    cargarContadores();
    cargarTablaSocios();

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
        fetch("../ADMINISTRADOR/informes_backend.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "accion=obtener_socios_aportes"
        })
        .then(response => response.json())
        .then(data => {
            if (data.estado === "ok") {
                const tablaBody = document.querySelector("#tabla-socios tbody");
                tablaBody.innerHTML = '';  // Limpiar las filas de la tabla

                const filas = data.data.map(socio => {
                    return `
                        <tr>
                            <td>${socio.nombres}</td>
                            <td>${socio.apellidos}</td>
                            <td>${socio.total_aportes.toFixed(2)}</td>
                        </tr>`;
                }).join('');  // Crear todas las filas y unirlas en un solo string

                tablaBody.innerHTML = filas;  // Insertar las filas al mismo tiempo
            } else {
                console.error("Error al cargar los datos de la tabla:", data.mensaje);
            }
        })
        .catch(error => console.error("Error al cargar la tabla:", error));
    }
});
// ------ FIN CONTADORES ------