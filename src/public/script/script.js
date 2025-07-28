document.addEventListener('DOMContentLoaded', () => {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(link => {
    link.classList.toggle('active', link.getAttribute('href') === currentPath);
  });
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
