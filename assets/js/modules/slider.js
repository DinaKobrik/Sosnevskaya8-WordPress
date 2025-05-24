"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const sliderContainer = document.querySelector(".slider__wrapper");
  const sliderWrapper = document.querySelector(".slider__items");
  const sliderItems = document.querySelectorAll(".slider__item");

  let currentIndex = 0;
  let slidesToShow = 1;
  let centerPadding = 130;
  let startX = 0;
  let endX = 0;

  function updateSlider() {
    const containerWidth = sliderContainer.offsetWidth;
    const itemWidth = (containerWidth - 2 * centerPadding) / slidesToShow;

    sliderWrapper.style.transform = `translateX(-${
      currentIndex * itemWidth - centerPadding
    }px)`;

    sliderItems.forEach((item, i) => {
      item.style.width = `${itemWidth}px`;

      const img = item.querySelector("img");
      if (img) {
        if (i === currentIndex || i === sliderItems.length - 1) {
          img.style.filter = "brightness(100%)";
          img.style.zIndex = "10";
        } else {
          img.style.filter = "brightness(60%)";
          img.style.zIndex = "1";
        }
      }
    });
  }

  function goToSlide(index) {
    if (index < 0) {
      currentIndex = sliderItems.length - 1;
    } else if (index >= sliderItems.length) {
      currentIndex = 0;
    } else {
      currentIndex = index;
    }
    updateSlider();
  }

  function updateResponsiveSettings() {
    const viewportWidth = window.innerWidth;

    if (viewportWidth <= 480) {
      centerPadding = 10;
    } else if (viewportWidth <= 1260) {
      centerPadding = 20;
    } else {
      centerPadding = 130;
    }

    updateSlider();
  }

  window.addEventListener("resize", updateResponsiveSettings);

  sliderContainer.addEventListener("touchstart", (e) => {
    startX = e.touches[0].clientX;
  });

  sliderContainer.addEventListener("touchmove", (e) => {
    endX = e.touches[0].clientX;
  });

  sliderContainer.addEventListener("touchend", () => {
    const deltaX = endX - startX;

    if (deltaX > 50) {
      goToSlide(currentIndex - 1);
    } else if (deltaX < -50) {
      goToSlide(currentIndex + 1);
    }

    startX = 0;
    endX = 0;
  });

  setInterval(() => {
    goToSlide(currentIndex + 1);
  }, 3000);

  sliderItems.forEach((item, index) => {
    item.addEventListener("click", () => {
      if (index === currentIndex) {
        goToSlide(currentIndex + 1);
      } else {
        goToSlide(index);
      }
    });
  });

  updateResponsiveSettings();
  goToSlide(0);
});
