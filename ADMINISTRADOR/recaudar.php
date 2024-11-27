<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recaudar Cuota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/recaudar.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
</head>
<body>

    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/recaudar.js"></script>

    <!-- Contenido Principal -->
    <div class="main-content" id="mainContent">
        <h1>Recaudar Cuota</h1>
        <!-- Tabla de Socios -->
        <h4>Lista de Socios Activos</h4>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="tabla-socios">
                    <!-- Aquí se agregarán los socios dinámicamente -->
                </tbody>
            </table>
        </div>

        <!-- Lista de Socios Seleccionados -->
        <h4>Socios Seleccionados para Recaudar</h4>
        <div class="selected-socios-list">
            <!-- Aquí se agregarán los socios seleccionados -->
        </div>

        <!-- Botón para Recaudar -->
        <div class="mt-3">
            <button class="btn btn-success" id="btn-recaudar">Recaudar</button>
        </div>
    </div>

</body>
</html>

<script>
    // Usar AJAX para obtener los socios activos desde el backend
    document.addEventListener("DOMContentLoaded", function() {
        fetch('../BACKEND/recaudar_backend.php')
            .then(response => response.json())
            .then(data => {
                let sociosTable = document.getElementById("tabla-socios");

                // Recorrer los datos y agregar filas a la tabla
                data.forEach(socio => {
                    let row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${socio.dni_socio}</td>
                        <td>${socio.nombre_socio}</td>
                        <td>${socio.apellidos_socio}</td>
                        <td>
                            <button class="btn btn-primary agregar-socio" data-dni="${socio.dni_socio}" data-nombre="${socio.nombre_socio}" data-apellidos="${socio.apellidos_socio}">
                                Agregar
                            </button>
                        </td>
                    `;
                    sociosTable.appendChild(row);
                });
            })
            .catch(error => console.error("Error al cargar los socios:", error));
    });

    // Función para agregar socio a la lista de seleccionados
    document.addEventListener("click", function(event) {
        if (event.target && event.target.classList.contains("agregar-socio")) {
            let dni = event.target.getAttribute("data-dni");
            let nombre = event.target.getAttribute("data-nombre");
            let apellidos = event.target.getAttribute("data-apellidos");

            // Mostrar ventana emergente para elegir monto
            let monto = prompt("¿Cuánto se le cobrará al socio? (20 o 40)");

            if (monto == "20" || monto == "40") {
                // Crear un nuevo elemento de lista con los datos del socio y el monto
                let selectedList = document.querySelector(".selected-socios-list");
                let item = document.createElement("div");
                item.classList.add("selected-socio");
                item.innerHTML = `
                    <span>${dni} - ${nombre} ${apellidos} - Monto: ${monto}</span>
                    <button class="btn btn-danger btn-sm eliminar-socio">Eliminar</button>
                `;
                selectedList.appendChild(item);
            } else {
                alert("Por favor ingrese un monto válido (20 o 40).");
            }
        }

        // Eliminar socio de la lista seleccionada
        if (event.target && event.target.classList.contains("eliminar-socio")) {
            let item = event.target.closest(".selected-socio");
            item.remove();
        }
    });
</script>
