import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const alerts = document.querySelectorAll('.alert');
alerts.forEach((alert, i) => {
    setTimeout(() => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => {
            alert.remove();
        }, 500);
    }, 3000 + i * 700); // Cada alerta desaparece con 0.7s de diferencia
});

document.addEventListener('DOMContentLoaded', function () {
    const tipoSelect = document.getElementById('tipoSelect');
    const estudianteSelect = document.getElementById('estudianteSelect');
    const docenteSelect = document.getElementById('docenteSelect');

    function toggleSelect() {
        const value = tipoSelect.value;
        estudianteSelect.classList.toggle('hidden', value !== 'estudiante');
        docenteSelect.classList.toggle('hidden', value !== 'docente');
    }

    tipoSelect.addEventListener('change', toggleSelect);
    toggleSelect(); // por si viene preseleccionado (old input)
});
