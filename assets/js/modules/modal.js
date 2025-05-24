const modalTriggers = document.querySelectorAll(".modal-trigger");
const modalClose = document.querySelector(".modal__close");
const modal = document.querySelector(".modal");
const modalText = document.querySelector(".modal__text");
const modalThanks = document.querySelector(".modal__thanks");
const form = document.getElementById("form");
const modalContent = document.querySelector(".modal__content");

function initModal() {
  modalTriggers.forEach((trigger) => {
    trigger.addEventListener("click", () => {
      modal.classList.add("modal--active");
      modal.setAttribute("aria-hidden", "false");
      document.body.classList.add("no-scroll");
      if (modalText) {
        const firstInput = modalText.querySelector(".modal__input");
        if (firstInput) firstInput.focus();
      }
    });
  });

  modalClose.addEventListener("click", () => closeModal());

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal.classList.contains("modal--active")) {
      closeModal();
    }
  });

  document.addEventListener("click", (e) => {
    if (!modal.classList.contains("modal--active")) return;
    if (
      modalContent &&
      !modalContent.contains(e.target) &&
      !Array.from(modalTriggers).some((trigger) => trigger.contains(e.target))
    ) {
      closeModal();
    }
  });

  function closeModal() {
    modal.classList.remove("modal--active");
    modal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("no-scroll");
    resetModalContent();
  }

  function resetModalContent() {
    if (modalText) {
      const subheader = modalText.querySelector(".modal__subheader");
      const formElement = modalText.querySelector(".modal__form");
      if (subheader) subheader.classList.remove("modal__subheader--hidden");
      if (formElement) formElement.classList.remove("modal__form--hidden");
    }
    if (modalThanks) modalThanks.classList.add("modal__thanks--hidden");
  }
}
