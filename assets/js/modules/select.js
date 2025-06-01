"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const DEFAULT_FLOOR = "1";
  const ITEM_WIDTH = 400;
  const MOBILE_BREAKPOINT = 576;

  const elements = {
    floorSelect: document.getElementById("floor"),
    cardWrappers: document.querySelectorAll(".select__card-wrapper"),
    stepDescrWrappers: document.querySelectorAll(".select__step-items"),
    nextButton: document.getElementById("next"),
    backButton: document.querySelector(".select__back"),
    primarySelectWrapper: document.getElementById("select1"),
    secondarySelectWrapper: document.getElementById("select2"),
    arrowLeft: document.getElementById("selectArrowLeft"),
    arrowRight: document.getElementById("selectArrowRight"),
    empty: document.querySelector(".select__card-empty"),
  };

  function setActiveFloor(floorValue) {
    elements.cardWrappers.forEach((wrapper) => {
      wrapper.classList.remove("select__card-wrapper--active");
    });
    elements.stepDescrWrappers.forEach((wrapper) => {
      wrapper.classList.remove("select__step-items--active");
    });

    if (elements.empty) {
      elements.empty.classList.remove("select__card-empty--active");
    }

    const activeWrapper = document.getElementById(`cardWrapper${floorValue}`);
    if (activeWrapper) {
      activeWrapper.classList.add("select__card-wrapper--active");
    } else {
      if (elements.empty) {
        elements.empty.classList.add("select__card-empty--active");
      } else {
        console.warn(
          `No card wrapper or empty message found for floor ${floorValue}`
        );
      }
    }

    const activeStepDescr = document.querySelector(
      `.select__step-items[data-floor="${floorValue}"]`
    );
    if (activeStepDescr) {
      activeStepDescr.classList.add("select__step-items--active");
    } else {
      console.warn(`No step description found for floor ${floorValue}`);
    }

    const stepImage = document.querySelector(".select__step-img");
    if (stepImage) {
      stepImage.className = stepImage.className.replace(
        /\bselect__step-img--\d+\b/g,
        ""
      );

      stepImage.classList.add(`select__step-img--${floorValue}`);
    }
  }

  function initFloorSelection() {
    setActiveFloor(DEFAULT_FLOOR);
    elements.floorSelect.addEventListener("change", (e) =>
      setActiveFloor(e.target.value)
    );
  }

  function initNavigation() {
    elements.nextButton.addEventListener("click", () => {
      elements.primarySelectWrapper.classList.remove("select__wrapper--active");
      elements.secondarySelectWrapper.classList.add("select__wrapper--active");
    });

    if (elements.backButton) {
      elements.backButton.addEventListener("click", () => {
        elements.secondarySelectWrapper.classList.remove(
          "select__wrapper--active"
        );
        elements.primarySelectWrapper.classList.add("select__wrapper--active");
      });
    } else {
      console.warn("Back button (.select__back) not found");
    }
  }

  function initCarousel() {
    if (window.innerWidth <= MOBILE_BREAKPOINT) return;

    let currentOffset = 0;
    const getActiveWrapper = () =>
      document.querySelector(".select__card-wrapper--active");

    const updateButtons = () => {
      const activeWrapper = getActiveWrapper();
      if (!activeWrapper) return;

      const itemCount =
        activeWrapper.querySelectorAll(".select__card-item").length;
      const minOffset = -(ITEM_WIDTH * (itemCount - 1));

      elements.arrowLeft.disabled = currentOffset === 0;
      elements.arrowRight.disabled = currentOffset === minOffset;
    };

    const moveCarousel = (direction) => {
      const activeWrapper = getActiveWrapper();
      if (!activeWrapper) return;

      const itemCount =
        activeWrapper.querySelectorAll(".select__card-item").length;
      const minOffset = -(ITEM_WIDTH * (itemCount - 1));

      if (direction === "left" && currentOffset < 0) {
        currentOffset += ITEM_WIDTH;
      } else if (direction === "right" && currentOffset > minOffset) {
        currentOffset -= ITEM_WIDTH;
      }

      activeWrapper.style.transform = `translateX(${currentOffset}px)`;
      updateButtons();
    };

    elements.arrowLeft.addEventListener("click", () => moveCarousel("left"));
    elements.arrowRight.addEventListener("click", () => moveCarousel("right"));

    updateButtons();
  }

  function init() {
    const requiredElements = {
      floorSelect: elements.floorSelect,
      cardWrappers: elements.cardWrappers,
      stepDescrWrappers: elements.stepDescrWrappers,
      nextButton: elements.nextButton,
      primarySelectWrapper: elements.primarySelectWrapper,
      secondarySelectWrapper: elements.secondarySelectWrapper,
    };

    if (!Object.values(requiredElements).every((el) => el)) {
      console.error("One or more required DOM elements are missing");
      return;
    }

    initFloorSelection();
    initNavigation();
    initCarousel();
  }

  init();
});
