function handleLogout() {
    // Añade aquí tu lógica de cierre de sesión
    console.log('Cerrando sesión...');
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