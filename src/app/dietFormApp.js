const prevBtns = document.querySelectorAll(".prev-btn");
const nextBtns = document.querySelectorAll(".next-btn");
const steps = document.querySelectorAll(".step");
const stepContents = document.querySelectorAll(".step-content");
const form = document.getElementById("form");

let currentStep = 1;

function updateSteps() {
  steps.forEach((step, index) => {
    step.classList.remove("active");
    if (index < currentStep) {
      step.classList.add("active");
    }
  });

  stepContents.forEach((content) => {
    content.classList.remove("active");
  });

  document.getElementById(`step${currentStep}`).classList.add("active");
}

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    currentStep++;
    if (currentStep > steps.length) {
      currentStep = steps.length;
    }
    updateSteps();
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    currentStep--;
    if (currentStep < 1) {
      currentStep = 1;
    }
    updateSteps();
  });
});

updateSteps(); // Inicializar la visualización del primer paso

form.addEventListener("submit", (event) => {
  event.preventDefault();
  alert("¡Formulario enviado!"); // Aquí puedes agregar la lógica para enviar los datos
  //Puedes recopilar los datos del formulario aquí:
  const formData = new FormData(form);
  console.log(formData);

  for (const [key, value] of formData.entries()) {
    console.log(`${key}: ${value}`);
  }
});

/*Add observation */
/*
const skillInput = document.getElementById("observation-input");
const skillsList = document.getElementById("obeservations-list");
const obsButton = document.getElementById("observation-add");

function addSkill() {
  const skillText = skillInput.value.trim();
  if (skillText) {
    const chip = document.createElement("div");
    chip.classList.add("chip");
    chip.textContent = skillText;

    const deleteButton = document.createElement("button");
    deleteButton.classList.add("buttonX");
    deleteButton.textContent = " x";
    deleteButton.onclick = function () {
      chip.remove();
    };

    chip.appendChild(deleteButton);
    skillsList.appendChild(chip);
    skillInput.value = ""; // Limpiar el input después de agregar
  }

  if (skillsList.childNodes.length > 3) {
    alert("No puedes agregar más de 3 observaciones.");
    skillsList.removeChild(skillsList.lastChild); // Eliminar la última observación agregada
  }
}

// Permitir agregar con la tecla Enter // revisaaaaar
skillInput.addEventListener("keypress", function (event) {
  if (event.key === "Enter") {
    addSkill();
  }
});

obsButton.addEventListener("click", addSkill);
*/
