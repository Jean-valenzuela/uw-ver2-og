'use strict';
(() => {
  const form = document.querySelector('[data-borrower-form]');
  if (!form) return;
  const saved = JSON.parse(document.getElementById('uw-profile-data').textContent);
  const field = name => form.elements.namedItem(name);
  for (const name of ['mobile', 'reference_contact']) {
    const input = field(name);
    if (input) input.addEventListener('input', () => {
      input.value = input.value.replace(/\D/g, '').slice(0, 10);
      input.setCustomValidity(input.value && !/^9\d{9}$/.test(input.value) ? 'Enter exactly 10 digits starting with 9.' : '');
    });
  }
  document.querySelectorAll('.id-type').forEach(button => {
    const name = button.querySelector('span:last-child').textContent.trim();
    button.classList.toggle('active', field('id_type')?.value === name);
    button.setAttribute('aria-pressed', String(field('id_type')?.value === name));
    button.addEventListener('click', () => {
      field('id_type').value = name;
      document.querySelectorAll('.id-type').forEach(other => {
        other.classList.toggle('active', other === button);
        other.setAttribute('aria-pressed', String(other === button));
      });
    });
  });
  form.querySelectorAll('input[type=file]').forEach(input => {
    input.addEventListener('change', () => {
      const file = input.files[0];
      const error = file && (!/\.(pdf|jpe?g|png)$/i.test(file.name) || file.size > 5*1024*1024) ? 'Choose a PNG, JPG or PDF file up to 5 MB.' : '';
      input.setCustomValidity(error);
      const label = input.name === 'coe' ? document.getElementById('coeFileName') : document.querySelector('.uw-file-status');
      if (label) label.textContent = error || (file ? file.name : 'No replacement selected. Any previously saved file is retained.');
    });
  });
  document.querySelectorAll('.quick-amounts button').forEach(button => button.addEventListener('click', () => {
    field('loan_amount').value = button.textContent.replace(/[^0-9]/g, '');
    document.querySelectorAll('.quick-amounts button').forEach(other => other.classList.toggle('active', other === button));
  }));
  if (field('gross_income')) {
    const update = () => {
      const other = field('has_other_income').value === 'yes';
      field('income_source').disabled = !other; field('other_income').disabled = !other;
      field('income_source').required = other; field('other_income').required = other;
      field('loan_balance').disabled = field('has_loans').value !== 'yes';
      field('total_income').value = ((Number(field('gross_income').value)||0)+(other ? Number(field('other_income').value)||0 : 0)).toFixed(2);
      const employed = field('employment_status').value === 'employed';
      ['company','job_title','work_type','years_job'].forEach(name => field(name).required = employed);
    };
    form.addEventListener('input', update); form.addEventListener('change', update); update();
  }
  const region = form.querySelector('[data-address="region"]');
  if (!region) return;
  const prefix = region.name.startsWith('reference_') ? 'reference_' : '';
  const selects = ['region','province','city','barangay',prefix ? 'zip' : 'zip_code'].map(k=>field(prefix+k));
  const message = document.createElement('p');
  message.className = 'uw-address-error'; message.setAttribute('role','status'); region.after(message);
  const fill = (select, values, value = '') => {
    select.replaceChildren(new Option('Select '+select.dataset.address.replace('_',' '), ''));
    values.forEach(v => select.add(new Option(v, v)));
    select.value = values.includes(value) ? value : '';
    select.disabled = values.length === 0;
  };
  selects.forEach(select=>{select.disabled=true;});
  let addressReady = false;
  form.addEventListener('submit',event=>{if(!addressReady){event.preventDefault();message.textContent='Address data is unavailable. Reload the page to try again.';}});
  fetch('../../assets/data/addresses.json').then(response => {
    if (!response.ok) throw Error('Address data unavailable');
    return response.json();
  }).then(tree => {
    function populate(index, restore=false) {
      let branch=tree;
      for(let j=0;j<index;j++) branch=branch?.[selects[j].value];
      for(let j=index;j<selects.length;j++) {
        const options = j===4 ? (Array.isArray(branch)?branch:[]) : Object.keys(branch||{}).sort((a,b)=>a.localeCompare(b));
        fill(selects[j],options,restore ? saved[selects[j].name] : '');
        if(j===4 && options.length===1) selects[j].value=options[0];
        branch=branch?.[selects[j].value];
      }
      const zip=selects[4];
      message.textContent = selects[3].value && zip.options.length===1 ? 'Postal code is unavailable for this barangay. Please contact support to update the directory.' : '';
      addressReady=true;
    }
    selects.slice(0,4).forEach((select,index)=>select.addEventListener('change',()=>populate(index+1)));
    populate(0,true);
  }).catch(()=> {message.textContent='Address data could not load. Reload the page to try again.';});
})();
