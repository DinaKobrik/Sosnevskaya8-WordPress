"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const yearButtons = document.querySelectorAll(".progress__year");
  const progressItems = document.querySelectorAll(".progress__item");

  yearButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const selectedYear = button.getAttribute("data-year");

      yearButtons.forEach((btn) =>
        btn.classList.remove("progress__year--active")
      );
      button.classList.add("progress__year--active");

      progressItems.forEach((item) => {
        if (
          selectedYear === "all" ||
          item.getAttribute("data-year") === selectedYear
        ) {
          item.style.display = "grid";
        } else {
          item.style.display = "none";
        }
      });
    });
  });

  if (yearButtons.length > 0) {
    yearButtons[0].click();
  }
});
