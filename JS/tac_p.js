// Función para cargar los préstamos
function cargarPrestamos() {
    const filter = document.getElementById('filterInput').value.trim(); // Obtener filtro y eliminar espacios extra

    // Realizar la solicitud al backend
    fetch(`../ADMINISTRADOR/COMPONENTES_INFORMES/tac_pbackend.php?filter=${filter}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar los datos');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error(data.error);
            } else {
                cargarPrestamosPorSocio(data.activos, data.cancelados);
            }
        })
        .catch(error => {
            console.error('Error al cargar los datos:', error);
        });
}

// Función para agrupar los préstamos por socio
function groupBySocio(prestamos) {
    return prestamos.reduce((acc, prestamo) => {
        const dni_socio = prestamo.dni_socio;
        if (!acc[dni_socio]) {
            acc[dni_socio] = {
                socio: prestamo.socio,
                dni_socio: prestamo.dni_socio,
                activos: [],
                cancelados: []
            };
        }
        if (prestamo.estado_prestamo === 'activo') {
            acc[dni_socio].activos.push(prestamo);
        } else {
            acc[dni_socio].cancelados.push(prestamo);
        }
        return acc;
    }, {});
}

// Función para cargar los préstamos activos y cancelados por socio
function cargarPrestamosPorSocio(activos, cancelados) {
    const contenedorSocios = document.getElementById('contenedorSocios');
    contenedorSocios.innerHTML = '';  // Limpiar el contenedor antes de agregar los datos

    if (!activos || !cancelados) {
        console.error('No hay datos disponibles para mostrar.');
        return;
    }

    // Agrupar los préstamos por socio
    const prestamosAgrupados = groupBySocio([...activos, ...cancelados]);

    // Mostrar cada socio con sus préstamos activos y cancelados
    for (const dni_socio in prestamosAgrupados) {
        const socio = prestamosAgrupados[dni_socio];
        const totalPrestamos = socio.activos.length + socio.cancelados.length; // Sumar activos y cancelados

        const div = document.createElement('div');
        div.classList.add('socio-container');
        
        div.innerHTML = `
            <div class="socio-header">
                <div class="socio-info">
                    ${socio.socio} (${socio.dni_socio})
                </div>
                <div class="prestamos-count">
                    Activos: ${socio.activos.length} | Cancelados: ${socio.cancelados.length} | Total: ${totalPrestamos}
                </div>
            </div>
            <div class="prestamos-container">
                ${generatePrestamosHTML(socio.activos, 'activo')}
                ${generatePrestamosHTML(socio.cancelados, 'cancelado')}
            </div>
        `;
        contenedorSocios.appendChild(div);
    }

    // Filtrar los divs según el texto introducido en el input
    filterDivs(filter);
}

// Función para generar el HTML de los préstamos
function generatePrestamosHTML(prestamos, tipo) {
    let prestamosHTML = '';
    prestamos.forEach(prestamo => {
        prestamosHTML += `
            <div class="prestamo-${tipo}">
                <h5>${tipo === 'activo' ? 'Préstamo Activo' : 'Préstamo Cancelado'}</h5>
                <p>Monto: S/ ${prestamo.monto}</p>
                <p>${tipo === 'activo' ? 'Fecha de Emisión' : 'Fecha de Finalización'}: ${prestamo.fecha_emision || prestamo.fecha_finalizacion}</p>
                <button class="more-info-btn" 
                        data-id="${prestamo.id_prestamo}" 
                        data-tipo="${tipo}">
                    Más Información
                </button>
            </div>
        `;
    });
    return prestamosHTML;
}

// Función para filtrar los divs generados
function filterDivs(filter) {
    const sociosDivs = document.querySelectorAll('.socio-container');
    sociosDivs.forEach(div => {
        const socioInfo = div.querySelector('.socio-info').textContent.toLowerCase();
        if (socioInfo.includes(filter.toLowerCase())) {
            div.style.display = ''; // Mostrar div si cumple con el filtro
        } else {
            div.style.display = 'none'; // Ocultar div si no cumple con el filtro
        }
    });
}

// Llamar a la función cuando se carga la página
document.addEventListener('DOMContentLoaded', cargarPrestamos);

// Función para actualizar los datos cuando el filtro cambia
document.getElementById('filterInput').addEventListener('input', cargarPrestamos);
