function handleLogout() {
    console.log('Cerrando sesión...');
    window.location.href = '../login/login.php';
}

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    const collapseIcon = sidebarCollapse.querySelector('i');
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    let tooltipList = [];

    function enableTooltips() {
        tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    function disableTooltips() {
        tooltipList.forEach(tooltip => {
            tooltip.dispose();
        });
        tooltipList = [];
    }

    sidebarCollapse.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
        
        if (sidebar.classList.contains('collapsed')) {
            collapseIcon.classList.replace('bi-arrow-left-circle', 'bi-arrow-right-circle');
            sidebarCollapse.setAttribute('aria-label', 'Expandir sidebar');
            enableTooltips();
        } else {
            collapseIcon.classList.replace('bi-arrow-right-circle', 'bi-arrow-left-circle');
            sidebarCollapse.setAttribute('aria-label', 'Colapsar sidebar');
            disableTooltips();
        }
    });
});

// ----------- SIMULADOR -----------

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loanForm');
    const installmentsInput = document.getElementById('installments');
    const decreaseBtn = document.getElementById('decreaseInstallments');
    const increaseBtn = document.getElementById('increaseInstallments');
    const resultsDiv = document.getElementById('results');

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

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const amount = parseFloat(document.getElementById('amount').value);
        const installments = parseInt(installmentsInput.value);
        const interestRate = parseFloat(document.getElementById('interestRate').value) / 100;

        if (isNaN(amount) || isNaN(interestRate)) {
            alert('Por favor, ingrese valores válidos para el monto y la tasa de interés.');
            return;
        }

        const monthlyRate = interestRate / 12;
        const monthlyPayment = (amount * monthlyRate * Math.pow(1 + monthlyRate, installments)) / (Math.pow(1 + monthlyRate, installments) - 1);

        let resultsHTML = `
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title">Resultados de la simulación</h3>
                    <p>Monto del préstamo: S/ ${amount.toFixed(2)}</p>
                    <p>Número de cuotas: ${installments}</p>
                    <p>Tasa de interés anual: ${(interestRate * 100).toFixed(2)}%</p>
                    <p>Cuota mensual: S/ ${monthlyPayment.toFixed(2)}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cuota</th>
                                <th>Saldo Inicial</th>
                                <th>Interés</th>
                                <th>Capital</th>
                                <th>Saldo Final</th>
                            </tr>
                        </thead>
                        <tbody>
        `;

        let balance = amount;
        for (let i = 1; i <= installments; i++) {
            const interest = balance * monthlyRate;
            const principal = monthlyPayment - interest;
            const finalBalance = balance - principal;

            resultsHTML += `
                <tr>
                    <td>${i}</td>
                    <td>S/ ${balance.toFixed(2)}</td>
                    <td>S/ ${interest.toFixed(2)}</td>
                    <td>S/ ${principal.toFixed(2)}</td>
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