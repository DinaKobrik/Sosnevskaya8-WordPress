"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const preloader = document.querySelector(".preloader");
  const promo = document.querySelector(".promo");
  const promoGradient = document.querySelector(".promo__gradient");

  if (!preloader) {
    console.warn("Preloader element not found");
    return;
  }
  if (!promo) {
    console.warn(
      "Promo section (.promo) not found, hiding preloader immediately"
    );
    preloader.classList.add("preloader--loading");
    setTimeout(() => {
      preloader.classList.add("preloader--hidden");
    }, 300);
    return;
  }
  if (!promoGradient) {
    console.warn(
      "Promo gradient (.promo__gradient) not found, proceeding with .promo background"
    );
  }

  const backgroundsToLoad = [];
  const elementsToCheck = [
    { element: promo, name: ".promo" },
    { element: promoGradient, name: ".promo__gradient" },
  ];

  elementsToCheck.forEach(({ element, name }) => {
    if (!element) return;

    const computedStyle = getComputedStyle(element);
    const backgroundImage = computedStyle.backgroundImage;


    const bgUrlMatch = backgroundImage.match(/url\(["']?([^"']+)["']?\)/);
    if (bgUrlMatch && bgUrlMatch[1]) {
      backgroundsToLoad.push({ url: bgUrlMatch[1], name });
    }
  });


  const completeLoading = () => {
    preloader.classList.add("preloader--loading");
    setTimeout(() => {
      preloader.classList.add("preloader--hidden");
    }, 300);
  };

  if (backgroundsToLoad.length === 0) {

    console.warn("No background images found for .promo or .promo__gradient");
    completeLoading();
    return;
  }


  let loadedCount = 0;
  backgroundsToLoad.forEach(({ url, name }) => {
    const bgImage = new Image();
    bgImage.src = url;

    bgImage.addEventListener("load", () => {
      loadedCount++;
      if (loadedCount === backgroundsToLoad.length) {
        completeLoading();
      }
    });
    bgImage.addEventListener("error", () => {
      console.warn(`Failed to load background image for ${name}: ${url}`);
      loadedCount++;
      if (loadedCount === backgroundsToLoad.length) {
        completeLoading();
      }
    });
  });
});
