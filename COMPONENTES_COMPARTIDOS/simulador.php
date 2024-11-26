
    <!-- SIMULADOR -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">¡Simula tus cuotas!</h2>
                        <form id="loanForm">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Monto (Soles)</label>
                                <input type="number" class="form-control" id="amount" placeholder="Cantidad" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Cuotas (2 a 36)</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-dark" type="button" id="decreaseInstallments">-</button>
                                    <input type="number" class="form-control text-center" id="installments" value="2" min="2" max="36" readonly>
                                    <button class="btn btn-outline-dark" type="button" id="increaseInstallments">+</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="interestRate" class="form-label">Tasa de Interés Anual % (TEA)</label>
                                <input type="number" class="form-control" id="interestRate" placeholder="0%" required>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Quiero Simular</button>
                        </form>
                    </div>
                </div>
                <div id="results" class="mt-4"></div>
            </div>
        </div>
    </div>
    <!-- FIN SIMULADOR -->