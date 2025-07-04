"use strict";

window.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".phone").forEach((item) => {
    item.innerHTML = item.innerHTML.replace(
      /(\+\d)(\d{3})(\d{3})(\d{2})(\d{2})/,
      "$1 ($2) $3-$4-$5"
    );
  });
});
