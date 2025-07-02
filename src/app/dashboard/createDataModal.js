// DOM Elements
const modal = document.getElementById("patientModal");
const newPatientBtn = document.getElementById("createBtnModal");
const closeBtn = document.querySelector(".modal-close");

// Show modal with animation
newPatientBtn.addEventListener("click", () => {
  modal.style.display = "block";
  setTimeout(() => {
    modal.classList.add("show");
  }, 10);
});

// Close modal
const closeModal = () => {
  modal.classList.remove("show");
  setTimeout(() => {
    modal.style.display = "none";
  }, 300);
};

// Event listeners for closing
closeBtn.addEventListener("click", closeModal);
window.addEventListener("click", (e) => {
  if (e.target === modal) {
    closeModal();
  }
});

/*------------------------------------------------------------------------------------------ */
const form = document.getElementById("form");
form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const data = new FormData(form);

  const patientData = {
    name: data.get("name-data"),
    lastName: data.get("last-name-data"),
    idCardNumber: data.get("id-data"),
    email: data.get("email-data"),
    phone: data.get("number-data"),
    bornDate: data.get("born-data"),
    genre: data.get("gender-data"),
    weight: data.get("weight-data"),
    height: data.get("height-data"),
    reason: data.get("reason-data"),
    activity: data.get("activity-data"),
    patology: data.get("pathology-data"),
  };

  for (const [key, value] of Object.entries(patientData)) {
    if (!value || value.toString().trim() === "") {
      alert(`El campo ${key} está vacío.`);
      return;
    }
  }

  // console.log(patientData);

  try {
    const response = await fetch(
      "http://localhost/AI-healthy-project/src/controllers/modalRegisterPatient.php",
      {
        method: "POST",
        body: data,
      }
    );

    // Intenta parsear la respuesta del servidor como JSON
    const serverResponse = await response.json();
    console.log("Respuesta del servidor:", serverResponse);

    // Condicional para mostrar alert según la respuesta del servidor
    if (serverResponse.status === "success") {
      Swal.fire({
        title: "Registro Exitoso!",
        text: "Se ha registrado el paciente exitosamente!",
        icon: "success",
      }).then(() => {
        location.reload();
      });
    } else if (serverResponse.status === "error") {
      Swal.fire({
        icon: "error",
        title: "Registro Fallido",
        text: "El usuario ya existe en el sistema.",
      });
    } else {
      Swal.fire({
        icon: "warning",
        title: "Registro Fallido",
        text: "El usuario ya existe en el sistema.",
      });
    }
  } catch (error) {
    console.error("Error de: ", error);
    alert("Hubo un problema");
  }
});
