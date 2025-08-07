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

function interfaceModal(type){
  switch (type) {
    case 'contact':
      showContactModal();
      break;
  
    default:
      break;
  }
}
function showContactModal(){
  const contact = document.getElementById('contact-modal');

  if (contact){
    contact.classList.add('active-modal');
  }

  setTimeout(()=> {
    contact.style.opacity = '1';
  }, 10);
}

function setModalType(type){

  fetch('/modal', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({type})
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);
  })
  .catch(error => {
    console.error('Error', error);
  })
  //PHP will do the work
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