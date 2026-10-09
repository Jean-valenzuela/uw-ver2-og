const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');
const menuButton = document.getElementById('mobileMenuBtn');
function setMenu(open) {
    sidebar.classList.toggle('open', open);
    overlay.classList.toggle('show', open);
    menuButton.setAttribute('aria-expanded', String(open));
    menuButton.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
}
menuButton.addEventListener('click', () => setMenu(!sidebar.classList.contains('open')));
overlay.addEventListener('click', () => setMenu(false));
document.addEventListener('keydown', e => { if (e.key === 'Escape') setMenu(false); });
document.querySelectorAll('.review-form').forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();
        const decision = e.submitter?.value;
        if (decision === 'reject' && !form.elements.review_note.value.trim()) {
            form.elements.review_note.setCustomValidity('Please enter a review note before rejecting.');
            form.elements.review_note.reportValidity();
            return;
        }
        alert('Demo only: no application has been ' + (decision === 'approve' ? 'approved' : 'rejected') + '. Connect your existing backend handler.');
    });
    form.elements.review_note.addEventListener('input', () => form.elements.review_note.setCustomValidity(''));
});