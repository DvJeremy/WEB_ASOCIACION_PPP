// Función para cargar los socios desde el backend
function loadSocios() {
    fetch('../BACKEND/recaudar_backend.php', {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        const sociosList = document.getElementById('sociosList');
        sociosList.innerHTML = ''; // Limpiar la tabla antes de agregar nuevos socios
        
        data.socios.forEach(socio => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${socio.dni_socio}</td>
                <td>${socio.nombre_socio}</td>
                <td>${socio.apellidos_socio}</td>
                <td><button class="btn btn-info addButton" data-dni="${socio.dni_socio}" data-nombre="${socio.nombre_socio}" data-apellidos="${socio.apellidos_socio}">Agregar</button></td>
            `;
            sociosList.appendChild(row);
        });

        // Agregar los eventos de los botones "Agregar"
        const addButtons = document.querySelectorAll('.addButton');
        addButtons.forEach(button => {
            button.addEventListener('click', showAmountModal);
        });
    });
}

// Función para mostrar la ventana emergente para elegir monto
function showAmountModal(event) {
    const socioDni = event.target.getAttribute('data-dni');
    const socioNombre = event.target.getAttribute('data-nombre');
    const socioApellidos = event.target.getAttribute('data-apellidos');
    
    // Mostrar el modal
    const amountModal = new bootstrap.Modal(document.getElementById('amountModal'));
    amountModal.show();

    // Al seleccionar el monto
    document.getElementById('amount20').addEventListener('click', function() {
        addSocioToSelected(socioDni, socioNombre, socioApellidos, 20);
        amountModal.hide();
    });

    document.getElementById('amount40').addEventListener('click', function() {
        addSocioToSelected(socioDni, socioNombre, socioApellidos, 40);
        amountModal.hide();
    });
}

// Función para agregar el socio a la lista de seleccionados
function addSocioToSelected(dni, nombre, apellidos, monto) {
    const selectedSociosList = document.getElementById('selectedSociosList');
    const li = document.createElement('li');
    li.innerHTML = `${nombre} ${apellidos} - ${dni} - $${monto} <button class="btn btn-danger removeButton" data-dni="${dni}">Eliminar</button>`;
    selectedSociosList.appendChild(li);

    // Agregar evento para eliminar
    li.querySelector('.removeButton').addEventListener('click', function() {
        li.remove();
    });
}

// Función para recaudar pagos
document.getElementById('recaudarButton').addEventListener('click', function() {
    const selectedSocios = [];
    const selectedSociosList = document.getElementById('selectedSociosList').getElementsByTagName('li');

    for (let li of selectedSociosList) {
        const dni = li.querySelector('.removeButton').getAttribute('data-dni');
        const monto = li.innerText.split('-')[1].trim().substring(1); // Extraer monto
        selectedSocios.push({ dni, monto });
    }

    // Enviar los datos al backend
    fetch('../BACKEND/recaudar_backend.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ socios: selectedSocios })
    })
    .then(response => response.json())
    .then(data => alert(data.message))
    .catch(error => alert('Error al recaudar los pagos.'));
});

// Cargar los socios cuando se carga la página
document.addEventListener('DOMContentLoaded', loadSocios);
