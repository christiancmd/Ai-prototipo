document.addEventListener("DOMContentLoaded", () => {
  const sectionAside = document.querySelector("#principal-aside");
  const buttonAside = document.querySelector(".aside-hide-icon-box");

  console.log("actionAside.js loaded");

  buttonAside.addEventListener("click", () => {
    console.log("click aside button");

    sectionAside.classList.toggle("style-hide-aside");
  });
});
