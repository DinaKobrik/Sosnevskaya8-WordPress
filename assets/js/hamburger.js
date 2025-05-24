"use strict";

window.addEventListener("DOMContentLoaded", () => {
  const elements = {
    hamburgers: document.querySelectorAll(".hamburger"),
    menuClose: document.querySelector(".menu__close"),
    nav: document.querySelector(".menu__overlay"),
    menuLinks: document.querySelectorAll(".menu__link"),
    menu:
      document.querySelector(".menu") ||
      document.querySelector(".menu__overlay"),
  };

  if (!elements.hamburgers.length || !elements.menuClose || !elements.nav) {
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

  function toggleMenu(isOpen) {
    const method = isOpen ? "add" : "remove";
    elements.nav.classList[method]("menu__overlay--active");
    document.body.classList[method]("no-scroll");

    elements.hamburgers.forEach((hamburger) => {
      hamburger.setAttribute("aria-expanded", isOpen);
    });
  }

  function initMenu() {
    elements.hamburgers.forEach((hamburger) => {
      hamburger.addEventListener("click", () => toggleMenu(true));
    });

    elements.menuClose.addEventListener("click", () => toggleMenu(false));

    elements.menuLinks.forEach((link) => {
      link.addEventListener("click", () => toggleMenu(false));
    });

    document.addEventListener("click", (e) => {
      if (!elements.nav.classList.contains("menu__overlay--active")) return;
      if (
        !elements.menu.contains(e.target) &&
        !Array.from(elements.hamburgers).some((hamburger) =>
          hamburger.contains(e.target)
        )
      ) {
        toggleMenu(false);
      }
    });

    document.addEventListener("keydown", (e) => {
      if (
        e.key === "Escape" &&
        elements.nav.classList.contains("menu__overlay--active")
      ) {
        toggleMenu(false);
      }
    });
  }

  const handleResize = throttle(() => {
    if (
      window.innerWidth >= 1070 &&
      elements.nav.classList.contains("menu__overlay--active")
    ) {
      toggleMenu(false);
    }
  }, 200);

  function init() {
    initMenu();
    window.addEventListener("resize", handleResize);

    elements.hamburgers.forEach((hamburger) => {
      hamburger.setAttribute("aria-expanded", "false");
    });
  }

  init();
});

document.addEventListener("DOMContentLoaded", () => {
  const menuLinks = document.querySelectorAll(".menu__link");
  const upLink = document.querySelector(".up a");
  const isMainPage = window.location.pathname === "/";

  menuLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      const targetId = link.getAttribute("href");

      if (!isMainPage) {
        sessionStorage.setItem("scrollToSection", targetId);
        window.location.href = "/";
      } else {
        const targetSection = document.querySelector(targetId);
        if (targetSection) {
          const offsetTop = targetSection.offsetTop;
          window.scrollTo({
            top: offsetTop,
            behavior: "smooth",
          });
        } else {
          console.warn(`Section with ID ${targetId} not found`);
        }
      }
    });
  });

  if (upLink) {
    upLink.addEventListener("click", (event) => {
      event.preventDefault();
      const targetId = upLink.getAttribute("href");
      const targetSection = document.querySelector(targetId);

      if (targetSection) {
        const offsetTop = targetSection.offsetTop;
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      } else {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
        console.warn(`Section with ID ${targetId} not found, scrolling to top`);
      }
    });
  }

  if (isMainPage) {
    const targetId = sessionStorage.getItem("scrollToSection");
    if (targetId) {
      const targetSection = document.querySelector(targetId);
      if (targetSection) {
        const offsetTop = targetSection.offsetTop;
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      } else {
        console.warn(`Section with ID ${targetId} not found`);
      }
      sessionStorage.removeItem("scrollToSection");
    }
  }
});
