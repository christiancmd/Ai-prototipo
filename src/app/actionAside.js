document.addEventListener("DOMContentLoaded", () => {
  const aside = document.getElementById("aside");
  const asideToggleButton = document.querySelector(".nav-icon");

  asideToggleButton.addEventListener("click", () => {
    aside.classList.toggle("active-show-aside");
  });
});
