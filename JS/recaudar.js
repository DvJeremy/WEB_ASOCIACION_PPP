document.addEventListener("DOMContentLoaded", function () {
    const filtroInput = document.getElementById("filtro-socios");
    const tablaSocios = document.getElementById("tabla-socios").querySelector("tbody");
    const montoModal = new bootstrap.Modal(document.getElementById("montoModal")); // Instancia del modal

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

            // Configurar botones de agregar
            configurarBotonesAgregar();
        })
        .catch((error) => {
            console.error("Error al cargar los socios:", error);
            alert("Error al cargar los socios.");
        });

    // Configurar filtro
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

    // Configurar botones "Agregar" para mostrar la ventana emergente
    function configurarBotonesAgregar() {
        document.querySelectorAll(".agregar-socio").forEach((button) => {
            button.addEventListener("click", function () {
                const dni = this.getAttribute("data-dni");
                const nombre = this.getAttribute("data-nombre");
                const apellidos = this.getAttribute("data-apellidos");

                // Limpiar eventos anteriores de los botones del modal
                limpiarEventosBotones();

                // Asignar eventos con los datos correctos
                document.getElementById("monto-20").addEventListener("click", function handler20() {
                    agregarSocio(dni, nombre, apellidos, 20);
                    montoModal.hide();
                    this.removeEventListener("click", handler20); // Remover evento después de usarlo
                });

                document.getElementById("monto-40").addEventListener("click", function handler40() {
                    agregarSocio(dni, nombre, apellidos, 40);
                    montoModal.hide();
                    this.removeEventListener("click", handler40); // Remover evento después de usarlo
                });

                // Mostrar el modal
                montoModal.show();
            });
        });
    }

    // Limpiar eventos de los botones del modal
    function limpiarEventosBotones() {
        const monto20 = document.getElementById("monto-20");
        const monto40 = document.getElementById("monto-40");

        const nuevoMonto20 = monto20.cloneNode(true); // Clonar el nodo para eliminar eventos
        const nuevoMonto40 = monto40.cloneNode(true);

        monto20.parentNode.replaceChild(nuevoMonto20, monto20); // Reemplazar el nodo en el DOM
        monto40.parentNode.replaceChild(nuevoMonto40, monto40);
    }

    // Agregar socio a la lista de seleccionados
    function agregarSocio(dni, nombre, apellidos, monto) {
        const listaSocios = document.getElementById("lista-socios");

        // Verificar si el socio ya está en la lista
        if ([...listaSocios.children].some(item => item.dataset.dni === dni)) {
            alert("El socio ya está agregado en la lista.");
            return;
        }

        const listItem = document.createElement("li");
        listItem.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");
        listItem.dataset.dni = dni; // Guardar DNI como atributo para validar duplicados

        listItem.innerHTML = `
            ${nombre} ${apellidos} - DNI: ${dni} - Monto: S/ ${monto}
            <button class="btn btn-danger btn-sm eliminar-socio" data-dni="${dni}">
                Eliminar
            </button>
        `;

        listaSocios.appendChild(listItem);

        // Configurar botón de eliminar
        listItem.querySelector(".eliminar-socio").addEventListener("click", function () {
            listItem.remove();
        });
    }
});
