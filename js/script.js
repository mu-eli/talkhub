const yearEl = document.querySelector(".year");
const currentYear = new Date().getFullYear();
yearEl.textContent = currentYear;

const btnNavEl = document.querySelector(".btn-mobile--nav");
const headerEl = document.querySelector(".header");
btnNavEl.addEventListener("click", function () {
  headerEl.classList.toggle("nav-open");
});

document.addEventListener("DOMContentLoaded", () => {
  const currentPage = location.pathname.split("/").pop();
  const navLinks = document.querySelectorAll(".main-nav--link");
  navLinks.forEach((link) => {
    if (
      link.getAttribute("href") === currentPage ||
      (currentPage === "" && link.getAttribute("href") === "index.html")
    ) {
      link.classList.add("active");
    }
  });
});
