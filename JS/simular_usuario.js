// ----------- SIMULADOR USUARIO -----------

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loanForm');
    const installmentsInput = document.getElementById('installments');
    const decreaseBtn = document.getElementById('decreaseInstallments');
    const increaseBtn = document.getElementById('increaseInstallments');
    const resultsDiv = document.getElementById('results');

    // Ajustar número de cuotas
    decreaseBtn.addEventListener('click', function () {
        let value = parseInt(installmentsInput.value);
        if (value > 2) {
            installmentsInput.value = value - 1;
        }
    });

    increaseBtn.addEventListener('click', function () {
        let value = parseInt(installmentsInput.value);
        if (value < 36) {
            installmentsInput.value = value + 1;
        }
    });

    // Manejo del formulario
    form.addEventListener('submit', function (e) {
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
        const resultsHTML = `
            <div class="card shadow border-0">
                <div class="card-body">
                    <h3 class="card-title text-center">Resultados de tu Simulación</h3>
                    <p class="text-muted text-center mb-4">Aquí tienes los detalles de tu préstamo simulado:</p>
                    <div class="row text-center">
                        <div class="col-6">
                            <h5>Monto</h5>
                            <p>S/ ${amount.toFixed(2)}</p>
                        </div>
                        <div class="col-6">
                            <h5>Cuotas</h5>
                            <p>${installments}</p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-6">
                            <h5>Interés</h5>
                            <p>S/ ${interest.toFixed(2)}</p>
                        </div>
                        <div class="col-6">
                            <h5>Amortización</h5>
                            <p>S/ ${amortization.toFixed(2)}</p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4 class="text-success">Cuota Mensual</h4>
                        <p class="fs-4"><strong>S/ ${monthlyPayment.toFixed(2)}</strong></p>
                    </div>
                </div>
            </div>
        `;

        resultsDiv.innerHTML = resultsHTML;
    });
});
