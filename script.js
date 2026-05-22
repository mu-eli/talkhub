const yearEl = document.querySelector(".year");
if (yearEl) {
  const currentYear = new Date().getFullYear();
  yearEl.textContent = currentYear;
}

const btnNavEl = document.querySelector(".btn-mobile--nav");
const headerEl = document.querySelector(".header");
if (btnNavEl && headerEl) {
  btnNavEl.addEventListener("click", function () {
    headerEl.classList.toggle("nav-open");
  });
}

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

  const params = new URLSearchParams(window.location.search);
  const status = params.get("status");
  const statusEl = document.getElementById("form-status");

  if (statusEl && (status === "success" || status === "error")) {
    statusEl.className =
      status === "success"
        ? "form-alert form-alert--success"
        : "form-alert form-alert--error";
    statusEl.textContent =
      status === "success"
        ? "✓ Your message was sent! We'll get back to you soon."
        : "✗ Something went wrong. Please try again or email us directly.";
  }
});
