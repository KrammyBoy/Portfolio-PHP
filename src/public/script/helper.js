"use strict";

const ToastIcons = {
  success: 'bx bx-check-circle',
  error: 'bx bx-x-circle',
  info: 'bx bx-info-circle',
};

Object.freeze(ToastIcons);


// Show toast
function showToast(message, type='info', timeout){
    //Create a div element
    const toast = document.createElement('div');
    toast.className = 'toast toast-' + type;

    const icon = document.createElement('i');
    icon.className = ToastIcons[type] || ToastIcons['info'];

    const text = document.createElement('span');
    text.textContent = message;

    toast.appendChild(icon);
    toast.appendChild(text);

    document.body.appendChild(toast);
    //Append child 
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.4s ease forwards';
        setTimeout(() => toast.remove(), 400); // wait for animation to finish
    }, timeout);
    //Set timeout
}
//Modal
function closeModal(action, type=null){
  const modal = document.querySelector(action);

  if (sessionStorage.getItem('credential_url') !== null ){
    sessionStorage.removeItem('credential_url');

    document.querySelector('#temporary-preview-type')?.remove();
    document.querySelector('#created-form')?.remove();

    const admin_form = document.createElement('div');
    admin_form.className = 'admin-form-group';
    admin_form.id = 'created-form';
    const label = document.createElement('label');
    label.className = 'form-label';
    const input = document.createElement('input');
    input.className = 'form-input';  
    label.textContent = 'Credential URL';

    input.type = 'text';
    input.id = 'credential_url';
    input.name = 'credential_url';
    input.placeholder = 'https://www.credly.com/badges/...';  
    admin_form.appendChild(label);
    admin_form.appendChild(input);
    const typeFieldGroup = document.querySelector('#type').closest('.admin-form-group');
    typeFieldGroup.insertAdjacentElement('afterend', admin_form);
  }
  modal.style.animation = 'fadeOut 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
  setTimeout(()=>{
    modal.style.display = 'none';
    modal.querySelector('form').reset();
    modal.querySelector('#preview').src = '';
  }, 200)
}

function showLoginAlert(message, duration){
  // Get the specific part you want to attached
  const login = document.getElementById('login-block');

  // Create a div
  const alert = document.createElement('div');
  alert.classList.add('login-alert');
  alert.textContent = message;

  // Find the h3
  const heading = login.querySelector('h3');

  if (heading && heading.nextSibling){
    login.insertBefore(alert, heading.nextSibling);
  }else {
    login.append(alert);
  }

  setTimeout(()=> {
    alert.style.opacity = '0';
    setTimeout(()=> alert.remove(), 400);
  }, duration);
}

function interfaceModal(type, action=null){
  switch (type) {
    case 'contact':
      showContactModal();
      break;
    case 'project':
      showProjectModal(action);
      break;
    case 'experience':
      showExperienceModal(action);
      break;
    case 'certificates':
      showCertificatesModal(action);
      break;
    case 'technologies':
      showTechnologiesModal(action);
      break;
    case 'projtech':
      showProjTechModal(action);
      break;
    default:
      break;
  }
}
function getRowDataById(projectId) {
  const rows = document.querySelectorAll('table tr');
  for (const row of rows) {

    const firstCell = row.querySelector('td');
    
    if (firstCell && firstCell.textContent.trim() == projectId) {
      //console.log(row.querySelector('img').src);
      let array = Array.from(row.querySelectorAll('td')).map(td => td.textContent.trim());
      //Change the image
      const img = row.querySelector('td img');
      if (img && img.src) {
        array[1] = img.src;
      }
      return array;
    }
  }
  return null; // not found
}
function showProjTechModal(actions, id=null){
  const modal = document.querySelector('.proj-tech-modal');

  if (actions === 'add'){
    modal.querySelector('.admin-modal-title').textContent = "Add Association";
    modal.querySelector('form').setAttribute('action', '/project-technologies/add');
    modal.querySelector('.modal-actions button[type="submit"]').textContent = "Add Association";
    modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    modal.style.display = 'flex';
  }
}
function showTechnologiesModal(actions, id=null){
  const modal = document.querySelector('.technologies-modal');

  if (actions === 'add'){
    modal.querySelector('.admin-modal-title').textContent = "Add Technologies";
    modal.querySelector('form').setAttribute('action', '/technologies/add');
    modal.querySelector('.modal-actions button[type="submit"]').textContent = "Add Technology";
    modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    modal.style.display = 'flex';
  }
  else  if (actions === 'update'){
    let rowValues = getRowDataById(id);
    modal.querySelector('.admin-modal-title').textContent = "Update Technology[" +rowValues[0] +"]";    

    const form = modal.querySelector('form');
    form.setAttribute('action', '/technologies/update');
    form.querySelector('#name').value = rowValues[1];
    form.querySelector('#boxicon').value = rowValues[2];
    form.querySelector('#category').value = rowValues[3];

    modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    modal.style.display = 'flex';

    //Adding ID to input
    const idHiddenField = document.createElement('input');
    idHiddenField.id = 'id';
    idHiddenField.type = 'hidden';
    idHiddenField.name = 'id';
    idHiddenField.value = rowValues[0];

    form.appendChild(idHiddenField);    
    
    form.querySelector('#button-submit').textContent = 'Update Technology';
  }
}
function showCertificatesModal(action, id=null){
  const modal = document.querySelector('.certificates-modal');

  if (action === 'add'){
    modal.querySelector('.admin-modal-title').textContent = "Add Certificates";
    modal.querySelector('form').setAttribute('action', '/certificates/add');
    modal.querySelector('.modal-actions button[type="submit"]').textContent = "Add Certificates";
    modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    modal.style.display = 'flex';

  } else if (action === 'update') {
    let rowValues = getRowDataById(id);
    modal.querySelector('.admin-modal-title').textContent = "Update Certificates[" +rowValues[0] +"]";

    const form = modal.querySelector('form');
    form.setAttribute('action', '/certificates/update');
    form.querySelector('#name').value = rowValues[1];
    form.querySelector('#issuer').value = rowValues[2];
    form.querySelector('#date_earned').value = new Date(rowValues[3]).toISOString().split("T")[0];

    //Something url versus type
    form.querySelector('#type').value = rowValues[5];
    //form.querySelector('#credential_url').value = rowValues[4];
    form.querySelector('#description').value = rowValues[6];

    fileUpload(JSON.stringify({
      'type': rowValues[5],
      'credential_url': rowValues[4]
    }));
    //
    modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    modal.style.display = 'flex';

    //Adding ID to input
    const idHiddenField = document.createElement('input');
    idHiddenField.id = 'id';
    idHiddenField.type = 'hidden';
    idHiddenField.name = 'id';
    idHiddenField.value = rowValues[0];

    form.appendChild(idHiddenField);    
    
    form.querySelector('#button-submit').textContent = 'Update Certificates';

  }
}
function showExperienceModal(action, id=null){
  const modal = document.querySelector('.experience-modal');

  if (action === 'add'){
    modal.querySelector('.admin-modal-title').textContent = "Add Experience";

    modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    modal.style.display = 'flex';

    form.querySelector('#button-submit').textContent = 'Add Experience';

  } else if (action === 'update'){
    let rowValues = getRowDataById(id);
    modal.querySelector('.admin-modal-title').textContent = "Update Experience[" +rowValues[0] +"]";

    const form = modal.querySelector('form');
    form.setAttribute('action', '/experiences/update');
    form.querySelector('#type').value = rowValues[1];
    form.querySelector('#description').value = rowValues[2];
    form.querySelector('#start_date').value = new Date(rowValues[3]).toISOString().split("T")[0];
    form.querySelector('#end_date').value = new Date(rowValues[4]).toISOString().split("T")[0];
    form.querySelector('#school').value = rowValues[5];
    form.querySelector('#degree').value = rowValues[6];
    modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    modal.style.display = 'flex';
    //Adding ID to input
    const idHiddenField = document.createElement('input');
    idHiddenField.id = 'id';
    idHiddenField.type = 'hidden';
    idHiddenField.name = 'id';
    idHiddenField.value = rowValues[0];

    form.appendChild(idHiddenField);    
    
    form.querySelector('#button-submit').textContent = 'Update Experience';
  }
}
function showProjectModal(action, id=null){
    const modal = document.querySelector('.project-modal');

    if (action === 'add'){
        modal.querySelector('.admin-modal-title').textContent = "Add Projects";
        modal.querySelector('form').setAttribute('action', '/addProject');
        modal.querySelector('.modal-actions button[type="submit"]').textContent = "Add Project";
        modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        modal.style.display = 'flex';

    } else if(action === 'update'){
        let rowValues = getRowDataById(id);

        modal.querySelector('.admin-modal-title').textContent = "Update Projects [" +rowValues[0]+"]";
        //Get the image using id

        const form = modal.querySelector('form');
        form.setAttribute('action', '/projects/update');
        form.querySelector('#preview').src = rowValues[1];
        form.querySelector('#preview').style = 'display: flex;'; 
        form.querySelector('#title').value = rowValues[2];
        form.querySelector('#description').value = rowValues[3];
        form.querySelector('#live-url').value = (rowValues[4] === 'null') ? null: rowValues[4];
        form.querySelector('#repo-url').value = (rowValues[5] === 'null') ? null: rowValues[5];
        form.querySelector('#status').value = rowValues[6];

        //Adding ID to input
        const idHiddenField = document.createElement('input');
        idHiddenField.id = 'id';
        idHiddenField.type = 'hidden';
        idHiddenField.name = 'id';
        idHiddenField.value = rowValues[0];

        form.appendChild(idHiddenField);

        modal.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        modal.style.display = 'flex';
    }
}
function showContactModal(){
  const contact = document.querySelector('.modal-overlay');
  contact.style.animation = 'fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
  contact.style.display = 'flex';
}

// Upload Change
function fileUpload(uploadValue = null) {
  const form = document.querySelector('.certificates-modal form');
  const type = document.getElementById('type').value;

  if (uploadValue !== null){
    //Save to session storage
    sessionStorage.setItem('credential_url', uploadValue);
  }

  // Remove any old created-form if it exists
  const oldForm = document.getElementById('created-form');
  if (oldForm) {
    oldForm.remove();
  }

  // Create wrapper
  const admin_form = document.createElement('div');
  admin_form.className = 'admin-form-group';
  admin_form.id = 'created-form';

  // Label
  const label = document.createElement('label');
  label.className = 'form-label';

  // Input
  const input = document.createElement('input');
  input.className = 'form-input';

  //Saved Link
  const savedLink = JSON.parse(sessionStorage.getItem('credential_url'));

  if (type === 'File') {
    label.textContent = 'Upload File';

    input.type = 'file';
    input.id = 'credential_url';
    input.name = 'credential_url';
    input.accept = '.pdf,.jpg,.png'; // optional, allowed file types


    if (savedLink !== null && savedLink.type === 'File'){

      const preview = document.createElement('a');
      preview.href = savedLink.credential_url;  // e.g. URL to file from server
      preview.textContent = "View uploaded file";
      preview.style= 'color: blue; margin-left: 1rem';
      preview.id = 'temporary-preview-type'
      preview.target = "_blank";
      label.appendChild(preview);
    }
  } 
  else if (type === 'Url') {
    label.textContent = 'Credential URL';

    input.type = 'text';
    input.id = 'credential_url';
    input.name = 'credential_url';
    input.placeholder = 'https://www.credly.com/badges/...';

    if (savedLink !== null && savedLink.type === 'Url'){
      input.value = savedLink.credential_url;
    }
  }

  // Combine
  admin_form.appendChild(label);
  admin_form.appendChild(input);

  // 🔑 Insert AFTER the Type field group
  const typeFieldGroup = document.querySelector('#type').closest('.admin-form-group');
  typeFieldGroup.insertAdjacentElement('afterend', admin_form);
}


        // Update time and date
        function updateDateTime() {
            const now = new Date();
            const timeOptions = { 
                timeZone: 'Asia/Manila',
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const dateOptions = { 
                timeZone: 'Asia/Manila',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            
            document.getElementById('current-time').textContent = now.toLocaleTimeString('en-US', timeOptions);
            document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', dateOptions);
        }
        // Page visits chart
        //TODO should be a function or it should have an api call
        const visitsCtx = document.getElementById('visitsChart').getContext('2d');
        new Chart(visitsCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Page Visits',
                    data: [1250, 1890, 2100, 1675, 2340, 1980, 2150],
                    borderColor: '#5d001e',
                    backgroundColor: 'rgba(93, 0, 30, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#5d001e',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#3a3a3c'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#3a3a3c'
                        }
                    }
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#8b5cf6'
                    }
                }
            }
        });  
        //TODO: Probably create a one function to animate all stats
        function animateStats() {
            const stats = document.querySelectorAll('.stat-number');
            stats.forEach(stat => {
                const target = parseInt(stat.textContent.replace(/\D/g, '')) || 0;
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        stat.textContent = stat.textContent.includes('+') ? target + '+' : target;
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current);
                    }
                }, 40);
            });
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);
              