document.addEventListener('DOMContentLoaded', () => {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(link => {
    link.classList.toggle('active', link.getAttribute('href') === currentPath);
  });

  //Check if the current path is projects
  if (currentPath.includes('projects')) {
    const statusID = new URLSearchParams(window.location.search).get('status_id');
    if (statusID) {
      document.querySelectorAll('.stat-item-project').forEach(item => {
        item.classList.remove('selected');
      });
      const selectedItem = document.querySelector(`.stat-item-project[data-status-id="${statusID}"]`);
      if (selectedItem) {
        selectedItem.classList.add('selected');
      }
    }
  }
});

document.getElementById('logoutBtn').addEventListener('click', ()=> {
  window.location.href="/logout";
});

function toggleMobileMenu() {
  const mobileMenu = document.querySelector(".mobile-menu");
  const mobileToggle = document.querySelector(".mobile-toggle");

  mobileMenu.classList.toggle("active");
  mobileToggle.classList.toggle("active");
}

document.querySelectorAll(".mobile-link").forEach((link) => {
  link.addEventListener("click", () => {
    const mobileMenu = document.querySelector(".mobile-menu");
    const mobileToggle = document.querySelector(".mobile-toggle");

    mobileMenu.classList.remove("active");
    mobileToggle.classList.remove("active");
  });
});


window.addEventListener("resize", () => {
  if (window.innerWidth > 768) {
    const mobileMenu = document.querySelector(".mobile-menu");
    const mobileToggle = document.querySelector(".mobile-toggle");

    mobileMenu.classList.remove("active");
    mobileToggle.classList.remove("active");
  }
});

function filterProjects(statusID, element){
  // Remove active class from all status
  document.querySelectorAll('.stat-item').forEach(item => {
    item.classList.remove('.selected');
  });

  element.classList.add('.selected');

  window.location.href = `?status_id=${statusID}`;
}

// File Preview
const fileInput = document.querySelector('.project-modal #image');
const previewImg  = document.querySelector('.project-modal #preview');

fileInput.addEventListener('change', ()=> {
  const file = fileInput.files[0];

  if (file){
    previewImg.src = URL.createObjectURL(file);
        previewImg.style.display = 'block';
  } else {
      previewImg.src = '';
      previewImg.style.display = 'none';
  }
});