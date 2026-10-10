(()=>{'use strict';const run=()=>{
 let data=null;const custom=document.getElementById('uwSuccessData');if(custom){try{data=JSON.parse(custom.textContent);}catch{}}
 if(!data){const n=document.querySelector('[data-uw-notice][data-uw-kind="success"]');if(n&&n.textContent.trim())data={title:'Saved successfully',text:n.textContent.trim()};}
 if(!data){for(const id of ['lenderNotice','adminFeedback','paymentMessage']){const n=document.getElementById(id);if(n&&!n.hidden&&n.textContent.trim()){data={title:'Saved successfully',text:n.textContent.trim()};break;}}}
 if(!data||!window.Swal)return;
 document.querySelectorAll('dialog[open]').forEach(d=>d.close());
 Swal.fire({icon:'success',title:data.title||'Submitted successfully',text:data.text,confirmButtonText:'OK',confirmButtonColor:'#062347',heightAuto:false,allowOutsideClick:false});
 };if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',run,{once:true});else run();})();
