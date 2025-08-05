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

function showLoginAlert(message, duration){
  // Get the specific part you want to attached
  const login = document.getElementById('login');

  // Create a div
  const alert = document.createElement('div');
  alert.classList.add('login-alert');
  alert.textContent = message;

  login.appendChild(alert);

  setTimeout(()=> {
    alert.style.opacity = '0';
    setTimeout(()=> alert.remove(), 400);
  }, duration);
}