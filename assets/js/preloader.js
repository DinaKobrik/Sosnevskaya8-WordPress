"use strict";

window.addEventListener("load", () => {
  const preloader = document.querySelector(".preloader");
  preloader.classList.add("preloader--loading");
  // preloader.style.opacity = "0";
  // preloader.style.transition = "opacity 0.5s";

  setTimeout(() => {
    preloader.classList.add("preloader--hidden");
  }, 500);
});
