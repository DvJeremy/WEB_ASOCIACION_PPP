document.addEventListener("DOMContentLoaded", function () {
    const filtroInput = document.getElementById("filtro-socios");
    const tablaSocios = document.getElementById("tabla-socios").querySelector("tbody");
    const montoModal = new bootstrap.Modal(document.getElementById("montoModal")); // Instancia del modal
    const inputCargarExcel = document.getElementById("cargarExcel");
    const btnCargarListado = document.getElementById("cargarListado");

    // Variables para datos temporales del modal
    let modalDni = null;
    let modalNombre = null;
    let modalApellidos = null;

    // Cargar socios activos
    fetch("../ADMINISTRADOR/recaudar_backend.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                alert(data.error);
                return;
            }

            if (data.length === 0) {
                tablaSocios.innerHTML = "<tr><td colspan='4'>No hay socios activos disponibles.</td></tr>";
                return;
            }

            data.forEach((socio) => {
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${socio.dni_socio}</td>
                    <td>${socio.nombres}</td>
                    <td>${socio.apellidos}</td>
                    <td>
                        <button class="btn btn-primary agregar-socio" data-dni="${socio.dni_socio}" data-nombre="${socio.nombres}" data-apellidos="${socio.apellidos}">
                            Agregar
                        </button>
                    </td>
                `;
                tablaSocios.appendChild(row);
            });

            configurarBotonesAgregar();
        })
        .catch((error) => {
            console.error("Error al cargar los socios:", error);
            alert("Error al cargar los socios.");
        });

    // Filtro de búsqueda
    filtroInput.addEventListener("input", function () {
        const filtro = filtroInput.value.toLowerCase();
        const filas = tablaSocios.querySelectorAll("tr");

        filas.forEach((fila) => {
            const dni = fila.cells[0].textContent.toLowerCase();
            const nombres = fila.cells[1].textContent.toLowerCase();
            const apellidos = fila.cells[2].textContent.toLowerCase();

            if (dni.includes(filtro) || nombres.includes(filtro) || apellidos.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });

    // Configurar botones "Agregar" de la tabla
    function configurarBotonesAgregar() {
        document.querySelectorAll(".agregar-socio").forEach((button) => {
            button.addEventListener("click", function () {
                modalDni = this.getAttribute("data-dni");
                modalNombre = this.getAttribute("data-nombre");
                modalApellidos = this.getAttribute("data-apellidos");

                // Mostrar el modal para seleccionar monto
                montoModal.show();
            });
        });
    }

    // Funciones para botones del modal
    document.getElementById("monto-20").addEventListener("click", function () {
        agregarSocio(modalDni, modalNombre, modalApellidos, 20);
        montoModal.hide();
    });

    document.getElementById("monto-40").addEventListener("click", function () {
        agregarSocio(modalDni, modalNombre, modalApellidos, 40);
        montoModal.hide();
    });

    // Función para agregar un socio a la lista
    function agregarSocio(dni, nombre, apellidos, monto) {
        const listaSocios = document.getElementById("lista-socios");

        if ([...listaSocios.children].some(item => item.dataset.dni === dni)) {
            alert("El socio ya está agregado en la lista.");
            return;
        }

        const listItem = document.createElement("li");
        listItem.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");
        listItem.dataset.dni = dni;

        listItem.innerHTML = `
            ${nombre} ${apellidos} - DNI: ${dni} - Monto: S/ ${monto}
            <button class="btn btn-danger btn-sm eliminar-socio" data-dni="${dni}">
                Eliminar
            </button>
        `;

        listaSocios.appendChild(listItem);

        listItem.querySelector(".eliminar-socio").addEventListener("click", function () {
            listItem.remove();
        });
    }

    // Cargar datos desde el Excel
    btnCargarListado.addEventListener("click", function () {
        const file = inputCargarExcel.files[0];
        if (!file) {
            alert("Por favor, seleccione un archivo Excel.");
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            const data = new Uint8Array(event.target.result);
            const workbook = XLSX.read(data, { type: "array" });
            const sheetName = workbook.SheetNames[0];
            const sheet = workbook.Sheets[sheetName];
            const rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });

            const headers = rows[0];
            const dniIndex = headers.findIndex(header => header.toLowerCase().includes("dni"));
            const montoIndex = headers.findIndex(header => header.toLowerCase().includes("monto"));

            if (dniIndex === -1 || montoIndex === -1) {
                alert("El archivo Excel debe contener columnas de DNI y Monto.");
                return;
            }

            const sociosExcel = rows.slice(1).map(row => ({
                dni: row[dniIndex],
                monto: row[montoIndex]
            }));

            // Enviar datos al backend para obtener nombres y apellidos
            fetch("../ADMINISTRADOR/recaudar_backend.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ socios_excel: sociosExcel })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        alert("No se encontraron coincidencias para los DNI proporcionados.");
                        return;
                    }

                    data.forEach(socio => {
                        agregarSocio(socio.dni, socio.nombres, socio.apellidos, socio.monto);
                    });
                })
                .catch(error => {
                    console.error("Error al procesar el archivo Excel:", error);
                    alert("Error al procesar el archivo Excel.");
                });
        };

        reader.readAsArrayBuffer(file);
    });

    // Función para recaudar
    const btnRecaudar = document.getElementById("recaudarButton");
    btnRecaudar.addEventListener("click", function () {
        const listaSocios = document.getElementById("lista-socios");
        const sociosSeleccionados = [...listaSocios.children].map(item => ({
            dni: item.dataset.dni,
            monto: parseInt(item.textContent.match(/Monto: S\/ (\d+)/)[1]) // Extraer el monto del texto
        }));

        if (sociosSeleccionados.length === 0) {
            alert("No hay socios seleccionados para recaudar.");
            return;
        }

        fetch("../ADMINISTRADOR/recaudar_backend.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ socios: sociosSeleccionados })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Cuotas recaudadas exitosamente.");
                    listaSocios.innerHTML = ""; // Limpiar la lista
                } else {
                    alert(`Error al recaudar: ${data.error}`);
                }
            })
            .catch(error => {
                console.error("Error en la solicitud:", error);
                alert("Error al procesar la solicitud.");
            });
    });
});
