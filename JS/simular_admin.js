// ----------- SIMULADOR ADMIN -----------

// Evento para cuando se carga el DOM
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loanForm');
    const installmentsInput = document.getElementById('installments');
    const decreaseBtn = document.getElementById('decreaseInstallments');
    const increaseBtn = document.getElementById('increaseInstallments');
    const resultsDiv = document.getElementById('results');

    // Ajustar número de cuotas
    decreaseBtn.addEventListener('click', function() {
        let value = parseInt(installmentsInput.value);
        if (value > 2) {
            installmentsInput.value = value - 1;
        }
    });

    increaseBtn.addEventListener('click', function() {
        let value = parseInt(installmentsInput.value);
        if (value < 36) {
            installmentsInput.value = value + 1;
        }
    });

    // Manejo del formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const amount = parseFloat(document.getElementById('amount').value);
        const installments = parseInt(installmentsInput.value);
        const interestRate = parseFloat(document.getElementById('interestRate').value) / 100;

        if (isNaN(amount) || isNaN(interestRate) || amount <= 0 || interestRate <= 0) {
            alert('Por favor, ingrese valores válidos para el monto y la tasa de interés.');
            return;
        }

        // Cálculos
        const interest = amount * interestRate;
        const amortization = amount / installments;
        const monthlyPayment = interest + amortization;

        // Generar resultados
        let resultsHTML = `
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title">Resultados de la simulación</h3>
                    <p><strong>Monto:</strong> S/ ${amount.toFixed(2)}</p>
                    <p><strong>Cuotas:</strong> ${installments}</p>
                    <p><strong>Tasa de interés anual:</strong> ${(interestRate * 100).toFixed(2)}%</p>
                    <p><strong>Interés:</strong> S/ ${interest.toFixed(2)}</p>
                    <p><strong>Amortización:</strong> S/ ${amortization.toFixed(2)}</p>
                    <p><strong>Cuota mensual:</strong> S/ ${monthlyPayment.toFixed(2)}</p>
                    <hr>
                    <h4>Detalle por cuotas</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cuota</th>
                                <th>Saldo Inicial</th>
                                <th>Interés</th>
                                <th>Amortización</th>
                                <th>Saldo Final</th>
                            </tr>
                        </thead>
                        <tbody>
        `;

        let balance = amount;
        for (let i = 1; i <= installments; i++) {
            const finalBalance = balance - amortization;

            resultsHTML += `
                <tr>
                    <td>${i}</td>
                    <td>S/ ${balance.toFixed(2)}</td>
                    <td>S/ ${interest.toFixed(2)}</td>
                    <td>S/ ${amortization.toFixed(2)}</td>
                    <td>S/ ${finalBalance.toFixed(2)}</td>
                </tr>
            `;

            balance = finalBalance;
        }

        resultsHTML += `
                        </tbody>
                    </table>
                    <button id="generateLoan" class="btn btn-primary w-100">Generar Préstamo</button>
                </div>
            </div>
        `;

        resultsDiv.innerHTML = resultsHTML;

        // Agregar evento para generar el préstamo
        document.getElementById('generateLoan').addEventListener('click', function() {
            const confirmation = confirm('¿Desea continuar con la generación del préstamo?');
            if (confirmation) {
                // Obtener los datos necesarios para el préstamo
                const tags = document.querySelectorAll('.tag');
                const socio = Array.from(tags).find(tag => tag.querySelector('.remove-tag[data-type="socio"]'));
                const garantes = Array.from(tags)
                    .map(tag => tag.querySelector('.remove-tag[data-type="garante"]'))
                    .filter(Boolean);

                console.log('Socio:', socio ? socio.querySelector('.remove-tag').dataset.dni : 'No se seleccionó socio');
                console.log('Garantes:', garantes.map(garante => garante.dataset.dni));

                // Datos para enviar al backend
                const data = {
                    monto: amount,
                    cuotas: installments,
                    cuotaMensual: monthlyPayment.toFixed(2),
                    tasa: interestRate * 100,
                    interes: interest.toFixed(2),
                    amortizacion: amortization.toFixed(2),
                    dniSocio: socio ? socio.querySelector('.remove-tag').dataset.dni : null,
                    dniGarante1: garantes.length > 0 ? garantes[0].dataset.dni : null,
                    dniGarante2: garantes.length > 1 ? garantes[1].dataset.dni : null,
                    cuotasDetalles: [] // Aquí irán los detalles de cada cuota
                };

                // Preparar detalles de cuotas
                let balance = amount;
                for (let i = 1; i <= installments; i++) {
                    const finalBalance = balance - amortization;
                    data.cuotasDetalles.push({
                        numeroCuota: i,
                        saldoInicial: balance.toFixed(2),
                        saldoFinal: finalBalance.toFixed(2)
                    });
                    balance = finalBalance;
                }

                // Enviar los datos al backend
                fetch('../ADMINISTRADOR/simular_pbackend.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(response => {
                    if (response.status === 'success') {
                        alert('Préstamo generado con éxito');
                    } else {
                        alert('Hubo un error al generar el préstamo: ' + response.message);
                    }
                })
                .catch(error => alert('Error en la conexión: ' + error));
            }
        });
    });
});
