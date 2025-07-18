//////////////////////////////////////////////////////////////////////////////////////////////////////
/*Button active-nav-mobile */

const active_nav_mobile_button = document.querySelector("#active-nav-button");
const navigator = document.querySelector(".ul-list-mobile");

const action_nav_Mobile = () => {
  navigator.classList.toggle("action-nav");
};

function active_nav_mobile(e) {
  navigator.classList.toggle("action-nav");
  const close_button = document.querySelector("#icon-close");
  close_button.addEventListener("click", action_nav_Mobile);
}

const handle_resize = () => {
  if (navigator.id !== "nav-php") {
    if (window.innerWidth > 1000) {
      navigator.classList.remove("ul-list-mobile");
      navigator.classList.add("ul-nav-desktop");
    } else {
      navigator.classList.remove("ul-nav-desktop");
      navigator.classList.add("ul-list-mobile");
      // navigator.classList.remove('action-nav');
    }
  }
};

active_nav_mobile_button.addEventListener("click", active_nav_mobile);
window.addEventListener("resize", handle_resize);
window.addEventListener("load", handle_resize);
