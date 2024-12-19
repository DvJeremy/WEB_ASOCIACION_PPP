document.addEventListener('DOMContentLoaded', () => {
    const searchSocioInput = document.getElementById('searchSocioInput');
    const searchGaranteInput = document.getElementById('searchGaranteInput');
    const socioTable = document.getElementById('socioTable');
    const garanteTable = document.getElementById('garanteTable');
    const tagsContainer = document.getElementById('tagsContainer');
    let selectedSocio = null;
    let selectedGarantes = [];

    // Cargar datos desde el backend
    loadData('socios', socioTable, 'select-socio');
    loadData('garantes', garanteTable, 'select-garante');

    // Cargar la data para socios o garantes
    function loadData(type, table, buttonClass) {
        fetch(`generar_pbackend.php?type=${type}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.dataset.dni = item.dni;
                    tr.dataset.name = item.name;

                    tr.innerHTML = `
                        <td>${item.dni} - ${item.name}</td>
                        <td><button class="btn btn-primary btn-sm ${buttonClass}">Seleccionar</button></td>
                    `;

                    table.querySelector('tbody').appendChild(tr);
                });
            })
            .catch(error => console.error('Error al cargar los datos:', error));
    }

    // Búsqueda dinámica para socios
    searchSocioInput.addEventListener('input', () => {
        const filter = searchSocioInput.value.toLowerCase();
        filterTable(socioTable, filter);
    });

    // Búsqueda dinámica para garantes
    searchGaranteInput.addEventListener('input', () => {
        const filter = searchGaranteInput.value.toLowerCase();
        filterTable(garanteTable, filter);
    });

    function filterTable(table, filter) {
        Array.from(table.querySelectorAll('tr')).forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    // Selección de socio
    socioTable.addEventListener('click', (e) => {
        if (e.target.classList.contains('select-socio')) {
            const item = e.target.closest('tr');
            if (!selectedSocio) {
                selectedSocio = item.dataset.dni;
                addTag('socio', item.dataset.dni, item.dataset.name);
                disableTableRows(socioTable, selectedSocio);
                e.target.classList.replace('btn-primary', 'btn-success');
            }
        }
    });

    // Selección de garantes (permitir hasta 2 garantes)
    garanteTable.addEventListener('click', (e) => {
        if (e.target.classList.contains('select-garante')) {
            const item = e.target.closest('tr');
            const dni = item.dataset.dni;
            if (selectedGarantes.length < 2 && !selectedGarantes.includes(dni)) {
                selectedGarantes.push(dni);
                addTag('garante', dni, item.dataset.name);
                e.target.classList.replace('btn-primary', 'btn-success');
                // Si ya se seleccionaron 2 garantes, bloquear el resto de los botones
                if (selectedGarantes.length === 2) {
                    disableTableRows(garanteTable);
                }
            }
        }
    });

    // Agregar tags
    function addTag(type, dni, name) {
        const tag = document.createElement('div');
        tag.className = 'tag';
        tag.innerHTML = `${type === 'socio' ? 'Socio' : 'Garante'}: ${name} 
            <span class="remove-tag" data-type="${type}" data-dni="${dni}">&times;</span>`;
        tagsContainer.appendChild(tag);
    }

    // Eliminar tags
    tagsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-tag')) {
            const type = e.target.dataset.type;
            const dni = e.target.dataset.dni;
            if (type === 'socio') {
                selectedSocio = null;
                enableTableRows(socioTable);
            } else if (type === 'garante') {
                selectedGarantes = selectedGarantes.filter(g => g !== dni);
                if (selectedGarantes.length < 2) enableTableRows(garanteTable);
            }
            e.target.closest('.tag').remove();
            // Cuando se elimina un tag, se vuelve a marcar el botón como seleccionado
            if (selectedGarantes.length === 1) {
                const remainingGarante = garanteTable.querySelector(`[data-dni="${selectedGarantes[0]}"]`);
                const button = remainingGarante.querySelector('button');
                button.classList.replace('btn-primary', 'btn-success');
            }
        }
    });

    // Deshabilitar filas de la tabla
    function disableTableRows(table, excludeDni) {
        Array.from(table.querySelectorAll('tr')).forEach(row => {
            const button = row.querySelector('button');
            if (row.dataset.dni !== excludeDni) {
                button.disabled = true;
            } else {
                button.classList.replace('btn-primary', 'btn-success');
            }
        });
    }

    // Habilitar filas de la tabla
    function enableTableRows(table) {
        Array.from(table.querySelectorAll('tr')).forEach(row => {
            const button = row.querySelector('button');
            button.disabled = false;
            button.classList.replace('btn-success', 'btn-primary');
        });
    }
});
