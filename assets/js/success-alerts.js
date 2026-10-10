(() => {
  'use strict';
  if (window.UWSuccess) return;
  let shown = false;
  async function show(data = {}) {
    document.querySelectorAll('dialog[open]').forEach(dialog => dialog.close());
    const title = data.title || 'Saved successfully';
    const text = data.text || data.message || 'Your submission was saved.';
    if (window.Swal) {
      await Swal.fire({icon:'success', title, text, confirmButtonText:'OK',
        confirmButtonColor:'#062347', heightAuto:false, allowOutsideClick:false, allowEscapeKey:false});
    } else {
      window.alert(title + '\n' + text);
    }
  }
  window.UWSuccess = {show};
  function run() {
    if (shown) return;
    let data = null;
    const custom = document.getElementById('uwSuccessData');
    if (custom) {
      try {data = JSON.parse(custom.textContent);} catch {}
      custom.remove();
    }
    if (!data) {
      const notice = document.querySelector('[data-uw-notice][data-uw-kind="success"]');
      if (notice?.textContent.trim()) data = {title:'Saved successfully',text:notice.textContent.trim()};
    }
    // Legacy one-time feedback remains compatible with the existing pages.
    if (!data) {
      for (const id of ['lenderNotice','adminFeedback','paymentMessage']) {
        const notice = document.getElementById(id);
        if (notice && !notice.hidden && notice.textContent.trim()) {
          data = {title:'Saved successfully',text:notice.textContent.trim()};
          break;
        }
      }
    }
    if (data) {shown=true;void show(data);}
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded',run,{once:true});
  else run();
})();
