(() => {
 const button=document.getElementById('portalMenu'),sidebar=document.getElementById('sidebar'),overlay=document.getElementById('portalOverlay');
 function toggle(open){sidebar?.classList.toggle('portal-open',open);if(overlay)overlay.hidden=!open;button?.setAttribute('aria-expanded',String(open));}
 button?.addEventListener('click',()=>toggle(!sidebar.classList.contains('portal-open')));overlay?.addEventListener('click',()=>toggle(false));document.addEventListener('keydown',e=>{if(e.key==='Escape')toggle(false);});window.addEventListener('resize',()=>{if(innerWidth>1100)toggle(false);});
 document.querySelectorAll('[data-filter-table]').forEach(input=>input.addEventListener('input',()=>{const q=input.value.toLowerCase();document.querySelectorAll(input.dataset.filterTable+' tbody tr').forEach(r=>r.hidden=!r.textContent.toLowerCase().includes(q));}));
})();
