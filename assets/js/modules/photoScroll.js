(function () {
  "use strict";

  window.addEventListener("DOMContentLoaded", () => {
    const photoScrollElements = document.querySelectorAll(
      ".advantages__items, .select-card__wrapper, .progress__item-images"
    );

    if (!photoScrollElements.length) {
      console.warn(
        "No scrollable elements found with classes .advantages__items, .select-card__wrapper, or .progress__item-images"
      );
      return;
    }

    const throttle = (func, delay) => {
      let lastCall = 0;
      return (...args) => {
        const now = new Date().getTime();
        if (now - lastCall < delay) return;
        lastCall = now;
        return func(...args);
      };
    };

    photoScrollElements.forEach((scrollContainer) => {
      let isDragging = false;
      let startX;
      let scrollLeft;

      scrollContainer.setAttribute("role", "region");
      scrollContainer.setAttribute("aria-label", "Scrollable content");
      scrollContainer.setAttribute("tabindex", "0");

      scrollContainer.addEventListener("mousedown", (e) => {
        isDragging = true;
        scrollContainer.classList.add("scroll-container--dragging");
        startX = (e.pageX || e.clientX) - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
      });

      scrollContainer.addEventListener("mouseleave", () => {
        isDragging = false;
        scrollContainer.classList.remove("scroll-container--dragging");
      });

      scrollContainer.addEventListener("mouseup", () => {
        isDragging = false;
        scrollContainer.classList.remove("scroll-container--dragging");
      });

      const handleMouseMove = throttle((e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = (e.pageX || e.clientX) - scrollContainer.offsetLeft;
        const walk = (x - startX) * 1;
        scrollContainer.scrollLeft = scrollLeft - walk;
      }, 16);

      scrollContainer.addEventListener("mousemove", handleMouseMove);

      scrollContainer.addEventListener("touchstart", (e) => {
        isDragging = true;
        startX = e.touches[0].pageX - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
      });

      scrollContainer.addEventListener("touchend", () => {
        isDragging = false;
      });

      scrollContainer.addEventListener("touchmove", (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.touches[0].pageX - scrollContainer.offsetLeft;
        const walk = (x - startX) * 1;
        scrollContainer.scrollLeft = scrollLeft - walk;
      });

      scrollContainer.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") {
          scrollContainer.scrollLeft -= 100;
        } else if (e.key === "ArrowRight") {
          scrollContainer.scrollLeft += 100;
        }
      });
    });
  });
})();
