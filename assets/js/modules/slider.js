"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const sliderContainer = document.querySelector(".slider__wrapper");
  const sliderWrapper = document.querySelector(".slider__items");
  const sliderItems = document.querySelectorAll(".slider__item");

  if (!sliderContainer || !sliderWrapper || !sliderItems.length) {
    console.error("Required slider elements are missing");
    return;
  }

  let currentIndex = 0;
  let slidesToShow = 1;
  let centerPadding = 130;
  let startX = 0;
  let endX = 0;
  let isDragging = false;
  let autoScrollTimeout = null;

  function updateSlider() {
    const containerWidth = sliderContainer.offsetWidth;
    const itemWidth = (containerWidth - 2 * centerPadding) / slidesToShow;

    let offset;
    if (currentIndex === 0) {
      offset = 0;
    } else {
      offset = currentIndex * itemWidth - centerPadding;
    }
    sliderWrapper.style.transform = `translateX(-${offset}px)`;

    sliderItems.forEach((item, i) => {
      item.style.width = `${itemWidth}px`;

      const img = item.querySelector("img");
      if (img) {
        if (
          i === currentIndex ||
          (currentIndex === 0 && i === sliderItems.length - 1)
        ) {
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

  function startAutoScroll() {
    clearTimeout(autoScrollTimeout);
    autoScrollTimeout = setTimeout(() => {
      goToSlide(currentIndex + 1);
      startAutoScroll();
    }, 3000);
  }

  function resetAutoScroll() {
    startAutoScroll();
  }

  function handleStart(e) {
    isDragging = true;
    startX = e.type.includes("mouse") ? e.clientX : e.touches[0].clientX;
    e.preventDefault();
  }

  function handleMove(e) {
    if (!isDragging) return;
    endX = e.type.includes("mouse") ? e.clientX : e.touches[0].clientX;
  }

  function handleEnd() {
    if (!isDragging) return;
    isDragging = false;

    const deltaX = endX - startX;
    if (deltaX > 50) {
      goToSlide(currentIndex - 1);
      resetAutoScroll();
    } else if (deltaX < -50) {
      goToSlide(currentIndex + 1);
      resetAutoScroll();
    }

    startX = 0;
    endX = 0;
  }

  window.addEventListener("resize", updateResponsiveSettings);

  sliderContainer.addEventListener("touchstart", handleStart, {
    passive: false,
  });
  sliderContainer.addEventListener("touchmove", handleMove, { passive: false });
  sliderContainer.addEventListener("touchend", handleEnd);

  sliderContainer.addEventListener("mousedown", handleStart);
  sliderContainer.addEventListener("mousemove", handleMove);
  sliderContainer.addEventListener("mouseup", handleEnd);
  sliderContainer.addEventListener("mouseleave", handleEnd);

  sliderItems.forEach((item, index) => {
    item.addEventListener("click", () => {
      if (index === currentIndex) {
        goToSlide(currentIndex + 1);
      } else {
        goToSlide(index);
      }
      resetAutoScroll();
    });
  });

  updateResponsiveSettings();
  goToSlide(0);
  startAutoScroll();
});
