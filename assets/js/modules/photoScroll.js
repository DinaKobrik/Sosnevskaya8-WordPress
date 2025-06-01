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

    photoScrollElements.forEach((scrollContainer) => {
      // Настройка доступности
      scrollContainer.setAttribute("role", "region");
      scrollContainer.setAttribute("aria-label", "Scrollable content");
      scrollContainer.setAttribute("tabindex", "0");

      let isDragging = false;
      let startX, startY;
      let deltaXAccumulated = 0;
      const swipeThreshold = 50; // Порог для свайпа

      // Получаем ширину элемента (например, первой карточки)
      const getScrollStep = () => {
        const firstItem = scrollContainer.querySelector("*");
        return firstItem
          ? firstItem.offsetWidth +
              parseInt(getComputedStyle(firstItem).marginRight || 0)
          : 300; // Запасной шаг 300px
      };

      // Обработчик начала свайпа/перетаскивания
      const handleStart = (x, y) => {
        isDragging = true;
        startX = x;
        startY = y;
        deltaXAccumulated = 0;
        scrollContainer.classList.add("scroll-container--dragging");
      };

      // Обработчик движения
      const handleMove = (x, y, isTouch = false) => {
        if (!isDragging) return;

        const deltaX = x - startX;
        const deltaY = y - startY;
        const absDeltaX = Math.abs(deltaX);
        const absDeltaY = Math.abs(deltaY);

        // Игнорируем вертикальный скролл
        if (absDeltaY > absDeltaX && absDeltaY > 20) {
          isDragging = false;
          return;
        }

        // Предотвращаем только горизонтальный скролл
        if (isTouch && event.cancelable && absDeltaX > absDeltaY) {
          event.preventDefault();
        }

        deltaXAccumulated += deltaX;
        const scrollStep = getScrollStep();

        // Прокручиваем, если накопленное смещение превышает порог
        if (Math.abs(deltaXAccumulated) > swipeThreshold) {
          const direction = deltaXAccumulated > 0 ? -1 : 1;
          scrollContainer.scrollBy({
            left: direction * scrollStep,
            behavior: "smooth",
          });
          deltaXAccumulated = 0; // Сбрасываем накопленное смещение
        }

        startX = x; // Обновляем начальную точку
      };

      // Обработчик окончания
      const handleEnd = () => {
        isDragging = false;
        scrollContainer.classList.remove("scroll-container--dragging");
      };

      // События для мыши
      scrollContainer.addEventListener("mousedown", (e) => {
        handleStart(e.clientX, e.clientY);
      });

      scrollContainer.addEventListener("mousemove", (e) => {
        handleMove(e.clientX, e.clientY);
      });

      scrollContainer.addEventListener("mouseup", handleEnd);
      scrollContainer.addEventListener("mouseleave", handleEnd);

      // События для сенсорных устройств
      scrollContainer.addEventListener("touchstart", (e) => {
        handleStart(e.touches[0].clientX, e.touches[0].clientY);
      });

      scrollContainer.addEventListener("touchmove", (e) => {
        handleMove(e.touches[0].clientX, e.touches[0].clientY, true);
      });

      scrollContainer.addEventListener("touchend", handleEnd);

      // Поддержка клавиш
      scrollContainer.addEventListener("keydown", (e) => {
        const scrollStep = getScrollStep();
        if (e.key === "ArrowLeft") {
          scrollContainer.scrollBy({ left: -scrollStep, behavior: "smooth" });
        } else if (e.key === "ArrowRight") {
          scrollContainer.scrollBy({ left: scrollStep, behavior: "smooth" });
        }
      });

      // Поддержка колеса мыши
      scrollContainer.addEventListener(
        "wheel",
        (e) => {
          const deltaX = e.deltaX;
          const deltaY = e.deltaY;
          const absDeltaX = Math.abs(deltaX);
          const absDeltaY = Math.abs(deltaY);

          if (absDeltaX >= absDeltaY || absDeltaY < 50) {
            if (e.cancelable) {
              e.preventDefault();
            }
            const scrollStep = getScrollStep();
            const direction = (deltaX || deltaY) > 0 ? 1 : -1;
            scrollContainer.scrollBy({
              left: direction * scrollStep,
              behavior: "smooth",
            });
          }
        },
        { passive: false }
      );
    });
  });
})();
