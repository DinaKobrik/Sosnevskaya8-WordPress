function validateFormAndSubmit(formSelector) {
  const form = document.getElementById(formSelector);

  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    let isValid = true;

    form.querySelectorAll(".error-input").forEach((input) => {
      input.classList.remove("error-input");
    });

    const nameInput = form.querySelector("[name='name']");
    if (nameInput) {
      if (nameInput.value.trim() === "" || nameInput.value.trim().length < 2) {
        isValid = false;
        nameInput.classList.add("error-input");
      }
    }

    const phoneInput = form.querySelector("[name='phone']");
    if (phoneInput) {
      const phonePattern = /^\+?\d{10,15}$/;
      if (
        phoneInput.value.trim() === "" ||
        !phonePattern.test(phoneInput.value.trim())
      ) {
        isValid = false;
        phoneInput.classList.add("error-input");
      }
    }

    const emailInput = form.querySelector("[name='email']");
    if (emailInput) {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (
        emailInput.value.trim() === "" ||
        !emailPattern.test(emailInput.value.trim())
      ) {
        isValid = false;
        emailInput.classList.add("error-input");
      }
    }

    if (!isValid) {
      return;
    }

    const formData = new FormData(form);

    fetch(wpData.ajaxUrl, {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Ошибка отправки формы");
        }
        return response.text();
      })
      .then(() => {
        form.querySelectorAll("input").forEach((input) => (input.value = ""));

        modalThanks.classList.add("modal__thanks--visible");
        modalText.classList.add("modal__text--hidden");

        form.reset();
      })
      .catch((error) => {
        console.error("Ошибка:", error);
      });
  });
}
initModal();
validateFormAndSubmit("form");
