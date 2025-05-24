"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const categoryButtons = document.querySelectorAll(".mortgage__category");
  const categoryTables = document.querySelectorAll(".banks__category");

  categoryButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const selectedCategory = button.getAttribute("data-category");

      categoryButtons.forEach((btn) =>
        btn.classList.remove("mortgage__category--active")
      );
      button.classList.add("mortgage__category--active");

      categoryTables.forEach((table) => {
        if (table.getAttribute("data-category") === selectedCategory) {
          table.classList.add("banks__category--active");
        } else {
          table.classList.remove("banks__category--active");
        }
      });
    });
  });

  if (categoryButtons.length > 0) {
    categoryButtons[0].click();
  }
});
