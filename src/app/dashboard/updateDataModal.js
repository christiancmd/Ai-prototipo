const btnUpdate = Array.from(document.querySelectorAll(".btn-edit"));
// DOM Elements
const updateModal = document.getElementById("updatePatientModal");
const closeModalBtn = document.querySelector(".update-modal-close");

async function handleShowUpdateModal(event) {
  const id = event.currentTarget.id;

  if (!id) {
    console.error("ID not found for the update button.");
    return;
  }

  // Mostrar el modal
  updateModal.style.display = "block";
  setTimeout(() => {
    updateModal.classList.add("show");
  }, 10);

  try {
    const response = await fetch(
      "http://localhost/AI-healthy-project/src/controllers/modalUpdatePatient.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id }),
      }
    );

    if (!response.ok) {
      throw new Error(`Error del servidor: ${response.status}`);
    }

    const data = await response.json();

    if (data.status === "success") {
      console.log("Mensaje: ", data.message);
      console.log("Datos del paciente:", data.data);
    } else {
      console.log("Error: ", data.message);
    }

    const patient = data.data[0]; // accede al primer (y único) paciente

    console.log("Datos del paciente:", patient);

    document.getElementById("name-data-update").value = patient.Name || "";
    document.getElementById("last-name-data-update").value =
      patient.Last_name || "";
    document.getElementById("id-data-update").value =
      patient.Id_card_number || "";
    document.getElementById("email-data-update").value = patient.Email || "";
    document.getElementById("number-data-update").value = patient.Contact || "";
    document.getElementById("born-data-update").value = patient.Age || "";

    document.getElementById("weigth-data-update").value = patient.Weigth || "";
    document.getElementById("heigth-data-update").value = patient.Tall || "";
    document.getElementById("activity-data-update").value =
      patient.Activity || "";
    document.getElementById("reason-data-update").value = patient.Reason || "";
    document.getElementById("pathology-data-update").value =
      patient.Pathology || "";

    // Género
    /* if (patient.Genre === "Masculino") {
      document.getElementById("check-male-update").checked = true;
    } else if (patient.Genre === "Femenino") {
      document.getElementById("check-female-update").checked = true;
    }*/

    // Agrega más campos según lo que devuelva tu backend
  } catch (error) {
    console.error("Error al obtener los datos del paciente:", error);
  }
}

// Close modal
const handleCloseModal = () => {
  updateModal.classList.remove("show");
  setTimeout(() => {
    updateModal.style.display = "none";
  }, 300);
};

// Event listeners for closing
closeModalBtn.addEventListener("click", handleCloseModal);
window.addEventListener("click", (e) => {
  if (e.target === updateModal) {
    handleCloseModal();
  }
});

for (const btn of btnUpdate) {
  btn.addEventListener("click", handleShowUpdateModal);
}

/*------------------------------------------------------------------------------------------ */
const updateForm = document.getElementById("form-update");
updateForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const data = new FormData(updateForm);

  const patientDataToUpdate = {
    name: data.get("name-data-update"),
    lastName: data.get("last-name-data-update"),
    idCardNumber: data.get("id-data-update"),
    email: data.get("email-data-update"),
    phone: data.get("number-data-update"),
    bornDate: data.get("born-data-update"),
    // genre
    weight: data.get("weight-data-update"),
    height: data.get("height-data-update"),
    reason: data.get("reason-data-update"),
    activity: data.get("activity-data-update"),
    patology: data.get("pathology-data-update"),
  };

  for (const [key, value] of Object.entries(patientDataToUpdate)) {
    if (!value || value.toString().trim() === "") {
      alert(`El campo ${key} está vacío.`);
      return;
    }
  }

  console.log(patientDataToUpdate);

  try {
    const response = await fetch(
      "http://localhost/AI-healthy-project/src/controllers/updateDataPatient.php",
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
      console.log("Mensaje: ", serverResponse.message);

      Swal.fire({
        title: "Actualizacion Exitosa!",
        text: "Se ha registrado el paciente exitosamente!",
        icon: "success",
      }).then(() => {
        location.reload();
      });
    } else if (serverResponse.status === "error") {
      console.log("Mensaje: ", serverResponse.message);

      Swal.fire({
        icon: "error",
        title: "Actualizacion Fallido",
        text: "El usuario ya existe en el sistema.",
      });
    } else {
      console.log("Mensaje: ", serverResponse.message);

      Swal.fire({
        icon: "warning",
        title: "Actualizacion Fallido",
        text: "El usuario ya existe en el sistema.",
      });
    }
  } catch (error) {
    console.error("Error de: ", error);
    alert("Hubo un problema");
  }
});
