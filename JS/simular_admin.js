// ----------- SIMULADOR ADMIN -----------

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
                </div>
            </div>
        `;

        resultsDiv.innerHTML = resultsHTML;
    });
});
