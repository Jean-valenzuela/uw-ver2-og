(() => {
  'use strict';
  if (window.UWForms) return;
  const busy = new WeakSet();
  const errors = new WeakMap();
  const named = (form, name) => [...form.elements].find(el => el.name === name && !el.disabled);
  function clear(input) {
    if (!errors.has(input)) return;
    if (input.validationMessage === errors.get(input)) input.setCustomValidity('');
    errors.delete(input);
    input.removeAttribute('aria-invalid');
  }
  function showError(form, message, field) {
    if (!form) return;
    if (/failed to fetch|networkerror|load failed|unexpected token|unexpected end.*json/i.test(message)) message='The connection or server response was interrupted. Your details are still here. Check whether it was saved before trying again.';
    const input = field && named(form, field);
    // Business/session/network failures belong to the form, not an unrelated field.
    if (input && input.type !== 'hidden' && input.willValidate) {
      form.querySelectorAll('[data-uw-form-error], .uw-error, [data-error]').forEach(note=>note.textContent='');
      clear(input);
      input.setCustomValidity(message);
      errors.set(input, message);
      input.setAttribute('aria-invalid', 'true');
      input.scrollIntoView({block:'center', behavior:'smooth'});
      input.focus({preventScroll:true});
      input.reportValidity();
      return;
    }
    let note = form.querySelector('[data-uw-form-error], .uw-error, [data-error], [role="alert"]');
    if (!note) {
      note = document.createElement('p');
      note.dataset.uwFormError = '1';
      note.setAttribute('role', 'alert');
      form.append(note);
    }
    note.hidden = false;
    note.textContent = message;
    if (window.Swal && !form.closest('dialog[open]')) {
      Swal.fire({icon:'error', title:'Please check your submission', text:message,
        confirmButtonText:'OK', confirmButtonColor:'#062347', heightAuto:false});
    } else note.scrollIntoView({block:'nearest'});
  }
  window.UWForms = {showError};
  function registrationChecks(form) {
    if (!named(form, 'confirm-password')) return;
    const first = named(form, 'password'), confirm = named(form, 'confirm-password');
    clear(first); clear(confirm);
    if (first.value && (new TextEncoder().encode(first.value).length < 8 || new TextEncoder().encode(first.value).length > 72)) {
      first.setCustomValidity('Use a password of 8 to 72 bytes.'); errors.set(first, first.validationMessage);
    }
    if (confirm.value && confirm.value !== first.value) {
      confirm.setCustomValidity('The passwords do not match.'); errors.set(confirm, confirm.validationMessage);
    }
  }
  document.addEventListener('input', event => {
    const input = event.target;
    if (!input.form) return;
    clear(input);
    if (['password','confirm-password'].includes(input.name)) registrationChecks(input.form);
  }, true);
  document.addEventListener('change', event => {
    const input = event.target;
    if (!input.form) return;
    clear(input);
    if (input.type === 'file' && input.files.length) {
      const allowed = input.accept.split(',').map(s=>s.trim().toLowerCase()).filter(Boolean);
      const invalid = [...input.files].find(file => file.size > 5 * 1024 * 1024 ||
        (allowed.length && !allowed.some(type => type.startsWith('.') ? file.name.toLowerCase().endsWith(type) :
          type.endsWith('/*') ? file.type.startsWith(type.slice(0,-1)) : file.type === type)));
      if (invalid) {
        const msg = invalid.size > 5 * 1024 * 1024 ? 'Choose a file up to 5 MB.' : 'Choose one of the allowed file types.';
        input.setCustomValidity(msg); errors.set(input,msg); input.reportValidity();
      }
    }
  });
  // Run before existing handlers, including forms created inside dialogs.
  document.addEventListener('submit', event => {
    const form = event.target;
    if (!(form instanceof HTMLFormElement)) return;
    if (busy.has(form) || form.dataset.uwPending === '1') {event.preventDefault(); event.stopImmediatePropagation(); return;}
    registrationChecks(form);
    if (!form.reportValidity()) {event.preventDefault(); event.stopImmediatePropagation();}
  }, true);
  document.addEventListener('submit', async event => {
    const form = event.target;
    if (!(form instanceof HTMLFormElement) || event.defaultPrevented || form.method.toLowerCase() !== 'post') return;
    const action = new URL(event.submitter?.hasAttribute('formaction') ? event.submitter.formAction : form.action, location.href);
    if (action.origin !== location.origin || form.target === '_blank' || form.dataset.uwNative === '1') return;
    event.preventDefault();
    if (busy.has(form)) return;
    busy.add(form);
    const body = new FormData(form);
    if (event.submitter?.name) body.append(event.submitter.name, event.submitter.value);
    const buttons = [...form.querySelectorAll('button, input[type=submit]')];
    const states = buttons.map(b=>b.disabled);
    buttons.forEach(b=>b.disabled=true);
    form.setAttribute('aria-busy','true');
    const note = form.querySelector('[data-uw-form-error], .uw-error, [data-error]');
    if (note) note.textContent='';
    let navigating = false;
    try {
      const response = await fetch(action, {method:'POST', body, credentials:'same-origin',
        headers:{'X-UW-Form':'1','Accept':'application/json'}});
      const type = response.headers.get('content-type') || '';
      if (!type.includes('application/json')) {
        throw new Error(response.status === 413 ? 'The selected uploads are too large. Choose smaller files.' :
          'The server could not confirm this submission. Your details are still here. Check the saved records before trying again.');
      }
      let data;
      try {data = await response.json();}
      catch {throw new Error('The server returned an incomplete response. Your details are still here. Check whether it was saved before retrying.');}
      if (!data || typeof data !== 'object') throw new Error('The server could not confirm this submission. Your details are still here.');
      if (!response.ok || data.ok === false || data.error) {
        showError(form, data.error || 'Please check your details.', data.field);
        if (data.csrf) form.querySelectorAll('[name=csrf]').forEach(input=>input.value=data.csrf);
        return;
      }
      if (data.success && window.UWSuccess) await window.UWSuccess.show(data.success);
      if (data.redirect) {
        const destination = new URL(data.redirect, location.href);
        if (destination.origin !== location.origin) {
          // Hosted payment checkout redirects may use an external HTTPS URL.
          if (destination.protocol !== 'https:') throw new Error('Invalid checkout address.');
        }
        location.assign(destination.href);
        navigating = true;
      } else {
        if (!data.success && window.UWSuccess) await window.UWSuccess.show({text:data.message || 'Your submission was saved.'});
      }
    } catch (error) {
      showError(form, error instanceof TypeError ? 'Connection interrupted. Your details are still here. Check whether the submission was saved before trying again.' : error.message);
    } finally {
      if (!navigating) busy.delete(form);
      buttons.forEach((b,index)=>b.disabled=navigating || states[index]);
      form.removeAttribute('aria-busy');
    }
  });
})();
