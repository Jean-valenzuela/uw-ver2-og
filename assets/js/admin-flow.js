(() => {
'use strict';
const cfg=JSON.parse(document.getElementById('adminConfig').textContent);
const modal=document.getElementById('adminModal'),body=document.getElementById('adminModalBody');
const esc=v=>String(v??'').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const feedback=document.getElementById('adminFeedback');feedback.textContent=sessionStorage.getItem('uwAdminFeedback')||'';sessionStorage.removeItem('uwAdminFeedback');
let table;
if(cfg.page!=='dashboard'){
 table=new DataTable('#adminTable',{layout:{topStart:null,topEnd:null,bottomStart:'info',bottomEnd:'paging'},pageLength:10,order:[],columnDefs:[{targets:5,orderable:false}],language:{emptyTable:'No lender applications found.'}});
 document.getElementById('lenderSearch').addEventListener('input',e=>table.search(e.target.value).draw());
 document.getElementById('statusFilter')?.addEventListener('change',e=>table.column(4).search(e.target.value,{exact:true}).draw());
}
async function api(action,values={}){
 const r=await fetch('../controllers/admin-actions.php',{method:'POST',headers:{'X-UW-Form':'1'},body:new URLSearchParams({csrf:cfg.csrf,action,...values})});
 if(!r.headers.get('content-type')?.includes('application/json'))throw new Error('Your session expired or the request was rejected. Reload and sign in again.');
 const d=await r.json();if(d.csrf)cfg.csrf=d.csrf;if(!r.ok)throw Object.assign(new Error(d.error||'Request failed.'),{field:d.field});return d;
}
const statusMessage=s=>({sent:'The mail server accepted the notification.',queued:'Email is queued. Configure the Gmail App Password, then retry.',failed:'Email failed.',uncertain:'Delivery is uncertain. Check Gmail Sent before retrying.',sending:'Email is currently being sent.'}[s]||'');
const mailStatusText=d=>[
 statusMessage(d.mail_status),
 d.mail_error || ''
].filter(Boolean).join(' ');
async function finish(d){await window.UWSuccess.show({title:'Saved successfully',text:[d.message,mailStatusText(d)].filter(Boolean).join(' ')||'Your changes were saved.'});location.reload();}
function error(e){const form=body.querySelector('form');if(form&&window.UWForms){window.UWForms.showError(form,e.message,e.field);if(e.field)return;}let el=body.querySelector('[role="alert"]');if(!el){el=document.createElement('p');el.setAttribute('role','alert');el.className='admin-error';body.prepend(el);}el.textContent=e.message;}
let generation=0;
async function show(id){
 const request=++generation;body.textContent='Loading application…';if(!modal.open)modal.showModal();
 try{
 const r=await fetch('../controllers/admin-data.php?id='+encodeURIComponent(id));if(!r.headers.get('content-type')?.includes('application/json'))throw new Error('Please sign in again.');
 const u=await r.json();if(!r.ok)throw new Error(u.error||'Cannot load application.');if(request!==generation)return;
 const v=u.requirements;
 const fields=[['Email',u.email],['Phone',u.phone],['Date applied',u.submitted_at||'Not recorded'],['Status',u.account_status],['Source of funds',v.source_of_funds||'Not submitted'],['Lending limit',v.lending_limit?'PHP '+Number(v.lending_limit).toLocaleString('en-PH',{minimumFractionDigits:2}):'Not submitted'],['Lender reason',v.lender_reason||'Not submitted'],['Review note',u.review_note||'None']];
 body.innerHTML=`<h3>${esc(u.user_fn+' '+u.user_ln)}</h3><dl class="admin-details">${fields.map(([k,v])=>`<dt>${esc(k)}</dt><dd>${esc(v)}</dd>`).join('')}</dl><h3>Submitted requirements</h3><div class="admin-documents">${u.documents.map(d=>`<a class="view-btn" target="_blank" rel="noopener" href="../controllers/admin-document.php?id=${Number(id)}&document=${Number(d.document_id)}">View ${esc(({source_proof:'proof of funds',valid_id:'valid ID',lender_photo:'selfie / profile photo'})[d.kind]||d.kind)}</a>`).join('')||'<p>No documents submitted.</p>'}</div><div id="decisionArea"></div><div id="mailArea"></div>`;
 const area=document.getElementById('decisionArea');
 if(u.account_status==='pending'){
 area.innerHTML='<form id="decisionForm" class="admin-form"><label>Review note (required for rejection)<textarea name="note" maxlength="2000"></textarea></label><div class="admin-actions"><button class="approve-btn" type="submit" value="approve">Approve & Send email</button><button class="reject-btn" type="submit" value="reject">Reject & Send email</button></div></form>';
 document.getElementById('decisionForm').addEventListener('submit',async e=>{
 e.preventDefault();if(e.target.dataset.uwPending==='1')return;const action=e.submitter?.value;if(!action)return;const note=e.target.elements.note.value.trim();
 if(action==='reject'&&note.length<5){error(Object.assign(new Error('Provide a rejection reason of at least 5 characters.'),{field:'note'}));return;}
 e.target.dataset.uwPending='1';const buttons=[...e.target.querySelectorAll('button')];buttons.forEach(b=>b.disabled=true);
 try{await finish(await api(action,{id,note}));}catch(err){error(err);delete e.target.dataset.uwPending;buttons.forEach(b=>b.disabled=false);}
 });
 }else if(u.account_status==='approved'&&cfg.page==='approved-lenders'){
 area.innerHTML='<form id="deleteForm" class="admin-form"><h3>Delete profile</h3><p>This removes the lender from the lists and disables login. Linked loan records are retained.</p><label>Type DELETE to confirm<input name="confirm_delete" required pattern="DELETE" autocomplete="off"></label><button class="reject-btn" type="submit">Delete profile</button></form>';
 document.getElementById('deleteForm').addEventListener('submit',async e=>{e.preventDefault();if(e.target.dataset.uwPending==='1')return;e.target.dataset.uwPending='1';const b=e.target.querySelector('button');b.disabled=true;try{await finish(await api('delete',{id,confirm_delete:e.target.elements.confirm_delete.value}));}catch(err){error(err);delete e.target.dataset.uwPending;b.disabled=false;}});
 }
 document.getElementById('mailArea').innerHTML=u.emails.map(m=>`<section class="admin-mail"><strong>Email: ${esc(m.status)}</strong><p>${esc(m.last_error||statusMessage(m.status))}</p>${['queued','failed','uncertain'].includes(m.status)?`${m.status==='uncertain'?'<label><input type="checkbox" class="ack"> I checked Gmail Sent and acknowledge that retrying may duplicate the email.</label>':''}<button class="view-btn" type="button" data-retry="${Number(m.email_id)}" data-uncertain="${m.status==='uncertain'}">Retry email</button>`:''}</section>`).join('');
 body.querySelectorAll('[data-retry]').forEach(b=>b.addEventListener('click',async()=>{
 if(b.dataset.uncertain==='true'&&!b.closest('section').querySelector('.ack').checked){error(new Error('Check Gmail Sent and acknowledge before retrying.'));return;}
 b.disabled=true;try{const d=await api('retry',{id:b.dataset.retry,confirm_uncertain:b.dataset.uncertain==='true'?'1':'0'});feedback.textContent=mailStatusText(d);await window.UWSuccess.show({title:'Email status updated',text:feedback.textContent||d.message||'Email retry completed.'});await show(id);}catch(err){error(err);b.disabled=false;}
 }));
 await api('read',{id});await notifications();
 }catch(e){if(request===generation)error(e);}
}
document.addEventListener('click',e=>{const b=e.target.closest('[data-view]');if(b)show(b.dataset.view);});
document.getElementById('closeAdminModal').addEventListener('click',()=>{generation++;modal.close();});
modal.addEventListener('cancel',()=>generation++);
const panel=document.getElementById('notificationsPanel'),toggle=document.getElementById('notificationsToggle');
toggle.addEventListener('click',()=>{panel.hidden=!panel.hidden;toggle.setAttribute('aria-expanded',String(!panel.hidden));if(!panel.hidden)notifications();});
async function notifications(){
 try{const r=await fetch('../controllers/admin-data.php?kind=notifications');if(!r.ok||!r.headers.get('content-type')?.includes('application/json'))throw new Error('Sign in again to refresh notifications.');const d=await r.json();if(d.csrf)cfg.csrf=d.csrf;
 document.getElementById('notificationCount').textContent=d.count;
 document.getElementById('notificationsList').innerHTML=d.items.map(n=>`<button type="button" data-view="${Number(n.user_id)}">${esc(n.user_fn+' '+n.user_ln)} submitted a lender application<small>${esc(n.submitted_at||'Earlier application — date not recorded')}</small></button>`).join('')||'<p>No unread applications.</p>';
 document.getElementById('notificationError').textContent='';
 }catch(e){document.getElementById('notificationError').textContent=e.message;}
}
notifications();setInterval(()=>{if(!document.hidden)notifications();},30000);
document.getElementById('menuToggle').addEventListener('click',e=>{const open=document.getElementById('sidebar').classList.toggle('open');e.currentTarget.setAttribute('aria-expanded',String(open));});
document.getElementById('sidebarClose').addEventListener('click',()=>{document.getElementById('sidebar').classList.remove('open');document.getElementById('menuToggle').setAttribute('aria-expanded','false');});
const id=new URLSearchParams(location.search).get('view');if(id)show(id);
})();
