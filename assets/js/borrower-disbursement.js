'use strict';
(() => {
    const method = document.getElementById('receiving-method');
    if (!method) return;
    const sync = () => {
        document.querySelectorAll('[data-receiving]').forEach(label => {
            const active = label.dataset.receiving === method.value;
            label.hidden = !active;
            label.querySelectorAll('input').forEach(input => {
                input.disabled = !active;
                input.required = active;
            });
        });
    };
    method.addEventListener('change', sync);
    window.addEventListener('pageshow', sync);
    sync();
    const qr = document.querySelector('[name="receiving_qr"]');
    qr.addEventListener('change', () => {
        qr.setCustomValidity(qr.files[0]?.size > 3 * 1024 * 1024 ? 'Choose a QR image up to 3 MB.' : '');
        qr.reportValidity();
    });
})();
